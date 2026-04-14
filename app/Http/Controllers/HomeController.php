<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Hasil;
use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user     = Auth::user();
        $karyawan = Karyawan::with('jabatan')->where('id_user', $user->id)->first();

        $cutiQuery     = $karyawan ? Cuti::where('id_karyawans', $karyawan->id) : null;

        $cutiCount     = $cutiQuery ? (clone $cutiQuery)->count() : 0;
        $pendingCount  = $cutiQuery ? (clone $cutiQuery)->where('status', 'menunggu')->count() : 0;
        $approvedCount = $cutiQuery ? (clone $cutiQuery)->where('status', 'disetujui')->count() : 0;
        $rejectedCount = $cutiQuery ? (clone $cutiQuery)->where('status', 'ditolak')->count() : 0;
        $recentCutis   = $cutiQuery ? (clone $cutiQuery)->latest()->take(5)->get() : collect();

        return view('home', [
            'karyawan'      => $karyawan,
            'karyawanCount' => Karyawan::count(),
            'jabatanCount'  => Jabatan::count(),
            'cutiCount'     => $cutiCount,
            'pendingCount'  => $pendingCount,
            'approvedCount' => $approvedCount,
            'rejectedCount' => $rejectedCount,
            'recentCutis'   => $recentCutis,
        ]);
    }
}
