@extends('adminlte::page')

@section('title', 'SIKontrak')

@section('content_header')
    <h1>Account Manager</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tambah Account Manager</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="NamaAccMgr" class="col-sm-2 control-label">Nama Account Manager</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Nama Perusahaan">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="TlpAccMgr" class="col-sm-2 control-label">No. Telepon</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="No. Telepon">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="EmailAccMgr" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">Batal</button>
                            <a href="{{route('perusahaan')}}">
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