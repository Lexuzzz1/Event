@extends('layouts.master')

@section('title', 'Create User')
@section('content')
    <div class="row pt-10 mt-10">
        <div class="col-12 mt-10 pt-10">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="card-title">Create User</h4>
                            <p class="card-subtitle">
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('user.index') }}" class="btn btn-danger mx-3 mt-2 d-block">
                                Cancel
                            </a>
                        </div>
                    </div>
                    {{--Form User--}}
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                           value="{{ old('name') }}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                           value="{{ old('email') }}">
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                    @error('password')
                                    <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label for="role" class="form-label">Role</label>
                                    <select name="role_id" class="form-select" id="role">
                                        <option value="">Choose the Role</option>
                                        <option value="3" {{ old('role_id') == '3' ? 'selected' : '' }}>
                                            Panitia
                                        </option>
                                        <option value="4" {{ old('role_id') == '4' ? 'selected' : '' }}>
                                            Keuangan
                                        </option>
                                    </select>
                                    @error('role')
                                    <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                           id="password_confirmation">
                                </div>
                                <div class="col-sm-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" class="form-select" id="status">
                                        <option value="">Pilih Status</option>
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                    @error('status')
                                    <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success mt-10">Confirm</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
