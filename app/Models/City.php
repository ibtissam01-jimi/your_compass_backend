<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'image', 'location'];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function touristGuides()
    {
        return $this->hasMany(Tourist_Guide::class);
    }
}
