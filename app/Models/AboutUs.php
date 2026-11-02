<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    private static $aboutUs, $image, $imageName, $directory, $imageUrl;

    public static function imageUpload($request){

        if($request->hasFile('aboutUsImage')){
            self::$image = $request->aboutUsImage;
            self::$imageName = time() . '_' . uniqid() . '_' . self::$image->getClientOriginalName();
            self::$directory = 'uploads/backend/about-us-images/';
            self::$image->move(self::$directory, self::$imageName);
            return self::$directory . self::$imageName;
        }else{
            return 'uploads/backend/about-us-images/default_about_us_image.jpg';
        }
        
    }

    public static function addAboutUs($request){
        self::$aboutUs = new AboutUs();
        self::$aboutUs->aboutUsImage = self::imageUpload($request);
        self::$aboutUs->aboutUsDetails = $request->aboutUsDetails;
        self::$aboutUs->save();
    }

    public static function updateAboutUs($request, $id){
        self::$aboutUs = AboutUs::find($id);
        if($request->hasFile('aboutUsImage')){
            if(self::$aboutUs->aboutUsImage !== 'uploads/backend/about-us-images/default_about_us_image.jpg' && file_exists(self::$aboutUs->aboutUsImage)){
                unlink(self::$aboutUs->aboutUsImage);
            }
            self::$aboutUs->aboutUsImage = self::imageUpload($request);
        }
        self::$aboutUs->aboutUsDetails = $request->aboutUsDetails;
        self::$aboutUs->save();
    }

    public static function deleteAboutUs($id){
        self::$aboutUs = AboutUs::find($id);
        if(self::$aboutUs->aboutUsImage !== 'uploads/backend/about-us-images/default_about_us_image.jpg' && file_exists(self::$aboutUs->aboutUsImage)){
            unlink(self::$aboutUs->aboutUsImage);
        }
        self::$aboutUs->delete();
    }

}
