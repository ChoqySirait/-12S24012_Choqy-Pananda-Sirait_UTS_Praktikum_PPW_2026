@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-del-navy text-white fw-bold py-3">
                <i class="bi bi-journal-arrow-up me-1"></i> Formulir Pengajuan Peminjaman Perangkat
            </div>
            <div class="card-body p-4 bg-white">
                <form action="{{ route('loans.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pilih Perangkat Laboratorium</label>
                        <select name="equipment_id" class="form-select @error('equipment_id') is-invalid @enderror">
                            <option value="">-- Pilih Perangkat --</option>
                            @foreach($equipments as $item)
                                <option value="{{ $item->id }}" {{ (old('equipment_id', $selected_equipment_id) == $item->id) ? 'selected' : '' }}>
                                    {{ $item->name }} (Rp {{ number_format($item->daily_rental_fee, 0, ',', '.') }}/hari) - Status: {{ $item->status }}
                                </option>
                            @endforeach
                        </select>
                        @error('equipment_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Peminjam</label>
                            <input type="text" name="borrower_name" class="form-control @error('borrower_name') is-invalid @enderror" value="{{ old('borrower_name') }}" placeholder="Nama Lengkap">
                            @error('borrower_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NIM Mahasiswa (8 Digit)</label>
                            <input type="text" name="borrower_nim" class="form-control @error('borrower_nim') is-invalid @enderror" value="{{ old('borrower_nim') }}" placeholder="Contoh: 12S24012">
                            @error('borrower_nim') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email Institut Del</label>
                        <input type="email" name="borrower_email" class="form-control @error('borrower_email') is-invalid @enderror" value="{{ old('borrower_email') }}" placeholder="issXXXXX@del.ac.id">
                        @error('borrower_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tanggal Mulai Pinjam</label>
                            <input type="date" name="loan_date" class="form-control @error('loan_date') is-invalid @enderror" value="{{ old('loan_date', date('Y-m-d')) }}">
                            @error('loan_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Rencana Tanggal Pengembalian</label>
                            <input type="date" name="expected_return_date" class="form-control @error('expected_return_date') is-invalid @enderror" value="{{ old('expected_return_date') }}">
                            @error('expected_return_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">*Maksimal durasi peminjaman 7 hari kalender</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tujuan / Keperluan Peminjaman</label>
                        <textarea name="purpose" class="form-control" rows="2" placeholder="Keperluan praktikum / proyek perkuliahan">{{ old('purpose') }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-2">
                        <a href="{{ route('equipments.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-del-primary fw-bold">
                            <i class="bi bi-send me-1"></i> Kirim Pengajuan Peminjaman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection