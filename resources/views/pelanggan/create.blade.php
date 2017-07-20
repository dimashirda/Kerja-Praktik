<<<<<<< HEAD
@extends('adminlte::page')

@section('title', 'SIKontrak')

@section('content_header')
    <h1>Pelanggan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tambah Pelanggan</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="NIPNAS" class="col-sm-2 control-label">NIPNAS</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="NIPNAS">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NamaPelanggan" class="col-sm-2 control-label">Nama Pelanggan</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Nama Pelanggan">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="EmailPelanggan" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="TlpPelanggan" class="col-sm-2 control-label">No. Telepon</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="No. Telepon">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">Batal</button>
                            <a href="{{route('pelanggan')}}">
                                <button type="submit" class="btn btn-success pull-right">Simpan</button>
                            </a>

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
=======
<html>
	<head>
		<body>
			<form action="{{url('/tambahpelanggan')}}" method="POST">
			{{ csrf_field() }}
				<input type="text" name="nipnas" required>
				<input type="text" name="nama" required>
				<input type="text" name="tlp" required>
				<input type="text" name="email" required>
				<button type="submit">save</button>
			</form>
		</body>
	</head>
</html>
>>>>>>> d12e427d68594c67f92910c0271fc1524aafe117
