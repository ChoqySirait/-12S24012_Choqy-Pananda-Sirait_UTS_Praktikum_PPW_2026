@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-del-navy text-white fw-bold py-3">
                <i class="bi bi-plus-circle me-1"></i> Form Registrasi Aset Laboratorium Baru
            </div>
            <div class="card-body p-4 bg-white">
                <form action="{{ route('equipments.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori Perangkat</label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kode Aset Unik</label>
                        <input type="text" name="asset_code" class="form-control @error('asset_code') is-invalid @enderror" value="{{ old('asset_code') }}" placeholder="Contoh: EQ-SRV-003">
                        @error('asset_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Perangkat</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Spesifikasi Lengkap</label>
                        <textarea name="specification" class="form-control" rows="3" placeholder="Processor, RAM, Storage, Port, dll">{{ old('specification') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Estimasi Biaya Sewa Per Hari dalam bentuk rupiah (rp)</label>
                        <input type="number" name="daily_rental_fee" class="form-control @error('daily_rental_fee') is-invalid @enderror" value="{{ old('daily_rental_fee') }}">
                        @error('daily_rental_fee') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Unggah Foto Perangkat</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-2">
                        <a href="{{ route('equipments.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-del-primary fw-bold">
                            <i class="bi bi-save me-1"></i> Simpan Data Aset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection