<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index($slug){
        $service = Service::where('slug', $slug)->firstOrFail();
        return view('frontend.services.index', [
            'service' => $service
        ]);
    }
}
