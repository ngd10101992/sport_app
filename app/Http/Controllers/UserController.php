<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function profile($userId) {
        $user = User::find($userId);
        return view('profile', compact('user'));
    }

    public function password($userId) {
        return view('password', compact('userId'));
    }

    public function updatePassword(Request $request) {
 
        $this->validate($request, [
            'oldpassword' => 'required',
            'newpassword' => 'required',
        ]);
 
 
 
        $hashedPassword = Auth::user()->password;

        if ($request->newpassword !== $request->password_confirmation) {
            return response()->json([
                'status' => false, 
                'message' => 're-enter incorrect password',
            ]);
        }
 
        if (\Hash::check($request->oldpassword , $hashedPassword )) {
 
            if (!\Hash::check($request->newpassword , $hashedPassword)) {
    
                $users =User::find(Auth::user()->id);
                $users->password = bcrypt($request->newpassword);
                User::where( 'id' , Auth::user()->id)->update( array( 'password' =>  $users->password));
    
                // session()->flash('message','password updated successfully');
                // return redirect()->back();
                return response()->json([
                    'status' => true, 
                    'message' => 'password updated successfully',
                ]);
            } else {
                // session()->flash('message','new password can not be the old password!');
                // return redirect()->back();
                return response()->json([
                    'status' => false, 
                    'message' => 'New password can not be the old password!',
                ]);
            }
        } else {
            // session()->flash('message','old password doesnt matched ');
            // return redirect()->back();
            return response()->json([
                'status' => false, 
                'message' => 'Old password doesnt matched!',
            ]);
        }
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
