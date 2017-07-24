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
                    {!! Form::open(array('url'=>'/admin/upload/store','method'=>'POST', 'files'=>true, 'class'=>'form-horizontal')) !!}
{{--                    <form class="form-horizontal" method="post" action="{{url('admin/upload/store')}}" enctype="multipart/form-data" >--}}
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="NamaPelanggan" class="col-sm-2 control-label">Nama Pelanggan</label>

                                <div class="col-sm-10">
                                    <select class="form-control select2" name="nipnas" data-placeholder="Pilih Pelanggan">
                                        <option></option>
                                        @foreach($plg as $nplg)
                                            <option value="{{$nplg->nipnas}}">{{$nplg->nama_pelanggan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="AnakPerusahaan" class="col-sm-2 control-label">Anak Perusahaan</label>

                                <div class="col-sm-10">
                                    <select class="form-control select2" data-placeholder="Pilih perusahaan" name="id_perusahaan">
                                        <option></option>
                                        @foreach($ap as $np)
                                            <option value="{{$np->id_perusahaan}}">{{$np->nama_perusahaan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NamaKontrak" class="col-sm-2 control-label">Nama Kontrak</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" placeholder="Nama Kontrak">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="AccMgr" class="col-sm-2 control-label">Account Manager</label>

                                <div class="col-sm-10">
                                    <select class="form-control select2" data-placeholder="Pilih Account Manager" name="id_am">
                                        <option></option>
                                        @foreach($am as $nm)
                                            <option value="{{$nm->id_am}}">{{$nm->nama_am}}</option>
                                        @endforeach
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
                                                <input type="text" name="tgl_mulai" placeholder="Tanggal Mulai Kontrak" class="form-control pull-right" id="datepicker1">
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
                                                <input type="text" name="tgl_selesai" placeholder="Tanggal Akhir Kontrak" class="form-control pull-right" id="datepicker2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="JenisLayanan" class="col-sm-2 control-label">Jenis Layanan</label>

                                <div class="col-sm-10">
                                    <select class="form-control select2" multiple="multiple" name="name[]" data-placeholder="Pilih layanan">
                                        @foreach($lyn as $nlyn)
                                            <option value="{{$nlyn->id_layanan}}">{{$nlyn->nama_layanan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="SLG" class="col-sm-2 control-label">SLG (%)</label>

                                <div class="col-sm-10">
                                    <input type="number" step="0.01" max="100" name="slg" class="form-control" placeholder="SLG">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="FileUpload" class="col-sm-2 control-label">File Kontrak</label>

                                <div class="col-sm-10">
                                    <input type="file" name="image" id="exampleInputFile">
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{url('home')}}">
                                <button type="button" class="btn btn-default">Cancel</button>
                            </a>
                            <button type="submit" class="btn btn-success pull-right">Save</button>
                        </div>
                        <!-- /.box-footer -->
                    {!! Form::close() !!}
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