<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Illuminate\Http\Request;

class CutiAdminController extends Controller
{
    public function index()
    {
        $cutis = Cuti::with('karyawan.user')
            ->orderBy('created_at', 'desc')
            ->get();

        $pendingCount  = $cutis->where('status', 'menunggu')->count();
        $approvedCount = $cutis->where('status', 'disetujui')->count();
        $rejectedCount = $cutis->where('status', 'ditolak')->count();

        return view('admin.cuti.index', compact('cutis', 'pendingCount', 'approvedCount', 'rejectedCount'));
    }

    public function show(Cuti $cuti)
    {
        $cuti->load('karyawan.user');
        return view('admin.cuti.show', compact('cuti'));
    }

    public function approve(Request $request, Cuti $cuti)
    {
        $request->validate([
            'catatan_admin' => 'nullable|string|max:500',
        ]);

        $cuti->update([
            'status' => 'disetujui',
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect()->route('admin.cuti.index')
            ->with('success', 'Pengajuan cuti telah disetujui.');
    }

    public function reject(Request $request, Cuti $cuti)
    {
        $request->validate([
            'catatan_admin' => 'nullable|string|max:500',
        ]);

        $cuti->update([
            'status' => 'ditolak',
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect()->route('admin.cuti.index')
            ->with('success', 'Pengajuan cuti telah ditolak.');
    }

    public function destroy(Cuti $cuti)
    {
        $cuti->delete();
        return redirect()->route('admin.cuti.index')
            ->with('success', 'Data cuti berhasil dihapus.');
    }
}
