<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawans = Karyawan::with(['user', 'jabatan'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.karyawan.index', compact('karyawans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::orderBy('name')->get();
        $jabatans = Jabatan::orderBy('jabatan')->get();

        return view('admin.karyawan.create', compact('users', 'jabatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_jabatan' => 'required|exists:jabatans,id',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:100',
            'alamat' => 'required|string|max:500',
            'no_telp' => 'required|string|max:30',
        ]);

        Karyawan::create($data);

        return redirect()->route('admin.karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( string $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $users = User::orderBy('name')->get();
        $jabatans = Jabatan::orderBy('jabatan')->get();

        return view('admin.karyawan.edit', compact('karyawan', 'users', 'jabatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_jabatan' => 'required|exists:jabatans,id',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:100',
            'alamat' => 'required|string|max:500',
            'no_telp' => 'required|string|max:30',
        ]);

        $karyawan = Karyawan::findOrFail($id);


        $karyawan->update($data);

        return redirect()->route('admin.karyawan.index')->with([
            'success' => 'Karyawan berhasil diperbarui.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('admin.karyawan.index')->with('success', 'Karyawan berhasil dihapus.');
    }
}
