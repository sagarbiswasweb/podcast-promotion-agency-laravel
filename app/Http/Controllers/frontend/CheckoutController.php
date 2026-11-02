<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index($id){
        $plan = Plan::find($id);
        return view('frontend.checkout.index', [
            'plan' => $plan
        ]);
    }
}
