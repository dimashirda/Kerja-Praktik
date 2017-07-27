@extends('adminlte::page')

@section('title', 'SIKontrak')

@section('content_header')
    <h1>Layanan IMES</h1>
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
        @if(Session::has('alert-edit'))
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                    {{Session::get('alert-edit')}}.
                </div>
            </div>
        @endif
        @if(Session::has('alert-success'))
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                    {{Session::get('alert-success')}}.
                </div>
            </div>
        @endif
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Layanan IMES yang Tersedia</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <form action="{{url('imes')}}" method="get" role="search">
                        <div class="row">
                            <div class="col-md-6">
                                <div id="example1_filter" class="form-inline">
                                    <div class="form-group">
                                        <label>Search by:
                                            <select name="kategori" class="form-control input-sm">
                                                <option value="nama">Nama Layanan IMES</option>
                                                <option value="ID">ID layanan IMES</option>
                                            </select>
                                            <input type="search" class="form-control input-sm" name="search" placeholder aria-controls="example1">
                                            <button type="submit" class="btn btn-info btn-flat input-sm">Search</button>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="row">
                        @if(Auth::User()->role == 1)
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-layanan"><i class="fa fa-plus-circle"></i> Tambah baru</button>
                        </div>
                        @endif
                        <div id="add-layanan" class="modal fade" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Tambah Layanan IMES</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" action="{{url('imes/store')}}">
                                            {{ csrf_field() }}
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="NamaImes" class="col-sm-3 control-label">Nama Layanan IMES <span style="color: red">*</span></label>

                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" placeholder="Nama Layanan IMES" name="nama" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="FlagImes" class="col-sm-3 control-label">Jenis Layanan IMES <span style="color: red">*</span></label>

                                                    <select name="flag" class="form-control input-sm">
                                                        <option value="Connectivity">Connectivity</option>
                                                        <option value="Non Connectivity">Non Connectivity</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-success pull-right">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    @if(count($layanan) > 0)
                        <?php $i=1 ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="text-align: center">ID</th>
                            <th style="text-align: center">Nama Layanan IMES</th>
                            <th style="text-align: center">Jenis Layanan IMES</th>
                            @if(Auth::User()->role == 1)
                            <th colspan="2" style="text-align: center">Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($layanan as $l)
                        <tr>
                            <td>{{$l->id_imes}}</td>
                            <td>{{$l->nama_imes}}</td>
                            <td>{{$l->flag}}</td>
                            @if(Auth::User()->role == 1)
                            <td align="center" width="30px">
                                <button id="btn-edit" type="button" class="btn btn-default edit-button" data-toggle="modal" data-target="#modal-default" data-id="{{$l->id_imes}}" data-name="{{$l->nama_imes}}" data-flag="{{$l->flag}}"">
                                    Edit
                                </button>
                            </td>
                            <td align="center" width="30px">
                                <button type="button" class="btn btn-danger delete-button" data-name="{{$l->nama_imes}}" data-id="{{$l->id_imes}}" data-toggle="modal" data-target="#modal-danger">Hapus</button>
                            </td>
                            @endif
                        </tr>
                            <?php $i++;?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="modal-default" class="modal fade" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Layanan IMES</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="post" action="" id="form-edit">
                                    {{ csrf_field() }}
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="IDImes" class="col-sm-2 control-label">ID Layanan IMES</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="idims" name="id" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="NamaImes" class="col-sm-2 control-label">Nama Layanan IMES</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="namaims"  name="nama">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="JenisImes" class="col-sm-2 control-label">Jenis Layanan IMES</label>

                                            <select name="flag" class="form-control input-sm">
                                                <option value="Connectivity">Connectivity</option>
                                                <option value="Non Connectivity">Non Connectivity</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success pull-right">Simpan</button>
                                    </div>
                                </form>
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
                                <p id="show-name"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <a id="del-btn">
                                    <button type="submit" class="btn btn-success pull-right">Hapus</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                    <p>Data tidak ditemukan</p>
                @endif
            </div>
        </div>
    </div>

    <script>
        $(document).on("click", ".edit-button", function(){
            var id_imes = $(this).data('id');
            var nama_imes = $(this).data('name');
            var flag_imes = $(this).data('flag');
            $("#idims").val(id_imes);
            $("#namaims").val(nama_imes);
            $("#flagims").val(flag_imes);
            $("#form-edit").attr('action','{{url('/imes/edit')}}' + '/' + id_imes);
        });
        $(document).on("click",".delete-button", function () {
            var id_imes = $(this).data('id')
            var nama_imes = $(this).data('name')
            $("#del-btn").attr('href','{{url('imes/delete')}}' + '/' + id_imes)
            $("#show-name").html('Anda yakin ingin menghapus layanan IMES' + nama_imes + '?')

        })
    </script>
@stop
