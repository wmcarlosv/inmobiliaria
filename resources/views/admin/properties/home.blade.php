@extends('adminlte::page')
@section('title', 'Inmobiliarios')
@section('content_header')
    <h1>Inmobiliarios</h1>
@stop

@section('content')
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>Todas los Inmobiliarios</h2>
    	</div>
    	<div class="panel-body">
    		@include('flash::message')
    		<a href="{{ route('properties.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nuevo Inmobiliario</a>
    		<br />
    		<br />
    		<table class="table table-bordered table-striped data-table">
    			<thead>
    				<th>ID</th>
                    <th>Descripci&oacute;n</th>
                    <th>Tipo de Inmobiliario</th>
                    <th>Gestion</th>
    				<th>Acciones</th>
    			</thead>
    			<tbody>
    				@foreach($properties as $property)
    				<tr>
    					<td>{{ $property->id }}</td>
    					<td></td>
                        <td></td>
                        <td></td>
    					<td>
    						<a href="{{ route('properties.edit',['id' => $property->id]) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Actualizar</a>
    						{!! Form::open(['method' => 'DELETE', 'style' => 'display:inline;','route' => ['properties.destroy', $property->id]],null,null,['style' => 'display:inline;']) !!}
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