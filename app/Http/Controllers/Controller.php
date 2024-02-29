<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function generateChart( $for ){

        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July' , 'August' , 'September' , 'October' , 'November' , 'December']; // Initialize an empty array for labels
        $data = [0,0,0,0,0,0,0,0,0,0,0,0]; // Initialize an empty array for data

        $data_charts = [
            "users" => DB::table('users')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m")'),
                DB::raw('COUNT(*) as total'),
                DB::raw('MAX(DATE_FORMAT(created_at, "%Y-%m-%d")) as registration_date'),
                DB::raw('MAX(name) as name'),
                DB::raw('MAX(email) as email'),
                DB::raw('MAX(type) as type')
            )
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
            ->paginate(5),
            "urls" => DB::table('urls')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m")'),
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
