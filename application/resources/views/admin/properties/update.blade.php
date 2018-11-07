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
    		{!! Form::open(['method' => 'PUT', 'route' => ['properties.update', $property->id]]) !!}
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
                        {!! Form::label('direction_id', 'Dirección: ') !!}
                        {!! Form::select('direction_id',$directions,$property->direction_id,['class' => 'form-control select-2-single', 'style'=>'width:100%;']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('property_type_id', 'Tipo de Inmobiliaria: ') !!}
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
                            <li class="list-group-item">{!! Form::checkbox('features[]', $feature->id, false) !!} {{ $feature->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div id="menu3" class="tab-pane fade">
                    {!! Form::button('<i class="fa fa-plus"></i> Agregar Foto',['type' => 'button', 'class' => 'btn btn-success','id' => 'agregar-foto']) !!}
                    <br />
                    <br />
                    <ul class="list-group" id="file-list"></ul>
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

        $("#agregar-foto").click(function(){
            $("#file-list").append('<li class="list-group-item"><input type="file" name="photos[]" style="display:inline; width:80%;" /><button type="button" class="btn btn-danger remove-file">X</button></li>');
        });

        $("body").on('click','button.remove-file',function(){
            $(this).parent().remove();
        });

        @foreach($property->amenities as $amenity)
            $("#amenity_{{$amenity->id }}").prop('checked', true);
        @endforeach

    });
</script>
@stop