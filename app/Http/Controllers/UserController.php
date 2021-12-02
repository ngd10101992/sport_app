<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getTeams($userId) {
        $user = User::find($userId);
        return view('team.index', compact('user'));
    } 
}
