@extends('adminlte::page')
@section('title', 'Zonas')
@section('content_header')
    <h1>Zonas</h1>
@stop

@section('content')
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>Todas los zonas</h2>
    	</div>
    	<div class="panel-body">
    		@include('flash::message')
    		<a href="{{ route('zones.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nueva Zona</a>
    		<br />
    		<br />
    		<table class="table table-bordered table-striped data-table">
    			<thead>
    				<th>ID</th>
    				<th>Nombre</th>
                    <th>Ciudad</th>
                    <th>Departamento</th>
    				<th>Acciones</th>
    			</thead>
    			<tbody>
    				@foreach($zones as $zone)
    				<tr>
    					<td>{{ $zone->id }}</td>
    					<td>{{ $zone->name }}</td>
                        <td>{{ $zone->city->name }}</td>
                        <td>{{ $zone->city->departament->name }}</td>
    					<td>
    						<a href="{{ route('zones.edit',['id' => $zone->id]) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Actualizar</a>
    						{!! Form::open(['method' => 'DELETE', 'style' => 'display:inline;','route' => ['zones.destroy', $zone->id]],null,null,['style' => 'display:inline;']) !!}
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