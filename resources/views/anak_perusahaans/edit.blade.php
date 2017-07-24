<html>
	<head>
		<body>
			<form action="{{url('/editperusahaan')}}" method="POST">
			{{ csrf_field() }}
				<input type="text" name="id_anakperu" value="{{$anak_perusahaans->id_perusahaan}}" required>
				<input type="text" name="nama_anakperu"  value="{{$anak_perusahaans->nama_perusahaan}}" required>
				<input type="text" name="tlp_anakperu" value="{{$anak_perusahaans->tlp_perusahaan}}" required>
				<input type="text" name="email_anakperu" value="{{$anak_perusahaans->email_perusahaan}}" required>
				<button type="submit">edit</button>
			</form>
		</body>
	</head>
</html>