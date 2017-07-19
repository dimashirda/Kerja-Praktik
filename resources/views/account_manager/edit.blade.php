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
  <form action="{{url('/acc-mgr/update')}}" method="POST">
  {!! csrf_field() !!}
    <div class="form-group">
      <input type="text" name="id_accm" class="form-control" value="{{$acc->id_am}}">
    </div>
    <div class="form-group">
      <input type="text" name="nama_accm" class="form-control" value="{{$acc->nama_am}}">
    </div>
    <div class="form-group">
      <input type="text" name="tlp_accm" class="form-control" value="{{$acc->tlp_am}}">
    </div>
    <div class="form-group">
      <input type="email" name="email_accm" class="form-control" value="{{$acc->email_am}}">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>

  
</div>

</body>
</html>
