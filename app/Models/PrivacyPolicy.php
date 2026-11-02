<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivacyPolicy extends Model
{
    private static $privacyPolicy;

    public static function addPrivacyPolicy($request)
    {
        self::$privacyPolicy = new PrivacyPolicy();
        self::$privacyPolicy->privacyPolicy = $request->privacyPolicy;
        self::$privacyPolicy->save();
    }

    public static function updatePrivacyPolicy($request, $id)
    {
        self::$privacyPolicy = PrivacyPolicy::find($id);
        self::$privacyPolicy->privacyPolicy = $request->privacyPolicy;
        self::$privacyPolicy->save();
    }
    
    public static function deletePrivacyPolicy($id)
    {
        self::$privacyPolicy = PrivacyPolicy::find($id);
        self::$privacyPolicy->delete();
    }
}
