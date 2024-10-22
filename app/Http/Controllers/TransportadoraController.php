<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TransportadoraController extends Controller
{
    public function index()
    {
        $header = 'Painel Transportadora';
        $users = User::all();
        return view("transportadora.dashboard", compact('header', 'users'));
    }
}
