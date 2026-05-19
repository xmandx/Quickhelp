<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';
    protected $primaryKey = 'id_message';
    public $timestamps = false;

    protected $fillable = [
        'name_message',
        'email_message',
        'message_message',
    ];
}
