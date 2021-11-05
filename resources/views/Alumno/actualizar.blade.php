@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 col-xs-12">
                <div class="card">
                    <div class="card-header">{{ __('ALUMNO') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('alumno.update', $alumnos->idAlumno) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="mb-3">
                                <label for="txtNombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="txtNombre" id="txtNombre"
                                    value="{{ $alumnos->alumno }}"
                                    onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </div>
                            <div class="mb-3">
                                <label for="txtEmail" class="form-label">Email</label>
                                <input type="text" class="form-control" name="txtEmail" id="txtEmail"
                                    value="{{ $alumnos->alumno }}"
                                    onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </div>
                            <div class="mb-3">
                                <label for="txtTelefono" class="form-label">Telefono</label>
                                <input type="text" class="form-control" name="txtTelefono" id="txtTelefono"
                                    value="{{ $alumnos->alumno }}"
                                    onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection