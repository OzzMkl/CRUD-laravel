<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container">
    <h3>Editar producto</h3>
    <form action="{{url('/producto/'.$datosProducto->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field('PATCH') }}
        @include('producto.form')

    </form>
</div>
<script src="{{ asset('js/app.js') }}" defer></script>
