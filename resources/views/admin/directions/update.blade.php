@extends('adminlte::page')
@section('title', 'Actualizar Dirección')
@section('content_header')
    <h1>Direcciones</h1>
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
    		<h2>Actualizar Direcci&oacute;n</h2>
    	</div>
    	<div class="panel-body">
    		{!! Form::open(['method' => 'PUT', 'route' => ['directions.update', $direction->id]]) !!}
            <div class="form-group">
                {!! Form::label('departament', 'Departamento: ') !!}
                {!! Form::text('departament',$direction->departament,['id' => 'departament', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('zone', 'Zona: ') !!}
                {!! Form::text('zone',$direction->zone,['id' => 'zone', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('ubication', 'Uicación: ') !!}
                {!! Form::text('ubication',$direction->ubication,['id' => 'ubication', 'class' => 'form-control']) !!}
            </div>
            {!! Form::button('<i class="fa fa-floppy-o"></i> Save', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
            <a href="{{ route('directions.index') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>
            {!! Form::close() !!}
    	</div>
    </div>
@endsection