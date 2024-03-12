<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SettingsController extends Controller
{

    public function index( $id = false ){
        
        return view('settings');
    }

    public function update(Request $request){

    }

    public function changePassword(Request $request){

    }

    public function delete( $id ){

    }

}