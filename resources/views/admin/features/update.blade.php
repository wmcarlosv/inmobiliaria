@extends('adminlte::page')
@section('title', 'Actualizar Caracteristica')
@section('content_header')
    <h1>Caracteristicas</h1>
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
    		<h2>Actualizar Caracteristica</h2>
    	</div>
    	<div class="panel-body">
    		{!! Form::open(['method' => 'PUT', 'route' => ['features.update', $feature->id]]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name',$feature->name,['id' => 'name', 'class' => 'form-control']) !!}
            </div>
            {!! Form::button('<i class="fa fa-floppy-o"></i> Guardar', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
            <a href="{{ route('features.index') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
            {!! Form::close() !!}
    	</div>
    </div>
@endsection