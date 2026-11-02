<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackOrderController extends Controller
{
    public function index(){
        $orders = Order::where('user_id', Auth::id())->with('plan.service')->orderByDesc('created_at')->get();
        return view('frontend.user.track-order',[
            'orders' => $orders
        ]);
    }

    public function orderDetails($id){
        $order = Order::findOrFail($id);
        return view('frontend.user.order-details', [
            'order' => $order
        ]);
    }
}
