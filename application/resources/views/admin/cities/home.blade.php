@extends('adminlte::page')
@section('title', 'Ciudades')
@section('content_header')
    <h1>Ciudades</h1>
@stop

@section('content')
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>Todas las Ciudades</h2>
    	</div>
    	<div class="panel-body">
    		@include('flash::message')
    		<a href="{{ route('cities.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nueva Ciudad</a>
    		<br />
    		<br />
    		<table class="table table-bordered table-striped data-table">
    			<thead>
    				<th>ID</th>
    				<th>Nombre</th>
                    <th>Departamento</th>
    				<th>Acciones</th>
    			</thead>
    			<tbody>
    				@foreach($cities as $city)
    				<tr>
    					<td>{{ $city->id }}</td>
    					<td>{{ $city->name }}</td>
                        <td>{{ $city->departament->name }}</td>
    					<td>
    						<a href="{{ route('cities.edit',['id' => $city->id]) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Actualizar</a>
    						{!! Form::open(['method' => 'DELETE', 'style' => 'display:inline;','route' => ['cities.destroy', $city->id]],null,null,['style' => 'display:inline;']) !!}
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