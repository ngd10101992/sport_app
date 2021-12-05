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

    public function getMembersNotLogin($teamId, Request $request) {
        $Team = Team::find($teamId);
        $order = $request->has('order') ? $request->input('order') : 'name';
        $members = Team::find($teamId)->members()->orderBy($order)->get();

        return view('team.members', compact('Team', 'members'));
    }

    public function getMembers($userId, $teamId, Request $request) {
        $Team = Team::find($teamId);
        $order = $request->has('order') ? $request->input('order') : 'name';
        $members = Team::find($teamId)->members()->orderBy($order)->get();

        return view('team.members', compact('Team', 'members'));
    } 

    public function add(TeamAddRequest $request) {
        
        $data = $request->all();
        $data['slug'] = $this->createSlug($data['name']);
        if (Team::create($data)) {
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
