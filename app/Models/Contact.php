<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Définir les champs que vous pouvez remplir
    protected $fillable = ['nom', 'email', 'message', 'telephone'];
}
