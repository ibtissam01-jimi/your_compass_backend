<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['content', 'publication_date', 'status', 'utilisateur_id', 'service_id', 'guide_id'];

    public function user()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function guide()
    {
        return $this->belongsTo(Tourist_Guide::class, 'guide_id');
    }
}
