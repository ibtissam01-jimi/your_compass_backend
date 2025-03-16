<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable = ['utilisateur_id', 'service_id'];

    public function utilisateur()
    {
        return $this->belongsTo(utilisateur::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
