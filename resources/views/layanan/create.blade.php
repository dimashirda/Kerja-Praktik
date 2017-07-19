@extends('adminlte::page')

@section('title', 'SIKontrak')

@section('content_header')
    <h1>Layanan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tambah Layanan</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="NamaLayanan" class="col-sm-2 control-label">Nama Layanan</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Nama Layanan">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">Batal</button>
                            <a href="{{route('layanan')}}">
                                <button type="submit" class="btn btn-success pull-right">Simpan</button>
                            </a>

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