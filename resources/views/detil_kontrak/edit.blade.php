<html>
    <head>
        <body>
        {!! Form::open(array('url'=>'/editkontrak','method'=>'POST', 'files'=>true)) !!}
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$detil->id_detil}}" required>
                Nama Kontrak
                <input type="text" name="nama" value="{{$detil->nama_dokumen}}" readonly>
                <select name="id_perusahaan" required> Nama Anak Perusahaan
                    @foreach($ap as $np)
                    <option value="{{$np->id_perusahaan}}">{{$np->nama_perusahaan}}</option>
                    @endforeach
                </select>
                <select name="id_am" required> Nama Manager
                    @foreach($am as $nm)
                    <option value="{{$nm->id_am}}">{{$nm->nama_am}}</option>
                    @endforeach
                </select>
                <select name="nipnas" required> Nama Pelanggan
                    @foreach($plg as $nplg)
                    <option value="{{$nplg->nipnas}}">{{$nplg->nama_pelanggan}}</option>
                    @endforeach
                </select>
                tanggal mulai
                <input type="date" name="tgl_mulai" value="{{$detil->tgl_mulai}}">
                tanggal selesai
                <input type="date" name="tgl_selesai" value="{{$detil->tgl_selesai}}">
                <br>
                @foreach($lyn as $nlyn)
                    <input type="checkbox" value="{{$nlyn->id_layanan}}" name="name[]">
                    {{$nlyn->nama_layanan}}<br>
                @endforeach
                <input type="number" name="slg"  value="{{$detil->slg}}"required>
                <!-- <input type="file" name="image" required> -->
                {!! Form::file('image') !!}
                <button type="submit">Create Kontrak</button> 
            {!! Form::close() !!}
        </body>
    </head>
</html>