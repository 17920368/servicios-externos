@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('tamanio.update', $tamanios->idTamanio) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label for="txtNombre" class="form-label">Tamaño</label>
                <input type="text" class="form-control" name="txtNombre" id="txtNombre"
                    value="{{ $tamanios->nomTamanio }}">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection