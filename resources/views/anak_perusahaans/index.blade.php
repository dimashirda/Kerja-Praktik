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
                    <h3 class="box-title">Data Anak Perusahaan</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{route('addprshn')}}" class='btn btn-primary'><i class="fa fa-plus-circle"></i> Tambah baru</a>
                        </div>
                    </div>
                    <br>
                    @if($acc->count())
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Perusahaan</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th colspan="2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($acc as $a)
                        <tr>
                            <td>{{ $a->id_perusahaan }}</td>
                            <td>{{ $a->nama_perusahaan }}</td>
                            <td>{{ $a->tlp_perusahaan }}</td>
                            <td>{{ $a->email_perusahaan }}</td>
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
                                <h4 class="modal-title">Edit Data Anak Perusahaan</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="post" action="{{url('admin/perusahaan/edit', $a->id_perusahaan)}}">
                                   {{ csrf_field() }}
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="IDPerusahaan" class="col-sm-2 control-label">ID Perusahaan</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" value="{{$a->id_perusahaan}}" name="id_anakperu" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="NamaPerusahaan" class="col-sm-2 control-label">Nama Perusahaan</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control"value="{{$a->nama_perusahaan}}" name="nama_anakperu">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="EmailPerusahaan" class="col-sm-2 control-label">Email</label>

                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" value="{{$a->email_perusahaan}}" name="email_anakperu">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="TlpPerusahaan" class="col-sm-2 control-label">No. Telepon</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" value="{{$a->tlp_perusahaan}}" name="tlp_anakperu">
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
                                <p>Anda yakin ingin menghapus perusahaan ini?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <a href="{{url('admin/perusahaan/delete', $a->id_perusahaan)}}">
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
