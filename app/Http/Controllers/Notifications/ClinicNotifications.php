<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClinicNotif;

class ClinicNotifications extends Controller
{
    public function index()
    {
       $notification = ClinicNotif::all();

       return view('components.Essentials.sidebar', ['notifications' => $notification]);
    }
}
