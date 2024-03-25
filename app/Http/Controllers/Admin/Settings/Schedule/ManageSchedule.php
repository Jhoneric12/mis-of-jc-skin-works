<?php

namespace App\Http\Controllers\Admin\Settings\Schedule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageSchedule extends Controller
{
    public function index()
    {
        return view('Admin.Settings.Schedule.manage-schedule');
    }
}
