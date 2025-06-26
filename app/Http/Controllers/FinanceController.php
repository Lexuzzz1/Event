<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventRegistration;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class FinanceController extends Controller
{
    // Menampilkan dashboard utama Tim Keuangan
    public function index()
    {
        return view('keuangan.dashboard');
    }

    // Menampilkan daftar pembayaran yang belum diverifikasi
    public function verifikasi()
    {
        $registrations = EventRegistration::where('payment_status', 'pending')->with(['user', 'event'])->get();
        return view('keuangan.verifikasi', compact('registrations'));
    }

    // Menampilkan riwayat transaksi yang sudah diverifikasi
    public function transaksi()
    {
        $transactions = EventRegistration::where('payment_status', 'verified')->with(['user', 'event'])->get();
        return view('keuangan.transaksi', compact('transactions'));
    }

    // Menampilkan laporan keuangan (jumlah total pemasukan per event misalnya)
    public function laporan()
    {
        $laporan = EventRegistration::selectRaw('event_id, COUNT(*) as jumlah_peserta, SUM(paid_amount) as total_pembayaran')
            ->where('payment_status', 'verified')
            ->groupBy('event_id')
            ->with('event')
            ->get();

        return view('keuangan.laporan', compact('laporan'));
    }

    // Unduh bukti pembayaran
    public function unduhBukti()
    {
        $registrations = EventRegistration::whereNotNull('proof_of_payment_path')->with(['user', 'event'])->get();
        return view('keuangan.bukti', compact('registrations'));
    }

    // Jika ingin download file langsung (opsional)
    public function downloadBukti($id)
    {
        $registration = EventRegistration::findOrFail($id);
        if ($registration->proof_of_payment_path && Storage::exists($registration->proof_of_payment_path)) {
            return Storage::download($registration->proof_of_payment_path);
        }
        return redirect()->back()->with('error', 'File tidak ditemukan');
    }

    // Menyimpan verifikasi pembayaran
    public function prosesVerifikasi($id)
    {
        $registration = EventRegistration::findOrFail($id);
        $registration->payment_status = 'verified';
        $registration->save();

        return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi.');
    }
}
