@extends('adminlte::page')

@section('title', 'SIKontrak - Pelanggan')

@section('content_header')
    <h1>Pelanggan</h1>
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
        @endif
        @if(Session::has('alert-danger'))
            <div class="col-xs-12">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Gagal!</h4>
                    {{Session::get('alert-danger')}}
                </div>
            </div>
        @endif
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Data Pelanggan</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                <form action="{{url('pelanggan')}}" method="get" role="search">
                        <div class="row">
                            <div class="col-xs-6">
                                <div id="example1_filter" class="form-inline">
                                    <div class="form-group">
                                        <label>Cari berdasarkan:
                                            <select name="kategori" class="form-control input-sm">
                                                <option value="nama">Nama Pelanggan</option>
                                                <option value="nipnas">NIPNAS</option>
                                                <option value="segmen">Segmen</option>
                                            </select>
                                            <input type="search" id="search_id" class="form-control input-sm search-menu-box" name="search" placeholder aria-controls="example1">
                                            <button type="submit" class="btn btn-info btn-flat input-sm">Cari</button>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    @if(Auth::User()->role == 1)
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="{{url('pelanggan/create')}}" class='btn btn-primary'><i class="fa fa-plus-circle"></i> Tambah baru</a>
                        </div>
                    </div>
                    @endif
                    <br>
                    @if(count($pelanggan) > 0)
                        <?php $no=1 ?>
                    <div style="overflow-x:auto;">    
                        <table id="tabel" class="table table-new table-striped table-hover">
                            <thead>
                            <tr>
                                <th>NIPNAS</th>
                                <th>Pelanggan</th>
                                <th>Segmen</th>
                                <th>No. Telepon</th>
                                <th>Email</th>
                                @if(Auth::User()->role == 1)
                                <th style="text-align: center" colspan="2">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                @foreach($pelanggan as $p)
                                    <tr>
                                        <td>{{$p->nipnas}}</td>
                                        <td>{{$p->nama_pelanggan}}</td>
                                        <td>{{$p->segmen}}</td>
                                        <td>{{$p->tlp_pelanggan}}</td>
                                        <td>{{$p->email_pelanggan}}</td>
                                        @if(Auth::User()->role == 1)
                                        <td align="center" width="30px">
                                            <button id="btn-edit" type="button" class="btn btn-default edit-button" data-toggle="modal" data-target="#modal-default" data-id="{{$p->nipnas}}" data-name="{{$p->nama_pelanggan}}" data-segmen="{{$p->segmen}}" data-email="{{$p->email_pelanggan}}" data-telp="{{$p->tlp_pelanggan}}">
                                                Edit
                                            </button>
                                        </td>
                                        <td align="center" width="30px">
                                            <button type="button" class="btn btn-danger delete-button" data-name="{{$p->nama_pelanggan}}" data-id="{{$p->nipnas}}" data-toggle="modal" data-target="#modal-danger">
                                                Hapus
                                            </button>
                                        </td>
                                        @endif
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$pelanggan->render()}}
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
                                <form class="form-horizontal" method="post" action="" id="form-edit">
                                    {{ csrf_field() }}
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="NIPNAS" class="col-sm-2 control-label">NIPNAS</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="idplg" name="nipnas" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="NamaPelanggan" class="col-sm-2 control-label">Nama Pelanggan</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="namaplg"  name="name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="SegmenPelanggan" class="col-sm-2 control-label">Segmen</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="segmenplg"  name="segmen">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="EmailPelanggan" class="col-sm-2 control-label">Email</label>

                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="emailplg" name="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="TlpPelanggan" class="col-sm-2 control-label">No. Telepon</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="tlpplg" name="tlp">
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
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <a id="del-btn">
                                    <button type="button" class="btn btn-danger pull-right" style="margin-left: 4px ;">Hapus</button>
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
        var id_pelanggan = $(this).data('id');
        var nama_pelanggan = $(this).data('name');
        var segmen_pelanggan = $(this).data('segmen');
        var email_pelanggan = $(this).data('email');
        var tlp_pelanggan = $(this).data('telp');
        $("#idplg").val(id_pelanggan);
        $("#namaplg").val(nama_pelanggan);
        $("#segmenplg").val(segmen_pelanggan);
        $("#emailplg").val(email_pelanggan);
        $("#tlpplg").val(tlp_pelanggan);

        $("#form-edit").attr('action','{{url('/pelanggan/edit')}}' + '/' + id_pelanggan);
    });

    $(document).on("click",".delete-button", function () {
        var id_pelanggan = $(this).data('id');
        var nama_pelanggan = $(this).data('name');
        $("#del-btn").attr('href','{{url('pelanggan/delete')}}' + '/' + id_pelanggan);
        $("#show-name").html('Anda yakin ingin menghapus pelanggan ' + nama_pelanggan + '?')

    })

    $(function () {
        $(".search-menu-box").keyup(function () {

            var value = $(this).val();

            if (value != '') {
                $.ajax({
                    type: "GET",
                    url: "pelanggan/search",
                    data: {
                        q: value
                    },
                    cache: false,
                    success: function (data) {
                        console.log(data)
                    }
                });
            }
            return false;
        })
    });

</script>
@stop

