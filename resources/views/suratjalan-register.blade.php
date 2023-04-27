
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Surat Jalan</title>

  <!-- Favicon -->
  <link href="{{ asset('img/favicon.png') }}" rel="icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <img src="{{ asset("img/logo.png") }}" alt="" class="img img-fluid">
      <a href="../../index2.html" class="h1"><b>Keamanan PG</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"><b>Surat Jalan</b></p>

      <form method="POST" action="{{ route('suratjalan.store') }}" enctype="multipart/form-data">
        @csrf
        <p><b><u>ISI LEMBAR SURAT JALAN</u></b></p>
        <p>Deskripsi / Nama Barang</p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="nama_barang" placeholder="Jawaban Anda">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-userss"></span>
            </div>
          </div>
        </div>
        <p>Qty / Kuantitas / Jumlah</p>
        <div class="input-group mb-3">
          <input type="number" class="form-control" name="jumlah" placeholder="Jawaban Anda">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-userss"></span>
            </div>
          </div>
        </div>
        <p>Bentuk Packing (Bungkus)</p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="bentuk" placeholder="Jawaban Anda">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-userss"></span>
            </div>
          </div>
        </div>
        <p>Asal (Nama PT / Bagian)</p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="dari" placeholder="Jawaban Anda">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-userss"></span>
            </div>
          </div>
        </div>
        <p>Tujuan</p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="tujuan" placeholder="Jawaban Anda">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-userss"></span>
            </div>
          </div>
        </div>
        <p>No PO (No Dokumen)</p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="nomor_po" placeholder="Jawaban Anda">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-userss"></span>
            </div>
          </div>
        </div>
        <p><b><u>NAMA PENANGGUNG JAWAB</u></b></p>
        <p>Nama Penanggung Jawab</p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="nama_penanggung_jawab" placeholder="Jawaban Anda">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-userss"></span>
            </div>
          </div>
        </div>
        <p>NIK / No KIB / No Lainnya</p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="nomor" placeholder="Jawaban Anda">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-userss"></span>
            </div>
          </div>
        </div>
        <p><b><u>TRAFFIC KETERANGAN</u></b></p>
        <p>IN (Masuk Pukul)</p>
        <div class="input-group mb-3">
          <input type="time" class="form-control" name="waktu_masuk" placeholder="Jawaban Anda">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-userss"></span>
            </div>
          </div>
        </div>
        <p>OUT (Keluar Pukul)</p>
        <div class="input-group mb-3">
          <input type="time" class="form-control" name="waktu_keluar" placeholder="Jawaban Anda">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-userss"></span>
            </div>
          </div>
        </div>
        <p>Upload Foto Lembar Surat Jalan</p>
        <div class="form-group">
          <div class="input-group">
            <div class="custom-file">
              <input type="file" name="foto_suratjalans[]" class="custom-file-input" id="exampleInputFile" multiple>
              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      {{-- <a href="login.html" class="text-center">I already have a membership</a> --}}
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
@if (session()->has('danger'))
    <script>
        $(document).Toasts('create', {
            class: 'bg-danger',
            title: 'Info',
            subtitle: '',
            body: '{{ session()->get("danger") }}'
        })
    </script>
@endif
@if (session()->has('status'))
    <script>
        $(document).Toasts('create', {
            class: 'bg-info',
            title: 'Info',
            subtitle: '',
            body: '{{ session()->get("status") }}'
        })
    </script>
    
@endif
<script>
    $(function () {
      bsCustomFileInput.init();
    });
</script>
</body>
</html>
