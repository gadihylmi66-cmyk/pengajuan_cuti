<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $karyawan = Karyawan::where('id_user', auth()->id())->first();

        if (!$karyawan) {
            return view('cuti.index', [
                'cutis'         => collect(),
                'pendingCount'  => 0,
                'approvedCount' => 0,
                'rejectedCount' => 0,
            ])->with('warning', 'Data karyawan Anda belum terdaftar. Hubungi admin.');
        }

        $cutis = Cuti::where('id_karyawans', $karyawan->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('cuti.index', [
            'cutis'         => $cutis,
            'pendingCount'  => $cutis->where('status', 'menunggu')->count(),
            'approvedCount' => $cutis->where('status', 'disetujui')->count(),
            'rejectedCount' => $cutis->where('status', 'ditolak')->count(),
        ]);
    }

    public function create()
    {
        $karyawan = Karyawan::where('id_user', auth()->id())->first();

        if (!$karyawan) {
            return redirect()->route('cuti.index')
                ->with('error', 'Data karyawan Anda belum terdaftar. Hubungi admin.');
        }

        return view('cuti.create', compact('karyawan'));
    }

    public function store(Request $request)
    {
        $karyawan = Karyawan::where('id_user', auth()->id())->firstOrFail();

        $data = $request->validate([
            'alasan_cuti'    => 'required|string|max:500',
            'tanggal_masuk'  => 'required|date|after_or_equal:today',
            'tanggal_keluar' => 'required|date|after_or_equal:tanggal_masuk',
        ]);

        $data['id_karyawans'] = $karyawan->id;
        $data['status']       = 'menunggu';

        Cuti::create($data);

        return redirect()->route('cuti.index')
            ->with('success', 'Pengajuan cuti berhasil dikirim. Menunggu persetujuan admin.');
    }

    public function show(Cuti $cuti)
    {
        $this->authorizeOwner($cuti);
        $cuti->load('karyawan.user');
        return view('cuti.show', compact('cuti'));
    }

    // edit, update, destroy — tidak tersedia untuk user
    // semua perubahan status hanya bisa dilakukan oleh admin

    private function authorizeOwner(Cuti $cuti): void
    {
        $karyawan = Karyawan::where('id_user', auth()->id())->first();

        if (!$karyawan || $cuti->id_karyawans !== $karyawan->id) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }
    }
}
