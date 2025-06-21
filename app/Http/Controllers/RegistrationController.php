<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegistrationController extends Controller
{
    // Simpan registrasi event
    public function store(Event $event)
    {
        $user = Auth::user();

        // Cek apakah sudah terdaftar
        $existing = Registration::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->first();

        if ($existing) {
            return redirect()->back()->with('info', 'Anda sudah terdaftar dalam event ini.');
        }

        $registration = Registration::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'payment_status' => $event->registration_fee > 0 ? 'pending' : 'verified',
        ]);

        if ($event->registration_fee > 0) {
            return redirect()->route('payment.upload', $event->id)->with('info', 'Silakan upload bukti pembayaran.');
        } else {
            return redirect()->back()->with('success', 'Berhasil mendaftar.');
        }
    }

    // Tampilkan form upload pembayaran
    public function uploadForm(Event $event)
    {
        $registration = Registration::where('user_id', Auth::id())
            ->where('event_id', $event->id)
            ->firstOrFail();

        return view('payment.upload', compact('event', 'registration'));
    }

    // Proses upload bukti pembayaran
    public function uploadPayment(Request $request, Event $event)
    {
        $request->validate([
            'proof_of_payment' => 'required|image|max:2048',
        ]);

        $registration = Registration::where('user_id', Auth::id())
            ->where('event_id', $event->id)
            ->firstOrFail();

        // Simpan file
        $path = $request->file('proof_of_payment')->store('payments', 'public');

        $registration->update([
            'proof_of_payment_path' => $path,
            'payment_status' => 'paid',
        ]);

        return redirect()->route('event.show', $event->id)->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu konfirmasi.');
    }
}
