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

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

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