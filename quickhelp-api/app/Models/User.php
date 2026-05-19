<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'id_user';
    public $timestamps = false;

    protected $fillable = [
        'name_user',
        'email_user',
        'password_user',
        'rule_user',
    ];

    protected $hidden = [
        'password_user',
    ];

    public function soses()
    {
        return $this->hasMany(Sos::class, 'id_user', 'id_user');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class, 'id_user', 'id_user');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'id_user', 'id_user');
    }
}
