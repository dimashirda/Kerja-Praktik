<html>
	<head>
		<body>
			<form action="{{url('/notifikasi/save',$notif[0]->id_notifikasi)}}" method="POST">
				{{ csrf_field() }}

				<input type="hidden" name="id_notifikasi" value="{{$notif[0]->id_notifikasi}}" required>
				<input type="text" name="notif" value="{{$notif[0]->judul_kontrak}}" readonly>
				<input type="text" name="keterangan" value="{{$notif[0]->keterangan}}" required>
				<input type="checkbox" name="flag" value="1" required>
				<input type="submit">

			</form>
		</body>
	</head>
</html>