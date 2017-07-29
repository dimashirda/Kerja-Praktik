@extends('adminlte::page')

@section('title', 'SIKontrak')

@section('content_header')
    <h1>Daftar SID</h1>
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
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Daftar SID</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{url('vsat')}}" method="get" role="search">
                        <div class="row">
                            <div class="col-md-6">
                                <div id="example1_filter" class="form-inline">
                                    <div class="form-group">
                                        <label>Search by:
                                            <select name="kategori" class="form-control input-sm">
                                                <option value="sid">SID</option>
                                                <option value="perusahaan">Nama Anak Perusahaan</option>
                                                <option value="nipnas">NIPNAS</option>
                                                <option value="pelanggan">Nama Pelanggan</option>
                                                <option value="layanan">Layanan IMES</option>
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
                    @if(Auth::User()->role == 1)
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{route('addsid')}}" class='btn btn-primary'><i class="fa fa-plus-circle"></i> Tambah baru</a>
                        </div>
                    </div>
                    @endif
                    <br>
                    @if(count($sid)>0)
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="text-align: center">SID</th>
                            <th style="text-align: center">Nama Anak Perusahaan</th>
                            <th style="text-align: center">Alamat SID</th>
                            <th style="text-align: center">NIPNAS</th>
                            <th style="text-align: center">Nama Pelanggan</th>
                            <th style="text-align: center">Layanan IMES</th>
                            @if(Auth::User()->role == 1)
                            <th style="text-align: center" colspan="2">Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sid as $s)
                        <tr>
                            <td>{{$s->sid}}</td>
                            <td>{{$s->nama_perusahaan}}</td>
                            <td>{{$s->alamat_sid}}</td>
                            <td>{{$s->nipnas}}</td>
                            <td>{{$s->nama_pelanggan}}</td>
                            <td>{{$s->nama_imes}}</td>
                            
                            @if(Auth::User()->role == 1)
                            <td align="center" width="30px">
                                <a href="{{url('sid/edit',$s->sid)}}" class='btn btn-default'> Edit</a>
                                <!-- <button type="button" class="btn btn-default edit-button" data-toggle="modal" data-target="#modal-default" data-sid="{{$s->sid}}" data-perusahaan="{{$s->daftar_perusahaan->nama_perusahaan}}" data-alamat="{{$s->alamat_sid}}" data-nipnas="{{$s->daftar_pelanggan->nipnas}}" data-pelanggan="{{$s->daftar_pelanggan->nama_pelanggan}}" data-imes="{{$s->daftar_imes->nama_imes}}">
                                    Edit
                                </button> -->
                            </td>
                            <td align="center" width="30px">
                                <button type="button" class="btn btn-danger delete-button" data-alamat="{{$s->alamat_sid}}" data-sid="{{$s->sid}}" data-toggle="modal" data-target="#modal-danger">
                                    Hapus
                                </button>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                        {{$sid->render()}}
                </div>
                <!--  -->
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
                                    <button type="button" class="btn btn-success pull-right">Hapus</button>
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
            var sid = $(this).data('sid');
            var id_perusahaan = $(this).data('id_perusahaan');
            var alamat_sid = $(this).data('alamat');
            var nipnas = $(this).data('nipnas');
            var id_imes = $(this).data('id_imes');
            $("#sid").val(sid);
            $("#id_perusahaan").val(id_perusahaan);
            $("#alamat_sid").val(alamat_sid);
            $("#nipnas").val(nipnas);
            $("#id_imes").val(id_imes);
            $("#form-edit").attr('action','{{url('/sid/edit')}}' + '/' + sid);
        })
        $(document).on("click",".delete-button", function () {
            var sid = $(this).data('sid')
            $("#del-btn").attr('href','{{url('sid/delete')}}' + '/' + sid);
            $("#show-name").html('Anda yakin ingin menghapus Daftar SID ' + sid + '?')
        })
    </script>
@stop
