<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\LoanRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function create(Request $request)
    {
        $equipments = Equipment::all();
        $selected_equipment_id = $request->query('equipment_id');

        return view('loans.create', compact('equipments', 'selected_equipment_id'));
    }

    public function store(Request $request)
    {
                        $request->validate([
                                'equipment_id' => 'required|exists:equipments,id',
                                'borrower_name' => 'required|min:8',
                                'borrower_nim' => 'required|size:10',
                                'borrower_email' => 'required|email',
                                'loan_date' => 'required|date|after_or_equal:today',
                                'expected_return_date' => 'required|date|after_or_equal:loan_date',
                            ], [
                                'borrower_name.min' => 'Nama peminjam wajib diisi minimal 8 karakter',
                                'borrower_nim.size' => 'Format NIM harus terdiri dari 10 digit',
                                'borrower_email.email' => 'Format email tersebut tidak valid',
                                'loan_date.after_or_equal' => 'Tanggal peminjaman tidak boleh sebelum hari ini.',
                            ]);

        $equipment = Equipment::findOrFail($request->equipment_id);

        if ($equipment->status !== 'tersedia') {
            return back()->withInput()->withErrors([
                'equipment_id' => "Perangkat {$equipment->name} sedang {$equipment->status}."
            ])->with('error', 'Pengajuan tidak dapat diproses.');
        }

        $start = Carbon::parse($request->loan_date);
        $end = Carbon::parse($request->expected_return_date);
        $days = $start->diffInDays($end) + 1;

             if ($days > 7) {
           return back()->withInput()->withErrors([
           'expected_return_date' => 'Durasi peminjaman maksimal 7 hari.'
          ])->with('error', 'Pengajuan gagal diproses.'); }

        $totalFee = $days * $equipment->daily_rental_fee;

                            LoanRequest::create([
                                'equipment_id' => $equipment->id,
                                'borrower_name' => $request->borrower_name,
                                'borrower_nim' => $request->borrower_nim,
                                'borrower_email' => $request->borrower_email,
                                'loan_date' => $request->loan_date,
                                'expected_return_date' => $request->expected_return_date,
                                'purpose' => $request->purpose,
                                'status' => 'diajukan',
                                'total_estimated_fee' => $totalFee,
                            ]);

        $equipment->update(['status' => 'dipinjam']);


        return redirect()->route('equipments.index')
            ->with('success', 'Pengajuan peminjaman berhasil dikirim.');
    }
}