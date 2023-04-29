<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datos['empleados']=Empleado::paginate(2);
        return view('empleado.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     //* @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     //* @param \Illuminate\Http\Request
     //* @return \Illuminate\Http\Response
     //*/
    public function store(Request $request)
    {
        //

        $campos=[
            'Documento'=>'required|unique:empleados|string|max:20',
            'Nombre'=>'required|string|max:100',
            'Apellido'=>'required|string|max:100',
            'Correo'=>'required|unique:empleados|email',
            'FechaNacimiento'=>'required|date',
            'Sexo'=>'required|string|max:100',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg'
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La Foto es requerida',
            'FechaNacimiento.required'=>'La Fecha de Nacimiento es requerida',
            'Documento.unique' => 'El documento ya existe en la base de datos. Por favor ingrese otro.',
            'Correo.unique' => 'El correo ya existe. Por favor ingrese otro.'
        ];

            $this->validate($request, $campos, $mensaje);

       //$datosEmpleado = request()->all();
        $datosEmpleado = request()->except('_token');

        if ($request->hasFile('Foto')) {

            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads', 'public');
        }

        Empleado::insert($datosEmpleado);
        //return response()->json($datosEmpleado);
        return redirect('empleado')->with('mensaje','Empleado agregado con exito');

    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $empleado=Empleado::findOrFail($id);
        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $campos=[
            'Documento'=>'required|string|max:20',
            'Nombre'=>'required|string|max:100',
            'Apellido'=>'required|string|max:100',
            'Correo'=>'required|email',
            'FechaNacimiento'=>'required|date',
            'Sexo'=>'required|string|max:100',
            
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido'
            
        ];

        if ($request->hasFile('Foto')) {
            $campos= ['Foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=['Foto.required'=>'La Foto es requerida'];
        }

            $this->validate($request, $campos, $mensaje);


        //
        $datosEmpleado = request()->except(['_token','_method']);
        
        if ($request->hasFile('Foto')) {
            $empleado=Empleado::findOrFail($id);
            Storage::delete('public/'.$empleado->Foto);
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads', 'public');
        }
        
        Empleado::where('id','=',$id)->update($datosEmpleado);

        $empleado=Empleado::findOrFail($id);
        //return view('empleado.edit', compact('empleado'));
        return redirect('empleado')->with('mensaje','Empleado Modificado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $empleado=Empleado::findOrFail($id);
        if(Storage::delete('public/'.$empleado->Foto)){
            Empleado::destroy($id);
        }
        
        return redirect('empleado')->with('mensaje','Empleado Borrado');
    }
}
