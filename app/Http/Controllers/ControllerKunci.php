<?php

namespace App\Http\Controllers;

use App\Peminjaman;
use App\Status;
use App\User;
use App\laporanPeminjaman;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerKunci extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambahJaminan(Request $r)
    {
        //
        $status = Status::find($r->id_status);
        $status->status_kunci=1;
        $status->jaminan=$r->jaminan;
        $status->save();
        return redirect('/jadwal');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kembalikanKunci(Request $r)
    {
        //
        $status = Status::find($r->id_status);
        $status->status_kunci=2;
        $status->save();
        return redirect('/jadwal');
    }
}
