@extends('adminlte::page')

@section('title', 'SIKontrak')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Data Kontrak</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{url('home/search')}}" method="get" role="search">
                        <div class="row">
                            <div class="col-md-6">
                                <div id="i" class="form-inline">
                                    <div class="form-group">
                                        <label>Search by:
                                            <select name="kategori" id="kategori" onchange="myForm(this.value)" class="form-control input-sm">
                                                <option value='pelanggan' selected>Nama Pelanggan</option>
                                                <option value="nipnas">NIPNAS</option>
                                                <option value='ap'>Anak Perusahaan</option>
                                                <option value='nama'>Nama Kontrak</option>
                                                <option value='am'>Account Manager</option>
                                                <option value='tgl_akhir'>Tanggal Berakhir</option>
                                                <option value='status'>Status</option>

                                            </select>
                                            <input type="text" id="txt" class="form-control input-sm" name="search1">
                                            <div class="input-group date" id="date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" id="datepicker3" class="form-control pull-right input-sm" name="search2">
                                            </div>
                                            <select name="search3" id="bln" class="form-control input-sm">
                                                <option value="satu">< 1 Bulan</option>
                                                <option value="dua">< 2 Bulan</option>
                                                <option value="tiga">< 3 Bulan</option>
                                            </select>

                                            <button type="submit" class="btn btn-info btn-flat input-sm">Search</button>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    @if(Auth::User()->role == 1)
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{route('upload')}}" class='btn btn-primary'><i class="fa fa-plus-circle"></i> Tambah baru</a>
                        </div>

                    </div>
                    @endif
                    <br>
                    @if(count($dk) > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle;">Status</th>
                                <th style="vertical-align: middle;">NIPNAS</th>
                                <th style="vertical-align: middle;">Pelanggan</th>
                                <th style="vertical-align: middle;">Nama Kontrak</th>
                                <th style="vertical-align: middle;">Anak Perusahaan</th>
                                <th style="vertical-align: middle;">Tanggal Mulai</th>
                                <th style="vertical-align: middle;">Tanggal Akhir</th>
                                <th style="vertical-align: middle;">Layanan</th>
                                <th style="vertical-align: middle;">SLG (%)</th>
                                <th style="vertical-align: middle;">Account Manager</th>
                                <th style="vertical-align: middle;" colspan="3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($dk as $d)
                            <tr>
                                @if($merah > $d->tgl_selesai)
                                <td style="text-align: center"><span class="fa fa-circle" style="color: #ff3300; font-size: 16px"></span></td>
                                @elseif($kuning > $d->tgl_selesai)
                                <td style="text-align: center"><span class="fa fa-circle" style="color: #ffcc00; font-size: 16px"></span></td>
                                @elseif($hijau > $d->tgl_selesai)
                                <td style="text-align: center"><span class="fa fa-circle" style="color: #4dff4d; font-size: 16px"></span></td>
                                @else
                                <td style="text-align: center"><span></span></td>
                                @endif
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

                                <td>{{$d->nama_am}}</td>
                                <td align="center" width="30px">
                                    <a href="{{url('kontrak/download', $d->nama_dokumen)}}">
                                        <button type="button" class="btn btn-default">
                                            <i class="fa fa-download"></i>
                                        </button>
                                    </a>
                                </td>
                                            @if (Auth::User()->role==1)
                                <td align="center" width="30px">
                                    <a href="{{url('kontrak/edit', $d->id_detil)}}">
                                        <button type="button" class="btn btn-default">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </a>
                                </td>
                                <td align="center" width="30px">
                                    <button type="button" class="btn btn-default delete-button" data-name="{{$d->judul_kontrak}}" data-id="{{$d->id_detil}}" data-toggle="modal" data-target="#modal-danger">
                                        <i class="fa fa-times"></i>

                                    </button>
                                </td>
                                                @endif

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="modal-danger" class="modal fade" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Hapus Data</h4>
                            </div>
                            <div class="modal-body">
                                <p id="show-name"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <a id="del-btn">
                                    <button type="button" class="btn btn-success pull-right">Hapus</button>
                                </a>

                            </div>
                        </div>
                    </div>
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
            $("#bln").hide()
        });

        function myForm(value) {
            if (value == 'status') {
                $("#bln").show();
                $("#txt").hide();
                $("#date").hide();
            }
            else if (value == 'tgl_akhir') {
                $("#date").show();
                $("#txt").hide();
                $("#bln").hide();

            }
            else {
                $("#txt").show();
                $("#date").hide();
                $("#bln").hide();
            }
        }

        $(document).on("click",".delete-button", function () {
            var id_detil = $(this).data('id');
            var nama_kontrak = $(this).data('name');
            $("#del-btn").attr('href','{{url('kontrak/delete')}}' + '/' + id_detil);
            $("#show-name").html('Anda yakin ingin menghapus kontrak ' + nama_kontrak + '?')

        })


    </script>
@stop