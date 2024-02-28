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
    public function index()
    {
        // Retrieve users grouped by registration date
        $users = DB::table('users')
            ->select(DB::raw('DATE(created_at) as registration_date, name , email, type'), DB::raw('COUNT(*) as total_users'))
            ->groupBy(DB::raw('DATE(created_at), name, email, type'))
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

        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July' , 'August' , 'September' , 'October' , 'November' , 'December']; // Initialize an empty array for labels
        $data = [0,0,0,0,0,0,0,0,0,0,0,0]; // Initialize an empty array for data

        // Iterate over each grouped user data
        foreach ($users as $user) {
            // Parse the registration date as Carbon instance for formatting
            $date = Carbon::parse($user->registration_date);
            $month = explode( '-' , $date )[1];
            // Add the formatted registration date to labels array (e.g., 'January 01, 2022')
            // Add the total users for each registration date to data array
            $data[ $month - 1 ] = $user->total_users;
        }

        // Pass the users data along with labels and data to the view
        return view('users', compact('labels', 'data', 'users'));
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