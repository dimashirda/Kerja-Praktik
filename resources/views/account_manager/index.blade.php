@if($acc->count())
<div class="table-responsive">
<table class="table table-bordered table-striped table-hover table-condensed tfix">
 <thead align="center"> <tr> 
 <td><b>ID Acc Manager</b></td> 
 <td><b>Nama Acc Manager</b></td> 
 <td><b>Tlp Acc Manager</b></td>
 <td><b>Email Acc Manager</b></td>
 <td colspan="2"><b>MENU</b></td>
 </tr></thead>
@foreach($acc as $a)
 <tr>
 	<td>{{ $a->id_am }}</td>
 	<td>{{ $a->nama_am }}</td>
 	<td>{{ $a->tlp_am }}</td>
 	<td>{{ $a->email_am }}</td>
 	<td>
 		<a href="acc-mgr/edit/{{$a->id_am}}">edit</a>
 		<a href="acc-mgr/delete/{{$a->id_am}}">hapus</a>
 	</td>
 </tr>
@endforeach
</table>
</div>
@else
 <div class="alert alert-warning">
 <i class="fa fa-exclamation-triangle"></i> Data Acc Mgr tidak ditemukan</div>
@endif