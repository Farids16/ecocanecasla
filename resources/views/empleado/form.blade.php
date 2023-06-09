<h1>Hola {{$modo}} empleado</h1>

    @if(count($errors)>0)

    <div class="alert alert-danger" role="alert">
        <ul>
        @foreach( $errors->all() as $error)        
           <li>{{$error}}</li> 
        @endforeach
    </ul>
    </div>

    @endif

    <div class="form-group">

    <label for="Documento"> Documento </label>
    <input type="text" class="form-control" name="Documento" 
    value="{{ isset($empleado->Documento)?$empleado->Documento:old('Documento')}}" id="Documento">

    <label for="Nombre"> Nombre </label>
    <input type="text" class="form-control" name="Nombre" 
    value="{{ isset($empleado->Nombre)?$empleado->Nombre:old('Nombre')}}" id="Nombre">

    <label for="Apellido"> Apellidos </label>
    <input type="text" class="form-control" name="Apellido" 
    value="{{ isset($empleado->Apellido)?$empleado->Apellido:old('Apellido')}}" id="Apellido">

    <label for="Correo"> Correo </label>
    <input type="mail" class="form-control" name="Correo" 
    value="{{ isset($empleado->Correo)?$empleado->Correo:old('Correo')}}" id="Correo">

    <div style="padding-top: 2%;">
        <label for="FechaNacimiento">Fecha de nacimiento: </label>
    <input type="date"  id="FechaNacimiento" name="FechaNacimiento"
    value="{{ isset($empleado->FechaNacimiento)?$empleado->FechaNacimiento:old('FechaNacimiento')}}">


    <label for="Sexo">Sexo biológico:</label>
    <select  value="{{ isset($empleado->Correo)?$empleado->Correo:''}}" id="Sexo"  name="Sexo">
    <option value="M">Masculino</option>
    <option value="F">Femenino</option>
    </select>
    </div>
    


    <label for="Foto"></label>
    
    <input type="file" class="form-control" name="Foto" value="" id="Foto">
    @if(isset($empleado->Foto))
        <img src="{{ asset('storage').'/'.$empleado->Foto}}" class="img-thumbnail img-fluid" alt="" width="50">
        @endif
    </div>
    <br>

    <input type="submit" class="btn btn-success" value="{{$modo}} datos">

    <a class="btn btn-primary" href="{{url('empleado/') }}">Regresar</a>
    <br>