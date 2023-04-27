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
              <li class="breadcrumb-item active">List Surat Jalan</li>
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
            <div class="card">
              <div class="card-header">
                
                <a href="{{ route('suratjalan.index') }}" class="btn btn-success"><span class="fas fa-plus"></span> Tambah Surat Jalan</a>
                <button class="btn btn-success float-right" onclick="modalverifikasiall()"><span class="fas fa-check"></span> Verifikasi Semuanya</button>
                
                {{-- <a href="{{ route('index') }}" class="btn btn-success float-right"><span class="fas fa-plus"></span> tambah KIB</a> --}}

              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <p><b>Tanggal terpilih :</b> {{ $date }} s/d {{ $date_to }} </p>
                <div class="row">
                  <div class="col-12 col-sm-6 col-lg-4">
                    <form action="{{route('admin.suratjalan.index')}}">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Pilih Tanggal dari</label>
                        <input type="date" name="date" value="{{ $date }}" class="form-control pilih-tanggal" id="exampleInputEmail1" placeholder="NIK">
                      </div>
                      <button type="submit" class="btn btn-primary">Pilih</button>
                      <a href="{{route('admin.suratjalan.index')}}" class="btn btn-secondary">Reset</a>

                  </div>
                  <div class="col-12 col-sm-6 col-lg-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Pilih Tanggal sampai</label>
                        <input type="date" name="date_to" value="{{ $date_to }}" class="form-control pilih-tanggal" id="exampleInputEmail1" placeholder="NIK">
                      </div>
                    </form>
                  </div>
                  <div class="col-12 col-sm-6 col-lg-4">
                    <form action="{{route('admin.suratjalan.index')}}">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Pilih Bulan</label>
                        <br>
                        <select class="form-control" name="bulan" id="bulan">
                          @foreach ($months as $item)  
                            <option value="{{ $loop->index }}"  {{ ($loop->index == $bulan )?'selected':'' }}>{{$item}}</option>
                          @endforeach
                        </select>
                      </div>
                      <button type="submit" class="btn btn-primary">Pilih</button>
                      <a href="{{route('admin.suratjalan.index')}}" class="btn btn-secondary">Reset</a>
                    </form>
                  </div>
                </div>
                
                <br>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Deskripsi / Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Bentuk</th>
                    <th>Asal</th>
                    <th>Tujuan</th>
                    <th>No.PO (No Dokumen)</th>
                    <th>Nama PJ</th>
                    <th>NIK / No KIB / No</th>
                    <th>Foto</th>
                    <th>IN (Masuk Pukul)</th>
                    <th>OUT (Keluar Pukul)</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $jumlah = count($suratjalans); ?>
                    @foreach ($suratjalans as $item)
                        
                    <tr>
                        <td>{{ $jumlah-- }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $item->bentuk }}</td>
                        <td>{{ $item->dari }}</td>
                        <td>{{ $item->tujuan }}</td>
                        <td>{{ $item->nomor_po }}</td>
                        <td>{{ $item->nama_penanggung_jawab }}</td>
                        <td>{{ $item->nomor }}</td>
                        <td>
                          @foreach($item->images as $foto)
                            <a href="{{ asset($foto->image_surat_jalan) }}" target="_blank">Lihat foto</a>
                          @endforeach
                        </td>
                        <td>{{ $item->waktu_masuk }}</td>
                        <td>{{ $item->waktu_keluar }}</td>
                        <td>{{ $item->created_at }}</td>
                        @if($item->verifikasi != "Terverifikasi")
                        <td><i class="fas fa-trasss" style="color:red;" ></i> {{ $item->verifikasi }}</td>
                        @else
                        <td><i class="fas fa-check" style="color:green;" ></i> {{ $item->verifikasi }}</td>
                        @endif
                        <td>
                          @if($item->verifikasi != "Terverifikasi")
                            <a class="btn btn-success" href="{{ route('verifikasisuratjalan',$item->id) }}"><span class="fas fa-check"></span></a>
                            @endif
                            <a class="btn btn-primary" href="{{ route('admin.suratjalan.edit',$item->id) }}"><span class="fas fa-edit"></span></a>
                            <button class="btn btn-danger" onclick="modaldelete({{ $item->id }})"><span class="fas fa-trash"></span></button>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Deskripsi / Nama Barang</th>
                      <th>Jumlah</th>
                      <th>Bentuk</th>
                      <th>Asal</th>
                      <th>Tujuan</th>
                      <th>No.PO (No Dokumen)</th>
                      <th>Nama PJ</th>
                      <th>NIK / No KIB / No</th>
                      <th>Foto</th>
                      <th>IN (Masuk Pukul)</th>
                      <th>OUT (Keluar Pukul)</th>
                      <th>Tanggal</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
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
  <!-- Modal -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Peringatan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin akan menghapus data ini&hellip;</p>
        </div>
        <form action="{{ route('admin.suratjalan.destroy', ':id') }}" method="POST" class="delete-form">
            @csrf
            @method('DELETE')
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
  <!-- /.modal -->

  <div class="modal fade" id="modal-verifikasi">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Peringatan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin akan memverifikasi semua data&hellip;</p>
          {{-- <p></p> --}}
        </div>
        <form action="{{ route('verifikasisuratjalanall') }}" method="GET" class="delete-form">
            @csrf
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Verifikasi</button>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

@section('js')
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

    <!-- Page specific script -->
<script>

    function modaldelete(id){
        // alert(id);
        var url = $('.delete-form').attr('action');
        $('.delete-form').attr('action',url.replace(':id',id));
        $('#modal-default').modal('show');
    }
    function modalverifikasiall(){
        // alert(id);
        $('#modal-verifikasi').modal('show');
    }
    $(function () {
      //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
          alwaysShowClose: true
        });
      });
      $("#example1").DataTable({
        "iDisplayLength": 100,
        "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
@endsection