@extends('adminlte::page')

@section('title', 'SIKontrak')

@section('content_header')
	<h1>Pemberitahuan</h1>
@stop



@section('content')
	<style>

		table tr {
			cursor: pointer;
		}
	</style>

	<div class="row">
		<div class="col-md-12">
			<div class="box box-danger">
				<div class="box-header">
				</div>
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						@foreach($notif as $n)
							<tr href="{{url('notifikasi', $n->id_notifikasi)}}">
								@if($merah > $n->tgl_selesai)
									<td width="4%" style="text-align: center" ><span class="fa fa-exclamation-circle" style="color: #ff3300; font-size: 19px;"></span></td>
								@elseif($kuning > $n->tgl_selesai)
									<td width="4%" style="text-align: center"><span class="fa fa-exclamation-circle" style="color: #fde61c; font-size: 19px"></span></td>
								@elseif($hijau > $n->tgl_selesai)
									<td width="4%" style="text-align: center"><span class="fa fa-exclamation-circle" style="color: #00e600; font-size: 19px"></span></td>
								@else
									<td width="4%" style="text-align: center"><span></span></td>
								@endif
								<td>
									<p><strong>Kontrak {{$n->judul_kontrak}} akan habis pada tanggal {{$n->tgl_selesai}}</strong></p>
									<h6 style="color: #898989">{{$n->keterangan}}</h6>
								</td>
						</tr>
						@endforeach
					</table>

				</div>
			</div>
		</div>
	</div>
	<script>
        $(document).ready(function(){
            $('table tr').click(function(){
                window.location = $(this).attr('href');
                return false;
            });
        });
	</script>
@stop

