@extends('layouts.master')
@section('title','Setting | Submenu')
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
                <h3 class="card-title">Tambah Sub Menu</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{ route('menu.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <input type="hidden" name="menu_id" id="menu_id">
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
                <h3 class="card-title">Daftar Role</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                       {{-- @foreach ($data as $i)
                           @php
                               $no = 1;
                           @endphp
                           <tr>
                               <td>{{ $no++ }}</td>
                               <td>{{ $i->nama }}</td>
                               <td>{{ $i->url }}</td>
                               <td>
                                   <a href="" class="btn btn-outline-success btn-sm"><i class="fas fa-edit"> Edit</i></a>
                                   <a href="" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"> Delete</i></a>
                               </td>
                           </tr>
                       @endforeach --}}
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
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
