<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    private static $message;

    public static function storeMessage($request){
        self::$message = new Message();
        self::$message->senderName = $request->senderName;
        self::$message->senderEmail = $request->senderEmail;
        self::$message->senderPhone = $request->senderPhone;
        self::$message->senderMessage = $request->senderMessage;
        self::$message->save();
    }

    public function replies()
    {
        return $this->hasMany(MessageReply::class);
    }

}
