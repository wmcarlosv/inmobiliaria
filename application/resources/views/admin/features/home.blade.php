@extends('adminlte::page')
@section('title', 'Caracteristicas')
@section('content_header')
    <h1>Caracteristicas</h1>
@stop

@section('content')
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>Todas las Caracteristicas</h2>
    	</div>
    	<div class="panel-body">
    		@include('flash::message')
    		<a href="{{ route('features.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nueva Caracteristica</a>
    		<br />
    		<br />
    		<table class="table table-bordered table-striped data-table">
    			<thead>
    				<th>ID</th>
    				<th>Nombre</th>
    				<th>Acciones</th>
    			</thead>
    			<tbody>
    				@foreach($features as $feature)
    				<tr>
    					<td>{{ $feature->id }}</td>
    					<td>{{ $feature->name }}</td>
    					<td>
    						<a href="{{ route('features.edit',['id' => $feature->id]) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Actualizar</a>
    						{!! Form::open(['method' => 'DELETE', 'style' => 'display:inline;','route' => ['features.destroy', $feature->id]],null,null,['style' => 'display:inline;']) !!}
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