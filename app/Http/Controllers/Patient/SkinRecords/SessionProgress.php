<?php

namespace App\Http\Controllers\Patient\SkinRecords;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionProgress extends Controller
{
    public function index()
    {
        return view('Patient.SkinRecords.session-progress');
    }
}
