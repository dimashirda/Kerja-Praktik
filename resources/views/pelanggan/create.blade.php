<html>
	<head>
		<body>
			<form action="{{url('/tambahpelanggan')}}" method="POST">
			{{ csrf_field() }}
				<input type="text" name="nipnas" required>
				<input type="text" name="nama" required>
				<input type="text" name="tlp" required>
				<input type="text" name="email" required>
				<button type="submit">save</button>
			</form>
		</body>
	</head>
</html>