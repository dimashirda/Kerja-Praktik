@extends('adminlte::page')

@section('title', 'SIKontrak')

@section('content_header')
    <h1>Dashboard</h1>
@stop



@section('content')
    <style>
        .example-modal .modal {
            position: relative;
            top: auto;
            bottom: auto;
            right: auto;
            left: auto;
            display: block;
            z-index: 1;
        }

        .example-modal .modal {
            background: transparent !important;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Pelanggan</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{route('addplg')}}" class='btn btn-primary'><i class="fa fa-plus-circle"></i> Tambah baru</a>
                        </div>
                    </div>
                    <br>
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>NIPNAS</th>
                            <th>Pelanggan</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th colspan="2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>A</td>
                            <td>B</td>
                            <td>C</td>
                            <td>D</td>
                            <td align="center" width="30px">
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                                    Edit
                                </button>
                            </td>
                            <td align="center" width="30px">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger">
                                    Hapus
                                </button>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-default" class="modal fade" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Data Pelanggan</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="NIPNAS" class="col-sm-2 control-label">NIPNAS</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="NIPNAS" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NamaPelanggan" class="col-sm-2 control-label">Nama Pelanggan</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Nama Pelanggan">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="EmailPelanggan" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="TlpPelanggan" class="col-sm-2 control-label">No. Telepon</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="No. Telepon">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success pull-right">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-danger" class="modal fade" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Hapus Data</h4>
                </div>
                <div class="modal-body">
                    <p>Anda yakin ingin menghapus pelanggan ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success pull-right">Hapus</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#example1').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>
@stop