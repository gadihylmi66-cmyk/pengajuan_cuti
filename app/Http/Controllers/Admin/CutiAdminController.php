<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CutiAdminController extends Controller
{
    public function index()
    {
        $cutis = Cuti::with(['karyawan.user', 'karyawan.jabatan', 'jenisCuti'])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $pendingCount = Cuti::where('status', 'menunggu')->count();
        $approvedCount = Cuti::where('status', 'disetujui')->count();
        $rejectedCount = Cuti::where('status', 'ditolak')->count();

        return view('admin.cuti.index', compact('cutis', 'pendingCount', 'approvedCount', 'rejectedCount'));
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
        if ($cuti->lampiran) {
            Storage::disk('public')->delete($cuti->lampiran);
        }

        $cuti->delete();

        return redirect()->route('admin.cuti.index')
            ->with('success', 'Data cuti berhasil dihapus.');
    }
}
