<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PrivacyPolicyController extends Controller
{
    public function index(){
        $privacyPolicies = PrivacyPolicy::all();
        return view('backend.privacy-policy.index', [
            'privacyPolicies' => $privacyPolicies,
        ]);
    }

    public function create(){
        return view('backend.privacy-policy.add');
    }

    public function store(Request $request){
        $request->validate([
            'privacyPolicy' => 'required',
        ]);
        
        if (PrivacyPolicy::exists()) {
            Alert::error('Error', 'Privacy policy already exists. You can edit it or delete it before adding a new one.');
            return redirect(route('admin.privacy-policies'));
        }

        PrivacyPolicy::addPrivacyPolicy($request);
        Alert::success('Success', 'Privacy Policy Added Successfully');
        return redirect()->route('admin.privacy-policies');
    }

    public function edit($id){
        $privacyPolicy = PrivacyPolicy::findOrFail($id);
        return view('backend.privacy-policy.edit', [
            'privacyPolicy' => $privacyPolicy,
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'privacyPolicy' => 'required',
        ]);

        PrivacyPolicy::updatePrivacyPolicy($request, $id);
        Alert::success('Success', 'Privacy Policy Updated Successfully');
        return redirect()->route('admin.privacy-policies');
    }

    public function destroy($id){
        PrivacyPolicy::deletePrivacyPolicy($id);
        Alert::success('Success', 'Privacy Policy Deleted Successfully');
        return redirect()->route('admin.privacy-policies');
    }

    public function view($id){
        $privacyPolicy = PrivacyPolicy::findOrFail($id);
        return view('backend.privacy-policy.view', [
            'privacyPolicy' => $privacyPolicy,
        ]);
    }
}
