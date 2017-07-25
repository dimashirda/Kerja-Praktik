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
                    <form class="form-horizontal" method="post" action="{{url('admin/accmgr/store')}}">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="IDAccMgr" class="col-sm-2 control-label">NIK Account Manager</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="id_accm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NamaAccMgr" class="col-sm-2 control-label">Nama Account Manager</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama_accm">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="TlpAccMgr" class="col-sm-2 control-label">No. Telepon</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tlp_accm">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="EmailAccMgr" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email_accm">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{route('accmgr')}}">
                                <button type="button" class="btn btn-default">Batal</button>
                            </a>
                            <button type="submit" class="btn btn-success pull-right">Simpan</button>


                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop