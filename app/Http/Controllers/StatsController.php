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

        $svgDownArrow = '<svg class="h-8 w-8 text-red-500" width="24" height="24" viewBox="0 0 24 24"
        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" />
        <line x1="12" y1="5" x2="12" y2="19" />
        <line x1="16" y1="15" x2="12" y2="19" />
        <line x1="8" y1="15" x2="12" y2="19" />
        </svg>';
        $svgUpArrow = '<svg class="h-8 w-8 text-green-500"  width="24" height="24" viewBox="0 0 24 24" 
        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
        <path stroke="none" d="M0 0h24v24H0z"/>  
        <line x1="12" y1="5" x2="12" y2="19" />  
        <line x1="16" y1="9" x2="12" y2="5" />  
        <line x1="8" y1="9" x2="12" y2="5" />
        </svg>';

        return view('stats' , [ 
                'svgDownArrow' => $svgDownArrow,
                'svgUpArrow' => $svgUpArrow,
                'users' => $this->getNewUsersLastMonth(),
                'redirects' => [ 
                                'yesterday' => $this->getRedirectsLastDay() , 
                                'last_month' => $this->getRedirectsLastMonth() 
                                ] 
                ] );

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