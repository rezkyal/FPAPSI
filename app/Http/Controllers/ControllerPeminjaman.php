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

class ControllerPeminjaman extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function displayJadwal()
    {
        //return('test');
        $time=Carbon::today()->format('Y-m-d');
        $data['detail']=DB::table('peminjamen')
        ->join('users','users.id','=','peminjamen.id_user')
        ->join('statuses','peminjamen.id_peminjaman','=','statuses.id_status_peminjaman')
        ->join('laporan_peminjamen','laporan_peminjamen.id_laporan_peminjaman','=','peminjamen.id_peminjaman')
        ->where('peminjamen.tanggal_pinjam','>=',$time)
        ->select('users.*','peminjamen.*','statuses.*','laporan_peminjamen.*')
        ->get();
        $data['pinjam']=$data['detail'];
        $kunci=DB::table('statuses')
        ->where('status_kunci','=','1')
        ->count();
        //return $kunci;
        if (Auth::user()) {
            return view('jadwal',$data)->with('kunci',$kunci);
        }else{
            return redirect('/');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function tambahBooking(Request $r)
    {
        $cek = Peminjaman::where([
                ['tanggal_pinjam',$r->tanggal],
                ['ruangan',$r->ruangan],
                ['mulai_pinjam','<=',$r->jammulai],
                ['selesai_pinjam','>',$r->jammulai],
        ])->orwhere([
                ['tanggal_pinjam',$r->tanggal],
                ['ruangan',$r->ruangan],
                ['mulai_pinjam','<',$r->jamselesai],
                ['selesai_pinjam','>=',$r->jamselesai],
        ])
        ->count();
        //return $cek;
        if ($cek == 0) {
            $newpinjam = new Peminjaman();
            $newpinjam->id_user = Auth::id();
            $newpinjam->ruangan = $r->ruangan;
            $newpinjam->tanggal_pinjam = $r->tanggal;
            $newpinjam->mulai_pinjam = $r->jammulai;
            $newpinjam->selesai_pinjam = $r->jamselesai;
            $newpinjam->instansi_peminjaman=$r->instansi;
            $newpinjam->keperluan_peminjaman=$r->keperluan;
            $newpinjam->save();
            $newstatus = new Status();
            $newlaporan = new laporanPeminjaman();
            $pinjam = Peminjaman::where('tanggal_pinjam',$r->tanggal)->where('ruangan',$r->ruangan)->where('mulai_pinjam',$r->jammulai)->firstOrFail();
            $newstatus->id_status_peminjaman = $pinjam->id_peminjaman;
            $newlaporan->id_laporan_peminjaman = $pinjam->id_peminjaman;
            $user = User::find($pinjam->id_user);
            $newstatus->verif=0;
            $newstatus->status_kunci=0;
            $newstatus->nama_peminjam_kunci = $r->namakunci;
            $newstatus->jaminan='';
            $newstatus->save();
            $newlaporan->kebersihan='-';
            $newlaporan->AC='-';
            $newlaporan->kursi='-';
            $newlaporan->LCD='-';
            $newlaporan->Lampu='-';
            $newlaporan->kritik_dan_saran='-';
            $newlaporan->PC='-';
            $newlaporan->save();
            return redirect('/jadwal')->with('alert','Jadwal berhasil ditambahkan');
        }else{
            return redirect('/jadwal')->with('alert','Jadwal bertabrakan!');
        }
        
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function editBooking(Request $r)
    {  
        $cek = Peminjaman::where([
                ['tanggal_pinjam',$r->tanggal],
                ['ruangan',$r->ruangan],
                ['mulai_pinjam','<=',$r->jammulai],
                ['selesai_pinjam','>',$r->jammulai],
        ])->orwhere([
                ['tanggal_pinjam',$r->tanggal],
                ['ruangan',$r->ruangan],
                ['mulai_pinjam','<',$r->jamselesai],
                ['selesai_pinjam','>=',$r->jamselesai],
        ])
        ->count();
        //return $cek;
        if ($cek == 0) {
            $pinjam = Peminjaman::find($r->id_peminjaman);
            $pinjam->ruangan = $r->ruangan;
            $pinjam->tanggal_pinjam = $r->tanggal;
            $pinjam->mulai_pinjam = $r->jammulai;
            $pinjam->selesai_pinjam = $r->jamselesai;
            $pinjam->instansi_peminjaman=$r->instansi;
            $pinjam->keperluan_peminjaman=$r->keperluan;
            $pinjam->save();
            $status = Status::where('id_status_peminjaman',$r->id_peminjaman)->firstOrFail();
            $status->nama_peminjam_kunci = $r->namakunci;
            $status->save();
            return redirect('/jadwal');
        }else{
            return redirect('/jadwal')->with('alert','Jadwal bertabrakan!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */

    public function validasi(Request $r)
    {
        $status = Status::find($r->id_status);
        $status->verif=1;
        $status->save();
        return redirect('/jadwal')->with('alert','Validasi berhasil');
    }

    public function invalidasi(Request $r)
    {
        $status = Status::find($r->id_status);
        $status->verif=2;
        $status->save();
        return redirect('/jadwal')->with('alert','Invalidasi berhasil');
    }


    public function isilaporan(Request $r)
    {
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

    public function tambah()
    {
        if((Auth::user()) && (Auth::id()!=1) &&(Auth::id()!=2))
        {
            return view('tambah');
        }else{
            return redirect('/');
        }
    }
}
