<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index(){
        $aboutUs = AboutUs::all();
        return view('frontend.about-us.index', [
            'aboutUs' => $aboutUs
        ]);
    }
}
