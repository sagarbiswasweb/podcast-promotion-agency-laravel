<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name'              => 'required|max:255',
            'email'             => 'required|email',
            'phone'             => 'nullable',
            'transactionId'     => 'required|unique:orders,transactionId',
            'link'              => 'required|url',
            'country'           => 'required|array|min:1',
            'country.*'         => 'string',
            'additionalText'    => 'nullable',
        ],[
            'transactionId.unique' => 'This transaction id already exist in our system. Give new one or please contact with us',
        ]);
        Order::storeOrder($request);
        Alert::success('Success', 'Order Placed Successfully');
        return redirect()->route('user.track-order');
    }
}
