<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\StadisticUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if ( !Auth::check() ){
            return redirect()->intended('/');
        }

        $search = $this->params['search'];
        
        // Retrieve users grouped by registration date
        $users = !$search ? 
            DB::table('users')
            ->select(DB::raw('id , name , email, type , DATE_FORMAT(created_at, "%d of %M in %Y") as registration_date, updated_at'))
            ->where( 'type' , 'user' )
            ->paginate(5) : 
            DB::table('users')
            ->select(DB::raw('id , name , email, type , DATE_FORMAT(created_at, "%d of %M in %Y") as registration_date, updated_at'))
            ->where('type', 'user')
            ->where(function($query) use ($search) {
                $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            })
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

        // Generate table and pagination
        $table = $this->generateTable( $users , 'users' );
        $pagination = $this->generatePagination($users);

        // Pass the users data along with labels and data to the view
        return view('users', compact('labels', 'data' , 'table' , 'pagination' , 'styles' ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // dd( $request->all() );
        // die();
        // Step 1: Find the record you want to update
        $user = User::findOrFail($id);

        // Step 2: Update the record with the new values
        $user->update($request->all());

        // Optionally, you can perform additional validation or manipulation here before saving

        // Step 3: Save the changes to the database
        $user->save();

        // Optionally, you can return a response indicating success
        return redirect()->route('users');

    }

    public function delete(string $id){
        // Step 1: Find the record you want to delete
        $user = User::findOrFail($id);

        // Step 2: Delete the record from the database
        $user->delete();

        // Optionally, you can return a response indicating success
        return redirect()->route('users');
    }
    
}