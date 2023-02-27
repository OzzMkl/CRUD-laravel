@if(count($errors)>0)
    <div class="alert alert-danger">
        <ul>
            @foreach( $errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>
@endif

<div class="form-group">
    <label class="form-label" for="">Nombre producto</label>
    <input class="form-control" type="text" name="nombre_producto" id="nombre_producto"
            value="{{ isset($datosProducto->nombre)?$datosProducto->nombre:old('nombre_producto')}}">
</div>

<div class="form-group">
    <label class="form-label" for="nombre_producto">Descripcion producto</label>
    <input class="form-control" type="text" name="descripcion_producto" id="descripcion_producto"
            value="{{ isset($datosProducto->descripcion)?$datosProducto->descripcion:old('descripcion_producto')}}">
</div>

<div class="form-group">
    <label class="form-label" for="precio_producto">Precio producto</label>
    <input class="form-control" type="text" name="precio_producto" id="precio_producto" 
            value="{{ isset($datosProducto->precio)?$datosProducto->precio:old('precio_producto')}}">
</div>

<br>

<a class="btn btn-dark" href="{{url('/producto')}}"> Regresar</a>
<input class="btn btn-success" type="submit" value="Enviar"></button>