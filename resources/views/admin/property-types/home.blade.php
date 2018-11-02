@extends('adminlte::page')
@section('title', 'Property Types')
@section('content_header')
    <h1>Property Types</h1>
@stop

@section('content')
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>All Property Types</h2>
    	</div>
    	<div class="panel-body">
    		@include('flash::message')
    		<a href="{{ route('property-types.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> New Property Type</a>
    		<br />
    		<br />
    		<table class="table table-bordered table-striped data-table">
    			<thead>
    				<th>ID</th>
    				<th>Name</th>
    				<th>Actions</th>
    			</thead>
    			<tbody>
    				@foreach($propertytypes as $propertytype)
    				<tr>
    					<td>{{ $propertytype->id }}</td>
    					<td>{{ $propertytype->name }}</td>
    					<td>
    						<a href="{{ route('property-types.edit',['id' => $propertytype->id]) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Update</a>
    						{!! Form::open(['method' => 'DELETE', 'style' => 'display:inline;','route' => ['property-types.destroy', $propertytype->id]],null,null,['style' => 'display:inline;']) !!}
    							{!! Form::button('<i class="fa fa-times"></i> Delete', ['type' => 'sumit', 'class' => 'btn btn-danger delete-record']) !!}
    						{!! Form::close() !!}
    					</td>
    				</tr>
    				@endforeach
    			</tbody>
    		</table>
    	</div>
    </div>
@endsection