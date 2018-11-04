@extends('adminlte::page')
@section('title', 'Gestiones')
@section('content_header')
    <h1>Gestiones</h1>
@stop

@section('content')
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>Todas las Gestiones</h2>
    	</div>
    	<div class="panel-body">
    		@include('flash::message')
    		<a href="{{ route('managements.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nueva Gestion</a>
    		<br />
    		<br />
    		<table class="table table-bordered table-striped data-table">
    			<thead>
    				<th>ID</th>
    				<th>Nombre</th>
    				<th>Acciones</th>
    			</thead>
    			<tbody>
    				@foreach($managements as $management)
    				<tr>
    					<td>{{ $management->id }}</td>
    					<td>{{ $management->name }}</td>
    					<td>
    						<a href="{{ route('managements.edit',['id' => $management->id]) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Actualizar</a>
    						{!! Form::open(['method' => 'DELETE', 'style' => 'display:inline;','route' => ['managements.destroy', $management->id]],null,null,['style' => 'display:inline;']) !!}
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