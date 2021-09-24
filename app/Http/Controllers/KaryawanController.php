<?php

namespace App\Http\Controllers;

use App\Models\MasterKaryawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = MasterKaryawan::get();

        return view('pages.admin.karyawan.index', ['karyawans' => $karyawan]);
    }

    public function akses($id)
    {

    }
}
