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
                    <div class="row">
                        <div class="col-md-6">
                            <div id="example1_filter" class="form-inline">
                                <div class="form-group">
                                    <label>Search by:
                                        <select name="kategori" class="form-control input-sm">
                                            <option>Nama Pelanggan</option>
                                            <option>NIPNAS</option>
                                        </select>
                                        <input type="search" class="form-control input-sm" placeholder aria-controls="example1">
                                        <button type="button" class="btn btn-info btn-flat input-sm">Search</button>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>NIPNAS</th>
                                <th>Pelanggan</th>
                                <th>Anak Perusahaan</th>
                                <th>Nama Kontrak</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Akhir</th>
                                <th>Jenis Layanan</th>
                                <th>SLG (%)</th>
                                <th>Dokumen</th>
                                <th>Account Manager</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>A</td>
                                <td>B</td>
                                <td>C</td>
                                <td>D</td>
                                <td>E</td>
                                <td>F</td>
                                <td>G</td>
                                <td>H</td>
                                <td>I</td>
                                <td>J</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>

    </script>
@stop