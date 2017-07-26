@extends('adminlte::page')

@section('title', 'SIKontrak')

@section('content_header')
    <h1>Anak Perusahaan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tambah Anak Perusahaan</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form class="form-horizontal" action="{{url('perusahaan/store')}}" method="post">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="IDPerusahaan" class="col-sm-2 control-label">ID Perusahaan</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="ID Perusahaan" name="id_anakperu">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NamaPerusahaan" class="col-sm-2 control-label">Nama Perusahaan</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Nama Perusahaan" name="nama_anakperu">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="EmailPerusahaan" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" placeholder="Email" name="email_anakperu">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="TlpPerusahaan" class="col-sm-2 control-label">No. Telepon</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="No. Telepon" name="tlp_anakperu">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{route('perusahaan')}}">
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