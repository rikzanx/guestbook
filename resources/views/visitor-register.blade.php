
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Visitor</title>

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
      <p class="login-box-msg"><b>Visitor</b></p>

      <form method="POST" action="{{ route('visitor.store') }}" enctype="multipart/form-data">
        @csrf
        <p>Nama</p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="nama" placeholder="Jawaban Anda">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-userss"></span>
            </div>
          </div>
        </div>
        <p>NIK KTP / No Kartu Identitas</p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="nik" placeholder="Jawaban Anda">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-userss"></span>
            </div>
          </div>
        </div>
        <p>Nama Perusahaan / PT</p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="nama_perusahaan" placeholder="Jawaban Anda">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-userss"></span>
            </div>
          </div>
        </div>
        <p>Pos Pendaftaran Visitor PAS</p>
        <div class="form-check">
          <input type="radio" class="form-check-input" id="exampleCheck1" name="pos_asal" value="POS ZONA 1">
          <label class="form-check-label" for="exampleCheck1">POS ZONA 1</label>
          </div>
          <div class="form-check">
          <input type="radio" class="form-check-input" id="exampleCheck2" name="pos_asal" value="POS ZONA 2">
          <label class="form-check-label" for="exampleCheck2">POS ZONA 2</label>
          </div>
          <div class="form-check">
            <input type="radio" class="form-check-input" id="exampleCheck3" name="pos_asal" value="POS ZONA 3">
            <label class="form-check-label" for="exampleCheck3">POS ZONA 3</label>
          </div>
          <div class="form-check">
            <input type="radio" class="form-check-input" id="exampleCheck4" name="pos_asal" value="POS ZONA 4">
            <label class="form-check-label" for="exampleCheck4">POS ZONA 4</label>
          </div>
          <div class="form-check">
            <input type="radio" class="form-check-input" id="exampleCheck5" name="pos_asal" value="POS ZONA 5">
            <label class="form-check-label" for="exampleCheck5">POS ZONA 5</label>
            </div>
          <div class="form-check">
            <input type="radio" class="form-check-input" id="exampleCheck6" name="pos_asal" value="POS ZONA KAWASAN">
            <label class="form-check-label" for="exampleCheck6">POS ZONA KAWASAN</label>
            </div>
          <div class="form-check">
          <input type="radio" class="form-check-input" id="exampleCheck7" name="pos_asal" value="lainnya">
          <label class="form-check-label" for="exampleCheck7">Yang Lain</label>
        </div>
        <input type="text" class="form-control" name="lainnya" placeholder="Isi yang lain">
        <p>Tujuan (Nama/Departemen/Bagian)</p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="tujuan" placeholder="Jawaban Anda">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-userss"></span>
            </div>
          </div>
        </div>
        <p>Foto KTP</p>
        <div class="form-group">
            <div class="input-group">
              <div class="custom-file">
                <input type="file" name="foto_ktp" class="custom-file-input" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
            </div>
          </div>
        <p>No HP</p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="no_hp" placeholder="Jawaban Anda">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phoned"></span>
            </div>
          </div>
        </div>
        <p>Nomor Kartu Visitor</p>
        <p>Diisi oleh Visitor atau Admin POS</p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="nomor_kartu" placeholder="Jawaban Anda">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phoned"></span>
            </div>
          </div>
        </div>
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
