<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ContactInfoController extends Controller
{
    public function index(){
        $contactInfos = ContactInfo::all();
        return view('backend.contact-infoes.index', [
            'contactInfos' => $contactInfos,
        ]);
    }

    public function create(){
        return view('backend.contact-infoes.add');
    }

    public function store(Request $request){
        $request->validate([
            'email'             => 'required|email|max:255',
            'phone'             => 'required|numeric',
            'addressDetails'    => 'required|string',
        ],[
            'email.required'            => 'Email is required.',
            'email.email'               => 'Please provide a valid email address.',
            'phone.required'            => 'Phone number is required.',
            'phone.numeric'             => 'Phone number must be numeric.',
            'addressDetails.required'   => 'Address details are required.',
        ]);
        // Check if contact info already exists
        if (ContactInfo::exists()) {
            Alert::error('Error', 'Contact info already exists. You can edit it or delete it before adding a new one.');
            return redirect(route('admin.all-contact-infoes'));
        }
        ContactInfo::addContactInfo($request);
        Alert::success('Success', 'Contact information added successfully.');
        return back();
    }

    public function edit($id){
        $contactInfo = ContactInfo::findOrFail($id);
        return view('backend.contact-infoes.edit', [
            'contactInfo' => $contactInfo,
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'email'             => 'required|email|max:255',
            'phone'             => 'required|numeric',
            'addressDetails'    => 'required|string',
        ],[
            'email.required'            => 'Email is required.',
            'email.email'               => 'Please provide a valid email address.',
            'phone.required'            => 'Phone number is required.',
            'phone.numeric'             => 'Phone number must be numeric.',
            'addressDetails.required'   => 'Address details are required.',
        ]);
        ContactInfo::updateContactInfo($request, $id);
        Alert::success('Success', 'Contact information updated successfully.');
        return redirect(route('admin.all-contact-infoes'));
    }

    public function destroy($id){
        ContactInfo::deleteContactInfo($id);
        Alert::success('Success', 'Contact information deleted successfully.');
        return back();
    }

    public function view($id){
        $contactInfo = ContactInfo::findOrFail($id);
        return view('backend.contact-infoes.view', [
            'contactInfo' => $contactInfo,
        ]);
    }
}
