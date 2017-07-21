<html>
	<head>
		<body>
		<a href="{{url('layanan/create')}}" class="btn btn-primary">Create nih</a>
		<br>
		<br>
		@if(count($layanan) > 0)
			@foreach($layanan as $l)
				<tr>
				<td>{{$l->id_layanan}}</td>
				<td>{{$l->nama_layanan}}</td>
				</tr>
				<a href="layanan/edit/{{$l->id_layanan}}"> edit data </a>
				<a href="layanan/delete/{{$l->id_layanan}}"> hapus data </a>
				<br>
			@endforeach
		@else 
			<h1>ga ada apa apa</h1>
		@endif
		</body>
	</head>
</html>