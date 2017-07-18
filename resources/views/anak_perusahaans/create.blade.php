<html>
	<head>
		<body>
			<form action="{{url('/tambahperusahaan')}}" method="POST">
			{{ csrf_field() }}
				<input type="text" name="id_anakperu" required>
				<input type="text" name="nama_anakperu" required>
				<input type="text" name="tlp_anakperu" required>
				<input type="text" name="email_anakperu" required>
				<button type="submit">save</button>
			</form>
		</body>
	</head>
</html>