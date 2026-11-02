<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index(){
        $services = Service::with('plans')->get();
        return view('frontend.pricing.index', [
            'services' => $services
        ]);
    }
}
