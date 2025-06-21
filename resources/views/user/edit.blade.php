@extends('layouts.master')

@section('title', 'Edit User')

@section('content')
    <div class="card mt-5">
        <div class="card-body">
            <h4 class="card-title mb-4">Edit User</h4>

            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name"
                                   value="{{ old('name', $user->name) }}">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email"
                                   value="{{ old('email', $user->email) }}" readonly>
                            @error('email')
                            <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="role" class="form-label">Role</label>
                            <select name="role_id" class="form-select" id="role">
                                <option value="">Choose the Role</option>
                                <option value="3" {{ $user->role_id == '3' ? 'selected' : '' }}>
                                    Panitia
                                </option>
                                <option value="4" {{ $user->role_id == '4' ? 'selected' : '' }}>
                                    Keuangan
                                </option>
                            </select>
                            @error('role')
                            <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-select" id="status">
                                <option value="">Pilih Status</option>
                                <option value="1" {{ old('status', $user->status) == '1' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="0" {{ old('status', $user->status) == '0' ? 'selected' : '' }}>Nonaktif
                                </option>
                            </select>
                            @error('status')
                            <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection
