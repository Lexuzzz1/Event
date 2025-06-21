@extends('layouts.master')

@section('title', 'Upload Bukti Pembayaran')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="mb-4">Upload Bukti Pembayaran untuk :</h3>
                <p><strong>{{ $event->name }}</strong></p>

                <form action="{{ route('payment.upload.submit', $event->id) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="proof_of_payment" class="form-label">Bukti Pembayaran</label>
                        <input type="file" class="form-control" id="proof_of_payment" name="proof_of_payment" required>
                        @error('proof_of_payment')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Upload</button>
                    <a href="{{ route('event.all', $event->id) }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
