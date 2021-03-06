@extends('adminlte::page')
@section('title', 'Nueva Propiedad')
@section('content_header')
    <h1>Propiedades</h1>
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
    		<h2>Nueva Propiedad</h2>
    	</div>
    	<div class="panel-body">
            {!! Form::open(['route' => 'properties.store', 'files' => true]) !!}

            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Datos</a></li>
                <li><a data-toggle="tab" href="#menu1">Amenidades</a></li>
                <li><a data-toggle="tab" href="#menu2">Caracteristicas</a></li>
                <li><a data-toggle="tab" href="#menu3">Fotos</a></li>
            </ul>
    		<br />
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="form-group">
                        {!! Form::label('departament_id', 'Departamento: ') !!}
                        {!! Form::select('departament_id',$departaments,null,['class' => 'form-control', 'style'=>'width:100%;', 'id' => 'departament_id']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('city_id', 'Ciudad: ') !!}
                        {!! Form::select('city_id',['' => '-'],NULL,['class' => 'form-control', 'style'=>'width:100%;', 'id' => 'city_id']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('zone_id', 'Zona: ') !!}
                        {!! Form::select('zone_id',['' => '-'],NULL,['class' => 'form-control', 'style'=>'width:100%;', 'id' => 'zone_id']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('address', 'Dirección: ') !!}
                        {!! Form::textarea('address',null,['id' => 'address', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('property_type_id', 'Tipo de Propiedad: ') !!}
                        {!! Form::select('property_type_id',$propertytypes,null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('management_id', 'Gestion: ') !!}
                        {!! Form::select('management_id',$managements,null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Descripción: ') !!}
                        {!! Form::textarea('description',null,['id' => 'description', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('price', 'Precio: ') !!}
                        {!! Form::text('price',null,['id' => 'precio', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('stratum', 'Estrato: ') !!}
                        {!! Form::text('stratum',null,['id' => 'stratum', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('square_meter', 'Metros Cuadrados: ') !!}
                        {!! Form::text('square_meter',null,['id' => 'square_meter', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('consultant_id', 'Asesor: ') !!}
                        {!! Form::select('consultant_id',$consultants,null,['class' => 'form-control select-2-single', 'style'=>'width:100%;']) !!}
                    </div>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <ul class="list-group">
                        @foreach($amenities as $amenity)
                            <li class="list-group-item">{!! Form::checkbox('amenities[]', $amenity->id, false) !!} {{ $amenity->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <ul class="list-group">
                        @foreach($features as $feature)
                            <li class="list-group-item">{!! Form::checkbox('features[]', $feature->id, false) !!} {{ $feature->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div id="menu3" class="tab-pane fade">
                    {!! Form::button('<i class="fa fa-plus"></i> Agregar Foto',['type' => 'button', 'class' => 'btn btn-success','id' => 'agregar-foto']) !!}
                    <br />
                    <br />
                    <ul class="list-group" id="file-list">
                        <li class="list-group-item" id="por_defecto"><center>Sin Imagenes</center></li>
                    </ul>
                </div>
                {!! Form::button('<i class="fa fa-floppy-o"></i> Guardar', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                <a href="{{ route('properties.index') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
                {!! Form::close() !!}
            </div>
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

        $("#city_id").change(function(){
            var id = $(this).val();
            var url = '{{ asset("admin") }}/zones/'+id;
            $("#zone_id").empty();
            $("#zone_id").append("<option value=''>-</option>");
            $.get(url, function(response){
                if(response.length > 0){
                    var data = JSON.parse(response);
                    $.each(data, function(index, obj){
                        $("#zone_id").append("<option value='"+obj.id+"'>"+obj.name+"</option>");
                    });  
                }
            });
        });


        $("#agregar-foto").click(function(){

            $("#file-list").append('<li class="list-group-item" data-photo="si"><input type="file" name="photos[]" style="display:inline; width:80%;" /><button type="button" class="btn btn-danger remove-file">X</button></li>');

            $("#por_defecto").remove();
        });

        $("body").on('click','button.remove-file',function(){
            var fotos = document.getElementsByTagName("li");
            var contador = 0;

            for(var i=0; i< fotos.length; i++){

                if(fotos[i].getAttribute("data-photo") == "si"){
                    contador++;
                }

            }

            if(contador == 1){
                $("#file-list").append('<li class="list-group-item" id="por_defecto" data-photo="si"><center>Sin Imagenes</center></li>');
            }

            $(this).parent().remove();
        });
    });
</script>
@stop