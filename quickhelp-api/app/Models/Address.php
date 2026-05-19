<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'adress';
    protected $primaryKey = 'id_address';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'state_address',
        'city_address',
        'neighborhood_address',
        'street_address',
        'number_address',
        'complement_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
