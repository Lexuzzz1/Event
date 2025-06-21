@extends('layouts.master')

@section('title', 'View Event')
@section('content')
    <div class="row pt-10 mt-10">
        <div class="col-12 mt-10 pt-10">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="card-title">View Event (Read Only)</h4>
                        </div>
                        <div>
                            <a href="{{ route('event.index') }}" class="btn btn-secondary mx-3 mt-2 d-block">
                                Back
                            </a>
                        </div>
                    </div>

                    <form>
                        <div class="mb-3">
                            <label class="form-label">Event Name</label>
                            <input type="text" class="form-control" value="{{ $event->name }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea readonly class="form-control" rows="4">{{ $event->description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" value="{{ $event->date }}" readonly>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Time</label>
                                    <input type="time" class="form-control" value="{{ $event->time }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" class="form-control" value="{{ $event->location }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Speaker</label>
                            <input type="text" class="form-control" value="{{ $event->speaker }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Poster</label><br>
                            @if ($event->poster)
                                <img src="{{ asset('storage/' . $event->poster) }}" alt="Poster" class="img-fluid"
                                     style="max-height: 300px;">
                            @else
                                <p>No poster uploaded</p>
                            @endif

                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="form-label">Registration Fee</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" name="registration_fee" class="form-control"
                                               value="{{ number_format($event->registration_fee, 0, ',', '.') }}"
                                               id="fee-input" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Max Participants</label>
                                    <input type="number" class="form-control" value="{{ $event->max_participants }}"
                                           readonly>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <input type="text" class="form-control" value="{{ ucfirst($event->status) }}" readonly>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const feeInput = document.getElementById('fee-input');
            if (feeInput) {
                feeInput.addEventListener('input', function (e) {
                    let value = e.target.value.replace(/\D/g, '');
                    e.target.value = new Intl.NumberFormat('id-ID').format(value);
                });
            }
        });
    </script>
@endpush
