@extends('layouts.master')

@section('title', 'Users')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-0 fw-semibold">Data Users</h3>
                <small class="text-muted">Kelola pengguna sistem</small>
            </div>
            <a href="{{ route('user.create') }}" class="btn btn-primary">
                + Create User
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td class="text-capitalize">{{ $user->role->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-capitalize">
                                    @if($user->status == 1)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Non Aktif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    @if($user->status == 1)
                                        <button type="button" class="btn btn-sm btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            data-user-id="{{ $user->id }}">
                                            <i class="ti ti-x"></i>
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-sm btn-success"
                                            data-bs-toggle="modal"
                                            data-bs-target="#activeModal"
                                            data-user-id="{{ $user->id }}">
                                            <i class="ti ti-check"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($users->isEmpty())
                    <p class="text-center mt-4 text-muted">Belum ada data pengguna.</p>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Modal: Nonaktifkan --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="#" id="deleteUserForm">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nonaktifkan User?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    User akan dinonaktifkan. Kamu bisa mengaktifkannya kembali nanti.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Nonaktifkan</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Modal: Aktifkan --}}
<div class="modal fade" id="activeModal" tabindex="-1" aria-labelledby="activeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="#" id="activeUserForm">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Aktifkan User?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    User akan diaktifkan. Kamu bisa menonaktifkannya kembali nanti.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Aktifkan</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Toast --}}
@if( session('success') )
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div class="toast show align-items-center text-white bg-success border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

{{-- Script --}}
<script>
    const toastElList = [].slice.call(document.querySelectorAll('.toast'))
    const toastList = toastElList.map(toastEl => new bootstrap.Toast(toastEl).show());

    document.getElementById('deleteModal').addEventListener('show.bs.modal', function (event) {
        const userId = event.relatedTarget.getAttribute('data-user-id');
        document.getElementById('deleteUserForm').action = `/user/${userId}/deactivate`;
    });

    document.getElementById('activeModal').addEventListener('show.bs.modal', function (event) {
        const userId = event.relatedTarget.getAttribute('data-user-id');
        document.getElementById('activeUserForm').action = `/user/${userId}/activate`;
    });
</script>
@endsection
