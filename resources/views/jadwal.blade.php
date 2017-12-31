@extends ('layouts.template')
{{-- @section('head')

@endsection --}}

@section('content')

{{-- @if (session('alertbaru'))
  <script type="text/javascript">
    alert('{{ session('alertbaru') }}');
  </script>
@endif --}}
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h4>Jadwal Booking</h4>
        <div class="table-responsive">
          @if(Auth::id() === 2)
          <p data-placement="top" data-toggle="tooltip" title="Kunciloc"><button class="btn btn-success btn-xs" data-title="Kunciloc" data-toggle="modal" data-target="#kunciloc" >Lokasi kunci</button></p>
          @endif
          <table id="mytable" class="table table-bordred table-striped">       
            <thead>
              <th>Tanggal</th>
              <th>Jam Pinjam</th>
              <th>Ruangan</th>
              <th>Keperluan</th>
              @if(Auth::user())
              <th>Detail</th>
              @endif
              @if(Auth::user())
                @unless(Auth::id() === 2)

              <th>Edit</th>        
              {{-- <th>Delete</th> --}}
                @endunless
              @endif
              @if(Auth::id() === 1)
              <th>Validate</th>
              <th>Invalidate</th>
              @endif
              @if(Auth::id() === 2)
              <th>Kunci</th>
              @endif
            </thead>
            <tbody>
            @foreach ($pinjam as $m)
              @if(Auth::id() === 1)
              <tr>
                <td>{{ $m->tanggal_pinjam }}</td>
                <td>{{ $m->mulai_pinjam }} - {{ $m->selesai_pinjam }}</td>
                <td>{{ $m->ruangan }}</td>
                <td>{{ $m->keperluan_peminjaman }}</td>
                <td><p data-placement="top" data-toggle="tooltip" title="Detail"><button class="btn btn-detil btn-xs" data-title="Detail" data-toggle="modal" data-target="#detail{{ $m->id_peminjaman }}" >Detail</button></p></td>
                <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit{{ $m->id_peminjaman }}" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                {{-- <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete{{ $m->id_peminjaman }}" ><span class="glyphicon glyphicon-trash"></span></button></p></td> --}}
                <td><p data-placement="top" data-toggle="tooltip" title="Verif"><button class="btn btn-success btn-xs" data-title="Verifikasi" data-toggle="modal" data-target="#verif{{ $m->id_peminjaman }}" ><span class="glyphicon glyphicon-check"></span></button></p></td>
                <td><p data-placement="top" data-toggle="tooltip" title="IVerif"><button class="btn btn-danger btn-xs" data-title="inverifikasi" data-toggle="modal" data-target="#iverif{{ $m->id_peminjaman }}" ><span class="glyphicon glyphicon-remove"></span></button></p></td>
              </tr>
              @else
              <tr>
                @if($m->verif === 1 || $m->id === Auth::id())
                <td>{{ $m->tanggal_pinjam }}</td>
                <td>{{ $m->mulai_pinjam }} - {{ $m->selesai_pinjam }}</td>
                <td>{{ $m->ruangan }}</td>
                <td>{{ $m->keperluan_peminjaman }}</td>
                  @if(Auth::user())
                    @unless(Auth::id() === 1)
                <td><p data-placement="top" data-toggle="tooltip" title="Detail"><button class="btn btn-detil btn-xs" data-title="Detail" data-toggle="modal" data-target="#detail{{ $m->id_peminjaman }}" >Detail</button></p></td>
                    @endunless
                  @endif
                  @if(Auth::user())
                    @unless(Auth::id() === 2)
                <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit{{ $m->id_peminjaman }}" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                {{-- <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete{{ $m->id_peminjaman }}" ><span class="glyphicon glyphicon-trash"></span></button></p></td> --}}
                    @endunless
                  @endif
                  @if(Auth::id() === 2)
                <td><p data-placement="top" data-toggle="tooltip" title="Kunci"><button class="btn btn-warning btn-xs" data-title="Kunci" data-toggle="modal" data-target="#kunci{{ $m->id_peminjaman }}" >Kunci</button></p></td>
                  @endif
                @endif
              </tr>
              @endif
            @endforeach
            </tbody>
          </table>
      </div>        
    </div>
  </div>
</div>




@foreach($detail as $d)
@if(Auth::id() === 1)
<div class="modal fade" id="detail{{ $d->id_peminjaman }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hiddtrue"></span></button>
        <h4 class="modal-title custom_align closer" id="Heading">Detail</h4>
      </div>
      <div class="modal-body">
        <p>Tanggal : {{ $d->tanggal_pinjam }}</p>
        <p>Jam pinjam : {{ $d->mulai_pinjam }} - {{ $d->selesai_pinjam }}</p>
        <p>Instansi : {{ $d->instansi_peminjaman }}</p>
        <p>Keperluan : {{ $d->keperluan_peminjaman }}</p>
        <p>Nama Peminjam : {{ $d->Nama }}</p>
        <p>NRP/NIP : {{ $d->NRP }}</p>
        <p>Kontak : {{ $d->HP }}</p>
        @if($d->verif === 1)
        <p>Status : Diverifikasi</p>
        @elseif($d->verif === 2)
        <p>Status : Verifikasi Ditolak</p>
        @else
        <p>Status : Menunggu verifikasi</p>
        @endif
      </div>
    </div>
<!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>

<div class="modal fade" id="edit{{ $d->id_peminjaman }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align closer" id="Heading">Edit Your Detail</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ url('/editbooking')}}">
        <div class="form-group">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id_peminjaman" value="{{ $d->id_peminjaman }}">
          <label>Tanggal</label>
          <input class="form-control" type="date" value="{{ $d->tanggal_pinjam }}" name="tanggal" required>
        </div>
        <div class="form-group">
          <label>Jam mulai</label>
          <input class="form-control" type="time" value="{{ $d->mulai_pinjam }}" name="jammulai" required>
        </div>
        <div class="form-group">
          <label>Jam selesai</label>
          <input class="form-control" type="time" value="{{ $d->selesai_pinjam }}" name="jamselesai" required>
        </div>
        <div class="form-group">
            <label>Instansi</label>
            <input class="form-control" type="text" value="{{ $d->instansi_peminjaman }}" name="instansi" required>
          </div>
        <div class="form-group">
          <label>Keperluan</label>
          <input class="form-control" type="text" value="{{ $d->keperluan_peminjaman }}" name="keperluan" required>
        </div>
        <div class="form-group">
          <label>Ruangan</label>
          <select class="form-control" value="{{ $d->ruangan }}" name="ruangan" required>
            <option value="aula">Aula</option>
            <option value="IF-101">IF-101</option>
            <option value="IF-102">IF-102</option>
            <option value="IF-103">IF-103</option>
            <option value="IF-104">IF-104</option>
            <option value="IF-105a">IF-105a</option>
            <option value="IF-105b">IF-105b</option>
            <option value="IF-106">IF-106</option>
            <option value="IF-108">IF-108</option>
          </select>
        </div>
        <div class="form-group">
            <label>Nama pengambil kunci</label>
            <input class="form-control" type="text" value="{{ $d->nama_peminjam_kunci }}" name="namakunci" required>
          </div>
        <div class="modal-footer ">
          <button type="submit" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Update</button>
        </div>
        </form>
      </div>
    <!-- /.modal-content --> 
    </div>
      <!-- /.modal-dialog --> 
  </div>
</div>
    
    
<div class="modal fade" id="verif{{ $d->id_peminjaman }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hiddtrue"></span></button>
        <h4 class="modal-title custom_align closer" id="Heading">Verifikasi</h4>
      </div>
      
      <div class="modal-body">
        <p>Beri Validasi?</p>
      </div>
      @if($d->verif === 0)
      <form method="POST" action="{{ url('/verif')}}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="id_status" value="{{ $d->id_status }}">
      <div class="modal-footer">
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
      </div>
      </form>
      @elseif($d->verif === 1)
      <div class="modal-footer">
        <div class="alert alert-success">Sudah terverifikasi</div>
      </div>
      @else
      <div class="modal-footer">
        <div class="alert alert-danger">Tidak terverifikasi</div>
      </div>
      @endif
    </div>
<!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>

<div class="modal fade" id="iverif{{ $d->id_peminjaman }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hiddtrue"></span></button>
        <h4 class="modal-title custom_align closer" id="Heading">Verifikasi</h4>
      </div>
      
      <div class="modal-body">
        <p>Tidak beri Validasi?</p>
      </div>
      @if($d->verif === 0)
      <form method="POST" action="{{ url('/iverif')}}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="id_status" value="{{ $d->id_status }}">
      <div class="modal-footer">
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
      </div>
      </form>
      @elseif($d->verif === 1)
      <div class="modal-footer">
        <div class="alert alert-success">Sudah terverifikasi</div>
      </div>
      @else
      <div class="modal-footer">
        <div class="alert alert-success">Tidak terverifikasi</div>
      </div>
      @endif
    </div>
<!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
@else
  @if($d->verif === 1 || $d->id === Auth::id())
    @unless(Auth::id() === 1)
<div class="modal fade" id="detail{{ $d->id_peminjaman }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hiddtrue"></span></button>
        <h4 class="modal-title custom_align closer" id="Heading">Detail</h4>
      </div>
      <div class="modal-body">
        <p>Tanggal : {{ $d->tanggal_pinjam }}</p>
        <p>Jam pinjam : {{ $d->mulai_pinjam }} - {{ $d->selesai_pinjam }}</p>
        <p>Instansi : {{ $d->instansi_peminjaman }}</p>
        <p>Keperluan : {{ $d->keperluan_peminjaman }}</p>
        <p>Nama Peminjam : {{ $d->Nama }}</p>
        <p>NRP/NIP : {{ $d->NRP }}</p>
        <p>Kontak : {{ $d->HP }}</p>
        <p>Pengambil kunci : {{ $d->nama_peminjam_kunci }}</p>
        @if($d->verif === 1)
        <p>Status : Diverifikasi</p>
        @elseif($d->verif === 2)
        <p>Status : Verifikasi Ditolak</p>
        @else
        <p>Status : Menunggu verifikasi</p>
        @endif
      </div>
      <div class="modal-footer ">
          @if(Auth::id() === 2)
          <button class="btn btn-warning btn-xs" data-title="Kunci" data-toggle="modal" data-target="#laporan{{ $d->id_peminjaman }}" >Laporan Pasca Peminjaman</button>
          @else
            @if(Auth::user())
            @unless(Auth::id()===1 || Auth::id()===2)
            <button class="btn btn-warning btn-xs" data-title="Kunci" data-toggle="modal" data-target="#flaporan{{ $d->id_peminjaman }}" >Laporan Pasca Peminjaman</button>
            @endunless
            @endif
          @endif
      </div>
      <div></div>
    </div>
<!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
@if(Auth::id() === 2)
<div class="modal fade" id="laporan{{ $d->id_peminjaman }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hiddtrue"></span></button>
        <h4 class="modal-title custom_align closer" id="Heading">Laporan Pasca Peminjaman</h4>
      </div>
      <div class="modal-body">
        <p>Kebersihan : {{ $d->kebersihan }}</p>
        <p>AC : {{ $d->AC }}</p>
        <p>Kursi : {{ $d->kursi }}</p>
        <p>LCD : {{ $d->LCD }}</p>
        <p>Lampu : {{ $d->Lampu }}</p>
        <p>PC : {{ $d->PC }}</p>
        <p>Kritik dan Saran : {{ $d->kritik_dan_saran }}</p>
      </div>
    </div>
<!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
@else
  @if(Auth::user())
  @unless(Auth::id()===1 || Auth::id()===2)
<div class="modal fade" id="flaporan{{ $d->id_peminjaman }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hiddtrue"></span></button>
        <h4 class="modal-title custom_align closer" id="Heading">Laporan Pasca Peminjaman</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ url('/laporan') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id_peminjaman" value="{{ $d->id_peminjaman }}">
          <p>Isi form berikut dengan kondisi real nya (misal: "baik", "rusak", "nyala 5 menit lalu mati sendiri"), jika tidak digunakan beri tanda "-"</p>
          <div class="form-group">
            <label>Kebersihan</label>
            <input class="form-control" type="text" value="{{ $d->kebersihan }}" name="kebersihan" required>
          </div>
          <div class="form-group">
            <label>AC</label>
            <input class="form-control" type="text" value="{{ $d->AC }}" name="AC" required>
          </div>
          <div class="form-group">
            <label>Kursi</label>
            <input class="form-control" type="text" value="{{ $d->kursi }}" name="kursi" required>
          </div>
          <div class="form-group">
            <label>Proyektor</label>
            <input class="form-control" type="text" value="{{ $d->LCD }}" name="LCD" required>
          </div>
          <div class="form-group">
            <label>PC</label>
            <input class="form-control" type="text" value="{{ $d->PC }}" name="PC" required>
          </div>
          <div class="form-group">
            <label>Lampu</label>
            <input class="form-control" type="text" value="{{ $d->Lampu }}" name="Lampu" required>
          </div>
          <div class="form-group">
            <label>Kritik dan Saran</label>
            <input class="form-control" type="text" value="{{ $d->kritik_dan_saran }}" name="kritik" required>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Simpan</button>
          </div>
        </form>
      </div>
    </div>
<!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
  @endunless
  @endif
@endif
    @endunless
    @if(Auth::user())
      @unless(Auth::id() === 2)
<div class="modal fade" id="edit{{ $d->id_peminjaman }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align closer" id="Heading">Edit Your Detail</h4>
      </div>
      @if($d->id === Auth::id())
      <div class="modal-body">
        <form method="POST" action="{{ url('/editbooking')}}">
        <div class="form-group">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id_peminjaman" value="{{ $d->id_peminjaman }}">
          <label>Tanggal</label>
          <input class="form-control" type="date" value="{{ $d->tanggal_pinjam }}" name="tanggal" required>
        </div>
        <div class="form-group">
          <label>Jam mulai</label>
          <input class="form-control" type="time" value="{{ $d->mulai_pinjam }}" name="jammulai" required>
        </div>
        <div class="form-group">
          <label>Jam selesai</label>
          <input class="form-control" type="time" value="{{ $d->selesai_pinjam }}" name="jamselesai" required>
        </div>
        <div class="form-group">
            <label>Instansi</label>
            <input class="form-control" type="text" value="{{ $d->instansi_peminjaman }}" name="instansi" required>
          </div>
        <div class="form-group">
          <label>Keperluan</label>
          <input class="form-control" type="text" value="{{ $d->keperluan_peminjaman }}" name="keperluan" required>
        </div>
        <div class="form-group">
          <label>Ruangan</label>
          <select class="form-control" value="{{ $d->ruangan }}" name="ruangan">
            <option value="aula">Aula</option>
            <option value="IF-101">IF-101</option>
            <option value="IF-102">IF-102</option>
            <option value="IF-103">IF-103</option>
            <option value="IF-104">IF-104</option>
            <option value="IF-105a">IF-105a</option>
            <option value="IF-105b">IF-105b</option>
            <option value="IF-106">IF-106</option>
            <option value="IF-108">IF-108</option>
          </select>
        </div>
        <div class="form-group">
            <label>Nama pengambil kunci</label>
            <input class="form-control" type="text" value="{{ $d->nama_peminjam_kunci }}" name="namakunci" required>
          </div>
        <div class="modal-footer ">
          <button type="submit" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Update</button>
        </div>
        </form>
        @else
        <div class="modal-content">
          <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Anda tidak punya akses melakukan ini!</div>
        </div>
        @endif
      </div>
    <!-- /.modal-content --> 
    </div>
      <!-- /.modal-dialog --> 
  </div>
</div>
    
    
    @endunless
    @endif
    @if(Auth::id()===2)

@if($kunci>0)
<div class="modal fade" id="kunci{{ $d->id_peminjaman }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hiddtrue"></span></button>
        <h4 class="modal-title custom_align closer" id="Heading">Berikan kunci</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Kunci sedang dipinjam</div>
      </div>
    </div>
<!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
@else
<div class="modal fade" id="kunci{{ $d->id_peminjaman }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hiddtrue"></span></button>
        <h4 class="modal-title custom_align closer" id="Heading">Berikan kunci</h4>
      </div>
      <form method="POST" action="{{ url('/kasihkunci') }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="id_status" value="{{ $d->id_status }}"> 
      <div class="modal-body">        
        <div class="form-group">
          <label>Jaminan</label>
          <input class="form-control" type="text" name="jaminan" required>
        </div>
        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Berikan kunci ke {{ $d->nama_peminjam_kunci }}?</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span>Konfirmasi</button>
      </div>
      </form>
    </div>
<!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
@endif


@if($kunci>0)
  @if( $d->status_kunci === 1)
<div class="modal fade" id="kunciloc" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hiddtrue"></span></button>
        <h4 class="modal-title custom_align closer" id="Heading">Lokasi kunci</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Kunci ada di {{ $d->nama_peminjam_kunci }}(barang jaminan: {{ $d->jaminan }}), nama peminjam ruangan {{ $d->Nama }} ({{ $d->NRP }}) (HP:{{ $d->HP }}), ambil?</div>
      </div>
      <form method="POST" action="{{ url('/ambilkunci')}}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="id_status" value="{{ $d->id_status }}">
      <div class="modal-footer">
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
      </div>
      </form>
    </div>
<!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
  @endif
@else
<div class="modal fade" id="kunciloc" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hiddtrue"></span></button>
        <h4 class="modal-title custom_align closer" id="Heading">Lokasi kunci</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-success"><span class="glyphicon glyphicon-warning-sign"></span> Kunci tidak ada yang mengambil</div>
      </div>
    </div>
<!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
@endif


    @endif
  @endif
@endif
@endforeach
@endsection