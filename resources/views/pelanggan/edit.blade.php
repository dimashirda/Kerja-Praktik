<html>
	<head>
		<body>
			<form action="{{url('/editpelanggan')}}" method="POST">
			{{ csrf_field() }}
				<input type="text" name="nipnas" value="{{$pelanggan->nipnas}}" required>
				<input type="text" name="nama"  value="{{$pelanggan->nama_pelanggan}}" required>
				<input type="text" name="tlp" value="{{$pelanggan->tlp_pelanggan}}" required>
				<input type="text" name="email" value="{{$pelanggan->email_pelanggan}}" required>
				<button type="submit">edit</button>
			</form>
		</body>
	</head>
</html>