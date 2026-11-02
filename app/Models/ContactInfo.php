<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    private static $contactInfo;

    public static function addContactInfo($request)
    {
        self::$contactInfo = new ContactInfo();
        self::$contactInfo->email = $request->email;
        self::$contactInfo->phone = $request->phone;
        self::$contactInfo->addressDetails = $request->addressDetails;
        self::$contactInfo->save();
    }

    public static function updateContactInfo($request, $id)
    {
        self::$contactInfo = ContactInfo::findOrFail($id);
        self::$contactInfo->email = $request->email;
        self::$contactInfo->phone = $request->phone;
        self::$contactInfo->addressDetails = $request->addressDetails;
        self::$contactInfo->save();
    }

    public static function deleteContactInfo($id)
    {
        self::$contactInfo = ContactInfo::findOrFail($id);
        self::$contactInfo->delete();
    }
}
