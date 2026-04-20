<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatan = Jabatan::orderBy('jabatan')->paginate(10);

        return view('admin.jabatan.index', compact('jabatan'));
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

    public function update(Request $request, string $id)
    {
        $jabatan = Jabatan::findOrFail($id);

        $request->validate([
            'jabatan' => ['required', 'string', 'max:255', Rule::unique('jabatans', 'jabatan')->ignore($jabatan->id)],
        ]);

        $jabatan->update($request->only('jabatan'));

        return redirect()->route('admin.jabatan.index')
            ->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->delete();

        return redirect()->route('admin.jabatan.index')
            ->with('success', 'Jabatan berhasil dihapus.');
    }
}
