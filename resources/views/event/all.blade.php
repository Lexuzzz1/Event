@extends('layouts.master')

@section('title', 'Event')
@section('content')
    <div class="row pt-10 mt-10">
        <div class="col-12 mt-10 pt-10">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Incoming Event!</h4>
                            <p class="card-subtitle">
                                Event yang Akan Segera Datang!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div class="row">
                            @foreach($events as $event)
                                <div class="col-6">
                                    <div class="card h-100">
                                        @if ($event->poster)
                                            <img src="{{ asset('storage/' . $event->poster) }}" class="card-img-top"
                                                 alt="Event Poster" style="height: 200px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('assets/images/default-poster.jpg') }}"
                                                 class="card-img-top" alt="No Poster"
                                                 style="height: 200px; object-fit: cover;">
                                        @endif

                                        <div class="card-body">
                                            <h5 class="card-title">{{ Str::limit(strip_tags($event->name), 20, '...') }}</h5>
                                            <p class="card-text">
                                                {{ Str::limit(strip_tags($event->description), 20, '...') }}
                                            </p>

                                            <a href="{{ route('event.detail', $event->id) }}" class="btn btn-primary">See
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
