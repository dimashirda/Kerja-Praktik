@extends('adminlte::page')

@section('title', 'SIKontrak')

@section('content_header')
    <h1>Dashboard</h1>
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
                    <form action="{{url('home/search')}}" method="get" role="search">
                        <div class="row">
                            <div class="col-md-6">
                                <div id="example1_filter" class="form-inline">
                                    <div class="form-group">
                                        <label>Search by:
                                            <select name="kategori" id="kategori" onchange="myForm(this.value)" class="form-control input-sm">
                                                <option value='ap' selected>Anak Perusahaan</option>
                                                <option value='nama'>Nama Kontrak</option>
                                                <option value='am'>Account Manager</option>
                                                <option value='tgl_akhir'>Tanggal Berakhir</option>
                                            </select>
                                            <input type="text" id="txt" class="form-control input-sm" name="search1">
                                            <div class="input-group date" id="date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" id="datepicker3" class="form-control pull-right input-sm" name="search2">
                                            </div>

                                            <button type="submit" class="btn btn-info btn-flat input-sm">Search</button>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    @if(count($dk) > 0)
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>NIPNAS</th>
                                <th>Pelanggan</th>
                                <th>Nama Kontrak</th>
                                <th>Anak Perusahaan</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Akhir</th>
                                <th>Jenis Layanan</th>
                                <th>SLG (%)</th>
                                <th>Dokumen</th>
                                <th>Account Manager</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($dk as $d)
                            <tr>
                                <td>{{$d->nipnas}}</td>
                                <td>{{$d->nama_pelanggan}}</td>
                                <td>{{$d->judul_kontrak}}</td>
                                <td>{{$d->nama_perusahaan}}</td>
                                <td>{{$d->tgl_mulai}}</td>
                                <td>{{$d->tgl_selesai}}</td>
                                <td>
                                    @foreach($dt as $ld)
                                        @if($d->id_detil == $ld->id_detil)
                                        {{$ld->nama_layanan}}<br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$d->slg}}</td>
                                    <td>
                                        <a href="kontrak/download/{{$d->nama_dokumen}}">
                                            {{$d->nama_dokumen}}
                                        </a>
                                    </td>

                                <td>{{$d->nama_am}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <p>Data tidak tersedia.</p>
                @endif
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#date").hide();
        });

        function myForm(value) {
            if (value != 'tgl_akhir') {
                $("#txt").show();
                $("#date").hide();

            }
            else {
                $("#txt").hide();
                $("#date").show();
            }
        }

    </script>
@stop