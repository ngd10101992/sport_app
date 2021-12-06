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

    public function getUsersByEmailOrPhone(Request $request) {
        $users = User::where('email', $request->all()['search'])
                        ->orWhere('phone', $request->all()['search'])
                        ->get();
        return view('admin.users', compact('users'));
    } 

    public function deleteUser($userId) {
        if (User::destroy((int)$userId)) {
            return response()->json(['status' => true, 'message' => 'Delete successfully']);
        }
        return response()->json(['status' => false, 'message' => 'Delete fail']);
    } 

    public function updateUser(Request $request) {
        if (User::where('id', $request->all()['id'])->update($request->all())) {
            return response()->json([
                'status' => true, 
                'message' => 'Update successfully',
            ]);
        }
        return response()->json(['status' => false, 'message' => 'Update fail']);
    } 
}
