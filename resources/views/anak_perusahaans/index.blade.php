@extends('adminlte::page')

@section('title', 'SIKontrak')

@section('content_header')
    <h1>Anak Perusahaan</h1>
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
                    <h3 class="box-title">Data Anak Perusahaan</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{url('perusahaan')}}" method="get" role="search">
                        <div class="row">
                            <div class="col-md-6">
                                <div id="example1_filter" class="form-inline">
                                    <div class="form-group">
                                        <label>Search by:
                                            <select name="kategori" class="form-control input-sm">
                                                <option value="nama">Nama Perusahaan</option>
                                                <option value="ID">ID Perusahaan</option>
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
                            <a href="{{route('addprshn')}}" class='btn btn-primary'><i class="fa fa-plus-circle"></i> Tambah baru</a>
                        </div>
                    </div>
                    @endif
                    <br>
                    @if($acc->count())
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Perusahaan</th>
                            <th>No. Telepon</th>
                            <th>Email</th>
                            @if(Auth::User()->role == 1)
                            <th colspan="2">Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($acc as $a)
                        <tr>
                            <td>{{ $a->id_perusahaan }}</td>
                            <td>{{ $a->nama_perusahaan }}</td>
                            <td>{{ $a->tlp_perusahaan }}</td>
                            <td>{{ $a->email_perusahaan }}</td>
                            @if(Auth::User()->role == 1)
                            <td align="center" width="30px">
                                <button type="button" class="btn btn-default edit-button" data-toggle="modal" data-target="#modal-default" data-id="{{$a->id_perusahaan}}" data-name="{{$a->nama_perusahaan}}" data-telp="{{$a->tlp_perusahaan}}" data-email="{{$a->email_perusahaan}}">
                                    Edit
                                </button>
                            </td>
                            <td align="center" width="30px">
                                <button type="button" class="btn btn-danger delete-button" data-name="{{$a->nama_perusahaan}}" data-id="{{$a->id_perusahaan}}" data-toggle="modal" data-target="#modal-danger">
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
                                <h4 class="modal-title">Edit Data Anak Perusahaan</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="post" id="form-edit">
                                   {{ csrf_field() }}
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="IDPerusahaan" class="col-sm-2 control-label">ID Perusahaan</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="idprshn" name="id_anakperu" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="NamaPerusahaan" class="col-sm-2 control-label">Nama Perusahaan</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="namaprshn" name="nama_anakperu">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="EmailPerusahaan" class="col-sm-2 control-label">Email</label>

                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="emailprshn" name="email_anakperu">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="TlpPerusahaan" class="col-sm-2 control-label">No. Telepon</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="tlpprshn" name="tlp_anakperu">
                                            </div>
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
            var id_perusahaan = $(this).data('id');
            var nama_perusahaan = $(this).data('name');
            var email_perusahaan = $(this).data('email');
            var tlp_perusahaan = $(this).data('telp');
            $("#idprshn").val(id_perusahaan);
            $("#namaprshn").val(nama_perusahaan);
            $("#emailprshn").val(email_perusahaan);
            $("#tlpprshn").val(tlp_perusahaan);

            $("#form-edit").attr('action','{{url('/perusahaan/edit')}}' + '/' + id_perusahaan);
        });

        $(document).on("click",".delete-button", function () {
            var id_perusahaan = $(this).data('id')
            var nama_perusahaan = $(this).data('name');
            $("#del-btn").attr('href','{{url('/perusahaan/delete')}}' + '/' + id_perusahaan)
            $("#show-name").html('Anda yakin ingin menghapus perusahaan ' + nama_perusahaan + '?')

        })
    </script>
@stop
