
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ env('APP_NAME')}}</title>
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
      <p class="login-box-msg"><b>Validasi Data Formulir KIB 24 JAM</b></p>

      <form method="POST" action="{{ route('gueststore') }}" enctype="multipart/form-data">
        @csrf
        <p>Nama Badan Usaha</p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="nama_badan_usaha" placeholder="Nama Badan Usaha">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-userss"></span>
            </div>
          </div>
        </div>
        <p>Lokasi Pekerjaan</p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="lokasi_pekerjaan" placeholder="Lokasi Pekerjaan">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phoned"></span>
            </div>
          </div>
        </div>
        <p>Unit Kerja Pemberi Jasa (Departemen)</p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="departemen" placeholder="Unit Kerja Pemberi Jasa (Departemen)">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-text"></span>
            </div>
          </div>
        </div>
        <p>Jenis Pekerjaan</p>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="jenis_pekerjaan" placeholder="Jenis Pekerjaan">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-text"></span>
              </div>
            </div>
          </div>
          <p>Jumlah Personil</p>
          <div class="input-group mb-3">
            <input type="number" class="form-control" name="jumlah_personil" placeholder="Jumlah Personil (Pekerja)">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-text"></span>
              </div>
            </div>
          </div>
          <p>Kelengkapan Fotokopi Berkas Terlampir (Cetang Jika Ada)</p>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="ktp" value="KTP">
            <label class="form-check-label" for="exampleCheck1">KTP</label>
            </div>
            <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="kib" value="KIB">
            <label class="form-check-label" for="exampleCheck1">KIB (Kartu Ijin Bekerja)</label>
            </div>
            <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="surat_kesehatan" value="Surat Kesehatan">
            <label class="form-check-label" for="exampleCheck1">Surat Kesehatan</label>
            </div>
            <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="lainnya" value="lainnya">
            <label class="form-check-label" for="exampleCheck1">Yang Lain</label>
        </div>
        <input type="text" class="form-control" name="lainnya_isi" placeholder="Isi yang lain">
        <br>
        <p>Foto Lembar Depan Formulir KIB 24Jam</p>
        <div class="form-group">
            <div class="input-group">
              <div class="custom-file">
                <input type="file" name="foto_lembar_depan" class="custom-file-input" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
            </div>
          </div>
        <p>Nama Safety Officer (Yang Upload Dokumen)</p>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="nama_safety_upload" placeholder="Nama Safety Officer">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-text"></span>
                </div>
            </div>
        </div>
        <p>No HP</p>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="no_hp" placeholder="No HP">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-text"></span>
                </div>
            </div>
        </div>
        @foreach($pertanyaans as $indexpertanyaan=>$pertanyaan)
        <p>{{ $pertanyaan->pertanyaan }}</p>
        <div class="mb-3">
            @foreach($pertanyaan->values as $indexvalue=>$value)
            <div class="form-check">
              <input type="radio" class="form-check-input" id="{{ $pertanyaan->kode.'_'.$indexpertanyaan.'_'.$indexvalue }}" name="{{ $pertanyaan->kode.'_'.$indexpertanyaan }}" value="{{ $value->value }}">
              <label class="form-check-label" for="{{ $pertanyaan->kode.'_'.$indexpertanyaan.'_'.$indexvalue }}">{{ $value->value }}</label>
            </div>
            @endforeach
        </div>
        @endforeach
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
