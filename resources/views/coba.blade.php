<html>
	<head>
		<body>
			<h1>ada {{$banyak}} kontrak yang belum ditindaklanjuti</h1>
			<ol>
				@foreach($nama as $tmp)
				<li>Kontrak {{$tmp}} akan habis dalam 30 hari</li>
				@endforeach
			</ol>
			<p>Silahkan buka aplikasi untuk lebih detailnya.</p>
		</body>
	</head>
</html>