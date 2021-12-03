<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TeamAddRequest;
use App\Models\Member;

class MemberController extends Controller
{
    public function add(TeamAddRequest $request) {
        if (Member::create($request->all())) {
            return redirect()->back()->with('yes', 'Add succesfully');
        }
        return redirect()->back()->with('no', 'Add faile');
    }
}
