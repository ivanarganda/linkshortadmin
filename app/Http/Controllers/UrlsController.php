<?php

namespace App\Http\Controllers;

use App\Charts\StadisticUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Facades\DB;

class UrlsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->intended('/');
        }

        // Get URLs associated with the authenticated user
        $urls = DB::table('urls')
        ->select(DB::raw('DATE_FORMAT(created_at, "%d of %M in %Y") as registration_date, url , short, description'))
        ->paginate(5);

        [ $labels , $data ] = $this->generateChart('urls');

        // Return the view with the URLs
        return view('urls', compact( 'labels' , 'data' , 'urls'));
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
