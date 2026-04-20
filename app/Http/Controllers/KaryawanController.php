<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class KaryawanController extends Controller
{
    public function index()
    {
        $usersWithKaryawan = Karyawan::pluck('id_user');
        $users = User::where('role', '!=', 'admin')
            ->whereNotIn('id', $usersWithKaryawan)
            ->orderBy('name')
            ->get();
        $allUsers = User::where('role', '!=', 'admin')->orderBy('name')->get();
        $jabatans = Jabatan::orderBy('jabatan')->get();
        $karyawans = Karyawan::with(['user', 'jabatan'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.karyawan.index', compact('karyawans', 'users', 'allUsers', 'jabatans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => ['required', 'exists:users,id', 'unique:karyawans,id_user'],
            'id_jabatan' => 'required|exists:jabatans,id',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:100',
            'alamat' => 'required|string|max:500',
            'no_telp' => 'required|string|max:30',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto_profil')) {
            $data['foto_profil'] = $request->file('foto_profil')->store('profiles', 'public');
        }

        Karyawan::create($data);

        return redirect()->route('admin.karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $data = $request->validate([
            'id_user' => ['required', 'exists:users,id', Rule::unique('karyawans', 'id_user')->ignore($karyawan->id)],
            'id_jabatan' => 'required|exists:jabatans,id',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:100',
            'alamat' => 'required|string|max:500',
            'no_telp' => 'required|string|max:30',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto_profil')) {
            if ($karyawan->foto_profil) {
                Storage::disk('public')->delete($karyawan->foto_profil);
            }
            $data['foto_profil'] = $request->file('foto_profil')->store('profiles', 'public');
        }

        $karyawan->update($data);

        return redirect()->route('admin.karyawan.index')->with('success', 'Karyawan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        if ($karyawan->foto_profil) {
            Storage::disk('public')->delete($karyawan->foto_profil);
        }

        $karyawan->delete();

        return redirect()->route('admin.karyawan.index')->with('success', 'Karyawan berhasil dihapus.');
    }
}
