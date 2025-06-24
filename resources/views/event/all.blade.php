@extends('layouts.master')

@section('title', 'Event')

@section('content')
<div class="container py-5">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h3 class="card-title mb-1">Incoming Event!</h3>
                    <p class="card-subtitle text-muted">Event yang Akan Segera Datang!</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Event Cards --}}
    <div class="row g-4">
        @forelse($events as $event)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    @if ($event->poster)
                        <img src="{{ asset('storage/' . $event->poster) }}"
                             class="card-img-top"
                             alt="Event Poster"
                             style="height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('assets/images/default-poster.jpg') }}"
                             class="card-img-top"
                             alt="No Poster"
                             style="height: 200px; object-fit: cover;">
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-2">
                            {{ Str::limit(strip_tags($event->name), 40, '...') }}
                        </h5>
                        <p class="card-text text-muted flex-grow-1">
                            {{ Str::limit(strip_tags($event->description), 80, '...') }}
                        </p>
                        <a href="{{ route('event.detail', $event->id) }}" class="btn btn-primary mt-auto">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Belum ada event yang akan datang.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
