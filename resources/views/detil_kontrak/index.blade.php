<html>
	<head>
		<body>
		<a href="{{url('kontrak/create')}}" class="btn btn-primary">Create nih</a>
		<br>
		<br>
		@if(count($dk) > 0)
			@foreach($dk as $d)
				<tr>
				<td>{{$d->judul_kontrak}}</td>
				<td>{{$d->id_detil}}</td>
				<td>{{$d->nama_am}}</td>
				<td>{{$d->nama_pelanggan}}</td>
				<td>{{$d->nama_perusahaan}}</td>
				<td>{{$d->tgl_mulai}}</td>
				<td>{{$d->tgl_selesai}}</td>
				<td>{{$d->slg}}</td>
				<td>{{$d->nama_dokumen}}</td>
				</tr>
				<br>
			@endforeach
		@else 
			<h1>ga ada apa apa</h1>
		@endif
		</body>
	</head>
</html>