<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'location', 'added_date', 'website_link', 'city_id', 'category_id', 'admin_id'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function category()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function service_submission()
    {
        return $this->belongsTo(Service_Submission::class);
    }
}
