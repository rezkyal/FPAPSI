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

class ControllerLaporan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambahLaporan(Request $r)
    {
        //
        $laporan = laporanPeminjaman::where('id_laporan_peminjaman',$r->id_peminjaman)->firstOrFail();
        $laporan->kebersihan= $r->kebersihan;
        $laporan->AC = $r->AC;
        $laporan->kursi = $r->kursi;
        $laporan->LCD = $r->LCD;
        $laporan->Lampu = $r->Lampu;
        $laporan->kritik_dan_saran = $r->kritik;
        $laporan->PC = $r->PC;
        $laporan->save();
        return redirect('/jadwal');
    }

}
