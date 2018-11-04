@extends('adminlte::page')
@section('title', 'Direcciones')
@section('content_header')
    <h1>Direcciones</h1>
@stop

@section('content')
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>Todas las Direcciones</h2>
    	</div>
    	<div class="panel-body">
    		@include('flash::message')
    		<a href="{{ route('directions.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nueva Direccion</a>
    		<br />
    		<br />
    		<table class="table table-bordered table-striped data-table">
    			<thead>
    				<th>ID</th>
    				<th>Departamento</th>
    				<th>Zona</th>
    				<th>Ubicaci&oacute;n</th>
    				<th>Acciones</th>
    			</thead>
    			<tbody>
    				@foreach($directions as $direction)
    				<tr>
    					<td>{{ $direction->id }}</td>
    					<td>{{ $direction->departament }}</td>
    					<td>{{ $direction->zone }}</td>
    					<td>{{ $direction->ubication }}</td>
    					<td>
    						<a href="{{ route('directions.edit',['id' => $direction->id]) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Actualizar</a>
    						{!! Form::open(['method' => 'DELETE', 'style' => 'display:inline;','route' => ['directions.destroy', $direction->id]],null,null,['style' => 'display:inline;']) !!}
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