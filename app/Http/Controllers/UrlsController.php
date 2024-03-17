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
        ->select(DB::raw('id,url , short, description,DATE_FORMAT(created_at, "%d of %M in %Y") as registration_date,updated_at'))
        ->paginate(5);

        [ $labels , $data ] = $this->generateChart('urls');

        $styles = $this->styles;

        // Generate table and pagination
        $table = $this->generateTable( $urls , 'urls' );
        $pagination = $this->generatePagination($urls);

        // Return the view with the URLs
        return view('urls', compact( 'labels' , 'data' , 'table' , 'pagination' , 'styles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

}
