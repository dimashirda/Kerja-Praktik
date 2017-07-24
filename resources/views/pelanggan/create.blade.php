@extends('adminlte::page')

@section('title', 'SIKontrak')

@section('content_header')
    <h1>Pelanggan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tambah Pelanggan</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form class="form-horizontal" action="{{url('admin/pelanggan/store')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="NIPNAS" class="col-sm-2 control-label">NIPNAS</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="NIPNAS" name="nipnas">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NamaPelanggan" class="col-sm-2 control-label">Nama Pelanggan</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Nama Pelanggan" name="nama">
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
