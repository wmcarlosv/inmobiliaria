@extends('adminlte::page')
@section('title', 'Amenidades')
@section('content_header')
    <h1>Amenidades</h1>
@stop

@section('content')
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>Todas las Amenidades</h2>
    	</div>
    	<div class="panel-body">
    		@include('flash::message')
    		<a href="{{ route('amenities.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nueva Amenidad</a>
    		<br />
    		<br />
    		<table class="table table-bordered table-striped data-table">
    			<thead>
    				<th>ID</th>
    				<th>Nomres</th>
    				<th>Acciones</th>
    			</thead>
    			<tbody>
    				@foreach($amenities as $amenity)
    				<tr>
    					<td>{{ $amenity->id }}</td>
    					<td>{{ $amenity->name }}</td>
    					<td>
    						<a href="{{ route('amenities.edit',['id' => $amenity->id]) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Actualizar</a>
    						{!! Form::open(['method' => 'DELETE', 'style' => 'display:inline;','route' => ['amenities.destroy', $amenity->id]],null,null,['style' => 'display:inline;']) !!}
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