@extends('adminlte::page')
@section('title', 'Managements')
@section('content_header')
    <h1>Managements</h1>
@stop

@section('content')
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>All Managements</h2>
    	</div>
    	<div class="panel-body">
    		@include('flash::message')
    		<a href="{{ route('managements.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> New Management</a>
    		<br />
    		<br />
    		<table class="table table-bordered table-striped data-table">
    			<thead>
    				<th>ID</th>
    				<th>Name</th>
    				<th>Actions</th>
    			</thead>
    			<tbody>
    				@foreach($managements as $management)
    				<tr>
    					<td>{{ $management->id }}</td>
    					<td>{{ $management->name }}</td>
    					<td>
    						<a href="{{ route('managements.edit',['id' => $management->id]) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Update</a>
    						{!! Form::open(['method' => 'DELETE', 'style' => 'display:inline;','route' => ['managements.destroy', $management->id]],null,null,['style' => 'display:inline;']) !!}
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