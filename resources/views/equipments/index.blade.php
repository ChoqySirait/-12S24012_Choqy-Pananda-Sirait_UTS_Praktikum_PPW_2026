@extends('layouts.app')

@section('content')
<div class="bg-white p-3 rounded-3 shadow-sm mb-4 border-start border-4 border-primary">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold text-del-navy mb-1"><i class="bi bi-box-seam me-2"></i>Katalog Aset & Inventaris Lab</h4>
            <p class="text-muted small mb-0">Layanan pencarian ketersediaan perangkat laboratorium IT Del</p>
        </div>
        <a href="{{ route('equipments.create') }}" class="btn btn-del-primary btn-sm px-3 py-2 fw-bold">
            <i class="bi bi-plus-lg me-1"></i> Registrasi Aset Baru
        </a>
    </div>
</div>

<!-- Filter Box ala CIS -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-del-navy text-white py-2 fw-semibold" style="font-size: 0.9rem;">
        <i class="bi bi-funnel-fill me-1"></i> Filter & Pencarian Data
    </div>
    <div class="card-body bg-light">
        <form action="{{ route('equipments.index') }}" method="GET" class="row g-2">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari kata kunci nama / kode aset..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="category_id" class="form-select form-select-sm">
                    <option value="">-- Semua Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select form-select-sm">
                    <option value="semua" {{ request('status') == 'semua' ? 'selected' : '' }}>-- Semua Status --</option>
                    <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="dalam_perbaikan" {{ request('status') == 'dalam_perbaikan' ? 'selected' : '' }}>Dalam Perbaikan</option>
                </select>
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-warning btn-sm fw-bold">
                    <i class="bi bi-search me-1"></i> Terapkan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Grid Card Aset -->
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    @forelse($equipments as $item)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm">
                @if($item->image_path)
                    <img src="{{ asset('storage/' . $item->image_path) }}" class="card-img-top card-img-asset" alt="{{ $item->name }}">
                @else
                    <div class="bg-secondary bg-opacity-10 text-secondary d-flex align-items-center justify-content-center card-img-asset">
                        <i class="bi bi-pc-display display-4"></i>
                    </div>
                @endif

                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge bg-light text-dark border">{{ $item->category->name }}</span>
                        <span class="badge badge-{{ $item->status }} text-capitalize px-2 py-1">
                            {{ str_replace('_', ' ', $item->status) }}
                        </span>
                    </div>

                    <h5 class="card-title fw-bold text-del-navy mb-1" style="font-size: 1.05rem;">{{ $item->name }}</h5>
                    <p class="text-muted small mb-2"><i class="bi bi-tag-fill me-1"></i>Kode: <strong>{{ $item->asset_code }}</strong></p>

                    <p class="text-primary fw-bold fs-6 mt-auto mb-3">
                        Rp {{ number_format($item->daily_rental_fee, 0, ',', '.') }} <span class="text-muted fs-6 fw-normal">/ hari</span>
                    </p>

                    <div class="d-grid gap-2">
                        <a href="{{ route('equipments.show', $item->id) }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-info-circle me-1"></i> Detail
                        </a>
                        @if($item->status === 'tersedia')
                            <a href="{{ route('loans.create', ['equipment_id' => $item->id]) }}" class="btn btn-del-primary btn-sm fw-bold">
                                <i class="bi bi-hand-index-thumb me-1"></i> Pinjam
                            </a>
                        @else
                            <button class="btn btn-secondary btn-sm" disabled>Tidak Tersedia</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5 bg-white rounded-3 shadow-sm">
            <i class="bi bi-inbox display-3 text-muted"></i>
            <p class="text-muted mt-2">Data aset tidak ditemukan dalam pencarian.</p>
        </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $equipments->links() }}
</div>
@endsection