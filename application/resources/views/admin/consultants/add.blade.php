@extends('adminlte::page')
@section('title', 'Nuevo Asesor')
@section('content_header')
    <h1>Asesores</h1>
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
    		<h2>Nuevo Asesor</h2>
    	</div>
    	<div class="panel-body">
    		{!! Form::open(['route' => 'consultants.store', 'files' => true]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Nombre: ') !!}
                {!! Form::text('name',null,['id' => 'name', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('phone', 'Telefono: ') !!}
                {!! Form::text('phone',null,['id' => 'phone', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Correo: ') !!}
                {!! Form::text('email',null,['id' => 'email', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('direction', 'Dirección: ') !!}
                {!! Form::text('direction',null,['id' => 'direction', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('avatar', 'Foto: ') !!}
                {!! Form::file('avatar',['id' => 'avatar', 'class' => 'form-control']) !!}
            </div>
            {!! Form::button('<i class="fa fa-floppy-o"></i> Guardar', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
            <a href="{{ route('consultants.index') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
            {!! Form::close() !!}
    	</div>
    </div>
@endsection