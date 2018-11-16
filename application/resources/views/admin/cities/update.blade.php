@extends('adminlte::page')
@section('title', 'Actualizar Ciudad')
@section('content_header')
    <h1>Ciudades</h1>
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
    		<h2>Actualizar Ciudad</h2>
    	</div>
    	<div class="panel-body">
    		{!! Form::open(['method' => 'PUT', 'route' => ['cities.update', $city->id]]) !!}
            <div class="form-group">
                {!! Form::label('departament_id', 'Departamento: ') !!}
                {!! Form::select('departament_id',$departaments,$city->departament_id,['id' => 'departament_id', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name',$city->name,['id' => 'name', 'class' => 'form-control']) !!}
            </div>
            {!! Form::button('<i class="fa fa-floppy-o"></i> Guardar', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
            <a href="{{ route('cities.index') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
            {!! Form::close() !!}
    	</div>
    </div>
@endsection