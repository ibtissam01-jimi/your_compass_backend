<?php
// Notification.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'send_date', 'type', 'user_id', 'admin_id', 'is_admin', 'is_read'];

    public function utilisateur()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    // Scope pour les notifications destinées aux admins
    public function scopeForAdmin($query)
    {
        return $query->where('is_admin', true);
    }

    // Scope pour récupérer les notifications non lues
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
}

