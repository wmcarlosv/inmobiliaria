@extends('adminlte::page')
@section('title', 'Nuevo Departamento')
@section('content_header')
    <h1>Departamentos</h1>
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
    		<h2>Nuevo Departamento</h2>
    	</div>
    	<div class="panel-body">
    		{!! Form::open(['route' => 'departaments.store']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Nombre: ') !!}
                {!! Form::text('name',null,['id' => 'name', 'class' => 'form-control']) !!}
            </div>
            {!! Form::button('<i class="fa fa-floppy-o"></i> Guardar', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
            <a href="{{ route('departaments.index') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
            {!! Form::close() !!}
    	</div>
    </div>
@endsection