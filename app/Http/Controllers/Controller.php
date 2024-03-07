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

    public function generateChart( $for ){

        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July' , 'August' , 'September' , 'October' , 'November' , 'December']; // Initialize an empty array for labels
        $data = [0,0,0,0,0,0,0,0,0,0,0,0]; // Initialize an empty array for data

        $data_charts = [
            "users" => User::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as formatted_date'),
                DB::raw('COUNT(*) as total'),
                DB::raw('MAX(DATE_FORMAT(created_at, "%Y-%m-%d")) as registration_date'),
                DB::raw('MAX(name) as name'),
                DB::raw('MAX(email) as email'),
                DB::raw('MAX(type) as type')
            )
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
            ->paginate(5),
            "urls" => Url::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as formatted_date'),
                DB::raw('COUNT(*) as total'),
                DB::raw('MAX(DATE_FORMAT(created_at, "%Y-%m-%d")) as registration_date'),
                DB::raw('MAX(url) as url'),
                DB::raw('MAX(short) as short'),
                DB::raw('MAX(description) as description')
            )
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
            ->paginate(5)
            ];

        // Iterate over each grouped user data
        foreach ($data_charts[$for] as $item) {
            // Parse the registration date as Carbon instance for formatting
            $date = Carbon::parse($item->registration_date);
            $month = explode( '-' , $date )[1];
            $month_ = $month < 10 ? $month[1] : $month;
            // Add the formatted registration date to labels array (e.g., 'January 01, 2022')
            // Add the total users for each registration date to data array
            $data[ $month_ - 1 ] = $item->total;
        }

        return [ $labels , $data ];
    }

}
