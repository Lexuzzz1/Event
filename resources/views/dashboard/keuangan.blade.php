@extends('layouts.master')

@section('title', 'Keuangan Dashboard')

@section('content')
    <div class="row pt-10 mt-10">
        <div class="col-12 mt-10 pt-10">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="card-title">Welcome Back Tim Keuangan!</h4>
                            <p class="card-subtitle">
                                Data terbaru yang perlu diproses!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tambahan Menu --}}
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body text-center">
                    <h5 class="card-title">Verifikasi Pembayaran</h5>
                    <a href="{{ route('keuangan.verifikasi') }}" class="btn btn-light mt-2">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body text-center">
                    <h5 class="card-title">Riwayat Transaksi</h5>
                    <a href="{{ route('keuangan.transaksi') }}" class="btn btn-light mt-2">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body text-center">
                    <h5 class="card-title">Laporan Keuangan</h5>
                    <a href="{{ route('keuangan.laporan') }}" class="btn btn-light mt-2">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body text-center">
                    <h5 class="card-title">Unduh Bukti Pembayaran</h5>
                    <a href="{{ route('keuangan.bukti') }}" class="btn btn-light mt-2">Unduh</a>
                </div>
            </div>
        </div>
    </div>
@endsection
