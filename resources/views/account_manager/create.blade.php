<<<<<<< HEAD
@extends('adminlte::page')

@section('title', 'SIKontrak')

@section('content_header')
    <h1>Account Manager</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tambah Account Manager</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="NamaAccMgr" class="col-sm-2 control-label">Nama Account Manager</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Nama Perusahaan">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="TlpAccMgr" class="col-sm-2 control-label">No. Telepon</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="No. Telepon">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="EmailAccMgr" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">Batal</button>
                            <a href="{{route('perusahaan')}}">
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
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Add Account Manager Data</h2>
  <form action="{{url('/acc-mgr/store')}}" method="POST">
  {!! csrf_field() !!}
    <div class="form-group">
      <input type="text" name="id_accm" class="form-control" placeholder="ID Account Manager">
    </div>
    <div class="form-group">
      <input type="text" name="nama_accm" class="form-control" placeholder="Nama Account Manager">
    </div>
    <div class="form-group">
      <input type="number" name="tlp_accm" class="form-control" placeholder="Telepon Account Manager">
    </div>
    <div class="form-group">
      <input type="email" name="email_accm" class="form-control" placeholder="Email Account Manager">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>

  
</div>

</body>
</html>
>>>>>>> d12e427d68594c67f92910c0271fc1524aafe117
