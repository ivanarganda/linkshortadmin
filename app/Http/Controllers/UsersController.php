<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\StadisticUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( $search = false )
    {

        if ( !Auth::check() ){
            return redirect()->intended('/');
        }
        
        // Retrieve users grouped by registration date
        $users = !$search ? 
            DB::table('users')
            ->select(DB::raw('DATE_FORMAT(created_at, "%d of %M in %Y") as registration_date, id , name , email, type'))
            ->where( 'type' , 'user' )
            ->paginate(5) : 
            
            DB::table('users')
            ->select(DB::raw('DATE_FORMAT(created_at, "%d of %M in %Y") as registration_date, id , name , email, type'))
            ->where('id', 'LIKE' , "%{$search}%")
            ->orWhere('name', 'LIKE' , "%{$search}%")
            ->orWhere('email', 'LIKE' , "%{$search}%")
            ->where('type', 'user')
            ->paginate(5);

        // Fetch the email of the authenticated user
        $authenticatedUserEmail = Auth::user()->email;

        // Iterate over each user in the paginated list
        foreach ($users as $user) {
            // Compare the email of each user with the authenticated user's email
            if ($user->email == $authenticatedUserEmail) {
                $user->name = 'Me'; // Assign a custom name for the authenticated user
            }
        }

        [ $labels, $data ] = $this->generateChart('users');

        $styles = $this->styles;

        // Pass the users data along with labels and data to the view
        return view('users', compact('labels', 'data' , 'users' , 'styles'));
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