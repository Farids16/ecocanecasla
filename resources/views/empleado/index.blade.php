@extends('layouts.app')
@section('content')
<div class="container">

    
        @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
        @endif
        


    <a href="{{url('empleado/create') }}" class="btn btn-success" >Registrar Nuevo Empleado</a>
    <br><br>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Documento</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Fecha de Nacimiento</th>
                <th>Sexo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $empleados as $empleado)
            <tr>
                <td>{{ $empleado->id}}</td>

                <td>
                    <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->Foto}}" alt="" width="50">
                </td>
                <td>{{ $empleado->Documento}}</td>
                <td>{{ $empleado->Nombre}}</td>
                <td>{{ $empleado->Apellido}}</td>
                <td>{{ $empleado->Correo}}</td>
                <td>{{ $empleado->FechaNacimiento}}</td>
                <td>{{ $empleado->Sexo}}</td>
                <td>
                    <a href="{{url('/empleado/'.$empleado->id.'/edit/')}}" class="btn btn-primary"> 

                        Editar

                    </a>

                    <form action="{{ url('/empleado/'.$empleado->id) }}" class="d-inline" method="post" >
                        @csrf
                        {{method_field('DELETE')}}
                        <input type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar" class="btn btn-danger">
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {!! $empleados->links() !!}
</div>
@endsection