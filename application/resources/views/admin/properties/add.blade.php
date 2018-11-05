@extends('adminlte::page')
@section('title', 'Nueva Inmobiliaria')
@section('content_header')
    <h1>Inmobiliarias</h1>
@stop

@section('content')
    <div class="panel panel-default">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    	<div class="panel-heading">
    		<h2>Nueva Inmobiliaria</h2>
    	</div>
    	<div class="panel-body">
            {!! Form::open(['route' => 'properties.store']) !!}

            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Datos</a></li>
                <li><a data-toggle="tab" href="#menu1">Amenidades</a></li>
                <li><a data-toggle="tab" href="#menu2">Caracteristicas</a></li>
                <li><a data-toggle="tab" href="#menu3">Fotos</a></li>
            </ul>
    		<br />
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="form-group">
                        {!! Form::label('direction_id', 'Dirección: ') !!}
                        {!! Form::select('direction_id',$directions,null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('property_type_id', 'Tipo de Inmobiliaria: ') !!}
                        {!! Form::select('property_type_id',$propertytypes,null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('management_id', 'Gestion: ') !!}
                        {!! Form::select('management_id',$managements,null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Descripción: ') !!}
                        {!! Form::textarea('description',null,['id' => 'description', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('price', 'Precio: ') !!}
                        {!! Form::text('price',null,['id' => 'precio', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('stratum', 'Estrato: ') !!}
                        {!! Form::text('stratum',null,['id' => 'stratum', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('square_meter', 'Metros Cuadrados: ') !!}
                        {!! Form::text('square_meter',null,['id' => 'square_meter', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('consultant_id', 'Asesor: ') !!}
                        {!! Form::select('consultant_id',$consultants,null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div id="menu1" class="tab-pane fade">
                </div>
                <div id="menu2" class="tab-pane fade">
                </div>
                <div id="menu3" class="tab-pane fade">
                </div>
                {!! Form::button('<i class="fa fa-floppy-o"></i> Guardar', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                <a href="{{ route('properties.index') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
                {!! Form::close() !!}
            </div>
    	</div>
    </div>
@endsection