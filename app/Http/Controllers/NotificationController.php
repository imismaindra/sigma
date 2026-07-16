<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->notifications()
            ->with('pengaduan')
            ->latest()
            ->paginate(15);

        $unreadNotifications = $user->notifications()->whereNull('read_at')->count();

        return view('mahasiswa.notifications.index', [
            'notifications' => $notifications,
            'unreadNotifications' => $unreadNotifications,
        ]);
    }

    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->update(['read_at' => now()]);

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back();
    }

    public function markAllAsRead()
    {
        Auth::user()->notifications()->whereNull('read_at')->update(['read_at' => now()]);

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Semua notifikasi telah ditandai dibaca.');
    }

    public function unreadCount()
    {
        $count = Auth::user()->notifications()->whereNull('read_at')->count();
        return response()->json(['count' => $count]);
    }

    public function adminIndex()
    {
        $user = Auth::user();
        $notifications = $user->notifications()
            ->with('pengaduan')
            ->latest()
            ->paginate(15);

        $unreadNotifications = $user->notifications()->whereNull('read_at')->count();

        return view('admin.notifications.index', [
            'notifications' => $notifications,
            'unreadNotifications' => $unreadNotifications,
        ]);
    }

    public function adminMarkAllAsRead()
    {
        Auth::user()->notifications()->whereNull('read_at')->update(['read_at' => now()]);

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Semua notifikasi telah ditandai dibaca.');
    }

    public function adminUnreadCount()
    {
        $count = Auth::user()->notifications()->whereNull('read_at')->count();
        return response()->json(['count' => $count]);
    }

    public function adminLatest()
    {
        $notifications = Auth::user()->notifications()
            ->with('pengaduan')
            ->latest()
            ->limit(5)
            ->get();
        $unreadCount = Auth::user()->notifications()->whereNull('read_at')->count();

        return response()->json([
            'notifications' => $notifications->map(function ($n) {
                return [
                    'id' => $n->id_notification,
                    'title' => $n->title,
                    'message' => $n->message,
                    'read_at' => $n->read_at,
                    'is_unread' => is_null($n->read_at),
                    'created_at' => $n->created_at->diffForHumans(),
                    'url' => $n->id_pengaduan ? route('admin.pengaduan.show', $n->id_pengaduan) : '#',
                ];
            }),
            'unread_count' => $unreadCount,
        ]);
    }

    public function latest()
    {
        $notifications = Auth::user()->notifications()
            ->with('pengaduan')
            ->latest()
            ->limit(5)
            ->get();
        $unreadCount = Auth::user()->notifications()->whereNull('read_at')->count();

        return response()->json([
            'notifications' => $notifications->map(function ($n) {
                return [
                    'id' => $n->id_notification,
                    'title' => $n->title,
                    'message' => $n->message,
                    'read_at' => $n->read_at,
                    'is_unread' => is_null($n->read_at),
                    'created_at' => $n->created_at->diffForHumans(),
                    'url' => $n->id_pengaduan ? route('mahasiswa.pengaduan.show', $n->id_pengaduan) : '#',
                ];
            }),
            'unread_count' => $unreadCount,
        ]);
    }
}
