<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SocialLinkController extends Controller
{
    public function index(){
        $socialLinks = SocialLink::all();
        return view('backend.social-links.index', [
            'socialLinks' => $socialLinks,
        ]);
    }

    public function create(){
        return view('backend.social-links.add');
    }

    public function store(Request $request){
        // Validate the request
        $request->validate([
            'facebookLink'      => 'nullable|url',
            'instagramLink'     => 'nullable|url',
            'twitterLink'       => 'nullable|url',
            'youtubeLink'       => 'nullable|url',
            'linkedinLink'      => 'nullable|url',
        ]);

        if (SocialLink::exists()) {
            Alert::error('Error', 'Social links already exists. You can edit it or delete it before adding a new one.');
            return redirect(route('admin.all-social-links'));
        }

        SocialLink::addSocialLink($request);
        Alert::success('Success', 'Social links added successfully.');
        return redirect()->route('admin.all-social-links');
    }

    public function edit($id){
        $socialLink = SocialLink::findOrFail($id);
        return view('backend.social-links.edit', [
            'socialLink' => $socialLink,
        ]);
    }

    public function update(Request $request, $id){
        // Validate the request
        $request->validate([
            'facebookLink'      => 'nullable|url',
            'instagramLink'     => 'nullable|url',
            'twitterLink'       => 'nullable|url',
            'youtubeLink'       => 'nullable|url',
            'linkedinLink'      => 'nullable|url',
        ]);

        SocialLink::updateSocialLink($request, $id);
        Alert::success('Success', 'Social links updated successfully.');
        return redirect()->route('admin.all-social-links');
    }

    public function destroy($id){
        SocialLink::deleteSocialLink($id);
        Alert::success('Success', 'Social links deleted successfully.');
        return back();
    }

    public function view($id){
        $socialLink = SocialLink::findOrFail($id);
        return view('backend.social-links.view', [
            'socialLink' => $socialLink,
        ]);
    }
}
