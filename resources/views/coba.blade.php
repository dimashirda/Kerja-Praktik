<html>
	<head>
		<body>
			<h1>Terdapat {{$banyak}} kontrak yang belum ditindaklanjuti</h1>
			<ol>
				@foreach($judul as $tmp)
				<li>Kontrak {{$tmp}} akan habis kurang dari 30 hari</li>
				@endforeach
			</ol>
			<p>Silahkan buka aplikasi kontrak untuk lebih detailnya.</p>
		</body>
	</head>
</html>