@extends('layouts.master')

@section('title', 'Event Detail')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-body px-4 py-5">
                    {{-- Judul --}}
                    <h2 class="text-center mb-4 fw-bold">{{ $event->name }}</h2>

                    {{-- Poster --}}
                    @if ($event->poster)
                        <div class="text-center mb-5">
                            <img src="{{ asset('storage/' . $event->poster) }}"
                                 alt="Poster"
                                 class="img-fluid rounded shadow"
                                 style="max-height: 350px; object-fit: cover;">
                        </div>
                    @endif

                    {{-- Informasi Event --}}
                    <div class="row gy-4">
                        <div class="col-md-6">
                            <dl class="row mb-0">
                                <dt class="col-sm-5">Tanggal</dt>
                                <dd class="col-sm-7">{{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}</dd>

                                <dt class="col-sm-5">Waktu</dt>
                                <dd class="col-sm-7">{{ \Carbon\Carbon::parse($event->time)->format('H:i') }}</dd>

                                <dt class="col-sm-5">Lokasi</dt>
                                <dd class="col-sm-7">{{ $event->location }}</dd>

                                <dt class="col-sm-5">Pembicara</dt>
                                <dd class="col-sm-7">{{ $event->speaker }}</dd>
                            </dl>
                        </div>

                        <div class="col-md-6">
                            <dl class="row mb-0">
                                <dt class="col-sm-6">Biaya Registrasi</dt>
                                <dd class="col-sm-6">Rp {{ number_format($event->registration_fee, 0, ',', '.') }}</dd>

                                <dt class="col-sm-6">Maksimal Peserta</dt>
                                <dd class="col-sm-6">{{ $event->max_participants }}</dd>
                            </dl>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mt-5">
                        <h5 class="mb-2">Deskripsi</h5>
                        <p class="text-muted">
                            {{ $event->description ?? '-' }}
                        </p>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="text-center mt-4">
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-primary px-4">Login untuk Daftar</a>
                        @else
                            @php
                                $isRegistered = $event->registrations->where('user_id', auth()->id())->first();
                                $isPassed = \Carbon\Carbon::parse($event->date)->isPast();
                                $isFull = $event->registrations->count() >= $event->max_participants;
                            @endphp

                            @if ($isPassed)
                                <button class="btn btn-secondary px-4" disabled>Event Telah Selesai</button>
                            @elseif ($isFull && !$isRegistered)
                                <button class="btn btn-danger px-4" disabled>Kuota Penuh</button>
                            @elseif (!$isRegistered)
                                <form action="{{ route('event.register', $event->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-primary px-4">Daftar Sekarang</button>
                                </form>
                            @else
                                @if ($event->registration_fee == 0)
                                    <button class="btn btn-success px-4" disabled>Anda Sudah Terdaftar</button>
                                @else
                                    @switch($isRegistered->payment_status)
                                        @case('pending')
                                            <a href="{{ route('payment.upload', $event->id) }}" class="btn btn-warning px-4">
                                                Upload Bukti Pembayaran
                                            </a>
                                            @break
                                        @case('paid')
                                            <button class="btn btn-warning px-4" disabled>Menunggu Verifikasi</button>
                                            @break
                                        @case('verified')
                                            <button class="btn btn-success px-4" disabled>Anda Sudah Terdaftar</button>
                                            @break
                                        @default
                                            <a href="{{ route('payment.upload', $event->id) }}" class="btn btn-warning px-4">
                                                Upload Bukti Pembayaran
                                            </a>
                                    @endswitch
                                @endif
                            @endif
                        @endguest
                    </div>

                    {{-- Back Button --}}
                    <div class="mt-4 text-center">
                        <a href="{{ route('event.all') }}" class="btn btn-outline-secondary">← Kembali ke Daftar Event</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
