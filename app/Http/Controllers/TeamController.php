<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TeamAddRequest;
use App\Models\Team;
use App\Models\Member;

class TeamController extends Controller
{
    // public function index() {
    //     $teams = Team::paginate(10);
    //     return view('home', compact('teams'));
    // }

    public function getMembersNotLogin($teamId) {
        $Team = Team::find($teamId);
        return view('team.members', compact('Team'));
    }

    public function getMembers($userId, $teamId) {
        $Team = Team::find($teamId);
        return view('team.members', compact('Team'));
    } 

    public function add(TeamAddRequest $request) {
        if (Team::create($request->all())) {
            return redirect()->back()->with('yes', 'Add succesfully');
        }
        return redirect()->back()->with('no', 'Add faile');
    }

    public function delete($id) {
        if (Team::destroy((int)$id)) {
            return response()->json(['status' => true, 'message' => 'Delete successfully']);
        }
        return response()->json(['status' => false, 'message' => 'Delete fail']);
    }

    public function update(TeamAddRequest $request) {
        $team = Team::find($request->all()['id']);
        $team->name = $request->all()['name'];
        if ($team->save()) {
            return response()->json([
                'status' => true, 
                'message' => 'Update successfully',
                'data' => [
                    'name' => $team->name
                ]
            ]);
        }
        return response()->json(['status' => false, 'message' => 'Update fail']);
    }
}
