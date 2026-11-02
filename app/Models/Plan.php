<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Plan extends Model
{
    private static $plan;

    public static function generateUniqueSlug($name){
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (self::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public static function addPlan($request){
        self::$plan = new Plan();
        self::$plan->service_id = $request->service;
        self::$plan->planName = $request->planName;
        self::$plan->slug = self::generateUniqueSlug($request->planName);
        self::$plan->planPrice = $request->planPrice;
        self::$plan->planDuration = $request->planDuration;
        self::$plan->planFeatures = json_encode($request->planFeatures);
        self::$plan->planDescription = $request->planDescription;
        self::$plan->save();
    }

    public static function updatePlan($request, $id){
        self::$plan = Plan::find($id);
        self::$plan->service_id = $request->service;
        self::$plan->planName = $request->planName;
        self::$plan->slug = self::generateUniqueSlug($request->planName);
        self::$plan->planPrice = $request->planPrice;
        self::$plan->planDuration = $request->planDuration;
        self::$plan->planFeatures = json_encode($request->planFeatures);
        self::$plan->planDescription = $request->planDescription;
        self::$plan->save();
    }

    public static function deletePlan($id){
        self::$plan = Plan::find($id);
        self::$plan->delete();
    }

    // reverse one to many relationship with Service 
    public function service(){
        return $this->belongsTo(Service::class);
    }

    // one to many relationship with Rating
    public function ratings(){
        return $this->hasMany(Rating::class);
    }

    // one to many relationship with Team
    public function teams(){
        return $this->hasMany(Team::class);
    }
}
