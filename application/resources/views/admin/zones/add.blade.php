@extends('adminlte::page')
@section('title', 'Nueva Zona')
@section('content_header')
    <h1>Zonas</h1>
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
    		<h2>Nuevo Departamento</h2>
    	</div>
    	<div class="panel-body">
    		{!! Form::open(['route' => 'zones.store']) !!}
            <div class="form-group">
                {!! Form::label('departament_id', 'Departamento: ') !!}
                {!! Form::select('departament_id',$departaments,NULL,['id' => 'departament_id', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('city_id', 'Ciudad: ') !!}
                {!! Form::select('city_id',['' => '-'],NULL,['id' => 'city_id', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('name', 'Nombre: ') !!}
                {!! Form::text('name',null,['id' => 'name', 'class' => 'form-control']) !!}
            </div>
            {!! Form::button('<i class="fa fa-floppy-o"></i> Guardar', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
            <a href="{{ route('zones.index') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
            {!! Form::close() !!}
    	</div>
    </div>
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function(){

        $("#departament_id").change(function(){
            var id = $(this).val();
            var url = '{{ asset("admin/cities/citiesForDepartament") }}/'+id;
            $("#city_id").empty();
            $("#city_id").append("<option value=''>-</option>");
            $.get(url, function(response){
                if(response.length > 0){
                    var data = JSON.parse(response);
                    $.each(data, function(index, obj){
                        $("#city_id").append("<option value='"+obj.id+"'>"+obj.name+"</option>");
                    });  
                }
            });
        });
        
    });
</script>
@stop