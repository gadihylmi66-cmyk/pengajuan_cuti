<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisCuti;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JenisCutiController extends Controller
{
    public function index()
    {
        $jenisCutis = JenisCuti::orderBy('nama')->paginate(10);

        return view('admin.jenis-cuti.index', compact('jenisCutis'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255|unique:jenis_cutis,nama',
            'deskripsi' => 'nullable|string|max:1000',
            'maksimal_hari_per_tahun' => 'required|integer|min:1|max:365',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        JenisCuti::create($data);

        return redirect()->route('admin.jenis-cuti.index')->with('success', 'Jenis cuti berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $jenisCuti = JenisCuti::findOrFail($id);

        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255', Rule::unique('jenis_cutis', 'nama')->ignore($jenisCuti->id)],
            'deskripsi' => 'nullable|string|max:1000',
            'maksimal_hari_per_tahun' => 'required|integer|min:1|max:365',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        $jenisCuti->update($data);

        return redirect()->route('admin.jenis-cuti.index')->with('success', 'Jenis cuti berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $jenisCuti = JenisCuti::findOrFail($id);
        $jenisCuti->delete();

        return redirect()->route('admin.jenis-cuti.index')->with('success', 'Jenis cuti berhasil dihapus.');
    }
}
