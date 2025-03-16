<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tourist_Guide extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'first_name', 'cin', 'address', 'email', 'phone_number', 'cv', 'photo', 'city_id'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
