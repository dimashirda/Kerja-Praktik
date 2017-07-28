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
                    @if(Auth::User()->role == 1)
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{route('upload')}}" class='btn btn-primary'><i class="fa fa-plus-circle"></i> Tambah baru</a>
                        </div>
                    </div>
                    @endif
                    <br>
                    @if(count($dk) > 0)
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center">NIPNAS</th>
                                <th style="text-align: center">Pelanggan</th>
                                <th style="text-align: center">Nama Kontrak</th>
                                <th style="text-align: center">Anak Perusahaan</th>
                                <th style="text-align: center">Tanggal Mulai</th>
                                <th style="text-align: center">Tanggal Akhir</th>
                                <th style="text-align: center">Jenis Layanan</th>
                                <th style="text-align: center">SLG (%)</th>
                                <th style="text-align: center">Dokumen</th>
                                <th style="text-align: center">Account Manager</th>
                                <th style="text-align: center" colspan="2">Actions</th>
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
                                <td align="center" width="30px">
                                    <a href="{{url('kontrak/edit', $d->id_detil)}}">
                                        <button type="button" class="btn btn-default">
                                            Edit
                                        </button>
                                    </a>
                                </td>
                                <td align="center" width="30px">
                                    <button type="button" class="btn btn-danger delete-button" data-name="{{$d->judul_kontrak}}" data-id="{{$d->id_detil}}" data-toggle="modal" data-target="#modal-danger">
                                        Hapus
                                    </button>
                                </td>

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
                
                <?php //dd($tmp); ?>
                <tr>
                    <select name="notif" id="selectbox">
                    @foreach($notif as $tmp)
                    <option value="notifikasi/edit/{{$tmp->id_notifikasi}}">{{$tmp->judul_kontrak}}</option>
                    @endforeach
                    <option value="notifikasi/viewall">View All</option>
                    </select>
                </tr>
                @else
                    <p>Data tidak tersedia.</p>
                @endif
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {
        $("#selectbox").change(function() {
            if ($(this).val()) {
                window.open($(this).val(), '_self');
                //$("#formElement").submit();
                <?php echo 'masuk'; ?>
            }
        });
    });

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

        $(document).on("click",".delete-button", function () {
            var id_pelanggan = $(this).data('id');
            var nama_pelanggan = $(this).data('name');
            $("#del-btn").attr('href','{{url('kontrak/delete')}}' + '/' + id_pelanggan);
            $("#show-name").html('Anda yakin ingin menghapus kontrak ' + nama_pelanggan + '?')

        })


    </script>
@stop