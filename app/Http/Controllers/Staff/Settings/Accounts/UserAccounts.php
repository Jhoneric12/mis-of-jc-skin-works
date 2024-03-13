<?php

namespace App\Http\Controllers\Staff\Settings\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAccounts extends Controller
{
    public function index()
    {
        return view('Staff.Settings.Accounts.user-accoutns');
    }
}
