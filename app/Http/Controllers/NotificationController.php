<?php
// NotificationController.php
namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Fonction pour obtenir le nombre de notifications non lues pour un admin
    public function getUnreadNotificationsCount(Request $request)
    {
        if (!$request->user()->is_admin) {
            return response()->json(['message' => 'Access denied'], 403); // Refuser l'accès si l'utilisateur n'est pas un admin
        }

        // Récupérer le nombre de notifications non lues pour l'admin
        $unreadCount = Notification::forAdmin()
            ->unread()
            ->count();

        return response()->json(['unread_count' => $unreadCount]);
    }
}
