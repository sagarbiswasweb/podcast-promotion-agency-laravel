<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{
    public function index(){
        $orders = Order::where('user_id', Auth::id())->with('plan.service')->orderByDesc('created_at')->get();
        return view('frontend.user.user-account', [
            'orders' => $orders
        ]);
    }
}
