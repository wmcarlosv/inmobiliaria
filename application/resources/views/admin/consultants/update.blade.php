@extends('adminlte::page')
@section('title', 'Actualizar Asesor')
@section('content_header')
    <h1>Asesores</h1>
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
    		<h2>Actualizar Asesor</h2>
    	</div>
    	<div class="panel-body">
    		{!! Form::open(['method' => 'PUT','files' => true, 'route' => ['consultants.update', $consultant->id]]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Nombre: ') !!}
                {!! Form::text('name',$consultant->name,['id' => 'name', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('phone', 'Telefono: ') !!}
                {!! Form::text('phone',$consultant->phone,['id' => 'phone', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Correo: ') !!}
                {!! Form::text('email',$consultant->email,['id' => 'email', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('direction', 'Dirección: ') !!}
                {!! Form::text('direction',$consultant->direction,['id' => 'direction', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('avatar', 'Foto: ') !!}
                @if(isset($consultant->avatar) and !empty($consultant->avatar))
                    <img src="{{ asset('application/storage/app/public/avatars') }}/{{ $consultant->avatar }}" id="image-show" width="100" height="140" class="img-thumbnail">
                    {!! Form::button('<i class="fa fa-times"></i> Eliminar Foto',['type' => 'button', 'class' => 'btn btn-danger', 'id' => 'delete-imagen', 'data-id' => $consultant->id]) !!}
                    {!! Form::file('avatar',['id' => 'avatar', 'class' => 'form-control', 'style' => 'display:none;']) !!}
                @else
                    {!! Form::file('avatar',['id' => 'avatar', 'class' => 'form-control']) !!}
                @endif
            </div>
            {!! Form::button('<i class="fa fa-floppy-o"></i> Guardar', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
            <a href="{{ route('consultants.index') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
            {!! Form::close() !!}
    	</div>
    </div>
@endsection
@section("js")
<script type="text/javascript">
    $(document).ready(function(){
        $("#delete-imagen").click(function(){
            var id = $(this).attr("data-id");
            var url = '{{ asset("/admin/consultants/destroyimage") }}/'+id;
            console.log(url);
            $.get(url, function( response ){
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