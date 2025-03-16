<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = ['last_connection', 'first_name', 'name', 'email', 'password'];

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function cities()
    {
        return $this->hasMany(Cities::class);
    }

}
