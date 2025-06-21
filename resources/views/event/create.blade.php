@extends('layouts.master')

@section('title', 'Create Event')
@section('content')
    <div class="row pt-10 mt-10">
        <div class="col-12 mt-10 pt-10">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="card-title">Create Event</h4>
                        </div>
                        <div>
                            <a href="{{ route('event.index') }}" class="btn btn-danger mx-3 mt-2 d-block">
                                Cancel
                            </a>
                        </div>
                    </div>

                    {{-- Form Event --}}
                    <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Event Name</label>
                            <input type="text" name="name" class="form-control" id="name"
                                   value="{{ old('name') }}">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control"
                                      rows="4">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" name="date" class="form-control" id="date"
                                       value="{{ old('date') }}" min="{{ now()->toDateString() }}">
                                @error('date')
                                <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="time" class="form-label">Time</label>
                                <input type="time" name="time" class="form-control" id="time"
                                       value="{{ old('time') }}">
                                @error('time')
                                <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" name="location" class="form-control" id="location"
                                   value="{{ old('location') }}">
                            @error('location')
                            <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="speaker" class="form-label">Speaker Name</label>
                            <input type="text" name="speaker" class="form-control" id="speaker"
                                   value="{{ old('speaker') }}">
                            @error('speaker')
                            <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="poster" class="form-label">Poster</label>
                            <input type="file" name="poster" id="poster" class="form-control">
                            @error('poster')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label class="form-label">Registration Fee</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" name="registration_fee" class="form-control"
                                           value="{{ old('registration_fee', isset($event) ? number_format($event->registration_fee, 0, ',', '.') : '') }}"
                                           id="fee-input">
                                </div>
                                @error('registration_fee')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="max_participants" class="form-label">Maximum Participants</label>
                                <input type="number" name="max_participants" class="form-control" id="max_participants"
                                       value="{{ old('max_participants') }}" min="1">
                                @error('max_participants')
                                <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                            @error('status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success mt-4">Create Event</button>
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
