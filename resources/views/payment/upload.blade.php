@extends('layouts.master')

@section('title', 'Upload Bukti Pembayaran')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h4 class="mb-3 fw-bold text-primary">Upload Bukti Pembayaran</h4>
                    <p class="mb-4">Silakan unggah bukti pembayaran untuk event:</p>

                    <h5 class="mb-4">{{ $event->name }}</h5>

                    <form action="{{ route('payment.upload.submit', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="proof_of_payment" class="form-label">Bukti Pembayaran (JPG/PNG, max 2MB)</label>
                            <input type="file" class="form-control @error('proof_of_payment') is-invalid @enderror" name="proof_of_payment" id="proof_of_payment" required>
                            @error('proof_of_payment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('event.detail', $event->id) }}" class="btn btn-outline-secondary">
                                ← Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Upload Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
