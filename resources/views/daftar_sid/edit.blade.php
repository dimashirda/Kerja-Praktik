@extends('adminlte::page')

@section('title', 'SIKontrak - Perbarui Daftar SID')

@section('content_header')
    <h1>Daftar SID</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Daftar SID</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form class="form-horizontal" method="post" action="{{url('sid/save',$s->sid)}}">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="Sid" class="col-sm-3 control-label">SID <span style="color: red">*</span></label>

                                <div class="col-sm-9">
                                    <input type="text" value="{{$s->sid}}" class="form-control" name="sid" placeholder="SID" disabled="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NamaPerusahaan" class="col-sm-3 control-label">Nama Anak Perusahaan <span style="color: red">*</span></label>

                                <div class="col-sm-9">
                                    <select name="id_perusahaan" class="form-control select2">
                                            <option value="{{$s->daftar_perusahaan->id_perusahaan}}" selected="">{{$s->daftar_perusahaan->nama_perusahaan}}</option>
                                        @foreach($ap as $a)
                                            <option value="{{$a->id_perusahaan}}">{{$a->nama_perusahaan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="AlamatSid" class="col-sm-3 control-label">Alamat SID <span style="color: red">*</span></label>

                                <div class="col-sm-9">
                                    <input type="text" value="{{$s->alamat_sid}}" class="form-control" name="alamat_sid" placeholder="Alamat SID" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NamaPelanggan" class="col-sm-3 control-label">Nama Pelanggan <span style="color: red">*</span></label>

                                <div class="col-sm-9">
                                    <select name="nipnas" class="form-control select2">
                                            <option value="{{$s->daftar_pelanggan->nipnas}}">{{$s->daftar_pelanggan->nipnas}} - {{$s->daftar_pelanggan->nama_pelanggan}}</option>
                                        @foreach($plg as $p)
                                            <option value="{{$p->nipnas}}">{{$p->nipnas}} - {{$p->nama_pelanggan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="LynImes" class="col-sm-3 control-label">Layanan IMES <span style="color: red">*</span></label>

                                <div class="col-sm-9">
                                    <select name="id_imes" class="form-control select2">
                                        <option value="{{$s->daftar_imes->id_imes}}">{{$s->daftar_imes->flag}} - {{$s->daftar_imes->nama_imes}}</option>

                                        <optgroup label="Connectivity">
                                            @foreach($lynconn as $l)
                                                <option value="{{$l->id_imes}}">{{$l->nama_imes}}</option>
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="Non Connectivity">
                                            @foreach($lynnon as $l)
                                                <option value="{{$l->id_imes}}">{{$l->nama_imes}}</option>
                                            @endforeach
                                        </optgroup>

                                    </select>
                                </div>
                            </div>
                                                       
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{route('home')}}">
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