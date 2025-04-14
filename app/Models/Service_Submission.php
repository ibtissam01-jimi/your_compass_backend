<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service_Submission extends Model
{
    use HasFactory;
    protected $table='service_submissions';
    protected $fillable = ['description', 'date', 'status', 'user_id', 'service_id'];

    public function utilisateur()
    {
        return $this->belongsTo(User::class);
    }
}
