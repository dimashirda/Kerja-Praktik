@extends('adminlte::page')

@section('title', 'SIKontrak - Layanan')

@section('content_header')
    <h1>Layanan</h1>
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
        @if(Session::has('alert-success'))
            <div class="col-xs-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                    {{Session::get('alert-success')}}
                </div>
            </div>
        @elseif(Session::has('alert-danger'))
            <div class="col-xs-12">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-times"></i> Gagal!</h4>
                    {{Session::get('alert-danger')}}
                </div>
            </div>
        @endif
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Layanan yang Tersedia</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <form action="{{url('layanan')}}" method="get" role="search">
                        <div class="row">
                            <div class="col-xs-6">
                                <div id="example1_filter" class="form-inline">
                                    <div class="form-group">
                                        <label>Cari berdasarkan:
                                            <select name="kategori" class="form-control input-sm">
                                                <option value="nama">Nama Layanan</option>
                                                <option value="ID">ID layanan</option>
                                            </select>
                                            <input type="search" class="form-control input-sm" name="search" placeholder aria-controls="example1">
                                            <button type="submit" class="btn btn-info btn-flat input-sm">Cari</button>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="row">
                        @if(Auth::User()->role == 1)
                        <div class="col-xs-6">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-layanan"><i class="fa fa-plus-circle"></i> Tambah baru</button>
                        </div>
                        @endif
                        <div id="add-layanan" class="modal fade" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Tambah Layanan</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" action="{{url('layanan/store')}}">
                                            {{ csrf_field() }}
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="NamaLayanan" class="col-sm-3 control-label">Nama Layanan <span style="color: red">*</span></label>

                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" placeholder="Nama Layanan" name="nama" required>
                                                    </div>
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
                    <div style="overflow-x:auto;">    
                        <table class="table table-new table-striped table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Layanan</th>
                                @if(Auth::User()->role == 1)
                                <th colspan="2" style="text-align: center">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($layanan as $l)
                            <tr>
                                <td>{{$l->id_layanan}}</td>
                                <td>{{$l->nama_layanan}}</td>
                                @if(Auth::User()->role == 1)
                                <td align="center" width="30px">
                                    <button id="btn-edit" type="button" class="btn btn-default edit-button" data-toggle="modal" data-target="#modal-default" data-id="{{$l->id_layanan}}" data-name="{{$l->nama_layanan}}">
                                        Edit
                                    </button>
                                </td>
                                <td align="center" width="30px">
                                    <button type="button" class="btn btn-danger delete-button" data-name="{{$l->nama_layanan}}" data-id="{{$l->id_layanan}}" data-toggle="modal" data-target="#modal-danger">Hapus</button>
                                </td>
                                @endif
                            </tr>
                                <?php $i++;?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="modal-default" class="modal fade" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Layanan</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="post" action="" id="form-edit">
                                    {{ csrf_field() }}
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="IDLayanan" class="col-sm-2 control-label">ID Layanan</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="idlyn" name="id" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="NamaLayanan" class="col-sm-2 control-label">Nama Layanan</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="namalyn"  name="nama">
                                            </div>
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
                                    <button type="submit" class="btn btn-danger pull-right" style="margin-left: 4px ;">Hapus</button>
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
            var id_layanan = $(this).data('id');
            var nama_layanan = $(this).data('name');
            $("#idlyn").val(id_layanan);
            $("#namalyn").val(nama_layanan);
            $("#form-edit").attr('action','{{url('/layanan/edit')}}' + '/' + id_layanan);
        });
        $(document).on("click",".delete-button", function () {
            var id_layanan = $(this).data('id')
            var nama_layanan = $(this).data('name')
            $("#del-btn").attr('href','{{url('layanan/delete')}}' + '/' + id_layanan)
            $("#show-name").html('Anda yakin ingin menghapus layanan ' + nama_layanan + '?')

        })
    </script>
@stop
