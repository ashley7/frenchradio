<?php

namespace App\Http\Controllers;

use App\Models\RadioProgram;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function welcome()
    {
        $programs = RadioProgram::orderBy('start_time','asc')->get();

        return view('welcome', compact('programs'));
    }
}
