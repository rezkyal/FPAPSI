@extends ('layouts.template')
{{-- @section('head')

@endsection --}}

@section('content')

{{-- @if (session('alertbaru'))
  <script type="text/javascript">
    alert('{{ session('alertbaru') }}');
  </script>
@endif --}}

<div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Tambah bookingan baru</h4>
      </div>
      <form method="POST" action="{{ url('/newbooking') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="modal-body">
          <div class="form-group">
            <label>Tanggal</label>
            <input class="form-control" type="date" name="tanggal" required>
          </div>
          <div class="form-group">
            <label>Jam mulai</label>
            <input class="form-control" type="time" name="jammulai" required>
          </div>
          <div class="form-group">
            <label>Jam selesai</label>
            <input class="form-control" type="time" name="jamselesai" required>
          </div>
          <div class="form-group">
            <label>Instansi</label>
            <input class="form-control" type="text" name="instansi" required>
          </div>
          <div class="form-group">
            <label>Keperluan</label>
            <input class="form-control" type="text" name="keperluan" required>
          </div>
          <div class="form-group">
            <label>Ruangan</label>
            <select class="form-control" name="ruangan">
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
            <input class="form-control" type="text" name="namakunci" required>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Tambah</button>
          </div>
        </div>
      </form>
    <!-- /.modal-content --> 
    </div>

@endsection