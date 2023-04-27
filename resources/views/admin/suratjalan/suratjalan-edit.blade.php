@extends('admin.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Surat Jalan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Surat Jalan</li>
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
                <h3 class="card-title">Edit Surat Jalan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.suratjalan.update',$suratjalan->id) }}" enctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Deskripsi / Nama Barang</label>
                    <input type="text" name="nama_barang" value="{{ $suratjalan->nama_barang }}" class="form-control" id="exampleInputEmail1" placeholder="Jawaban Anda">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Qty / Kuantitas / Jumlah</label>
                    <input type="text" name="jumlah" value="{{ $suratjalan->jumlah }}" class="form-control" id="exampleInputEmail1" placeholder="Jawaban Anda">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Bentuk Packing (Bungkus)</label>
                    <input type="text" name="bentuk" value="{{ $suratjalan->bentuk }}" class="form-control" id="exampleInputEmail1" placeholder="Jawaban Anda">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Asal (Nama PT / Bagian)</label>
                    <input type="text" name="dari" value="{{ $suratjalan->dari }}" class="form-control" id="exampleInputEmail1" placeholder="Jawaban Anda">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tujuan</label>
                    <input type="text" name="tujuan" value="{{ $suratjalan->tujuan }}" class="form-control" id="exampleInputEmail1" placeholder="Jawaban Anda">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">No PO (No Dokumen)</label>
                    <input type="text" name="nomor_po" value="{{ $suratjalan->nomor_po }}" class="form-control" id="exampleInputEmail1" placeholder="Jawaban Anda">
                  </div>

                  <p>Nama Penanggung Jawab</p>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Penanggung Jawab</label>
                    <input type="text" name="nama_penanggung_jawab" value="{{ $suratjalan->nama_penanggung_jawab }}" class="form-control" id="exampleInputEmail1" placeholder="Jawaban Anda">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">NIK / No KIB / No Lainnya</label>
                    <input type="text" name="nomor" value="{{ $suratjalan->nomor }}" class="form-control" id="exampleInputEmail1" placeholder="Jawaban Anda">
                  </div>
                  <p>TRAFFIC KETERANGAN</p>
                  <div class="form-group">
                    <label for="exampleInputEmail1">IN (Masuk Pukul)</label>
                    <input type="time" name="waktu_masuk" value="{{ $suratjalan->waktu_masuk }}" class="form-control" id="exampleInputEmail1" placeholder="Jawaban Anda">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">OUT (Keluar Pukul)</label>
                    <input type="time" name="waktu_keluar" value="{{ $suratjalan->waktu_keluar }}" class="form-control" id="exampleInputEmail1" placeholder="Jawaban Anda">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Upload Foto Lembar Surat Jalan</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="foto_suratjalans[]" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="verifikasi">
                        <option value="Terverifikasi" {{ ($suratjalan->verifikasi == "Terverifikasi" )?'selected':'' }}>Terverifikasi</option>
                        <option value="Belum Terverifikasi" {{ ($suratjalan->verifikasi != "Terverifikasi")?'selected':'' }}>Belum Terverifikasi</option>
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