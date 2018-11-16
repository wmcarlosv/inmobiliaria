@extends('adminlte::page')
@section('title', 'Actualizar Caracteristica')
@section('content_header')
    <h1>Caracteristicas</h1>
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
    		<h2>Actualizar Caracteristica</h2>
    	</div>
    	<div class="panel-body">
    		{!! Form::open(['method' => 'PUT', 'route' => ['properties.update', $property->id], 'files' => true]) !!}
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
                        {!! Form::select('departament_id',$departaments,$property->city->departament->id,['class' => 'form-control', 'style'=>'width:100%;', 'id' => 'departament_id']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('city_id', 'Ciudad: ') !!}
                        {!! Form::select('city_id',$cities,$property->city_id,['class' => 'form-control', 'style'=>'width:100%;', 'id' => 'city_id']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('address', 'Dirección: ') !!}
                        {!! Form::textarea('address',$property->address,['id' => 'address', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('property_type_id', 'Tipo de Propiedad: ') !!}
                        {!! Form::select('property_type_id',$propertytypes,$property->property_type_id,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('management_id', 'Gestion: ') !!}
                        {!! Form::select('management_id',$managements,$property->management_id,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Descripción: ') !!}
                        {!! Form::textarea('description',$property->description,['id' => 'description', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('price', 'Precio: ') !!}
                        {!! Form::text('price',$property->price,['id' => 'precio', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('stratum', 'Estrato: ') !!}
                        {!! Form::text('stratum',$property->stratum,['id' => 'stratum', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('square_meter', 'Metros Cuadrados: ') !!}
                        {!! Form::text('square_meter',$property->square_meter,['id' => 'square_meter', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('consultant_id', 'Asesor: ') !!}
                        {!! Form::select('consultant_id',$consultants,$property->consultant_id,['class' => 'form-control select-2-single', 'style'=>'width:100%;']) !!}
                    </div>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <ul class="list-group">
                        @foreach($amenities as $amenity)
                            <li class="list-group-item">{!! Form::checkbox('amenities[]', $amenity->id, false, ['id' => 'amenity_'.$amenity->id]) !!} {{ $amenity->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <ul class="list-group">
                        @foreach($features as $feature)
                            <li class="list-group-item">{!! Form::checkbox('features[]', $feature->id, false, ['id' => 'feature_'.$feature->id]) !!} {{ $feature->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div id="menu3" class="tab-pane fade">
                    {!! Form::button('<i class="fa fa-plus"></i> Agregar Foto',['type' => 'button', 'class' => 'btn btn-success','id' => 'agregar-foto']) !!}
                    <br />
                    <br />
                    <ul class="list-group" id="file-list">
                        @if( count($photos) > 0 )
                            @foreach($photos as $photo)
                                <li class="list-group-item" id="photo_{{ $photo->id }}">
                                    <img src="{{ asset('application/storage/app/public/photos') }}/{{ $photo->url }}" width="80" height="100" class="img-thumbnail">
                                    {{ Form::button('<i class="fa fa-times"></i> Eliminar Imagen',['type' => 'button', 'class' => 'delete-photo btn btn-danger','data-id' => $photo->id]) }}
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item" id="por_defecto"><center>Sin Imagenes</center></li>
                        @endif
                    </ul>
                </div>
                {!! Form::button('<i class="fa fa-floppy-o"></i> Guardar', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                <a href="{{ route('properties.index') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
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

            console.log(contador);

            $(this).parent().remove();
        });

        $(".delete-photo").click(function(){
            if(confirm("Esta seguro de elimiar esta foto?")){
               var id = $(this).attr("data-id");
                var url = "{{ asset('/admin/properties/delete_photo') }}/"+id;

                $.get(url, function( response ){
                    var data = JSON.parse(response);

                    if(data.borrado.trim() == 'si'){

                        alert("Imagen borrada con Exito!!");
                        $("#photo_"+id).remove();
                    }

                }); 

            }
        });

        @foreach($property->amenities as $amenity)
            $("#amenity_{{$amenity->id }}").prop('checked', true);
        @endforeach

        @foreach($property->features as $feature)
            $("#feature_{{ $feature->id }}").prop('checked', true);
        @endforeach

    });
</script>
@stop