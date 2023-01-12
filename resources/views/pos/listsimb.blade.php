@extends('pos.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List SIM B</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List SIM B</li>
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
                
                <a href="{{ route('simb.index') }}" class="btn btn-success"><span class="fas fa-plus"></span> Tambah SIM B</a>
                
                {{-- <a href="{{ route('index') }}" class="btn btn-success float-right"><span class="fas fa-plus"></span> tambah KIB</a> --}}

              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <p><b>Tanggal terpilih : {{ $date }}</b></p>
                <div class="row">
                  <div class="col-12 col-sm-6 col-lg-4">
                    <form action="{{route('pos.simb.index')}}">
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
                    <th>Nomor Surat</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Bag / Dep / Ro</th>
                    <th>Dari</th>
                    <th>Tujuan</th>
                    <th>No.MB/No.SPBK/No.POL</th>
                    <th>Barang dibawa</th>
                    <th>Foto SIMB</th>
                    <th>Izin POS</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $jumlah = count($simbs); ?>
                    @foreach ($simbs as $item)
                        
                    <tr>
                        <td>{{ $jumlah-- }}</td>
                        <td>{{ $item->nomor_surat }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->departemen }}</td>
                        <td>{{ $item->dari }}</td>
                        <td>{{ $item->tujuan }}</td>
                        <td>{{ $item->no_mb }}</td>
                        <td>{{ $item->barang }}</td>
                        <td>
                          <a href="{{ asset($item->foto_simb) }}" target="_blank">Lihat foto</a>
                        </td>
                        <td>{{ ($item->pos_izin == 'lainnya') ? $item->pos_izin." (".$item->lainnya.")":$item->pos_izin }}</td>
                        @if($item->verifikasi != "Terverifikasi")
                        <td><i class="fas fa-trasss" style="color:red;" ></i> {{ $item->verifikasi }}</td>
                        @else
                        <td><i class="fas fa-check" style="color:green;" ></i> {{ $item->verifikasi }}</td>
                        @endif
                        <td>{{ $item->created_at }}</td>
                        <td>
                            @if($item->verifikasi != "Terverifikasi")
                            <a class="btn btn-success" href="{{ route('verifikasisimb',$item->id) }}"><span class="fas fa-check"></span></a>
                            @endif
                            <a class="btn btn-primary" href="{{ route('pos.simb.edit',$item->id) }}"><span class="fas fa-edit"></span></a>
                            <button class="btn btn-danger" onclick="modaldelete({{ $item->id }})"><span class="fas fa-trash"></span></button>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Nomor Surat</th>
                      <th>Nama</th>
                      <th>NIK</th>
                      <th>Bag / Dep / Ro</th>
                      <th>Dari</th>
                      <th>Tujuan</th>
                      <th>No.MB/No.SPBK/No.POL</th>
                      <th>Barang dibawa</th>
                      <th>Foto SIMB</th>
                      <th>Izin POS</th>
                      <th>Status</th>
                      <th>Tanggal</th>
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
        <form action="{{ route('pos.simb.destroy', ':id') }}" method="POST" class="delete-form">
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