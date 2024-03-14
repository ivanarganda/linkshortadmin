<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\StadisticUsers;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Check if exist any short by query string parameters to filter out
        $short = $this->params['short'];

        [ $labels , $viewersData , $usersData ] = $this->generateChartRedirectsTotalAndUsers( $short );

        $styles = $this->styles;

        return view('stats' , [ 
            'params' => [
                'short' => $short
            ],
            'date' => $this->getDate('D','M','Y'),
            'users' => $this->getNewUsersLastMonth(),
            'redirects' => [ 
                'yesterday' => $this->getRedirectsLastDay(), 
                'last_month' => $this->getRedirectsLastMonth(),
                'getRedirectsTotalAndByUser' => $this->getRedirectsTotalAndByUser(),
                'getRedirectsTotalByUser' => $this->getRedirectsTotalByUser(),
                'chart' => [
                    'shorts' => $labels,
                    'viewersData' => $viewersData,
                    'usersData' => $usersData
                ]
            ],
            'styles' => $styles
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}