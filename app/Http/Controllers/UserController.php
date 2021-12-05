<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile($userId) {
        $user = User::find($userId);
        return view('profile', compact('user'));
    }

    public function update(Request $request) {
        if (User::where('id', $request->all()['id'])->update($request->all())) {
            return response()->json([
                'status' => true, 
                'message' => 'Update successfully',
            ]);
        }
        return response()->json(['status' => false, 'message' => 'Update fail']);
    } 

    public function getTeams($userId) {
        $user = User::find($userId);
        return view('team.index', compact('user'));
    } 
}
