<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TestimonialController extends Controller
{
    public function index(){
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();
        return view('backend.testimonials.index', [
            'testimonials' => $testimonials
        ]);
    }

    public function create(){
        return view('backend.testimonials.add');
    }

    public function store(Request $request){
        $request->validate([
            'date'      => 'required',
            'name'      => 'required',
            'designation'   => 'required',
            'rating'        => 'required',
            'testimonial'   => 'required'
        ]);
        
        Testimonial::addTestimonial($request);
        Alert::success('Success', 'Testimonial added successfully');
        return back();
    }

    public function edit($id){
        $testimonial = Testimonial::findOrFail($id);
        return view('backend.testimonials.edit', [
            'testimonial' => $testimonial
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'date'      => 'required',
            'name'      => 'required',
            'designation'   => 'required',
            'rating'        => 'required',
            'testimonial'   => 'required'
        ]);
        Testimonial::updateTestimonial($request, $id);
        Alert::success('Success', 'Testimonial updated successfully');
        return redirect()->route('admin.testimonials');
    }

    public function destroy($id){
        Testimonial::deleteTestimonial($id);
        Alert::success('Success', 'Testimonial deleted successfully');
        return back();
    }

    public function view($id){
        $testimonial = Testimonial::findOrFail($id);
        return view('backend.testimonials.view', [
            'testimonial' => $testimonial,
        ]);
    }
}
