@extends('layouts.master')

@section('title', 'Events')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body px-4 py-4">
                    <div class="d-md-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="card-title mb-1 fw-bold">Data Event</h4>
                            <p class="card-subtitle text-muted mb-0">Daftar semua event yang terdaftar.</p>
                        </div>
                        <div>
                            <a href="{{ route('event.create') }}" class="btn btn-outline-primary">
                                + Buat Event
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive mt-4">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-muted">Nama Event</th>
                                    <th class="text-muted">Tanggal</th>
                                    <th class="text-muted">Waktu</th>
                                    <th class="text-muted">Lokasi</th>
                                    <th class="text-muted">Pemateri</th>
                                    <th class="text-muted">Status</th>
                                    <th class="text-muted text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($events as $event)
                                    <tr>
                                        <td>{{ Str::limit(strip_tags($event->name), 25, '...') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</td>
                                        <td>{{ $event->time }}</td>
                                        <td>{{ Str::limit(strip_tags($event->location), 20, '...') }}</td>
                                        <td>{{ Str::limit(strip_tags($event->speaker), 20, '...') }}</td>
                                        <td class="text-capitalize">
                                            @if($event->status == 'active')
                                                <span class="badge bg-success">Aktif</span>
                                            @elseif($event->status == 'inactive')
                                                <span class="badge bg-secondary">Nonaktif</span>
                                            @elseif($event->status == 'pass')
                                                <span class="badge bg-dark">Selesai</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($event->status === 'pass' || $event->created_by !== auth()->id())
                                                <a href="{{ route('event.view', $event->id) }}" class="btn btn-sm btn-secondary">
                                                    View
                                                </a>
                                            @else
                                                <a href="{{ route('event.edit', $event->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Belum ada event yang terdaftar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Toast --}}
                    @if( session('success') )
                        <div class="toast-container position-fixed bottom-0 end-0 p-3">
                            <div class="toast align-items-center border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="d-flex">
                                    <div class="toast-body">
                                        {{ session('success') }}
                                    </div>
                                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const toastElList = [].slice.call(document.querySelectorAll('.toast'))
    toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl).show();
    });
</script>
@endsection
