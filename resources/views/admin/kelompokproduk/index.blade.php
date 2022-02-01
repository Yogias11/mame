@extends('layouts.master')
@section('title','Test')
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
                <h3 class="card-title">Tambah Kelompok</h3>
            </div>
            <form role="form" action="" id="formProduk" name="formProduk">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jenis</label>
                        <select name="jenis_id" id="" class="form-control jenis">
                            <option>Pilih Jenis</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" class="form-control" name="nama" id="exampleInputEmail1" placeholder="Nama">
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
                <h3 class="card-title">Data</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="table-produk" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
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
        <div class="form-group">
            <label for="exampleInputEmail1">Jenis</label>
            <select name="jenis_id" id="jenis_id" class="form-control jenis">
                <option>Pilih Jenis</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
        </div>
          <!-- /.card-body -->
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
        function modalshow() {
          $('#modal-info').modal('show');
        }

        $.ajax({
            url: "{{ url('/api/master/jenis') }}",
            type: "post",
            success: function(res) {
                $.each(res, function(key, value){
                    $('.jenis').append('<option value="' + value.id + '">' + value.nama +
                    '</option');
                })
            }
        })
        // data produk
        $("#table-produk").DataTable({
            "responsive": true,
            "autoWidth": false,
            ajax: {
                url: "/api/v1/kategori",
                type: "post",
            },
            columns: [{
                    data: 'DT_RowIndex'
                },
                {
                    data: 'jenis'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'aksi'
                }
            ]
        });
        // submit new produk
        $('body').on('submit', '#formProduk', function (e) {
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
                        url: "{{ url('/api/v1/create-kategori') }}",
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
                        // $("#example1").DataTable().ajax.reload();
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
                text: "Hapus kategori " + $(this).parent().prev().html() + "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                      url: "{{ url('/api/v1/delete-kategori') }}",
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
              url: "{{ url('/api/v1/show-kategori') }}",
              type: "post",
              data: {
                id: id
              },
              success: function(res) {
                console.log(res);
                $('#title').html('Edit kategori ' + '<b>' + res.data.nama + '</b>');
                modalshow();
                $('#id').val(res.data.id).attr('disabled', false);
                $('#jenis_id').val(res.data.jenis_id).trigger('change').attr('disabled', false);
                $('#nama').val(res.data.nama).attr('disabled', false);
                // location.reload();
              }
            })
        })

        $(document).on('click', '#btnDetail', function (e) {
            id = $(this).data('id');
            e.preventDefault();
            console.log($(this).parent().prev().html());
            $.ajax({
              url: "{{ url('/api/v1/show-kategori') }}",
              type: "post",
              data: {
                id: id
              },
              success: function(res) {
                console.log(res);
                $('#title').html('Edit kategori ' + '<b>' + res.data.nama + '</b>');
                modalshow();
                $('#id').val(res.data.id).attr('disabled', true);
                $('#jenis_id').val(res.data.jenis_id).trigger('change').attr('disabled', true);
                $('#nama').val(res.data.nama).attr('disabled', true);
                // location.reload();
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
                        url: "{{ url('/api/v1/create-kategori') }}",
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
