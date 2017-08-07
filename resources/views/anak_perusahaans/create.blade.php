@extends('adminlte::page')

@section('title', 'SIKontrak - Tambah Anak Perusahaan')

@section('content_header')
    <h1>Anak Perusahaan</h1>
@stop

@section('content')
    <div class="row">
        @if(Session::has('alert-success'))
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                    {{Session::get('alert-success')}} <a href="{{url('perusahaan')}}">Kembali</a>
                </div>
            </div>
        @elseif(Session::has('alert-danger'))
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-times"></i> Gagal!</h4>
                    {{Session::get('alert-danger')}} <a href="{{url('perusahaan')}}">Kembali</a>
                </div>
            </div>
        @endif
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Tambah Anak Perusahaan</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form class="form-horizontal" action="{{url('perusahaan/store')}}" method="post">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="IDPerusahaan" class="col-sm-2 control-label">ID Perusahaan <span style="color: red">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="ID Perusahaan" name="id_anakperu" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NamaPerusahaan" class="col-sm-2 control-label">Nama Perusahaan <span style="color: red">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Nama Perusahaan" name="nama_anakperu" required>
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