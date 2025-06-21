@extends('layouts.master')

@section('title', 'Event Detail')

@section('content')
    <div class="row pt-10 mt-10">
        <div class="col-12 mt-10 pt-10">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">{{ $event->name }}</h2>

                    @if ($event->poster)
                        <div class="mb-4 text-center">
                            <img src="{{ asset('storage/' . $event->poster) }}" alt="Poster"
                                 class="img-fluid rounded shadow" style="max-height: 350px; object-fit: cover;">
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">Date</dt>
                                <dd class="col-sm-8">{{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}</dd>

                                <dt class="col-sm-4">Time</dt>
                                <dd class="col-sm-8">{{ \Carbon\Carbon::parse($event->time)->format('H:i') }}</dd>

                                <dt class="col-sm-4">Location</dt>
                                <dd class="col-sm-8">{{ $event->location }}</dd>

                                <dt class="col-sm-4">Speaker</dt>
                                <dd class="col-sm-8">{{ $event->speaker }}</dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-5">Registration Fee</dt>
                                <dd class="col-sm-7">Rp {{ number_format($event->registration_fee, 0, ',', '.') }}</dd>

                                <dt class="col-sm-5">Max Participants</dt>
                                <dd class="col-sm-7">{{ $event->max_participants }}</dd>

                            </dl>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p>Description</p>
                            <p>{{ $event->description ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        {{-- Tombol Registrasi --}}
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-primary px-4">Login to Register</a>
                        @else
                            @php
                                $isRegistered = $event->registrations->where('user_id', auth()->id())->first();
                                $isPassed = \Carbon\Carbon::parse($event->date)->isPast();
                                $isFull = $event->registrations->count() >= $event->max_participants;
                            @endphp

                            @if ($isPassed)
                                <button class="btn btn-secondary px-4" disabled>Event Has Passed</button>
                            @elseif ($isFull && !$isRegistered)
                                <button class="btn btn-danger px-4" disabled>Kuota Penuh</button>
                            @elseif (!$isRegistered)
                                <form action="{{ route('event.register', $event->id) }}" method="POST"
                                      style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary px-4">Register</button>
                                </form>
                            @else
                                @if ($event->registration_fee == 0)
                                    <button class="btn btn-success px-4" disabled>Anda Sudah Terdaftar</button>
                                @else
                                    @switch($isRegistered->payment_status)
                                        @case('pending')
                                            <a href="{{ route('payment.upload', $event->id) }}"
                                               class="btn btn-warning px-4">
                                                Upload Payment Proof
                                            </a>
                                            @break
                                        @case('paid')
                                            <button class="btn btn-warning px-4" disabled>Menunggu Verifikasi</button>
                                            @break
                                        @case('verified')
                                            <button class="btn btn-success px-4" disabled>Anda Sudah Terdaftar</button>
                                            @break
                                        @default
                                            <a href="{{ route('payment.upload', $event->id) }}"
                                               class="btn btn-warning px-4">
                                                Upload Payment Proof
                                            </a>
                                    @endswitch
                                @endif
                            @endif
                        @endguest
                    </div>

                    <div class="mt-4 text-center">
                        <a href="{{ route('event.all') }}" class="btn btn-outline-secondary">Back to Events</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
