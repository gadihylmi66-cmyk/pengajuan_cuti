<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\Hasil;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
       $users = User::latest()->get();
        return view('admin.dashboard', [
            'karyawanCount' => User::count(),
            'jabatanCount' => Jabatan::count(),
            'cutiCount' => Cuti::count(),
            'hasilCount' => Hasil::count(),
            'users' => $users,
        ]);
    }
}
