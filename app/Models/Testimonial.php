<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    private static $testimonial;

    public static function addTestimonial($request){
        $convertedDate = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');

        self::$testimonial = new Testimonial();
        self::$testimonial->date = $convertedDate;
        self::$testimonial->name = $request->name;
        self::$testimonial->designation = $request->designation;
        self::$testimonial->rating = $request->rating;
        self::$testimonial->testimonial = $request->testimonial;
        self::$testimonial->save(); 
    }

    public static function updateTestimonial($request, $id){
        $convertedDate = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');

        self::$testimonial = Testimonial::find($id);
        self::$testimonial->date = $convertedDate;
        self::$testimonial->name = $request->name;
        self::$testimonial->designation = $request->designation;
        self::$testimonial->rating = $request->rating;
        self::$testimonial->testimonial = $request->testimonial;
        self::$testimonial->save(); 
    }

    public static function deleteTestimonial($id){
        self::$testimonial = Testimonial::find($id);
        self::$testimonial->delete();
    }
    
}
