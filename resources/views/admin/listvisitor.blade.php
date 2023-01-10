@extends('admin.layouts.app')

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
              <li class="breadcrumb-item active">List Visitor</li>
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
                
                <a href="{{ route('visitor.index') }}" class="btn btn-success"><span class="fas fa-plus"></span> Tambah Visitor</a>
                
                {{-- <a href="{{ route('index') }}" class="btn btn-success float-right"><span class="fas fa-plus"></span> tambah KIB</a> --}}

              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <p><b>Tanggal terpilih : {{ $date }}</b></p>
                <div class="row">
                  <div class="col-12 col-sm-6 col-lg-4">
                    <form action="{{route('admin.visitor.index')}}">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Pilih Tanggal</label>
                        <input type="date" name="date" value="{{ $date }}" class="form-control pilih-tanggal" id="exampleInputEmail1" placeholder="NIK">
                      </div>
                      <button type="submit" class="btn btn-primary">Pilih</button>
                    </form>
                  </div>
                </div>
                
                <br>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Perusahaan / Instansi</th>
                    <th>Pos Asal</th>
                    <th>Tujuan</th>
                    <th>Foto KTP</th>
                    <th>No HP</th>
                    <th>Nomor Kartu</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $jumlah = count($visitors); ?>
                    @foreach ($visitors as $item)
                        
                    <tr>
                        <td>{{ $jumlah-- }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->nama_perusahaan }}</td>
                        <td>{{ $item->pos_asal }}</td>
                        <td>{{ $item->tujuan }}</td>
                        <td>
                          <a href="{{ asset($item->foto_ktp) }}" target="_blank">Lihat foto</a>
                        </td>
                        <td>{{ $item->no_hp }}</td>
                        <td>{{ $item->nomor_kartu }}</td>
                        @if($item->verifikasi != "Terverifikasi")
                        <td><i class="fas fa-trasss" style="color:red;" ></i> {{ $item->verifikasi }}</td>
                        @else
                        <td><i class="fas fa-check" style="color:green;" ></i> {{ $item->verifikasi }}</td>
                        @endif
                        <td>{{ $item->created_at }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('h:i') }}</td>
                        @if($item->keluar != null)
                        <td>{{ \Carbon\Carbon::parse($item->keluar)->format('h:i') }}</td>
                        @else
                        <td>-</td>
                        @endif
                        <td>
                            @if($item->verifikasi != "Terverifikasi")
                            <a class="btn btn-success" href="{{ route('verifikasivisitor',$item->id) }}"><span class="fas fa-check"></span></a>
                            @endif
                            @if($item->keluar == null)
                            <a class="btn btn-secondary" href="{{ route('keluarvisitor',$item->id) }}"><span class="fas fa-sign-out-alt"></span></a>
                            @endif
                            <a class="btn btn-primary" href="{{ route('admin.visitor.edit',$item->id) }}"><span class="fas fa-edit"></span></a>
                            <button class="btn btn-danger" onclick="modaldelete({{ $item->id }})"><span class="fas fa-trash"></span></button>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>NIK</th>
                      <th>Perusahaan / Instansi</th>
                      <th>Pos Asal</th>
                      <th>Tujuan</th>
                      <th>Foto KTP</th>
                      <th>No HP</th>
                      <th>Nomor Kartu</th>
                      <th>Status</th>
                      <th>Tanggal</th>
                      <th>Jam Masuk</th>
                      <th>Jam Keluar</th>
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
        <form action="{{ route('admin.visitor.destroy', ':id') }}" method="POST" class="delete-form">
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