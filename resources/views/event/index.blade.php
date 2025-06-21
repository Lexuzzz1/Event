@extends('layouts.master')

@section('title', 'Events')
@section('content')
    <div class="row pt-10 mt-10">
        <div class="col-12 mt-10 pt-10">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="card-title">Data Event</h4>
                            <p class="card-subtitle">
                                Daftar semua event yang terdaftar.
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('event.create') }}" class="btn btn-outline-primary mx-3 mt-2 d-block">
                                Buat Event
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                            <thead>
                            <tr>
                                <th scope="col" class="px-0 text-muted">Nama Event</th>
                                <th scope="col" class="px-0 text-muted">Tanggal</th>
                                <th scope="col" class="px-0 text-muted">Waktu</th>
                                <th scope="col" class="px-0 text-muted">Lokasi</th>
                                <th scope="col" class="px-0 text-muted">Pemateri</th>
                                <th scope="col" class="px-0 text-muted">Status</th>
                                <th scope="col" class="px-0 text-muted text-center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td class="px-0">{{ Str::limit(strip_tags($event->name), 10, '...') }}</td>
                                    <td class="px-0">{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</td>
                                    <td class="px-0">{{ $event->time }}</td>
                                    <td class="px-0">{{ Str::limit(strip_tags($event->location), 10, '...') }}</td>
                                    <td class="px-0">{{ Str::limit(strip_tags($event->speaker), 10, '...') }}</td>
                                    <td class="px-0 text-capitalize">
                                        @if($event->status == 'active')
                                            Aktif
                                        @elseif($event->status == 'inactive')
                                            Nonaktif
                                        @elseif($event->status == 'pass')
                                            Selesai
                                        @endif
                                    </td>
                                    <td class="px-0 text-center">
                                        @if ($event->status === 'pass' || $event->created_by !== auth()->id())
                                            <a href="{{ route('event.view', $event->id) }}"
                                               class="btn btn-secondary btn-sm">View Only</a>
                                        @else
                                            <a href="{{ route('event.edit', $event->id) }}" class="btn btn-warning">
                                                <i class="ti ti-edit"></i>
                                            </a>
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
    </script>
@endsection
