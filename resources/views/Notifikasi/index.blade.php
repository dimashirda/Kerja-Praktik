<html>
	<head>
		<body>
			<table>
				@foreach($notif as $tmp)
				<tr>
					<td>{{$tmp->judul_kontrak}}</td>
					<td>{{$tmp->tanggal}}</td>
					<td>{{$tmp->keterangan}}</td>
					<td><a href="edit/{{$tmp->id_notifikasi}}">Detail Notif</a></td>
				</tr>
				@endforeach
			</table>
		</body>
	</head>
</html>