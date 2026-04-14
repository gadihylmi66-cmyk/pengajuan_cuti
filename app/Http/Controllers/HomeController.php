<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Hasil;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->latest()->get();
        return view('home', [
            'users' => $users,
            'karyawanCount' => User::count(),
            'jabatanCount' => Jabatan::count(),
            'cutiCount' => Cuti::count(),
            'hasilCount' => Hasil::count(),
        ]);
    }
}
