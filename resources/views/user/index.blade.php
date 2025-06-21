@extends('layouts.master')

@section('title', 'Users')
@section('content')
    <div class="row pt-10 mt-10">
        <div class="col-12 mt-10 pt-10">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="card-title">Data Users</h4>
                            <p class="card-subtitle">
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('user.create') }}" class="btn btn-outline-primary mx-3 mt-2 d-block">
                                Create User
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                            <thead>
                            <tr>
                                <th scope="col" class="px-0 text-muted">
                                    Name
                                </th>
                                <th scope="col" class="px-0 text-muted">
                                    Role
                                </th>
                                <th scope="col" class="px-0 text-muted">
                                    Email
                                </th>
                                <th scope="col" class="px-0 text-muted">
                                    Status
                                </th>
                                <th scope="col" class="px-0 text-muted text-center">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="px-0">{{$user->name}}</td>
                                    <td class="px-0 text-capitalize">{{$user->role->name}}</td>
                                    <td class="px-0">{{$user->email}}</td>
                                    <td class="px-0 text-capitalize">
                                        @if($user->status == 1)
                                            Aktif
                                        @elseif($user->status == 0)
                                            Non Aktif
                                        @endif
                                    </td>
                                    <td class="px-0 text-center">
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        @if($user->status == 1)
                                            <button type="button" class="btn btn-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal"
                                                    data-user-id="{{ $user->id }}">
                                                <i class="ti ti-x"></i>
                                            </button>
                                        @elseif($user->status == 0)
                                            <button type="button" class="btn btn-success"
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Non active -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="#" id="deleteUserForm">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Nonaktifkan User?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        User akan dinonaktifkan. Kamu bisa mengaktifkannya kembali nanti.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Nonaktifkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Non active -->
    <div class="modal fade" id="activeModal" tabindex="-1" aria-labelledby="activeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="" id="activeUserForm">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Aktifkan User?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        User akan diaktifkan. Kamu bisa mengnonaktifkannya kembali nanti.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Aktifkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{--Toast--}}
    @if( session('success') )
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div class="toast align-items-center border-0 show" role="alert" aria-live="assertive"
                 aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
    <script>
        const toastElList = [].slice.call(document.querySelectorAll('.toast'))
        const toastList = toastElList.map(function (toastEl) {
            return new bootstrap.Toast(toastEl).show();
        });

        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const userId = button.getAttribute('data-user-id');
            const form = document.getElementById('deleteUserForm');
            form.action = `/user/${userId}/deactivate`;
        });

        const activeModal = document.getElementById('activeModal');
        activeModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const userId = button.getAttribute('data-user-id');
            const form = document.getElementById('activeUserForm');
            form.action = `/user/${userId}/activate`;
        });
    </script>
@endsection
