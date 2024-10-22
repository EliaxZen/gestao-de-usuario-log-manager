<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        $header = 'Painel do Administrador';
        $users = User::all();
        return view("admin.dashboard", compact('header', 'users'));
    }
}
