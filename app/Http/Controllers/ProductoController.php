<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tipoBusqueda = $request->tipoBusqueda;
        $busqueda = $request->busqueda;
        $precio1 = $request->precio1;
        $precio2 = $request->precio2;

        switch($tipoBusqueda){
            case 1:
                    $datosProducto['Producto'] = Producto::where('nombre','like','%'.$busqueda.'%')
                                                    ->orderBy('nombre','asc')->paginate(5);
                    return view('producto.index',$datosProducto)->with('mensaje','La busqueda no devolvio resultado');
                break;
            case 2:
                    $datosProducto['Producto'] = Producto::whereBetween('precio',[$precio1,$precio2])
                                                    ->orderBy('nombre','asc')->paginate(5);
                    return view('producto.index',$datosProducto)->with('mensaje','option2');
                break;
            case 3:
                    $datosProducto['Producto'] = Producto::where('descripcion','like','%'.$busqueda.'%')
                                                    ->orderBy('nombre','asc')->paginate(5);
                return view('producto.index',$datosProducto);
            break;
            default:
                    $datosProducto['Producto'] = Producto::orderBy('nombre','asc')->paginate(5);
                    return view('producto.index',$datosProducto)->with('mensaje','defailt');
                break;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('producto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Creamos el array de datos a validar
        $validacion = [
            'nombre_producto' => 'required|string|max:100',
            'descripcion_producto' => 'required|string|max:150',
            'precio_producto' => 'required|numeric',
        ];
        //mesaje si falla la validacion
        $msg=[
            'required'=>' El campo :attribute es requerido'
        ];

        $this->validate($request, $validacion,$msg);
        //De lo que recibimos eliminados el token ya que no se va a ocupar
        $datosProducto = request()->except('_token');

        //creamos el modelo a guardar
        $producto = new Producto();
        $producto -> nombre = $datosProducto['nombre_producto'];
        $producto -> descripcion = $datosProducto['descripcion_producto'];
        $producto -> precio = $datosProducto['precio_producto'];
        $producto -> save();//guardamos

        //retornamos la vista junto con un mensaje de exito
        return redirect('/producto')->with('mensaje','Producto creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datosProducto = Producto::findOrFail($id);
        return view('producto.edit',compact('datosProducto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Creamos el array de datos a validar
        $validacion = [
            'nombre_producto' => 'required|string|max:100',
            'descripcion_producto' => 'required|string|max:150',
            'precio_producto' => 'required|numeric',
        ];
        //mesaje si falla la validacion
        $msg=[
            'required'=>' El campo :attribute es requerido'
        ];

        $this->validate($request, $validacion,$msg);

        $datosProducto = request()->except('_token','_method');

        $producto = Producto::where('id',$id)
                                ->update([
                                    'nombre'    =>  $datosProducto['nombre_producto'],
                                    'descripcion'=> $datosProducto['descripcion_producto'],
                                    'precio'    =>  $datosProducto['precio_producto']
                                ]);

        return redirect('/producto')->with('mensaje','Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Producto::destroy($id);
        return redirect('/producto')->with('mensaje','Producto eliminado correctamente');
    }
}
