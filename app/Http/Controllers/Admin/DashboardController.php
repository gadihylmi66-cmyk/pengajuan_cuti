<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\Hasil;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $recentCutis = Cuti::with('karyawan.user')
            ->where('status', 'menunggu')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'karyawanCount' => \App\Models\Karyawan::count(),
            'jabatanCount'  => Jabatan::count(),
            'cutiCount'     => Cuti::count(),
            'pendingCount'  => Cuti::where('status', 'menunggu')->count(),
            'approvedCount' => Cuti::where('status', 'disetujui')->count(),
            'rejectedCount' => Cuti::where('status', 'ditolak')->count(),
            'hasilCount'    => Hasil::count(),
            'recentCutis'   => $recentCutis,
        ]);
    }
}
