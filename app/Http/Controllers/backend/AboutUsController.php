<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AboutUsController extends Controller
{
    public function index(){
        $aboutUs = AboutUs::all();
        return view('backend.about-us.index', [
            'aboutUs' => $aboutUs,
        ]);
    }

    public function create(){
        return view('backend.about-us.add');
    }

    public function store(Request $request){
        $request->validate([
            'aboutUsImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'aboutUsDetails' => 'required|string',
        ]);

        if (AboutUs::exists()) {
            Alert::error('Error', 'About us already exists. You can edit it or delete it before adding a new one.');
            return redirect(route('admin.about-us'));
        }

        AboutUs::addAboutUs($request);
        Alert::success('Success', 'About Us added successfully.');
        return redirect()->route('admin.about-us');
    }

    public function edit($id){
        $aboutUs = AboutUs::findOrFail($id);
        return view('backend.about-us.edit', [
            'aboutUs' => $aboutUs,
        ]);
    }
    
    public function update(Request $request, $id){
        $request->validate([
            'aboutUsImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'aboutUsDetails' => 'required|string',
        ]);
        AboutUs::updateAboutUs($request, $id);
        Alert::success('Success', 'About Us updated successfully.');
        return redirect()->route('admin.about-us');
    }

    public function destroy($id){
        AboutUs::deleteAboutUs($id);
        Alert::success('Success', 'About us deleted successfully');
        return back();
    }

    public function view($id){
        $aboutUs = AboutUs::findOrFail($id);
        return view('backend.about-us.view', [
            'aboutUs' => $aboutUs
        ]);
    }
}
