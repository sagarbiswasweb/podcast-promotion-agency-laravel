<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index(){
        $privacyPolicy = PrivacyPolicy::all();
        return view('frontend.privacy-policy.index', [
            'privacyPolicy' => $privacyPolicy
        ]);
    }
}
