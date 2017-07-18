@if($acc->count())
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
</tr>
@endforeach
</table></div>
@else
<div class="alert alert-warning">
<i class=fa fa-exclamation-triangle"></i> DATA</div>
@endif