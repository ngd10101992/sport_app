<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function register()
    {
        return view('admin.register');
    }

    public function getTeams() {
        $teams = Team::paginate(10);
        return view('admin.teams', compact('teams'));
    }

    public function getUsers() {
        $users = User::paginate(10);
        return view('admin.users', compact('users'));
    } 

    public function deleteUser($userId) {
        if (User::destroy((int)$userId)) {
            return response()->json(['status' => true, 'message' => 'Delete successfully']);
        }
        return response()->json(['status' => false, 'message' => 'Delete fail']);
    } 
}
