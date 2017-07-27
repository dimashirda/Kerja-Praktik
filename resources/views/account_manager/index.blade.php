@extends('adminlte::page')

@section('title', 'SIKontrak')

@section('content_header')
    <h1>Account Manager</h1>
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
            @if(Session::has('alert-hapus'))
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                        {{Session::get('alert-hapus')}}.
                    </div>
                </div>
            @endif
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Data Account Manager</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{url('accmgr')}}" method="get" role="search">
                        <div class="row">
                            <div class="col-md-6">
                                <div id="example1_filter" class="form-inline">
                                    <div class="form-group">
                                        <label>Cari berdasarkan:
                                            <select name="kategori" class="form-control input-sm">
                                                <option value="nama">Nama Account Manager</option>
                                                <option value="ID">NIK Account Manager</option>
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
                    @if(Auth::User()->role == 1)
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{route('addaccmgr')}}" class='btn btn-primary'><i class="fa fa-plus-circle"></i> Tambah baru</a>
                        </div>
                    </div>
                    @endif
                    <br>
                    @if($acc->count())
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>NIK AM</th>
                            <th>Nama</th>
                            <th>No. Telepon</th>
                            <th>Email</th>
                            @if(Auth::User()->role == 1)
                            <th style="text-align: center" colspan="2">Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($acc as $a)
                        <tr>
                            <td>{{ $a->id_am }}</td>
                            <td>{{ $a->nama_am }}</td>
                            <td>{{ $a->tlp_am }}</td>
                            <td>{{ $a->email_am }}</td>
                            @if(Auth::User()->role == 1)
                            <td align="center" width="30px">
                                <button type="button" class="btn btn-default edit-button" data-toggle="modal" data-target="#modal-default" data-id="{{$a->id_am}}" data-name="{{$a->nama_am}}" data-telp="{{$a->tlp_am}}" data-email="{{$a->email_am}}">
                                    Edit
                                </button>
                            </td>
                            <td align="center" width="30px">
                                <button type="button" class="btn btn-danger delete-button" data-name="{{$a->nama_am}}" data-id="{{$a->id_am}}" data-toggle="modal" data-target="#modal-danger">
                                    Hapus
                                </button>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                        {{$acc->render()}}
                </div>
                <div id="modal-default" class="modal fade" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Data Account Manager</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="post" id="form-edit">
                                    {{csrf_field()}}
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="IDAccMgr" class="col-sm-2 control-label">NIK Account Manager</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="id_accm" id="idaccmgr" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="NamaAccMgr" class="col-sm-2 control-label">Nama Account Manager</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="nama_accm" id="namaaccmgr">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="TlpAccMgr" class="col-sm-2 control-label">No. Telepon</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="tlp_accm" id="tlpaccmgr">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="EmailAccMgr" class="col-sm-2 control-label">Email</label>

                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" name="email_accm" id="emailaccmgr">
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
            var id_accmgr = $(this).data('id');
            var nama_accmgr = $(this).data('name');
            var email_accmgr = $(this).data('email');
            var tlp_accmgr = $(this).data('telp');
            $("#idaccmgr").val(id_accmgr);
            $("#namaaccmgr").val(nama_accmgr);
            $("#emailaccmgr").val(email_accmgr);
            $("#tlpaccmgr").val(tlp_accmgr);

            $("#form-edit").attr('action','{{url('/accmgr/edit')}}' + '/' + id_accmgr);
        })

        $(document).on("click",".delete-button", function () {
            var id_accmgr = $(this).data('id');
            var nama_accmgr = $(this).data('name');
            $("#del-btn").attr('href','{{url('accmgr/delete')}}' + '/' + id_accmgr);
            $("#show-name").html('Anda yakin ingin menghapus Account Manager ' + nama_accmgr + '?')

        })
    </script>
@stop

