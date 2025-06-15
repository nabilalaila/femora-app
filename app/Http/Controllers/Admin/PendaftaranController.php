<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PendaftaranController extends Controller
{
    public function index(){
        return view('Admin.PendaftaranProgram', ['noNavbar' => true]);
    }
}
