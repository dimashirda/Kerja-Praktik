<html>
	<head>
		<body>
			<form action="{{url('/tambahkontrak')}}" method="POST">
			{{ csrf_field() }}
				Nama Kontrak
				<input type="text" name="nama">
				<select name="id_perusahaan"> Nama Anak Perusahaan
					@foreach($ap as $np)
					<option value="{{$np->id_perusahaan}}">{{$np->nama_perusahaan}}</option>
					@endforeach
				</select>
				<select name="id_am"> Nama Manager
					@foreach($am as $nm)
					<option value="{{$nm->id_am}}">{{$nm->nama_am}}</option>
					@endforeach
				</select>
				<select name="nipnas"> Nama Pelanggan
					@foreach($plg as $nplg)
					<option value="{{$nplg->nipnas}}">{{$nplg->nama_pelanggan}}</option>
					@endforeach
				</select>
				tanggal mulai
				<input type="date" name="tgl_mulai">
				tanggal selesai
				<input type="date" name="tgl_selesai">
				@foreach($lyn as $nlyn)
					<input type="checkbox" name="{{$nlyn->id_layanan}}">{{$nlyn->nama_layanan}}<br>
				@endforeach
				<input type="number" name="slg">
				<input type="text" name="nama_dokumen">
				<button type="submit">Create Kontrak</button> 
			</form>
		</body>
	</head>
</html>