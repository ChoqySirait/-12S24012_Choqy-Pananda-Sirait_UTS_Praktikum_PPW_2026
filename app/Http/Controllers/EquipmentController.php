<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Category;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Equipment::with('category');

                    if ($request->filled('search')) {
                        $key = $request->search;
                        $query->where(function($q) use ($key) {
                            $q->where('name', 'like', '%' . $key . '%')
                            ->orWhere('asset_code', 'like', '%' . $key . '%');
                        });
                    }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        $equipments = $query->latest()->paginate(5)->appends($request->query());
        $categories = Category::all();

        return view('equipments.index', compact('equipments', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('equipments.create', compact('categories'));
    }

    public function store(Request $request)
    {
                        $request->validate([
                            'category_id' => 'required|exists:categories,id',
                            'asset_code' => 'required|unique:equipments,asset_code',
                            'name' => 'required|min:5|max:150',
                            'daily_rental_fee' => 'required|numeric|min:0',
                            'image' => 'required|image|mimes:jpeg,png,webp|max:2048',
                        ]);

                        $imagePath = null;
                        if ($request->hasFile('image')) {
                            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
                            $imagePath = $request->file('image')->storeAs('equipments', $fileName, 'public');
                        }

                 $equipment = Equipment::create([
                            'category_id' => $request->category_id,
                            'asset_code' => $request->asset_code,
                            'name' => $request->name,
                            'specification' => $request->specification,
                            'condition' => $request->condition ?? 'baik',
                            'status' => 'tersedia',
                            'daily_rental_fee' => $request->daily_rental_fee,
                            'image_path' => $imagePath,
                        ]);

        return redirect()->route('equipments.index')
            ->with('success', "Perangkat '{$equipment->name}' ({$equipment->asset_code}) berhasil didaftarkan.");
    }

    public function show($id)
    {
        $equipment = Equipment::with('category')->findOrFail($id);
        return view('equipments.show', compact('equipment'));
    }
}