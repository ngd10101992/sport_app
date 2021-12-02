<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TeamAddRequest;
use App\Models\Team;

class TeamController extends Controller
{
    // public function index() {
    //     $teams = Team::paginate(10);
    //     return view('home', compact('teams'));
    // }

    public function add(TeamAddRequest $request) {
        if (Team::create($request->all())) {
            return redirect()->back()->with('yes', 'Add succesfully');
        }
        return redirect()->back()->with('no', 'Add faile');
    }
}
