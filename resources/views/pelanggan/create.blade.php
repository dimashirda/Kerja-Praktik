@extends('adminlte::page')

@section('title', 'SIKontrak')

@section('content_header')
    {{--<h1>Pelanggan</h1>--}}
@stop

@section('content')
    <div class="row">
        @if(Session::has('alert-success'))
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                {{Session::get('alert-success')}} <a href="{{url('pelanggan')}}">Kembali</a>
            </div>
        </div>
        @elseif(Session::has('alert-danger'))
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-times"></i> Gagal!</h4>
                {{Session::get('alert-danger')}} <a href="{{url('pelanggan')}}">Kembali</a>
            </div>
        </div>
        @endif
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Tambah Pelanggan</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form class="form-horizontal" action="{{url('pelanggan/store')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="NIPNAS" class="col-sm-2 control-label">NIPNAS <span style="color: red">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="NIPNAS" name="nipnas" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NamaPelanggan" class="col-sm-2 control-label">Nama Pelanggan <span style="color: red">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Nama Pelanggan" name="nama" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="SegmenPelanggan" class="col-sm-2 control-label">Segmen</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Segmen" name="segmen">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="EmailPelanggan" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" placeholder="Email" name="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="TlpPelanggan" class="col-sm-2 control-label">No. Telepon</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="No. Telepon" name="tlp">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{route('pelanggan')}}">
                                <button class="btn btn-default" type="button">Batal</button>
                            </a>
                            <button type="submit" class="btn btn-success pull-right" >Simpan</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        $('#datepicker').datepicker({
            autoclose: true
        });
    </script>
@stop
