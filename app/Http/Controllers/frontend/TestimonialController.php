<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index(){
        $testimonials = Testimonial::all();
        return view('frontend.testimonials.index', [
            'testimonials' => $testimonials
        ]);
    }
}
