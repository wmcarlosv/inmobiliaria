@extends('adminlte::page')
@section('title', 'New Direction')
@section('content_header')
    <h1>Directions</h1>
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
    		<h2>New Direction</h2>
    	</div>
    	<div class="panel-body">
    		{!! Form::open(['route' => 'directions.store']) !!}
            <div class="form-group">
                {!! Form::label('departament', 'Departament: ') !!}
                {!! Form::text('departament',null,['id' => 'departament', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('zone', 'Zone: ') !!}
                {!! Form::text('zone',null,['id' => 'zone', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('ubication', 'Ubication: ') !!}
                {!! Form::text('ubication',null,['id' => 'ubication', 'class' => 'form-control']) !!}
            </div>
            {!! Form::button('<i class="fa fa-floppy-o"></i> Save', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
            <a href="{{ route('directions.index') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>
            {!! Form::close() !!}
    	</div>
    </div>
@endsection