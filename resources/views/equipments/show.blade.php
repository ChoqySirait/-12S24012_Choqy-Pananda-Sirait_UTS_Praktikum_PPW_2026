@extends('layouts.app')

@section('content')
<div class="card border-0 shadow-sm p-4 bg-white">
    <div class="row g-4">
        <div class="col-md-5">
            @if($equipment->image_path)
                <img src="{{ asset('storage/' . $equipment->image_path) }}" class="img-fluid rounded-3 w-100 shadow-sm" alt="{{ $equipment->name }}">
            @else
                <div class="bg-light text-secondary rounded-3 d-flex align-items-center justify-content-center" style="height: 280px;">
                    <i class="bi bi-pc-display display-1"></i>
                </div>
            @endif
        </div>
        <div class="col-md-7">
            <div class="mb-2">
                <span class="badge bg-del-navy me-1">{{ $equipment->category->name }}</span>
                <span class="badge badge-{{ $equipment->status }} text-capitalize">
                    {{ str_replace('_', ' ', $equipment->status) }}
                </span>
            </div>

            <h2 class="fw-bold text-del-navy">{{ $equipment->name }}</h2>
            <p class="text-muted">Kode Aset Registrasi: <strong>{{ $equipment->asset_code }}</strong></p>

            <h4 class="text-primary fw-bold mb-3">
                Rp {{ number_format($equipment->daily_rental_fee, 0, ',', '.') }} <small class="text-muted fs-6">/ hari kalender</small>
            </h4>

            <div class="mb-4">
                <h6 class="fw-bold text-dark"><i class="bi bi-cpu me-1"></i> Spesifikasi Perangkat:</h6>
                <p class="text-secondary bg-light p-3 rounded-3 border">{{ $equipment->specification ?? 'Tidak ada deskripsi spesifikasi khusus.' }}</p>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('equipments.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Katalog
                </a>
                @if($equipment->status === 'tersedia')
                    <a href="{{ route('loans.create', ['equipment_id' => $equipment->id]) }}" class="btn btn-del-primary fw-bold">
                        <i class="bi bi-journal-plus me-1"></i> Ajukan Peminjaman Perangkat
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection