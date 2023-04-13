@extends('admin.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Guest</h1>
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
                <h3 class="card-title">Edit Guest</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('guest.update',$guest->id) }}" enctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Badan Usaha</label>
                    <input type="text" name="nama_badan_usaha" value="{{ $guest->nama_badan_usaha }}" class="form-control" id="exampleInputEmail1" placeholder="Jawaban Anda">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Lokasi Pekerjaan</label>
                    <input type="text" name="lokasi_pekerjaan" value="{{ $guest->lokasi_pekerjaan }}" class="form-control" id="exampleInputEmail1" placeholder="Jawaban Anda">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Unit Kerja Pemberi Jasa (Departemen)</label>
                    <input type="text" name="departemen" value="{{ $guest->departemen }}" class="form-control" id="exampleInputEmail1" placeholder="Jawaban Anda">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Jenis Pekerjaan</label>
                    <input type="text" name="jenis_pekerjaan" value="{{ $guest->jenis_pekerjaan }}" class="form-control" id="exampleInputEmail1" placeholder="Jawaban Anda">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Jumlah Personil</label>
                    <input type="number" name="jumlah_personil" value="{{ $guest->jumlah_personil }}" class="form-control" id="exampleInputEmail1" placeholder="Jawaban Anda">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Kelengkapan Fotokopi Berkas Terlampir (Cetang Jika Ada)</label>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" name="ktp" value="KTP" {{ ($guest->ktp == "KTP" )?'checked':'' }}>
                      <label class="form-check-label" for="exampleCheck1">KTP</label>
                      </div>
                      <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" name="kib" value="KIB" {{ ($guest->ki  == "KIB" )?'checked':'' }}>
                      <label class="form-check-label" for="exampleCheck1">KIB (Kartu Ijin Bekerja)</label>
                      </div>
                      <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" name="surat_kesehatan" value="Surat Kesehatan" {{ ($guest->surat_kesehatan == "Surat Kesehatan" )?'checked':'' }}>
                      <label class="form-check-label" for="exampleCheck1">Surat Kesehatan</label>
                      </div>
                      <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" name="lainnya" value="lainnya" {{ ($guest->lainnya == "lainnya" )?'checked':'' }}>
                      <label class="form-check-label" for="exampleCheck1">Yang Lain</label>
                  </div>
                  <input type="text" class="form-control" name="lainnya_isi" value="{{$guest->lainnya_isi}}" placeholder="Isi yang lain">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Foto Lembar Depan Formulir KIB 24Jam</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="foto_lembar_depan" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Safety Officer (Yang Upload Dokumen)</label>
                    <input type="text" name="nama_safety_upload" value="{{ $guest->nama_safety_upload }}" class="form-control" id="exampleInputEmail1" placeholder="Jawaban Anda">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">No HP</label>
                    <input type="text" name="no_hp" value="{{ $guest->no_hp }}" class="form-control" id="exampleInputEmail1" placeholder="Jawaban Anda">
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        <option value="Terverifikasi" {{ ($guest->status == "Terverifikasi" )?'selected':'' }}>Terverifikasi</option>
                        <option value="Belum Terverifikasi" {{ ($guest->status != "Terverifikasi")?'selected':'' }}>Belum Terverifikasi</option>
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