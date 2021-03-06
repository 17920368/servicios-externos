@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 col-xs-12">
                <div class="card">
                    <div class="card-header">{{ __('AGREGAR INSTANCIA') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('instancia.store') }}" class="needs-validation" novalidate>
                            {{ csrf_field() }}
                            <div class="mb-3">
                                <label for="txtResponsable" class="form-label">NOMBRE</label>
                                <input type="text" class="form-control" name="txtNombre" id="txtNombre" required
                                    onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </div>
                            <div class="mb-3">
                                <label for="txtResponsable" class="form-label">RESPONSABLE</label>
                                <input type="text" class="form-control" name="txtResponsable" id="txtResponsable" required
                                    onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </div>
                            <div class="form-check form-check-inline mb-3">
                                <input class="form-check-input" type="checkbox" id="inlineCheckboxEmail" value="option1">
                                <label class="form-check-label text-uppercase" for="inlineCheckboxEmail">¿Tiene el
                                    email?</label>
                            </div>
                            <div class="form-check form-check-inline mb-3">
                                <input class="form-check-input" type="checkbox" id="inlineCheckboxTel" value="option2">
                                <label class="form-check-label text-uppercase" for="inlineCheckboxTel">¿Tiene el
                                    teléfono?</label>
                            </div>
                            <div class="mb-3" id="divEmail">
                            </div>
                            <div class="mb-3" id="divTelefono">
                            </div>
                            <div class="form-group">
                                <label for="sltGiro" class="form-label">GIRO</label>
                                <select name="sltGiro" class="form-select" onChange="agregarID(sltGiro, txtIdGiro)"
                                    required>
                                    <option selected disabled value="">ELIJA EL GIRO</option>
                                    @foreach ($giros as $giro)
                                        <option value="{{ $giro->idGiro }}">{{ $giro->nomGiro }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sltSector" class="form-label">SECTOR</label>
                                <select name="sltSector" class="form-select" onChange="agregarID(sltSector, txtIdSector)"
                                    required>
                                    <option selected disabled value="">ELIJA EL SECTOR</option>
                                    @foreach ($sectores as $sector)
                                        <option value="{{ $sector->idSector }}">{{ $sector->nomSector }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sltTipoSector" class="form-label">TIPO DE SECTOR</label>
                                <select name="sltTipoSector" class="form-select"
                                    onChange="agregarID(sltTipoSector, txtIdTipoSec)" required>
                                    <option selected disabled value="">ELIJA EL TIPO DE SECTOR</option>
                                    @foreach ($tipoSectores as $tipoSector)
                                        <option value="{{ $tipoSector->idTipoSec }}">{{ $tipoSector->nomTipoSec }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sltTamanio" class="form-label">TAMAÑO</label>
                                <select name="sltTamanio" class="form-select"
                                    onChange="agregarID(sltTamanio, txtIdTamanio)" required>
                                    <option selected disabled value="">ELIJA EL TAMAÑO</option>
                                    @foreach ($tamanios as $tamanio)
                                        <option value="{{ $tamanio->idTamanio }}">{{ $tamanio->nomTamanio }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sltAreaConocimiento" class="form-label">ÁREA DE CONOCIMIENTO</label>
                                <select name="sltAreaConocimiento" class=" form-select"
                                    onChange="agregarID(sltAreaConocimiento, txtIdAreaC)" required>
                                    <option selected disabled value="">ELIJA EL ÁREA DE CONOCIMIENTO</option>
                                    @foreach ($areaConocimientos as $areaConocimiento)
                                        <option value="{{ $areaConocimiento->idAreaC }}">
                                            {{ $areaConocimiento->nomAreaC }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sltAlcance" class="form-label">ALCANCE</label>
                                <select name="sltAlcance" class="form-select"
                                    onChange="agregarID(sltAlcance, txtIdAlcance)" required>
                                    <option selected disabled value="">ELIJA EL ALCANCE</option>
                                    @foreach ($alcances as $alcance)
                                        <option value="{{ $alcance->idAlcance }}">{{ $alcance->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="text" hidden name="txtIdGiro" id="txtIdGiro">
                            <input type="text" hidden name="txtIdSector" id="txtIdSector">
                            <input type="text" hidden name="txtIdTipoSec" id="txtIdTipoSec">
                            <input type="text" hidden name="txtIdTamanio" id="txtIdTamanio">
                            <input type="text" hidden name="txtIdAreaC" id="txtIdAreaC">
                            <input type="text" hidden name="txtIdAlcance" id="txtIdAlcance">
                            <br>
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
        /* -------------------------------------------------------------------------- */
        /*                  Habilitar y Deshabilitar email y telefono                 */
        /* -------------------------------------------------------------------------- */
        inlineCheckboxEmail.addEventListener("click", (e) => {
            let email = "";
            if (inlineCheckboxEmail.checked) {
                email = `<label for="txtEmail" class="form-label">EMAIL</label>
                                <input type="email" class="form-control" name="txtEmail" id="txtEmail"
                                    onkeyup="javascript:this.value=this.value.toUpperCase();" required>`;
            } else {
                email = "";
            }
            divEmail.innerHTML = email;
        });
        inlineCheckboxTel.addEventListener("click", (e) => {
            let telefono = "";
            if (inlineCheckboxTel.checked) {
                telefono = `<label for="txtTelefono" class="form-label">TELÉFONO</label>
                                <input type="tel" class="form-control" name="txtTelefono" id="txtTelefono"
                                    onkeyup="javascript:this.value=this.value.toUpperCase();" required>`;
            } else {
                telefono = "";

            }
            divTelefono.innerHTML = telefono;
        });
    </script>
@endsection
