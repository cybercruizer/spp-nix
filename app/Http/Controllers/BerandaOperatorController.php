<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BerandaOperatorController extends Controller
{
    function index() {
        return view('operator.beranda_index');
    }
}
