@extends('layouts.master')
@section('title','Setting | Menu')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush

@section('content')
<div class="row">
    <div class="col-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Menu</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{ route('menu.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" class="form-control" name="nama" id="exampleInputEmail1" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Icon</label>
                        <input type="text" class="form-control" name="icons" id="exampleInputPassword1" placeholder="Icon">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Url</label>
                        <input type="text" class="form-control" name="url" id="exampleInputPassword1" placeholder="URL">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Ordering</label>
                        <input type="text" class="form-control" name="ordering" id="exampleInputPassword1" placeholder="Ordering">
                    </div>
                </div>
                <!-- /.card-body -->
        
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Menu</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Url</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($data as $i)
                           @php
                               $no = 1;
                           @endphp
                           <tr>
                               <td>{{ $no++ }}</td>
                               <td>{{ $i->nama }}</td>
                               <td>{{ $i->url }}</td>
                               <td>
                                   <a href="{{ url('setting/submenu/'. $i->id) }}" class="btn btn-outline-info btn-sm"><i class="fas fa-eye"> Submenu</i></a>
                                   <a href="{{ url('setting/submenu/'. $i->id) }}" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#modal-default"><i class="fas fa-edit"> Edit</i></a>
                                   <a href="" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"> Delete</i></a>
                               </td>
                           </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

{{-- modal --}}
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Default Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>One fine body&hellip;</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection

@push('js')
<!-- DataTables -->
<script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
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
@endpush
