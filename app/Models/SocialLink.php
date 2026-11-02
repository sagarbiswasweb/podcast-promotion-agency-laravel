<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    private static $socialLink;

    public static function addSocialLink($request)
    {
        self::$socialLink = new SocialLink();
        self::$socialLink->facebookLink = $request->facebookLink;
        self::$socialLink->instagramLink = $request->instagramLink;
        self::$socialLink->twitterLink = $request->twitterLink;
        self::$socialLink->youtubeLink = $request->youtubeLink;
        self::$socialLink->linkedinLink = $request->linkedinLink;
        self::$socialLink->save();
    }

    public static function updateSocialLink($request, $id)
    {
        self::$socialLink = SocialLink::find($id);
        self::$socialLink->facebookLink = $request->facebookLink;
        self::$socialLink->instagramLink = $request->instagramLink;
        self::$socialLink->twitterLink = $request->twitterLink;
        self::$socialLink->youtubeLink = $request->youtubeLink;
        self::$socialLink->linkedinLink = $request->linkedinLink;
        self::$socialLink->save();
    }

    public static function deleteSocialLink($id)
    {
        self::$socialLink = SocialLink::find($id);
        self::$socialLink->delete();
    }
}
