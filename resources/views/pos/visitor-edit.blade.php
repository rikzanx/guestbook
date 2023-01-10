@extends('pos.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Visitor</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Blokir</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Visitor</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('pos.visitor.update',$visitor->id) }}" enctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" name="nama" value="{{ $visitor->nama }}" class="form-control" id="exampleInputEmail1" placeholder="Jawaban Anda">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">NIK</label>
                    <input type="text" name="nik" value="{{ $visitor->nik }}" class="form-control" id="exampleInputEmail1" placeholder="Jawaban Anda">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan" value="{{ $visitor->nama_perusahaan }}" class="form-control" id="exampleInputEmail1" placeholder="Jawaban Anda">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">POS Asal</label>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="exampleCheck1" name="pos_asal" value="POS ZONA 1" {{ ($visitor->pos_asal  == "POS ZONA 1" )?'checked':'' }}>
                    <label class="form-check-label" for="exampleCheck1">POS ZONA 1</label>
                    </div>
                    <div class="form-check">
                    <input type="radio" class="form-check-input" id="exampleCheck2" name="pos_asal" value="POS ZONA 2" {{ ($visitor->pos_asal  == "POS ZONA 2" )?'checked':'' }}>
                    <label class="form-check-label" for="exampleCheck2">POS ZONA 2</label>
                    </div>
                    <div class="form-check">
                      <input type="radio" class="form-check-input" id="exampleCheck3" name="pos_asal" value="POS ZONA 3" {{ ($visitor->pos_asal  == "POS ZONA 3" )?'checked':'' }}>
                      <label class="form-check-label" for="exampleCheck3">POS ZONA 3</label>
                    </div>
                    <div class="form-check">
                      <input type="radio" class="form-check-input" id="exampleCheck4" name="pos_asal" value="POS ZONA 4" {{ ($visitor->pos_asal  == "POS ZONA 4" )?'checked':'' }}>
                      <label class="form-check-label" for="exampleCheck4">POS ZONA 4</label>
                    </div>
                    <div class="form-check">
                      <input type="radio" class="form-check-input" id="exampleCheck5" name="pos_asal" value="POS ZONA 5" {{ ($visitor->pos_asal  == "POS ZONA 5" )?'checked':'' }}>
                      <label class="form-check-label" for="exampleCheck5">POS ZONA 5</label>
                      </div>
                    <div class="form-check">
                      <input type="radio" class="form-check-input" id="exampleCheck6" name="pos_asal" value="POS ZONA KAWASAN" {{ ($visitor->pos_asal  == "POS ZONA KAWASAN" )?'checked':'' }}>
                      <label class="form-check-label" for="exampleCheck6">POS ZONA KAWASAN</label>
                      </div>
                    <div class="form-check">
                      <input type="radio" class="form-check-input" id="exampleCheck7" name="pos_asal" value="lainnya" {{ ($visitor->pos_asal  == "lainnya" )?'checked':'' }}>
                      <label class="form-check-label" for="exampleCheck7">Yang Lain</label>
                    </div>
                    <input type="text" class="form-control" name="lainnya" value="{{$visitor->lainnya}}" placeholder="Isi yang lain">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tujuan</label>
                    <input type="text" name="tujuan" value="{{ $visitor->tujuan }}" class="form-control" id="exampleInputEmail1" placeholder="Jawaban Anda">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Foto KTP</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="foto_ktp" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nomor Kartu</label>
                    <input type="text" name="nomor_kartu" value="{{ $visitor->nomor_kartu }}" class="form-control" id="exampleInputEmail1" placeholder="Jawaban Anda">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Jam Keluar</label>
                    <input type="time" name="keluar" value="{{ $visitor->keluar }}" class="form-control" id="exampleInputEmail1" placeholder="Jawaban Anda">
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="verifikasi">
                        <option value="Terverifikasi" {{ ($visitor->verifikasi == "Terverifikasi" )?'selected':'' }}>Terverifikasi</option>
                        <option value="Belum Terverifikasi" {{ ($visitor->verifikasi != "Terverifikasi")?'selected':'' }}>Belum Terverifikasi</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
                  <button type="submit" class="btn btn-success">Buat</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('js')
    
@endsection