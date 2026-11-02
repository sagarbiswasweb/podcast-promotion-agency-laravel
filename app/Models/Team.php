<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    private static $team, $image, $imageName, $directory, $imageUrl;

    public static function imageUpload($request){

        if($request->hasFile('memberImage')){
            self::$image = $request->memberImage;
            self::$imageName = time() . '_' . uniqid() . '_' . self::$image->getClientOriginalName();
            self::$directory = 'uploads/backend/team-member-images/';
            self::$image->move(self::$directory, self::$imageName);
            return self::$directory . self::$imageName;
        }else{
            return 'uploads/backend/team-member-images/default_team_member_image.jpg';
        }
        
    }

    public static function addTeamMember($request){
        self::$team = new Team();
        self::$team->plan_id = $request->plan;
        self::$team->position = $request->position;
        self::$team->memberName = $request->memberName;
        self::$team->memberImage = self::imageUpload($request);
        self::$team->memberRating = $request->memberRating;
        self::$team->totalReview = $request->totalReview;
        self::$team->portfolioLink = $request->portfolioLink;
        self::$team->memberDescription = $request->memberDescription;
        self::$team->save();
    }

    public static function updateTeamMember($request, $id){
        self::$team = Team::find($id);
        self::$team->plan_id = $request->plan;
        self::$team->position = $request->position;
        self::$team->memberName = $request->memberName;
        if($request->hasFile('memberImage')){
            if(self::$team->memberImage !=='uploads/backend/team-member-images/default_team_member_image.jpg' && file_exists(self::$team->memberImage)){
                unlink(self::$team->memberImage);
            }
            self::$team->memberImage = self::imageUpload($request);
        }
        self::$team->memberRating = $request->memberRating;
        self::$team->totalReview = $request->totalReview;
        self::$team->portfolioLink = $request->portfolioLink;
        self::$team->memberDescription = $request->memberDescription;
        self::$team->save();
    }

    public static function deleteTeamMember($id){
        self::$team = Team::find($id);
        if(self::$team->memberImage !== 'uploads/backend/team-member-images/default_team_member_image.jpg' && file_exists(self::$team->memberImage)){
            unlink(self::$team->memberImage);
        }
        self::$team->delete();
    }


    // reverse one to many relationship with Plan
    public function plan(){
        return $this->belongsTo(Plan::class);
    }
}
