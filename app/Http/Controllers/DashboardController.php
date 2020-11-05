<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function route1 () {
        return 'Anda Berada di Route 1';
    }

    public function route2 () {
        return 'Anda Berada di Route 2';
    }
}
