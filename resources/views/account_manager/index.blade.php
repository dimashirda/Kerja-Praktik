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
                    <h3 class="box-title">Account Manager</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{route('addaccmgr')}}" class='btn btn-primary'><i class="fa fa-plus-circle"></i> Tambah baru</a>
                        </div>
                    </div>
                    <br>
                    @if($acc->count())
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>No. Telepon</th>
                            <th>Email</th>
                            <th colspan="2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($acc as $a)
                        <tr>
                            <td>{{ $a->id_am }}</td>
                            <td>{{ $a->nama_am }}</td>
                            <td>{{ $a->tlp_am }}</td>
                            <td>{{ $a->email_am }}</td>
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
                                            <label for="IDAccMgr" class="col-sm-2 control-label">ID Account Manager</label>

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
            var id_accmgr = $(this).data('id');
            var nama_accmgr = $(this).data('name');
            var email_accmgr = $(this).data('email');
            var tlp_accmgr = $(this).data('telp');
            $("#idaccmgr").val(id_accmgr);
            $("#namaaccmgr").val(nama_accmgr);
            $("#emailaccmgr").val(email_accmgr);
            $("#tlpaccmgr").val(tlp_accmgr);

            $("#form-edit").attr('action','{{url('/admin/accmgr/edit')}}' + '/' + id_accmgr);
        })

        $(document).on("click",".delete-button", function () {
            var id_accmgr = $(this).data('id');
            var nama_accmgr = $(this).data('name');
            $("#del-btn").attr('href','{{url('admin/accmgr/delete')}}' + '/' + id_accmgr);
            $("#show-name").html('Anda yakin ingin menghapus Account Manager ' + nama_accmgr + '?')

        })
    </script>
@stop

