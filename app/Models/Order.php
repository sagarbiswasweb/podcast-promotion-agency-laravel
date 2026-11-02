<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    private static $order;
    
    public static function storeOrder($request){
        self::$order = new Order();
        self::$order->user_id = Auth::id();
        self::$order->plan_id = $request->planId;
        self::$order->name = $request->name;
        self::$order->email = $request->email;
        self::$order->phone = $request->phone;
        self::$order->transactionId = $request->transactionId;
        self::$order->link = $request->link;
        // self::$order->country = $reqest->country;
        // Convert country array to comma-separated string
        self::$order->country = is_array($request->country)
            ? implode(', ', $request->country)
            : $request->country;

        self::$order->additionalText = $request->additionalText;
        self::$order->save();
    }


    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
