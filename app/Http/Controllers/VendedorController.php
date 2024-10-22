<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VendedorController extends Controller
{
    public function index()
    {
        $header = 'Painel Vendedor';
        $users = User::all();
        return view("vendedor.dashboard", compact('header', 'users'));
    }
}
