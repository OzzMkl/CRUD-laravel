<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container">

    <h3>Agregar producto</h3>

    <form action="{{url('/producto')}}" method="post" enctype="multipart/form-data">
        @csrf
        @include('producto.form')
    </form>

</div>
<script src="{{ asset('js/app.js') }}" defer></script>