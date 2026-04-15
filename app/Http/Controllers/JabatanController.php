<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatan = Jabatan::orderBy('jabatan')->get();
        return view('admin.jabatan.index', compact('jabatan'));
    }

    public function create()
    {
        return view('admin.jabatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jabatan' => 'required|string|max:255|unique:jabatans,jabatan',
        ]);

        Jabatan::create($request->only('jabatan'));

        return redirect()->route('admin.jabatan.index')
            ->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $jabatan = Jabatan::findOrFail($id);
        return view('admin.jabatan.edit', compact('jabatan'));
    }

    public function update(Request $request, string $id)
    {
        $jabatan = Jabatan::findOrFail($id);

        $request->validate([
            'jabatan' => 'required|string|max:255|unique:jabatans,jabatan,' . $jabatan->id,
        ]);

        $jabatan->update($request->only('jabatan'));

        return redirect()->route('admin.jabatan.index')
            ->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroy(Jabatan $jabatan)
    {
        $jabatan->delete();

        return redirect()->route('admin.jabatan.index')
            ->with('success', 'Jabatan berhasil dihapus.');
    }
}
