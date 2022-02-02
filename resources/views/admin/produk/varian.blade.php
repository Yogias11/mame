@extends('layouts.master')
@section('title','Test1')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Varian</h3>
            </div>
            <form role="form" action="" id="formProduk" name="formProduk">
                @csrf
                <input type="hidden" name="produk_id" id="prdid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Satuan</label>
                                <select name="satuan_id" id="satuan_id" class="form-control satuan">
                                    <option>Pilih Satuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama</label>
                                <input type="text" class="form-control" name="nama" id="exampleInputEmail1" placeholder="Varian" style="text-transform:uppercase">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Stok</label>
                                <input type="number" class="form-control" name="stok" id="exampleInputEmail1" placeholder="Stok" style="text-transform:uppercase">
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
                <h3 class="card-title">Detail Produk <b><span id="produktitle"></span></b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="table-produk" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            {{-- <th>Kode</th> --}}
                            <th>Produk</th>
                            <th>Stok</th>
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
  <div class="modal-dialog modal-lg">
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
        <input type="hidden" name="produk_id" id="prdidedit">
        <div class="form-group">
            <label for="exampleInputEmail1">Satuan</label>
            <select name="satuan_id" id="satuan_id1" class="form-control satuan">
                <option>Pilih Satuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama1" placeholder="Varian" style="text-transform:uppercase">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Stok</label>
            <input type="number" class="form-control" name="stok" id="stok1" placeholder="Stok" style="text-transform:uppercase">
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
        let url = $(location).attr('href');
        let produkid = url.substring(url.lastIndexOf('/') + 1); 
        let prdid = $('#prdid').val(produkid);
        let prdidedit = $('#prdidedit').val(produkid);
        console.log(produkid);
        
        $.ajax({
            url: "{{ url('/api/master/satuan') }}",
            type: "post",
            success: function(res) {
                $.each(res, function(key, value){
                    $('.satuan').append('<option value="' + value.id + '">' + value.nama +
                    '</option');
                })
            }
        })
        // data produk
        $("#table-produk").DataTable({
            "responsive": true,
            "autoWidth": false,
            ajax: {
                url: "/api/v1/varian",
                type: "post",
                data: {
                    id: produkid
                },
            },
            columns: [{
                    data: 'DT_RowIndex'
                },
                {
                    data: 'produk'
                },
                {
                    data: 'stok'
                },
                {data: 'aksi'},
            ],
        });

        $.ajax({
            url: "/api/v1/varian",
            type: "post",
            data: {
                id: produkid
            },
            success: function(res) {
                
                $('span#produktitle').text(res.data[0].parent)
            }
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
                        url: "{{ url('/api/v1/create-varian') }}",
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
                text: "Hapus Produk " + $(this).parent().prev().prev().text() + "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                      url: "{{ url('/api/v1/delete-varian') }}",
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
            $('#title').html('Edit Varian ' + '<b>' + $(this).parent().prev().prev().text() + '</b>');
          id = $(this).data('id');
            e.preventDefault();
            console.log($(this).parent().prev().html());
            $.ajax({
              url: "{{ url('/api/v1/show-varian') }}",
              type: "post",
              data: {
                id: id
              },
              success: function(res) {
                console.log(res);
                $('#modal-info').modal('show');
                $('#id').val(res.data.id).attr('disabled', false);
                $('#nama1').val(res.data.nama).attr('disabled', false);
                $('#stok1').val(res.data.stok).attr('disabled', false);
                $('#satuan_id1').val(res.data.satuan_id).trigger('change').attr('disabled', false);
              }
            })
        })

        $(document).on('click', '#btnDetail', function (e) {
            $('#title').html('Edit Produk ' + '<b>' + $(this).parent().prev().prev().text() + '</b>');
          id = $(this).data('id');
            e.preventDefault();
            console.log($(this).parent().prev().html());
            $.ajax({
              url: "{{ url('/api/v1/show-varian') }}",
              type: "post",
              data: {
                id: id
              },
              success: function(res) {
                console.log(res);
                $('#modal-info').modal('show');
                $('#id').val(res.data.id).attr('disabled', true);
                $('#nama1').val(res.data.nama).attr('disabled', true);
                $('#stok1').val(res.data.stok).attr('disabled', true);
                $('#satuan_id1').val(res.data.satuan_id).trigger('change').attr('disabled', true);
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
                        url: "{{ url('/api/v1/create-varian') }}",
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
