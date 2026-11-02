<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomEmail extends Model
{
    protected $fillable = [
        'to',
        'subject',
        'message',
        'attachments',

        'source',           // NEW
        'in_reply_to',      // NEW
        'references',       // NEW
        'replied_inbox_id', // NEW
    ];
}
