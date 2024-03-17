<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WindowSizeController extends Controller
{
    public function store()
    {
        $width = isset($_GET['width']) ? $_GET['width'] : null;
        $height = isset($_GET['height']) ? $_GET['height'] : null;
        // You can store this information in the session, database, or take any action needed
        $_SESSION['windowSize'] = ['width' => $width, 'height' => $height];

        return response()->json(['success' => $_SESSION['windowSize']]);
    }

}
