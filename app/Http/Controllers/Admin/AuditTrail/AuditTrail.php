<?php

namespace App\Http\Controllers\Admin\AuditTrail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuditTrail extends Controller
{
    public function index()
    {
        return view('Admin.AuditTrail.audit-trail');
    }
}
