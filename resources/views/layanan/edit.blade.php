<html>
	<head>
		<body>
			<form action="{{url('/editlayanan')}}" method="POST">
			{{ csrf_field() }}
				<input type="hidden" name="id" value="{{$layanan->id_layanan}}" required>
				<input type="text" name="nama"  value="{{$layanan->nama_layanan}}" required>
				<input type="text" name="desk" value="{{$layanan->deskripsi}}" required>
				<button type="submit">edit</button>
			</form>
		</body>
	</head>
</html>