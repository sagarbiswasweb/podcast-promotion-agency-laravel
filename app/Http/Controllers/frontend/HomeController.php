<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        // eager loading with plans to get all plans under each service 
        $services = Service::with('plans')->get();
        $testimonials = Testimonial::take(5)->get();
        return view('frontend.home', [
            'services' => $services,
            'testimonials' => $testimonials
        ]);
    }
}
