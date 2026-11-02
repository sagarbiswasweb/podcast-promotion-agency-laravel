<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Team;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TeamController extends Controller
{
    public function index(){
        $services = Service::all();
        $teams = Team::orderBy('created_at', 'desc')->get();
        return view('backend.team.index', [
            'teams' => $teams,
            'services' => $services,
        ]);
    }

    public function create(){
        $services = Service::all();
        return view('backend.team.add', [
            'services' => $services,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'service'               => 'required|exists:services,id',
            'plan'                  => 'required|exists:plans,id',
            'position'              => 'required|integer',
            'memberName'            => 'required|string|max:255',
            'memberImage'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'memberRating'          => 'required|integer|min:1|max:5',
            'totalReview'           => 'required|integer|min:0',
            'portfolioLink'         => 'nullable|url',
            'memberDescription'     => 'nullable|string|max:5000',
        ],
        [
            'service.required'          => 'Please select a service.',
            'plan.required'             => 'Please select a plan.',
            'position.required'         => 'Position is required.',
            'memberName.required'       => 'Member name is required.',
            'memberName.max'            => 'This field must not exceed 255 characters.',
            'memberImage.image'         => 'Member image must be an image file.',
            'memberImage.max'           => 'Member image must not exceed 2MB.',
            'memberRating.required'     => 'Member rating is required.',
            'totalReview.required'      => 'Total review count is required.',
            'totalReview.integer'       => 'Total review count must be an integer.',
            'portfolioLink.url'         => 'Portfolio link must be a valid URL.',
            'memberDescription.max'     => 'Member description must not exceed 5000 characters.',
        ]);

        Team::addTeamMember($request);
        Alert::success('Success', 'Team member added successfully');
        return back();
    }

    public function edit($id){
        $team = Team::findOrFail($id);
        $services = Service::all();
        return view('backend.team.edit', [
            'team' => $team,
            'services' => $services,
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'service'               => 'required|exists:services,id',
            'plan'                  => 'required|exists:plans,id',
            'position'              => 'required|integer',
            'memberName'            => 'required|string|max:255',
            'memberImage'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'memberRating'          => 'required|integer|min:1|max:5',
            'totalReview'           => 'required|integer|min:0',
            'portfolioLink'         => 'nullable|url',
            'memberDescription'     => 'nullable|string|max:5000',
        ],
        [
            'service.required'          => 'Please select a service.',
            'plan.required'             => 'Please select a plan.',
            'position.required'         => 'Position is required.',
            'memberName.required'       => 'Member name is required.',
            'memberName.max'            => 'This field must not exceed 255 characters.',
            'memberImage.image'         => 'Member image must be an image file.',
            'memberImage.max'           => 'Member image must not exceed 2MB.',
            'memberRating.required'     => 'Member rating is required.',
            'totalReview.required'      => 'Total review count is required.',
            'totalReview.integer'       => 'Total review count must be an integer.',
            'portfolioLink.url'         => 'Portfolio link must be a valid URL.',
            'memberDescription.max'     => 'Member description must not exceed 5000 characters.',
        ]);

        Team::updateTeamMember($request, $id);
        Alert::success('Success', 'Team member updated successfully');
        return redirect()->route('admin.team');
    }

    public function destroy($id){
        Team::deleteTeamMember($id);
        Alert::success('Success', 'Team member deleted successfully');
        return back();
    }

    public function view($id){
        $team = Team::findOrFail($id);
        return view('backend.team.view', [
            'team' => $team,
        ]);
    }
}
