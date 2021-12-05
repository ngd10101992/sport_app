<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $teams = Team::paginate(10);
        return view('home', compact('teams'));
    }

    public function getTeamsBySlug(Request $request) {
        $slug = $this->createSlug($request->all()['search']);
        $teams = Team::where('slug', $slug)->get();
        return view('home', compact('teams'));
    }
}
