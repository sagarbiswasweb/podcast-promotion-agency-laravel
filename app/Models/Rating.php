<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    private static $rating;

    public static function addRating($request){
        self::$rating = new Rating();
        self::$rating->plan_id = $request->plan;
        self::$rating->clientName = $request->clientName;
        self::$rating->planRating = $request->planRating;
        self::$rating->clientReview = $request->clientReview;
        self::$rating->save();
    }

    public static function updateRating($request, $id){
        self::$rating = Rating::findOrFail($id);
        self::$rating->plan_id = $request->plan;
        self::$rating->clientName = $request->clientName;
        self::$rating->planRating = $request->planRating;
        self::$rating->clientReview = $request->clientReview;
        self::$rating->save();
    }

    public static function deleteRating($id){
        self::$rating = Rating::findOrFail($id);
        self::$rating->delete();
    }

    // reverse one to many relationship with Plan
    public function plan(){
        return $this->belongsTo(Plan::class);
    }
}
