@extends('adminlte::page')
@section('title', 'Update Consultant')
@section('content_header')
    <h1>Consultants</h1>
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
    		<h2>Update Consultant</h2>
    	</div>
    	<div class="panel-body">
    		{!! Form::open(['method' => 'PUT','files' => true, 'route' => ['consultants.update', $consultant->id]]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name',$consultant->name,['id' => 'name', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('phone', 'Phone: ') !!}
                {!! Form::text('phone',$consultant->phone,['id' => 'phone', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Email: ') !!}
                {!! Form::text('email',$consultant->email,['id' => 'email', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('direction', 'Direction: ') !!}
                {!! Form::text('direction',$consultant->direction,['id' => 'direction', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('avatar', 'Avatar: ') !!}
                @if(isset($consultant->avatar) and !empty($consultant->avatar))
                    <img src="{{ asset('storage/avatars') }}/{{ $consultant->avatar }}" id="image-show" width="100" height="140" class="img-thumbnail">
                    {!! Form::button('<i class="fa fa-times"></i> Delete Image',['type' => 'button', 'class' => 'btn btn-danger', 'id' => 'delete-imagen', 'data-id' => $consultant->id]) !!}
                    {!! Form::file('avatar',['id' => 'avatar', 'class' => 'form-control', 'style' => 'display:none;']) !!}
                @else
                    {!! Form::file('avatar',['id' => 'avatar', 'class' => 'form-control']) !!}
                @endif
            </div>
            {!! Form::button('<i class="fa fa-floppy-o"></i> Save', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
            <a href="{{ route('consultants.index') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>
            {!! Form::close() !!}
    	</div>
    </div>
@endsection
@section("js")
<script type="text/javascript">
    $(document).ready(function(){
        $("#delete-imagen").click(function(){
            var id = $(this).attr("data-id");

            $.get('/admin/consultants/destroyimage/'+id, function( response ){
                var m = JSON.parse(response);

                if(m.message == "delete"){
                    alert("Avatar Delete SuccessFully");
                    $("#avatar").show();
                    $("#image-show, #delete-imagen").hide();
                }

            });
        });
    });
</script>
@endsection