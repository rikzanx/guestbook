@extends('pos.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List KIB</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List KIB</li>
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
                <!-- <a href="{{ route('index') }}" class="btn btn-success"><span class="fas fa-plus"></span> tambah KIB</a> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Badan Usaha</th>
                        <th>Lokasi Pekerjaan</th>
                        <th>Departemen</th>
                        <th>Jenis Pekerjaan</th>
                        <th>Jumlah Personil</th>
                        <th>Kelengkapan Fotokopi Berkas</th>
                        <th>Foto Lembar Depan Formulir</th>
                        <th>Nama Safety Officer</th>
                        <th>No HP</th>
                        <th>Status</th>
                        <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($guests as $item)
                        
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->nama_badan_usaha }}</td>
                        <td>{{ $item->lokasi_pekerjaan }}</td>
                        <td>{{ $item->departemen }}</td>
                        <td>{{ $item->jenis_pekerjaan }}</td>
                        <td>{{ $item->jumlah_personil }}</td>
                        <td>{{ $item->ktp }} {{ $item->kib }} {{ $item->surat_kesehatan }} {{ $item->lainnya }}</td>
                        <td>
                        <!--  <a href="{{ asset($item->foto_lembar_depan) }}" data-toggle="lightbox" data-title="{{ $item->name }}">-->
                        <!--    <img src="{{ asset($item->foto_lembar_depan) }}" style="width: 100px;height:100px;" alt="" srcset="">-->
                        <!--</a>-->
                            <a href="{{ asset($item->foto_lembar_depan) }}" target="_blank">Lihat foto</a>
                        </td>
                        <td>{{ $item->nama_safety_upload }}</td>
                        <td>{{ $item->no_hp }}</td>
                        @if($item->verifikasi != "Terverifikasi")
                        <td><i class="fas fa-trasss" style="color:red;" ></i> {{ $item->verifikasi }}</td>
                        @else
                        <td><i class="fas fa-check" style="color:green;" ></i> {{ $item->verifikasi }}</td>

                        @endif
                        <td>
                            <!-- @if($item->verifikasi != "Terverifikasi")
                            <a class="btn btn-primary" href="{{ route('verifikasikib',$item->id) }}"><span class="fas fa-check"></span></a>
                            @endif -->
                            <!-- <button class="btn btn-danger" onclick="modaldelete({{ $item->id }})"><span class="fas fa-trash"></span></button> -->
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Badan Usaha</th>
                        <th>Lokasi Pekerjaan</th>
                        <th>Departemen</th>
                        <th>Jenis Pekerjaan</th>
                        <th>Jumlah Personil</th>
                        <th>Kelengkapan Fotokopi Berkas</th>
                        <th>Foto Lembar Depan Formulir</th>
                        <th>Nama Safety Officer</th>
                        <th>No HP</th>
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
        <form action="{{ route('guest.destroy', ':id') }}" method="POST" class="delete-form">
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