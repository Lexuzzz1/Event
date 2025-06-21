<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
            $user = Auth::user();

            $events = Event::where('status', 'active')
                ->where(function ($query) {
                    $now = Carbon::now();
                    $query->where('date', '>', $now->toDateString())
                        ->orWhere(function ($q) use ($now) {
                            $q->where('date', $now->toDateString())
                                ->where('time', '>=', $now->format('H:i'));
                        });
                })
                ->orderBy('date')
                ->orderBy('time')
                ->take(3)
                ->get();

            switch ($user->role_id) {
                case 1:
                    return view('dashboard.member', compact('events'));
                case 2:
                    return view('dashboard.admin');
                case 3:
                    return view('dashboard.panitia');
                case 4:
                    return view('dashboard.keuangan');
            }
    }
}
