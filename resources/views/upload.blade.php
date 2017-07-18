@extends('adminlte::page')

@section('title', 'SIKontrak')

@section('content_header')
    <h1>Upload Data Kontrak</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Kontrak</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="NamaPelanggan" class="col-sm-2 control-label">Nama Pelanggan</label>

                                <div class="col-sm-10">
                                    <select class="form-control select2">
                                        <option>a</option>
                                        <option>b</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="AnakPerusahaan" class="col-sm-2 control-label">Anak Perusahaan</label>

                                <div class="col-sm-10">
                                    <select class="form-control select2">
                                        <option>a</option>
                                        <option>b</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NamaKontrak" class="col-sm-2 control-label">Nama Kontrak</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Nama Kontrak">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="AccMgr" class="col-sm-2 control-label">Account Manager</label>

                                <div class="col-sm-10">
                                    <select class="form-control select2">
                                        <option>a</option>
                                        <option>b</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="KontrakAwal" class="col-sm-4 control-label">Mulai Kontrak</label>

                                        <div class="col-sm-8">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="datepicker1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="KontrakAkhir" class="col-sm-4 control-label">Akhir Kontrak</label>

                                        <div class="col-sm-8">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="datepicker2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="JenisLayanan" class="col-sm-2 control-label">Jenis Layanan</label>

                                <div class="col-sm-10">
                                    <select class="form-control select2"  multiple="multiple" data-placeholder="Jenis Layanan">
                                        <option>a</option>
                                        <option>b</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="SLG" class="col-sm-2 control-label">SLG </label>

                                <div class="col-sm-10">
                                    <label>
                                        <input type="radio" name="r3" class="flat-red">
                                        95%
                                    </label>
                                    <br>
                                    <label>
                                        <input type="radio" name="r3" class="flat-red">
                                        97%
                                    </label>
                                    <br>
                                    <label>
                                        <input type="radio" name="r3" class="flat-red">
                                        98%
                                    </label>
                                    <br>
                                    <label>
                                        <input type="radio" name="r3" class="flat-red">
                                        98.5%
                                    </label>
                                    <br>
                                    <label>
                                        <input type="radio" name="r3" class="flat-red">
                                        99%
                                    </label>
                                    <br>
                                    <label>
                                        <input type="radio" name="r3" class="flat-red">
                                        99.5%
                                    </label>
                                    <br>
                                    <label>
                                        <input type="radio" name="r3" class="flat-red">
                                        99.95%
                                    </label>
                                    <br>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="FileUpload" class="col-sm-2 control-label">File Kontrak</label>

                                <div class="col-sm-10">
                                    <input type="file" id="exampleInputFile">
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-success pull-right">Save</button>
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