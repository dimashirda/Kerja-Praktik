<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<body>
		<a href="{{url('kontrak/create')}}" class="btn btn-primary">Create nih</a>
		<br>
		<br>
		{!! Form::open(['method'=>'GET','url'=>'/searchkontrak','class'=>'navbar-form navbar-left','role'=>'search'])  !!}

            <div class="input-group custom-search-form">
             <select name='kategori' id="kategori" onchange="split(selected value)">
             <option value='ap' selected>Anak Perusahaan</option>
             <option value='nama'>Nama Kontrak</option>
             <option value='am'>Account Manager</option>
             <option value='tgl_akhir'>Tanggal Berakhir</option>
             </select>
              <input type="text" id="txt" class="form-control" name="search1" placeholder="Search...">
              <input type="date" id="date" class="form-control" name="search2" placeholder="Search...">
                <span class="input-group-btn">
    	<button class="btn btn-default-sm" type="submit">
        <i class="fa fa-search"> search </i>
        {!! Form::close() !!}
    	</button>
		</span>
		<br><br>
		@if(count($dk) > 0)
			@foreach($dk as $d)
				<tr>
				<td>{{$d->id_detil}}</td>
				<td>{{$d->judul_kontrak}}</td>
				<td>{{$d->nama_am}}</td>
				<td>{{$d->nama_pelanggan}}</td>
				<td>{{$d->nama_perusahaan}}</td>
				<td>{{$d->tgl_mulai}}</td>
				<td>{{$d->tgl_selesai}}</td>
				<td>{{$d->slg}}</td>
				<a href="kontrak/download/{{$d->nama_dokumen}}"><td>{{$d->nama_dokumen}}</td></a>
				@foreach($dt as $ld)
				<td>{{$ld->nama_layanan}}</td>
				@endforeach
				<!-- <a href="kontrak/edit/{{$d->id_detil}}"> edit data </a> -->
				<a href="kontrak/delete/{{$d->id_detil}}"> hapus data </a>
				</tr>
				<br>
			@endforeach
		@else 
			<h1>ga ada apa apa</h1>
		@endif
		<script>
			$(document).ready(function(){	
				$("#date").hide();
			});
			var select = document.forms[0].kategori;
			select.onchange = function(){
				var value = select.options[select.selectedIndex].value;
				//alert(value);
				if (value != 'tgl_akhir') {
				$("#txt").show();
				$("#date").hide();
				}
				else{
				$("#txt").hide();
				$("#date").show();
				}
			}
		</script>

		</body>
	</head>
</html>