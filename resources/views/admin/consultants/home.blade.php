@extends('adminlte::page')
@section('title', 'Asesores')
@section('content_header')
    <h1>Asesores</h1>
@stop

@section('content')
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>Todos los Asesores</h2>
    	</div>
    	<div class="panel-body">
    		@include('flash::message')
    		<a href="{{ route('consultants.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nuevo Asesor</a>
    		<br />
    		<br />
    		<table class="table table-bordered table-striped data-table">
    			<thead>
    				<th>ID</th>
    				<th>Nombre</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Direcci&oacute;n</th>
                    <th>Foto</th>
    				<th>Acciones</th>
    			</thead>
    			<tbody>
    				@foreach($consultants as $consultant)
    				<tr>
    					<td>{{ $consultant->id }}</td>
    					<td>{{ $consultant->name }}</td>
                        <td>{{ $consultant->phone }}</td>
                        <td>{{ $consultant->email }}</td>
                        <td>{{ $consultant->direction }}</td>
                        <td>
                            @if( isset($consultant->avatar) and !empty($consultant->avatar) )
                                <img src="{{ asset('storage/avatars') }}/{{ $consultant->avatar }}" width="80" height="100" class="img-thumbnail">
                            @else
                                <img src="{{ asset('storage/avatars') }}/empty.jpg" width="80" height="100" class="img-thumbnail">
                            @endif

                        </td>
    					<td>
    						<a href="{{ route('consultants.edit',['id' => $consultant->id]) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Actalizar</a>
    						{!! Form::open(['method' => 'DELETE', 'style' => 'display:inline;','route' => ['consultants.destroy', $consultant->id]],null,null,['style' => 'display:inline;']) !!}
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