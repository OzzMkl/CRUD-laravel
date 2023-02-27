@php
    use Illuminate\Support\Facades\Currency;
@endphp
<link href="{{ asset('css/app.css') }}" rel="stylesheet">


<div class="container">
    <h3> Vista de productos</h3>
    
    @if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <div>
            {{ Session::get('mensaje')}}
        </div>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <a class="btn btn-success" href="{{url('/producto/create')}}"> Registrar producto</a><br><br>

    
        <form action="{{ route('producto.index') }}" class="d-flex justify-content-end" method="GET" >
            <select class="form-select" name="tipoBusqueda" id="tipoBusqueda">
                <option value="1" selected>Nombre</option>
                <option value="2">Precio</option>
                <option value="3">Descripcion</option>
            </select>
            <input class="form-control me-2" type="search" name="busqueda" id="busqueda" >
            <input class="form-control me-2" type="search" name="precio1" id="precio1" placeholder="$" >
            <input class="form-control me-2" type="search" name="precio2" id="precio2" placeholder="$$$$" >
            <input class="btn btn-primary" type="submit" value="Buscar">
        </form>
    
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Precio</th>
                <th scope="col">Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $Producto as $p)
            <tr>
                <td >{{$p -> id}}</td>
                <td >{{$p -> nombre}}</td>
                <td >{{$p -> descripcion}}</td>
                <td >${{ number_format($p -> precio, 2)}}</td>
                <td >

                    <a class="btn btn-warning" href="{{url('/producto/'.$p->id.'/edit')}}">
                        Editar
                    </a>
                    <form action="{{url('/producto/'.$p->id)}}" class="d-inline" method="post" >
                        @csrf
                        {{ method_field('DELETE')}}
                        <input class="btn btn-danger" type="submit" onclick="return confirm('¿Desea borrar?')" 
                                value="Borrar">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $Producto -> links() !!}
</div>

<script src="{{ asset('js/app.js') }}" defer></script>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script language="JavaScript" type="text/javascript">
    $(document).ready(function(){
                $("#precio1").hide();
                $("#precio2").hide();
        $("#tipoBusqueda").change(function(){
            if($(this).val() == '1'){
                $("#busqueda").show();
                $("#precio1").hide();
                $("#precio2").hide();
            } 
            if($(this).val() == '2'){
                $("#busqueda").hide();
                $("#precio1").show();
                $("#precio2").show();
            }
        });
    });
</script>
