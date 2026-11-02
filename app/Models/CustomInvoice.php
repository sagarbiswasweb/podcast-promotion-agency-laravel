<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomInvoice extends Model
{
    private static $customInvoice;

    public static function createCustomInvoice($request){
        self::$customInvoice = new CustomInvoice();
        
        self::$customInvoice->serviceName = $request->serviceName;
        self::$customInvoice->price = $request->price;
        self::$customInvoice->duration = $request->duration;
        self::$customInvoice->features = $request->features;
        self::$customInvoice->link = $request->link;
        self::$customInvoice->country = $request->country;

        self::$customInvoice->clientName = $request->clientName;
        self::$customInvoice->clientEmail = $request->clientEmail;
        self::$customInvoice->clientPhone = $request->clientPhone;

        self::$customInvoice->paymentMethod = $request->paymentMethod;
        self::$customInvoice->transactionId = $request->transactionId;
        self::$customInvoice->amountPaid = $request->amountPaid;
        self::$customInvoice->tips = $request->tips;

        self::$customInvoice->save();

        return self::$customInvoice;
    }

    public static function updateCustomInvoice($id, $request){
        self::$customInvoice = CustomInvoice::findOrFail($id);
        
        self::$customInvoice->serviceName = $request->serviceName;
        self::$customInvoice->price = $request->price;
        self::$customInvoice->duration = $request->duration;
        self::$customInvoice->features = $request->features;
        self::$customInvoice->link = $request->link;
        self::$customInvoice->country = $request->country;

        self::$customInvoice->clientName = $request->clientName;
        self::$customInvoice->clientEmail = $request->clientEmail;
        self::$customInvoice->clientPhone = $request->clientPhone;

        self::$customInvoice->paymentMethod = $request->paymentMethod;
        self::$customInvoice->transactionId = $request->transactionId;
        self::$customInvoice->amountPaid = $request->amountPaid;
        self::$customInvoice->tips = $request->tips;

        self::$customInvoice->save();

        return self::$customInvoice;
    }

    public static function deleteCustomInvoice($id){
        self::$customInvoice = CustomInvoice::findOrFail($id);
        self::$customInvoice->delete();
    }
}
