<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Url;
use App\Models\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Icons;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(){

        session_start();

        $this->params = [
            'short' => isset( $_GET['short'] ) ? $_GET['short'] : null,
            'search' => isset( $_GET['search'] ) ? $_GET['search'] : false
        ];
        $this->styles = [
            'sections' => [
                'background' => 'style="background: rgba(255, 255, 255, 0.9)"'
            ]
        ];

        $this->windowSize = $_SESSION['windowSize'] ?? [];

    }

    public function generateDeleteButton($id) {
    
        return '<td class="p-4 text-gray-600 align-middle [&:has([role=checkbox])]:pr-0">
                <label class="cursor-pointer" for="delete'.$id.'">'.Icons::Icon('icon-trash').'</label>
                <input hidden type="button" onclick="window.location.href = \'users/delete/'.$id.'\'" id="edit'.$id.'" value="Edit" />
            </td>';

    }


    public function generateEditButton($url, $data) {
    
        $content_data = [];
    
        foreach ($data as $key => $d) {
            $content_data[$key] = $d;
        }
    
        return '<td class="p-4 text-gray-600 align-middle [&:has([role=checkbox])]:pr-0">
                <label class="cursor-pointer" for="edit'.$content_data['id'].'">'.Icons::Icon('icon-edit').'</label>
                <input hidden type="button" onclick="window.location.href = \''.$url.'?data=' . base64_encode(json_encode($content_data)).'\'" id="edit'.$content_data['id'].'" value="Edit" />
            </td>';

    }

    /*
    *
        *   @method generatePagination 
        *   @params data
    *
    */
    public function generatePagination( $data ){
        
        return "<nav role='navigation' aria-label='pagination' class='mx-auto flex w-full justify-center mt-6'>
            <ul class='flex flex-row items-center gap-1'>
                <!-- Previous page link -->
                <li>
                    <a href='{$data->previousPageUrl()}' class='pagination-link'>&laquo; Previous</a>
                </li>
                <!-- Pagination elements -->
                " . 
                implode('', array_map(function($i) use ($data) {
                    return "<li>
                                <a href='{$data->url($i)}' class='pagination-link" . ($i == $data->currentPage() ? ' active' : '') . "'>$i</a>
                            </li>";
                }, range(1, $data->lastPage()))) . "
                <!-- Next page link -->
                <li>
                    <a href='{$data->nextPageUrl()}' class='pagination-link'>Next &raquo;</a>
                </li>
            </ul>
        </nav>";

    }

    /*
    *
        *   @method generateTable 
        *   @params table name of the table to generate
        *   @params type of the table to generate
        *   @screen of render if pc , tablet or movile
    *
    */
    public function generateTable( $data , $type ){
        
        $content_table = '';
        $table = '';

        $columns = [];

        foreach ($data[0] as $key => $d) {
            $columns[] = $key;
        }

        if ( $this->windowSize['width'] >= 1024 ){

            // Generate table for pc

            foreach ($data as $item) {
                $content_table .= '<tr id="' . $item->id . '" class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">';
                
                foreach ($columns as $column) {
                    $content_table .= '<td class="p-4 text-gray-600 align-middle [&:has([role=checkbox])]:pr-0">' . $item->$column . '</td>';
                }
        
                $content_table .= '<td>' . $this->generateEditButton( $type , $item).'</td>';

                $content_table .= '<td>' . $this->generateDeleteButton( $item->id ) . '</td>';
        
                $content_table .= '</tr>';
            }

            $heading_table = '<tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">';

            foreach ($columns as $key => $col) {
                $heading_table.= '<th class="h-12 px-4 text-left text-lg text-gray-100 align-middle font-medium font-bold text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                        '.$col.'
                    </th>';
            }

            $heading_table.= '</tr>';

            $table = "<thead class='w-full bg-blue-500'>
                        {$heading_table}
                    </thead>
                    <tbody class='w-full tr:last-child:border-none'>
                        {$content_table}
                    </tbody>";

        } else {

            // Generate table for mobile tablet or mobile
            foreach ($data as $item) {
                
                foreach ($columns as $column) {
                    $content_table.= '<tr id="' . $item->id . '" class="w-full border-b flex flex-row justify-center items-center transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">';

                    $content_table .= '<th class="w-full h-12 flex flex-row items-center justify-start px-4 text-lg text-gray-500 align-center font-medium font-bold text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                        '.$column.'
                    </th>';
                    $content_table .= '<td class="w-full p-4 flex flex-row items-center justify-center text-gray-600 align-center [&:has([role=checkbox])]:pr-0">' . $item->$column . '</td>';
                    $content_table .= '</tr>';
                }

                $content_table .= '<tr class="border-b flex flex-row justify-center items-center">';
        
                $content_table .= '<td>' . $this->generateEditButton( $type , $item).'</td>';

                $content_table .= '<td>' . $this->generateDeleteButton( $item->id ) . '</td>';

                $content_table .= '</tr>';
    
            }

            $table = "<tbody class='w-2/4 m-auto [&_tr:last-child]:border-0 flex flex-col justify-center'>
                        {$content_table}
                    </tbody>";
        }
    
        return "<section {$this->styles['sections']['background']} class='relative ".( $this->windowSize['width'] <= 1024 ? 'block lg:hidden' : 'hidden lg:block' )." w-full rounded-lg lg:w-4/5 border border-gray-300 mx-auto rounded-md shadow-md p-6'>
            <table id='table-users' class='w-full caption-bottom text-sm'>
                $table
            </table>
        </section>";

    }

    public function getDate( $day , $month , $year ) {
 
        $date = Carbon::now();
    
        // Extract current month, day, and year
        $currentMonth = $date->format($month);
        $currentDay = $date->format($day);
        $currentYear = $date->format($year);
    
        // Subtract one month to get the previous month
        $previousDate = $date->copy()->subMonth();
    
        // Extract previous month and day
        $previousMonth = $previousDate->format($month);
        $previousDay = $previousDate->format($day);
    
        // Return the extracted values for current and previous dates
        return [
            'current' => [
                'month' => $currentMonth, 
                'day' => $currentDay, 
                'year' => $currentYear
            ],
            'previous' => [
                'month' => $previousMonth, 
                'day' => $previousDay, 
                'year' => $currentYear // Assuming year remains the same for previous month
            ]
        ];
    }

    public function getNewUsersLastMonth(){
        // Define a subquery for users registered last month
        $subqueryLastMonth = User::where('created_at', '<', now()->startOfMonth()->format('Y-m-01'))
        ->count();

        // Define a subquery for users registered this month
        $subqueryThisMonth = User::whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->count();

        // Perform the main query using the subqueries
        $result = DB::table(DB::raw('(SELECT 
            ' . $subqueryLastMonth . ' AS users_registered_last_month,
            ' . $subqueryThisMonth . ' AS users_registered_this_month) AS q'))
        ->select(
            'q.users_registered_this_month as users_registered_this_month',
            'q.users_registered_last_month as users_registered_last_month', 
            DB::raw('CONCAT(
                CASE 
                    WHEN q.users_registered_this_month < q.users_registered_last_month THEN CONCAT( "-" , FORMAT(ABS(((q.users_registered_this_month - q.users_registered_last_month) / q.users_registered_last_month) * 100), 2))
                    ELSE CONCAT( "+" , FORMAT(ABS(((q.users_registered_this_month - q.users_registered_last_month) / q.users_registered_this_month) * 100), 2)) 
                END,
                "%"
            ) AS percentage_change')
        )
        ->first();

        return $result;

    }

    public function getRedirectsLastDay(){
        // Define a subquery for redirects yesterday
        $subqueryRedirectsYesterday = Redirect::whereDay('updated_at', now()->subDay()->format('d'))->count();

        // Define a subquery for redirects today
        $subqueryRedirectsToday = Redirect::whereDay('updated_at', now()->format('d'))->count();

        // Perform the main query using the subqueries
        $result = DB::table(DB::raw('(SELECT 
                ' . $subqueryRedirectsYesterday . ' AS redirects_yesterday,
                ' . $subqueryRedirectsToday . ' AS redirects_today) AS q'))
            ->select(
                DB::raw("'Total redirects'"),
                'q.redirects_today AS Today',
                'q.redirects_yesterday AS Yesterday',
                DB::raw('CONCAT(
                    CASE 
                        WHEN q.redirects_today < q.redirects_yesterday THEN CONCAT( "-" , FORMAT(ABS(((q.redirects_today - q.redirects_yesterday) / q.redirects_yesterday) * 100), 2))
                        ELSE CONCAT( "+" , FORMAT(ABS(((q.redirects_today - q.redirects_yesterday) / q.redirects_today) * 100), 2)) 
                    END,
                    "%"
                ) AS percentage_change')
            )
            ->first();

        return $result;

    }

    public function getRedirectsLastMonth(){
        // Define a subquery for redirects last month
        $subqueryRedirectsLastMonth = Redirect::whereMonth('updated_at', now()->subMonth()->format('m'))->count();

        // Define a subquery for redirects this month
        $subqueryRedirectsThisMonth = Redirect::whereMonth('updated_at', now()->format('m'))->count();

        // Perform the main query using the subqueries
        $result = Redirect::select(
                DB::raw("'Total redirects'"),
                DB::raw($subqueryRedirectsThisMonth . ' AS ThisMonth'),
                DB::raw($subqueryRedirectsLastMonth . ' AS LastMonth'),
                DB::raw('CONCAT(
                    CASE 
                        WHEN ' . $subqueryRedirectsThisMonth . ' < ' . $subqueryRedirectsLastMonth . ' THEN CONCAT( "-" , FORMAT(ABS(((' . $subqueryRedirectsThisMonth . ' - ' . $subqueryRedirectsLastMonth . ') / ' . $subqueryRedirectsLastMonth . ') * 100), 2))
                        ELSE CONCAT( "+" , FORMAT(ABS(((' . $subqueryRedirectsThisMonth . ' - ' . $subqueryRedirectsLastMonth . ') / ' . $subqueryRedirectsThisMonth . ') * 100), 2)) 
                    END,
                    "%"
                ) AS percentage_change')
            )
            ->first();

        return $result;
    }

    public function getRedirectsTotalByUser(){

        $result = $result = Url::select('urls.url', 'urls.short', 'users.email', \DB::raw('COUNT(*) AS total_redirect_user'))
        ->leftJoin('redirects', 'urls.id', '=', 'redirects.idUrl')
        ->leftJoin('users', 'users.id', '=', 'redirects.idUser')
        ->whereNotNull('users.email')
        ->where('urls.short', '=', $this->params['short'])
        ->groupBy('urls.url', 'users.id','urls.short', 'users.email')
        ->get();

        return $result;

    }

    // Table of page visited by shorts
    public function getRedirectsTotalAndByUser(){
        
        $totalRedirects = DB::table('urls')
        ->leftJoin('redirects', 'urls.id', '=', 'redirects.idUrl')
        ->select('urls.id AS idUrl', 'urls.url' , 'urls.short' , DB::raw('count(*) AS total_redirects_shorts'))
        ->groupBy('urls.id', 'urls.url', 'urls.short')
        ->paginate(5);

        foreach ($totalRedirects as $redirect) {
            $redirect->total_redirects_users = DB::table('users')
                ->leftJoin('redirects', 'users.id', '=', 'redirects.idUser')
                ->where('redirects.idUrl', '=', $redirect->idUrl)
                ->count();
        }

        return $totalRedirects;
    }

    public function generateChartRedirectsTotalAndUsers(){

        // Your existing query to get the total redirects
        $totalRedirects = DB::table('urls')
        ->leftJoin('redirects', 'urls.id', '=', 'redirects.idUrl') // Make sure to use the correct column name for the foreign key in the redirects table
        ->select('urls.id AS idUrl', 'urls.url', 'urls.short', DB::raw('count(redirects.id) AS total_redirects_shorts'))
        ->groupBy('urls.id', 'urls.url', 'urls.short')
        ->paginate(5); // You may want to use ->get() instead of paginate if this is specifically for a chart

        // Loop through each redirect and get the unique user count
        foreach ($totalRedirects as $redirect) {
            $redirect->total_redirects_users = DB::table('users')
                ->join('redirects', 'users.id', '=', 'redirects.idUser') // Ensure you're using the correct column names
                ->where('redirects.idUrl', $redirect->idUrl) // Make sure the column name matches the foreign key in the redirects table
                ->distinct('users.id') // We want to count each user only once
                ->count();
        }

        // Prepare the data for Chart.js
        $labels = $totalRedirects->pluck('short');
        $viewersData = $totalRedirects->pluck('total_redirects_shorts');
        $usersData = $totalRedirects->pluck('total_redirects_users');

        return [
            $labels,
            $viewersData,
            $usersData
        ];

    }

    public function generateChart($for, $months = [])
{
    $labels = count($months) !== 0 ? $months : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    $data = array_fill(0, count($labels), 0);

    $data_charts = [
        "users" => User::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as formatted_date'),
            DB::raw('COUNT(*) as total'),
            DB::raw('MAX(DATE_FORMAT(created_at, "%Y-%m-%d")) as date'),
            DB::raw('MAX(name) as name'),
            DB::raw('MAX(email) as email'),
            DB::raw('MAX(type) as type')
        )
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
            ->paginate(5),
        "urls" => Url::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as formatted_date'),
            DB::raw('COUNT(*) as total'),
            DB::raw('MAX(DATE_FORMAT(created_at, "%Y-%m-%d")) as date'),
            DB::raw('MAX(url) as url'),
            DB::raw('MAX(short) as short'),
            DB::raw('MAX(description) as description')
        )
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
            ->paginate(5),
        "redirects" => $this->getRedirectsLastMonth()
    ];

    // Iterate over each grouped user data
    foreach ($data_charts[$for] as $item) {
        $date = Carbon::parse($item->date);
        $month = explode('-', $date)[1];
        $month_ = $month < 10 ? $month[1] : $month;
        $data[$month_ - 1] = $item->total;
    }

    return [$labels, $data];
}


}