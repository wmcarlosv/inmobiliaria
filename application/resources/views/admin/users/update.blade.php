@extends('adminlte::page')
@section('title', 'Actualizar Usuario')
@section('content_header')
    <h1>Usuarios</h1>
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
    		<h2>Actualizar Usuario</h2>
    	</div>
    	<div class="panel-body">
    		{!! Form::open(['method' => 'PUT', 'route' => ['users.update', $user->id]]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Nombre: ') !!}
                {!! Form::text('name',$user->name,['id' => 'name', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Email: ') !!}
                {!! Form::text('email',$user->email,['id' => 'email', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('user_type', 'Tipo de Usuario: ') !!}
                {!! Form::select('user_type',['' => '-','administrador' => 'administrador','agente' => 'agente'],$user->user_type,['id' => 'user_type', 'class' => 'form-control']) !!}
            </div>
            {!! Form::button('<i class="fa fa-floppy-o"></i> Guardar', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
            <a href="{{ route('users.index') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
            {!! Form::close() !!}
    	</div>
    </div>
@endsection