@extends('layouts.master')

@section('title', 'Verifikasi Pembayaran')

@section('content')
<div class="container mt-5">
    <h3>Verifikasi Pembayaran</h3>
    <table class="table table-bordered mt-3">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Nama Peserta</th>
                <th>Event</th>
                <th>Status</th>
                <th>Bukti Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($registrations as $index => $reg)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $reg->user->name }}</td>
                    <td>{{ $reg->event->name }}</td>
                    <td>{{ $reg->payment_status }}</td>
                    <td>
                        @if($reg->proof_of_payment_path)
                            <a href="{{ asset('storage/' . $reg->proof_of_payment_path) }}" target="_blank">Lihat</a>
                        @else
                            Tidak ada file
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('keuangan.verifikasi.proses', $reg->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Verifikasi</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada pembayaran yang menunggu verifikasi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
