@extends('adminlte::page')
@section('title', 'Update Property Type')
@section('content_header')
    <h1>Property Types</h1>
@stop

@section('content')
    <div class="panel panel-default">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    	<div class="panel-heading">
    		<h2>Update Property Type</h2>
    	</div>
    	<div class="panel-body">
    		{!! Form::open(['method' => 'PUT', 'route' => ['property-types.update', $propertytype->id]]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name',$propertytype->name,['id' => 'name', 'class' => 'form-control']) !!}
            </div>
            {!! Form::button('<i class="fa fa-floppy-o"></i> Save', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
            <a href="{{ route('property-types.index') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>
            {!! Form::close() !!}
    	</div>
    </div>
@endsection