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
                    <h3 class="box-title">Layanan yang Tersedia</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <form action="{{url('admin/layanan')}}" method="get" role="search">
                        <div class="row">
                            <div class="col-md-6">
                                <div id="example1_filter" class="form-inline">
                                    <div class="form-group">
                                        <label>Search by:
                                            <select name="kategori" class="form-control input-sm">
                                                <option value="nama">Nama Layanan</option>
                                                <option value="ID">ID layanan</option>
                                            </select>
                                            <input type="search" class="form-control input-sm" name="search" placeholder aria-controls="example1">
                                            <button type="submit" class="btn btn-info btn-flat input-sm">Search</button>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-layanan"><i class="fa fa-plus-circle"></i> Tambah baru</button>
                        </div>
                        <div id="add-layanan" class="modal fade" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Tambah Layanan</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" action="{{url('admin/layanan/create')}}">
                                            {{ csrf_field() }}
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="NamaLayanan" class="col-sm-2 control-label">Nama Layanan</label>

                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" placeholder="Nama Layanan" name="nama">
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
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="30px">No.</th>
                            <th>ID</th>
                            <th>Layanan</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($layanan as $l)
                        <tr>
                            <td width="30px">{{$i}}</td>
                            <td>{{$l->id_layanan}}</td>
                            <td>{{$l->nama_layanan}}</td>
                            <td align="center" width="30px">
                                <button type="button" class="btn btn-danger delete-button" data-name="{{$l->nama_layanan}}" data-id="{{$l->id_layanan}}" data-toggle="modal" data-target="#modal-danger">Hapus</button>
                            </td>
                        </tr>
                            <?php $i++;?>
                        @endforeach
                        </tbody>
                    </table>
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
        $(document).on("click",".delete-button", function () {
            var id_layanan = $(this).data('id')
            var nama_layanan = $(this).data('name')
            $("#del-btn").attr('href','{{url('admin/layanan/delete')}}' + '/' + id_layanan)
            $("#show-name").html('Anda yakin ingin menghapus layanan ' + nama_layanan + '?')

        })
    </script>
@stop
