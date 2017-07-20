@if($acc->count())
<a href="{{url('anak_perusahaans/create')}}" class="btn btn-primary">Create nih</a>

{!! Form::open(['method'=>'GET','url'=>'anak_perusahaans','class'=>'navbar-form navbar-left','role'=>'search'])  !!}

            <div class="input-group custom-search-form">
            	<select name='kategori'>
            	<option value='ID'>ID</option>
            	<option value='nama'>NAMA</option>
                <input type="text" class="form-control" name="search" placeholder="Search...">
                <span class="input-group-btn">
    <button class="btn btn-default-sm" type="submit">
        <i class="fa fa-search">i
    </button>
</span>

<div class="table-responsive">
<table class="table table-bordered table-striped table-hover table-condensed tfix">
	<thead align="center"><tr>
	<td><b>ID_perusahaan</b></td>
	<td><b>nama_perusahaan</b></td>
	<td><b>tlp_perusahaan</b></td>
	<td><b>email_perusahaan</b></td>
	</tr></thead>
@foreach($acc as $a)
<tr>
<td>{{ $a->id_perusahaan }}</td>
<td>{{ $a->nama_perusahaan }}</td>
<td>{{ $a->tlp_perusahaan }}</td>
<td>{{ $a->email_perusahaan }}</td>
<td><a href="anak_perusahaans/edit/{{$a->id_perusahaan}}"> edit data </a>
				<a href="anak_perusahaans/delete/{{$a->id_perusahaan}}"> hapus data </a></td></tr>
@endforeach
</table></div>
<?php echo $acc->render();?>
@else
<div class="alert alert-warning">
<i class=fa fa-exclamation-triangle"></i> DATA TIDAK ADA</div>
@endif
