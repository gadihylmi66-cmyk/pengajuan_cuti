<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cutis = Cuti::orderBy('created_at', 'desc')->get();
        $pendingCount = $cutis->count();

        return view('cuti.index', compact('cutis', 'pendingCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = Karyawan::with('user')->get();
        return view('cuti.create', compact('karyawans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_karyawans' => 'required|integer',
            'alasan_cuti' => 'required|string|max:500',
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'required|date|after_or_equal:tanggal_masuk',
        ]);

        Cuti::create($data);

        return redirect()->route('cuti.index')->with('success', 'Pengajuan cuti berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cuti $cuti)
    {
        return view('cuti.show', compact('cuti'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cuti $cuti)
    {
        return view('cuti.edit', compact('cuti'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cuti $cuti)
    {
        $data = $request->validate([
            'id_karyawans' => 'required|integer',
            'alasan_cuti' => 'required|string|max:500',
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'required|date|after_or_equal:tanggal_masuk',
        ]);

        $cuti->update($data);

        return redirect()->route('cuti.index')->with('success', 'Data cuti berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cuti $cuti)
    {
        $cuti->delete();

        return redirect()->route('cuti.index')->with('success', 'Pengajuan cuti berhasil dihapus.');
    }
}
