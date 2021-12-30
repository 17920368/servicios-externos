@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 col-xs-12">
                <div class="card">
                    <div class="card-header">{{ __('AGREGAR PROYECTO') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('proyecto.store') }}" class="needs-validation" novalidate>
                            {{ csrf_field() }}
                            <div class="mb-3">
                                <label for="txtNombre" class="form-label">NOMBRE DEL PROYECTO</label>
                                <input type="text" class="form-control" name="txtNombre" id="txtNombre"
                                    onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                            </div>
                            <div class="form-group">
                                <label for="sltPeriodo" class="form-label">PERIODO</label>
                                <select name="sltPeriodo" class="form-select"
                                    onChange="agregarID(sltPeriodo, txtIdPeriodo)" required>
                                    <option selected disabled value="">ELIJA EL PERIODO</option>
                                    @foreach ($periodos as $periodo)
                                        <option value="{{ $periodo->idPeriodo }}">{{ $periodo->periodo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sltAlumno" class="form-label">ALUMNO</label>
                                <select name="sltAlumno" class="form-select" onChange="agregarID(sltAlumno, txtIdAlumno)"
                                    required>
                                    <option selected disabled value="">ELIJA ALUMNO</option>
                                    @foreach ($alumnos as $alumno)
                                        <option value="{{ $alumno->idAlumno }}">{{ $alumno->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sltModalidad" class="form-label">MODALIDAD</label>
                                <select name="sltModalidad" id="sltModalidad" class="form-select"
                                    onChange="agregarIDYOcultarAsesores(sltModalidad, txtModalidad)" required>
                                    <option selected disabled value="">ELIJA LA MODALIDAD</option>
                                    <option value="SERVICIO SOCIAL">SERVICIO SOCIAL</option>
                                    <option value="RESIDENCIA PROFESIONAL">RESIDENCIA PROFESIONAL</option>
                                </select>
                            </div>
                            <div class="form-group" id="divAsesorInterno">
                            </div>
                            <div class="form-group" id="divAsesorExterno">
                            </div>
                            <div class="form-group">
                                <label for="sltInstancia" class="form-label">INSTANCIA</label>
                                <select name="sltInstancia" class="form-select"
                                    onChange="agregarID(sltInstancia, txtIdInstancia)" required>
                                    <option selected disabled value="">ELIJA INSTANCIA</option>
                                    @foreach ($instancias as $instancia)
                                        <option value="{{ $instancia->idInstancia }}">{{ $instancia->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <input hidden type="text" name="txtModalidad" id="txtModalidad">
                            <input hidden type="text" name="txtIdPeriodo" id="txtIdPeriodo">
                            <input hidden type="text" name="txtIdAlumno" id="txtIdAlumno">
                            <input hidden type="text" name="txtIdAsesorInterno" id="txtIdAsesorInterno">
                            <input hidden type="text" name="txtIdAsesorExterno" id="txtIdAsesorExterno">
                            <input hidden type="text" name="txtIdInstancia" id="txtIdInstancia">
                            <div class="row g-3">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-plus-square-dotted"></i>
                                    AGREGAR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function agregarIDYOcultarAsesores(idSelector, idInput) {
            let divAsesorInterno = document.getElementById("divAsesorInterno"),
                divAsesorExterno = document.getElementById("divAsesorExterno"),
                asesorInterno,
                asesorExterno;
            let valorSeleccionado = idSelector.value;
            idInput.value = valorSeleccionado;
            if (valorSeleccionado === "RESIDENCIA PROFESIONAL") {
                asesorInterno = `<label for="sltAsesorI" class="form-label">ASESOR INTERNO</label>
                                    <select name="sltAsesorI" class="form-select"
                                    onChange="agregarID(sltAsesorI, txtIdAsesorInterno)" required>
                                    <option selected disabled value="">ELIJA ASESOR INTERNO</option>
                                    @foreach ($asesoresInternos as $asesorInterno)
                                        <option value="{{ $asesorInterno->idAsesorI }}">{{ $asesorInterno->nombre }}
                                        </option>
                                    @endforeach
                                </select>`;
                asesorExterno = ` <label for="sltAsesorE" class="form-label">ASESOR EXTERNO</label>
                                <select name="sltAsesorE" class="form-select"
                                    onChange="agregarID(sltAsesorE, txtIdAsesorExterno)" required>
                                    <option selected disabled value="">ELIJA ASESOR EXTERNO</option>
                                    @foreach ($asesoresExternos as $asesorExterno)
                                        <option value="{{ $asesorExterno->idAsesorE }}">{{ $asesorExterno->nombre }}
                                        </option>
                                    @endforeach
                                </select>`;
            }
            if (valorSeleccionado === "SERVICIO SOCIAL") {
                asesorInterno = "";
                asesorExterno = "";
            }
            divAsesorInterno.innerHTML = asesorInterno;
            divAsesorExterno.innerHTML = asesorExterno;
        }
    </script>
@endsection
