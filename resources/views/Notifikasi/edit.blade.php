@extends('adminlte::page')

@section('title', 'SIKontrak')

@section('content_header')
	<h1>Data Kontrak</h1>
@stop

@section('content')
	<div class="row">
		@if(Session::has('alert-success'))
			<div class="col-md-12">
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Sukses!</h4>
					{{Session::get('alert-success')}}. <a href="{{url('home')}}">Kembali</a>
				</div>
			</div>
		@endif
		<div class="col-md-12">
			<div class="box box-danger">
				<div class="box-header">
					<h3 class="box-title">{{$notif[0]->judul_kontrak}}</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<form action="{{url('notifikasi/save', $notif[0]->id_notifikasi)}}" method="post">
					{{--                    <form class="form-horizontal" method="post" action="{{url('admin/upload/store')}}" enctype="multipart/form-data" >--}}
					{{ csrf_field() }}
						<div class="form-group">
							<label for="NamaPelanggan" class="col-sm-2 control-label">Nama Pelanggan</label>

							<div class="col-sm-10">
								<p>{{$notif[0]->nama_pelanggan}}</p>
							</div>
						</div>
						<div class="form-group">
							<label for="AnakPerusahaan" class="col-sm-2 control-label">Anak Perusahaan</label>

							<div class="col-sm-10">
								<p>{{$notif[0]->nama_perusahaan}}</p>
							</div>
						</div>
						<div class="form-group">
							<label for="NamaKontrak" class="col-sm-2 control-label">Nama Kontrak</label>

							<div class="col-sm-10">
								<p>{{$notif[0]->judul_kontrak}}</p>
							</div>
						</div>
						<div class="form-group">
							<label for="AccMgr" class="col-sm-2 control-label">Account Manager</label>

							<div class="col-sm-10">
								<p>{{$notif[0]->nama_am}}</p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="KontrakAwal" class="col-sm-4 control-label">Mulai Kontrak</label>

									<div class="col-sm-8">
										<p style="margin-left: 5px">{{$notif[0]->tgl_mulai}}</p>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="KontrakAkhir" class="col-sm-4 control-label">Akhir Kontrak</label>

									<div class="col-sm-8">
										<p>{{$notif[0]->tgl_selesai}}</p>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="JenisLayanan" class="col-sm-2 control-label">Jenis Layanan</label>

							<div class="col-sm-10">
								@foreach($dt as $ld)
									@if($notif[0]->id_detil == $ld->id_detil)
										<p>{{$ld->nama_layanan}}</p>
									@endif
								@endforeach
							</div>
						</div>
						<div class="form-group">
							<label for="SLG" class="col-sm-2 control-label">SLG (%)</label>

							<div class="col-sm-10">
								<p>{{$notif[0]->slg}}</p>

							</div>
						</div>
						<div class="form-group">
							<label for="Keterangan" class="col-sm-2 control-label">Keterangan <span style="color: red">*</span></label>

							<div class="col-sm-10">
								<textarea name="keterangan" placeholder="Keterangan" class="form-control pull-right" style="margin-top:4px" required></textarea>
							</div>
						</div>

						<div class="col-sm-12" style="margin-top: 20px;">
								<input type="checkbox" class="flat-red" id="flag" name="flag" value="1">
								<span style="margin-left: 10px">Kontrak telah ditindaklanjuti</span>
						</div>
					</div>

					<!-- /.box-body -->
					<div class="box-footer">
						<a href="{{url('notifikasi')}}">
							<button type="button" class="btn btn-default">Batal</button>
						</a>
						<button type="submit" class="btn btn-success pull-right">Simpan</button>
					</div>
					<!-- /.box-footer -->
					</form>
				</div>
			</div>
		</div>
	</div>

	<script>
        $('#datepicker').datepicker({
            autoclose: true
        });

	</script>
@stop