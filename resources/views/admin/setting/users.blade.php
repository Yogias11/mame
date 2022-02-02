@extends('layouts.master')
@section('title','Setting | Submenu')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Role</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="formRole" name="formRole">
                @csrf
                <input type="hidden" name="divisi_id" id="dvsid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="text" class="form-control" name="password" id="password" placeholder="Password" minlength="6">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id="btnSubmit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar User Role <span id="titlee"></span></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="table-role" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

{{-- modal --}}
<div class="modal fade" id="modal-info">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="title">Default Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form role="form" action="" id="formProdukEdit" name="formProdukEdit">
          @csrf
        <div class="modal-body">
          <input type="hidden" name="id" id="id">
          <input type="hidden" name="divisi_id" id="dvsidedit">
          <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama1" placeholder="Nama">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" name="email" id="email1" placeholder="Email">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" name="username" id="username1" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="text" class="form-control" name="password" id="password1" placeholder="Password" minlength="6">
                </div>
            </div>
        </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="btnSave">Save changes</button>
        </div>
      </form>
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
        // general
        var id = null;
        let url = $(location).attr('href');
        let divisiid = url.substring(url.lastIndexOf('/') + 1); 
        let divisi = $('#dvsid').val(divisiid);
        let divisi1 = $('#dvsidedit').val(divisiid);
        function modalshow() {
          $('#modal-info').modal('show');
        }

        // table
        $("#table-role").DataTable({
            "responsive": true,
            "autoWidth": false,
            ajax: {
                url: "/api/master/setting/users",
                type: "post",
                data: {
                    id: divisiid
                },
            },
            columns: [{
                    data: 'DT_RowIndex'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'username'
                },
                {
                    data: 'aksi'
                }
            ]
        });
        // new submit
        $('body').on('submit', '#formRole', function (e) {
            e.preventDefault();
            $('#btnSubmit').html('Sending..');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData(this);
                    $.ajax({
                        type: "post",
                        url: "{{ route('user.store') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            Swal.fire(
                                'Success!',
                                data.msg,
                                'success'
                            )
                            location.reload();
                        }
                    })
                }
            })
        })

        $(document).on('click', '#btnDelete', function (e) {
            id = $(this).data('id');
            e.preventDefault();
            console.log($(this).data('id'));
            Swal.fire({
                title: 'Kamu Yakin?',
                text: "Hapus User " + $(this).parent().prev().html() + "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                      url: "{{ url('/api/master/setting/delete-users') }}",
                      type: "delete",
                      data: {
                        id: id
                      },
                      success: function(res) {
                        console.log(res);
                        location.reload();
                      }
                    })
                }
            })
        })

        $(document).on('click', '#btnEdit', function (e) {
          id = $(this).data('id');
            e.preventDefault();
            console.log($(this).parent().prev().html());
            $.ajax({
              url: "{{ url('/api/master/setting/show-users') }}",
              type: "post",
              data: {
                id: id
              },
              success: function(res) {
                console.log(res);
                $('#title').html('Edit User ' + '<b>' + res.data.nama + '</b>');
                modalshow();
                $('#id').val(res.data.id).attr('disabled', false);
                $('#nama1').val(res.data.nama).attr('disabled', false);
                $('#email1').val(res.data.email).attr('disabled', false);
                $('#username1').val(res.data.username).attr('disabled', false);
                $('#password1').val(bcrypt.hash(res.data.password,4)).attr('disabled', false);
              }
            })
        })

        $(document).on('click', '#btnDetail', function (e) {
            id = $(this).data('id');
            e.preventDefault();
            console.log($(this).parent().prev().html());
            $.ajax({
              url: "{{ url('/api/master/setting/show-users') }}",
              type: "post",
              data: {
                id: id
              },
              success: function(res) {
                console.log(res);
                $('#title').html('Detail User ' + '<b>' + res.data.nama + '</b>');
                modalshow();
                $('#id').val(res.data.id).attr('disabled', true);
                $('#nama1').val(res.data.nama).attr('disabled', true);
                $('#email1').val(res.data.email).attr('disabled', true);
                $('#username1').val(res.data.username).attr('disabled', true);
                $('#password1').val(res.data.password).attr('disabled', true);
              }
            })
        })

        $('body').on('submit', '#formProdukEdit', function (e) {
            e.preventDefault();
            $('#btnSave').html('Sending..');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData(this);
                    $.ajax({
                        type: "post",
                        url: "{{ route('user.store') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            Swal.fire(
                                'Success!',
                                data.msg,
                                'success'
                            )
                            location.reload();
                        }
                    })
                }
            })
        })
    });

</script>
@endpush
