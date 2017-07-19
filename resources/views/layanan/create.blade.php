<html>
	<head>
		<body>
			<form action="{{url('/tambahlayanan')}}" method="POST">
			{{ csrf_field() }}
				<input type="hidden" name="id" required>
				<input type="text" name="nama" required>
				<input type="text" name="desk" required>
				<button type="submit">save</button>
			</form>
		</body>
	</head>
</html>