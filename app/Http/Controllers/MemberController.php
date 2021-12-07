<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TeamAddRequest;
use App\Http\Requests\MemberAddRequest;
use App\Models\Member;

class MemberController extends Controller
{
    public function add(MemberAddRequest $request) {
        if (Member::create($request->all())) {
            return redirect()->back()->with('yes', 'Add succesfully');
        }
        return redirect()->back()->with('no', 'Add faile');
    }

    public function update(MemberAddRequest $request) {
        if (Member::where('id', $request->all()['id'])->update($request->all())) {
            return response()->json([
                'status' => true, 
                'message' => 'Update successfully',
            ]);
        }
        return response()->json(['status' => false, 'message' => 'Update fail']);
    }

    public function delete($id) {
        if (Member::destroy((int)$id)) {
            return response()->json(['status' => true, 'message' => 'Delete successfully']);
        }
        return response()->json(['status' => false, 'message' => 'Delete fail']);
    }
}
