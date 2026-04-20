<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\JenisCuti;
use App\Models\Karyawan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $karyawan = Karyawan::with(['user', 'jabatan'])->where('id_user', auth()->id())->first();
        $jenisCutis = JenisCuti::where('is_active', true)->orderBy('nama')->get();

        if (!$karyawan) {
            return view('cuti.index', [
                'cutis' => collect(),
                'jenisCutis' => $jenisCutis,
                'karyawan' => null,
                'usedQuota' => collect(),
                'pendingCount' => 0,
                'approvedCount' => 0,
                'rejectedCount' => 0,
            ])->with('warning', 'Data karyawan Anda belum terdaftar. Hubungi admin.');
        }

        $cutiBaseQuery = Cuti::with('jenisCuti')->where('id_karyawans', $karyawan->id);
        $cutis = (clone $cutiBaseQuery)->latest()->paginate(10)->withQueryString();
        $allCutis = (clone $cutiBaseQuery)->get();
        $year = now()->year;
        $usedQuota = $jenisCutis->mapWithKeys(function ($jenisCuti) use ($karyawan, $year) {
            $days = Cuti::where('id_karyawans', $karyawan->id)
                ->where('jenis_cuti_id', $jenisCuti->id)
                ->whereYear('tanggal_masuk', $year)
                ->whereIn('status', ['menunggu', 'disetujui'])
                ->sum('jumlah_hari');

            return [$jenisCuti->id => $days];
        });

        return view('cuti.index', [
            'cutis' => $cutis,
            'jenisCutis' => $jenisCutis,
            'karyawan' => $karyawan,
            'usedQuota' => $usedQuota,
            'pendingCount' => $allCutis->where('status', 'menunggu')->count(),
            'approvedCount' => $allCutis->where('status', 'disetujui')->count(),
            'rejectedCount' => $allCutis->where('status', 'ditolak')->count(),
        ]);
    }

    public function store(Request $request)
    {
        $karyawan = Karyawan::where('id_user', auth()->id())->firstOrFail();

        $data = $request->validate([
            'jenis_cuti_id' => 'required|exists:jenis_cutis,id',
            'alasan_cuti' => 'required|string|max:500',
            'tanggal_masuk' => 'required|date|after_or_equal:today',
            'tanggal_keluar' => 'required|date|after_or_equal:tanggal_masuk',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $tanggalMasuk = Carbon::parse($data['tanggal_masuk']);
        $tanggalKeluar = Carbon::parse($data['tanggal_keluar']);
        $jumlahHari = $tanggalMasuk->diffInDays($tanggalKeluar) + 1;
        $jenisCuti = JenisCuti::where('is_active', true)->findOrFail($data['jenis_cuti_id']);
        $usedThisYear = Cuti::where('id_karyawans', $karyawan->id)
            ->where('jenis_cuti_id', $jenisCuti->id)
            ->whereYear('tanggal_masuk', $tanggalMasuk->year)
            ->whereIn('status', ['menunggu', 'disetujui'])
            ->sum('jumlah_hari');

        if (($usedThisYear + $jumlahHari) > $jenisCuti->maksimal_hari_per_tahun) {
            return redirect()->route('cuti.index')
                ->withInput()
                ->with('error', "Pengajuan melebihi batas {$jenisCuti->maksimal_hari_per_tahun} hari per tahun untuk {$jenisCuti->nama}.");
        }

        $data['id_karyawans'] = $karyawan->id;
        $data['jumlah_hari'] = $jumlahHari;
        $data['status'] = 'menunggu';

        if ($request->hasFile('lampiran')) {
            $data['lampiran'] = $request->file('lampiran')->store('lampiran-cuti', 'public');
        }

        Cuti::create($data);

        return redirect()->route('cuti.index')
            ->with('success', 'Pengajuan cuti berhasil dikirim. Menunggu persetujuan admin.');
    }
}
