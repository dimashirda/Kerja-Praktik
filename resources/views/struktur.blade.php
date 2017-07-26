@extends('adminlte::page')

@section('title', 'SIKontrak')

@section('content_header')

@stop

@section('content')
    <style type="text/css">
        .centerImage
        {
            text-align:center;
            display:block;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header">
                    <center>
                        <h2>Struktur Organisasi C3</h2>
                    </center>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12 centerImage">
                        <center>
                            {{ Html::image('image/struktur_org.png', 'Struktur Organisasi C3', array( 'width' => 900, 'height' => 523, 'align'=>'middle', 'class'=>'centerImage')) }}

                        </center>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop