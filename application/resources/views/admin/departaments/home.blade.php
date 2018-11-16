@extends('adminlte::page')
@section('title', 'Departamentos')
@section('content_header')
    <h1>Departamentos</h1>
@stop

@section('content')
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>Todas los Departamentos</h2>
    	</div>
    	<div class="panel-body">
    		@include('flash::message')
    		<a href="{{ route('departaments.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nuevo Departamento</a>
    		<br />
    		<br />
    		<table class="table table-bordered table-striped data-table">
    			<thead>
    				<th>ID</th>
    				<th>Nombre</th>
    				<th>Acciones</th>
    			</thead>
    			<tbody>
    				@foreach($departaments as $departament)
    				<tr>
    					<td>{{ $departament->id }}</td>
    					<td>{{ $departament->name }}</td>
    					<td>
    						<a href="{{ route('departaments.edit',['id' => $departament->id]) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Actualizar</a>
    						{!! Form::open(['method' => 'DELETE', 'style' => 'display:inline;','route' => ['departaments.destroy', $departament->id]],null,null,['style' => 'display:inline;']) !!}
    							{!! Form::button('<i class="fa fa-times"></i> Eliminar', ['type' => 'sumit', 'class' => 'btn btn-danger delete-record']) !!}
    						{!! Form::close() !!}
    					</td>
    				</tr>
    				@endforeach
    			</tbody>
    		</table>
    	</div>
    </div>
@endsection