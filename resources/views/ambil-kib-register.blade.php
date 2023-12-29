
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ambil KIB</title>

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
  <!-- Select 2 js -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <!-- Selet 2 bootstarp themes -->
  <!-- <link rel="stylesheet" href="{{ asset('css/select2-bootstrap.css') }}"> -->
  <style>
    .wrapper {
  /* position: relative; */
  /* width: 400px; */
  height: 200px;
  -moz-user-select: none;
  -webkit-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.signature-pad {
  border: 1px solid black;
  position: absolute;
  left: 0;
  top: 0;
  /* width:400px; */
  height:200px;
  background-color: white;
}
  </style>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <img src="{{ asset("img/logo.png") }}" alt="" class="img img-fluid">
      <a href="../../index2.html" class="h1"><b>Keamanan PG</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"><b>PENGAMBILAN KIB / KIKP</b></p>

      <form method="POST" action="{{ route('simb.store') }}" enctype="multipart/form-data">
        @csrf
        <p>Nama Perusahaan</p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="perusahaan" placeholder="Jawaban Anda">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-userss"></span>
            </div>
          </div>
        </div>
        <p>Nomor KIB</p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="no_kib[]" placeholder="Jawaban Anda">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-userss"></span>
            </div>
          </div>
        </div>
        <p>Pilih KIB</p>
        <div class="input-group mb-3">
          <select name="kib" id="kib-select" class="form-control">
            @for($i=0;$i<=50;$i++)
            <option value="2308928">2308928</option>
            @endfor
          </select>
        </div>

        <p>List KIB yag diambil</p>
        <p>Jumlah</p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="jumlah" placeholder="Jawaban Anda">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-userss"></span>
            </div>
          </div>
        </div>
        <p>Foto KIB yang diambil</p>
        <div class="form-group">
          <div class="input-group">
            <div class="custom-file">
              <input type="file" name="foto_kib" class="custom-file-input" id="exampleInputFile">
              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
            </div>
          </div>
        </div>
      
        <p>Nama Pengambil</p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="nama_pengambil" placeholder="Jawaban Anda">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-userss"></span>
            </div>
          </div>
        </div>
        <p>No KIB Pengambil</p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="kib_pengambil" placeholder="Jawaban Anda">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-userss"></span>
            </div>
          </div>
        </div>
        <p>No HP Pengambil</p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="hp_pengambil" placeholder="Jawaban Anda">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-userss"></span>
            </div>
          </div>
        </div>
        <p>Tanda Tangan</p>
        <div class="input-group mb-3">
          <div class="wrapper">
            <canvas id="signature-pad" class="signature-pad" height=200></canvas>
          </div>
        </div>
        <button type="button" id="save-png" class="d-none">Save as PNG</button>
        <button type="button" id="save-jpeg" class="d-none">Save as JPEG</button>
        <button type="button" id="save-svg" class="d-none">Save as SVG</button>
        <button type="button" id="draw" class="d-none">Draw</button>
        <button type="button" id="erase" class="d-none">Erase</button>
        <button type="button" id="undo" class="d-none">Undo</button>
        <button type="button" id="clear" class="btn btn-secondary">Clear</button>
        <br>
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
<!-- Select 2 js -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- macimuxx height select2 js -->
<script src="{{ asset('js/maximize-select2-height.min.js') }}"></script>
<!-- Siganture pad js -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
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
    $(document).ready(function(){
      $('#kib-select').select2();
    });

    $('#kib-select').on('change',function(e){
      var valueSelected = this.value;
      alert(valueSelected);
    });
</script>
<script>
  var canvas = document.getElementById('signature-pad');

// Adjust canvas coordinate space taking into account pixel ratio,
// to make it look crisp on mobile devices.
// This also causes canvas to be cleared.
function resizeCanvas() {
    // When zoomed out to less than 100%, for some very strange reason,
    // some browsers report devicePixelRatio as less than 1
    // and only part of the canvas is cleared then.
    var ratio =  Math.max(window.devicePixelRatio || 1, 1);
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    canvas.getContext("2d").scale(ratio, ratio);
}

window.onresize = resizeCanvas;
resizeCanvas();

var signaturePad = new SignaturePad(canvas, {
  backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
});

document.getElementById('save-png').addEventListener('click', function () {
  if (signaturePad.isEmpty()) {
    return alert("Please provide a signature first.");
  }
  
  var data = signaturePad.toDataURL('image/png');
  console.log(data);
  window.open(data);
});

document.getElementById('save-jpeg').addEventListener('click', function () {
  if (signaturePad.isEmpty()) {
    return alert("Please provide a signature first.");
  }

  var data = signaturePad.toDataURL('image/jpeg');
  console.log(data);
  window.open(data);
});

document.getElementById('save-svg').addEventListener('click', function () {
  if (signaturePad.isEmpty()) {
    return alert("Please provide a signature first.");
  }

  var data = signaturePad.toDataURL('image/svg+xml');
  console.log(data);
  console.log(atob(data.split(',')[1]));
  window.open(data);
});

document.getElementById('clear').addEventListener('click', function () {
  signaturePad.clear();
});

document.getElementById('draw').addEventListener('click', function () {
  signaturePad.compositeOperation = 'source-over'; // default value
});

document.getElementById('erase').addEventListener('click', function () {
  signaturePad.compositeOperation = 'destination-out';
});

document.getElementById('undo').addEventListener('click', function () {
	var data = signaturePad.toData();
  if (data) {
    data.pop(); // remove the last dot or line
    signaturePad.fromData(data);
  }
});

</script>
</body>
</html>
