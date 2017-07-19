<html>
	<head>
		<body>
		<a href="{{url('pelanggan/create')}}" class="btn btn-primary">Create nih</a>
		<br>
		<br>
		@if(count($pelanggan) > 0)
			<?php $i=1 ?>
			@foreach($pelanggan as $p)
				<tr>
				<td><?php echo $i; ?></td>
				<td>{{$p->nipnas}}</td>
				<td>{{$p->nama_pelanggan}}</td>
				<td>{{$p->tlp_pelanggan}}</td>
				<td>{{$p->email_pelanggan}}</td>
				</tr>
				<?php $i++; ?>
				<a href="pelanggan/edit/{{$p->nipnas}}"> edit data </a>
				<a href="pelanggan/delete/{{$p->nipnas}}"> hapus data </a>
				<br>
			@endforeach
		@else 
			<h1>ga ada apa apa</h1>
		@endif
		</body>
	</head>
</html>