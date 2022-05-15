@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 col-xs-12">
                <div class="card">
                    <div class="card-header">{{ __('MODIFICAR CONVENIO') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('convenio.update', $convenios->idConvenio) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="mb-3">
                                <label for="txtFolio" class="form-label">FOLIO</label>
                                <input type="text" class="form-control" name="txtFolio" id="txtFolio"
                                    value="{{ $convenios->folio }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="dateFechaFirma" class="form-label">FECHA DE FIRMA</label>
                                <input type="date" class="form-control" name="dateFechaFirma" id="txtFechaF"
                                    value="{{ $convenios->fechaFirma }}" required>
                            </div>
                            <div class="form-group">
                                <label for="sltTipoFecha" class="form-label">TIPO DE FECHA DE VIGENCIA</label>
                                <select name="sltTipoFecha" id="sltTipoFecha" class="form-select"
                                    onChange="validarTipoFecha(sltTipoFecha)" required>
                                    @if ($convenios->vigenciaIndefinida == 'NO')
                                        <option>ELIJA EL TIPO DE FECHA</option>
                                        <option selected value="NO">POR FECHA</option>
                                        <option value="SI">INDEFINIDO</option>
                                    @else
                                        <option>ELIJA EL TIPO DE FECHA</option>
                                        <option value="NO">POR FECHA</option>
                                        <option selected value="SI">INDEFINIDO</option>
                                    @endif
                                </select>
                            </div>
                            <div hidden class="mb-3" id="divFechaVigencia">
                                <label for="dateFechaVigencia" class="form-label">FECHA DE VIGENCIA</label>
                                <input type="date" class="form-control" name="dateFechaVigencia" id="txtFechaV"
                                    value="{{ $convenios->fechaVigencia }}">
                            </div>
                            <div class="mb-3">
                                <label for="txtFolio" class="form-label">URL DEL CONVENIO</label>
                                <input type="text" class="form-control" name="txtUrlConvenio" id="txtUrlConvenio"
                                    value="{{ $convenios->urlConvenio }}"
                                    onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                            </div>
                            <div class="form-group">
                                <label for="sltEstatus" class="form-label">ESTATUS</label>
                                <select name="sltEstatus" id="sltEstatus" class="form-select"
                                    onChange="agregarID(sltEstatus, txtEstatus)" required>
                                    @if ($convenios->estatus === 'VIGENTE')
                                        <option>ELIJA EL ESTATUS</option>
                                        <option selected value="VIGENTE">VIGENTE</option>
                                        <option value="FINALIZADO">FINALIZADO</option>
                                        <option value="CANCELADO">CANCELADO</option>
                                    @elseif ($convenios->estatus === 'FINALIZADO')
                                        <option>ELIJA EL ESTATUS</option>
                                        <option value="VIGENTE">VIGENTE</option>
                                        <option selected value="FINALIZADO">FINALIZADO</option>
                                        <option value="CANCELADO">CANCELADO</option>
                                    @else
                                        <option>ELIJA EL ESTATUS</option>
                                        <option value="VIGENTE">VIGENTE</option>
                                        <option value="FINALIZADO">FINALIZADO</option>
                                        <option selected value="CANCELADO">CANCELADO</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sltTipo" class="form-label">TIPO DE CONVENIO</label>
                                <select name="sltTipo" id="sltTipo" class="form-select"
                                    onChange="agregarIdOcultarMarco(sltTipo, txtIdTipoCon)" required>
                                    <option>ELIJA EL TIPO DE CONVENIO</option>
                                    @foreach ($tipoConvenios as $tipocon)
                                        @if ($tipocon->idTipoConvenio === $convenios->idTipoCon)
                                            <option selected value="{{ $tipocon->idTipoConvenio }}">
                                                {{ $tipocon->nomTipoConvenio }}
                                            </option>
                                        @else
                                            <option value="{{ $tipocon->idTipoConvenio }}">
                                                {{ $tipocon->nomTipoConvenio }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" id="divIndicador">
                                <label for="sltIndicador" class="form-label">INDICADOR</label>
                                <select name="sltIndicador" id="sltIndicador" class="form-select"
                                    onChange="agregarId(sltIndicador, txtIdIndicador)" required>
                                    <option>ELIJA EL INDICADOR</option>
                                    @foreach ($indicadores as $indicador)
                                        @if ($indicador->idIndicador === $convenios->idIndicador)
                                            <option selected value="{{ $indicador->idIndicador }}">
                                                {{ $indicador->descripcion }}
                                            </option>
                                        @else
                                            <option value="{{ $indicador->idIndicador }}">
                                                {{ $indicador->descripcion }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sltInstancia" class="form-label">INSTANCIA</label>
                                <select name="sltInstancia" id="sltInstancia" class="form-select"
                                    onChange="agregarID(sltInstancia, txtIdInstancia)" required>
                                    <option>ELIJA LA INSTANCIA</option>
                                    @foreach ($instancias as $instancia)
                                        @if ($instancia->idInstancia === $convenios->idInstancia)
                                            <option selected value="{{ $instancia->idInstancia }}">
                                                {{ $instancia->nombre }}
                                            </option>
                                        @else
                                            <option value="{{ $instancia->idInstancia }}">{{ $instancia->nombre }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">CARRERA</label>
                                <div class="div-flex" id="div-flex">
                                    @foreach ($carreras as $carrera)
                                        <div class="form-check col-3">
                                            <input class="form-check-input" type="checkbox"
                                                onclick='crearArregloCarrera(flexCheckChecked_{{ $carrera->idCarrera }})'
                                                value="{{ $carrera->idCarrera }}"
                                                id="flexCheckChecked_{{ $carrera->idCarrera }}">
                                            <label class="form-check-label"
                                                for="flexCheckChecked_{{ $carrera->idCarrera }}">
                                                {{ $carrera->nomCarrera }}
                                            </label>
                                        </div>
                                    @endforeach
                                    <div class="form-check col-3">
                                        <input class="form-check-input" type="checkbox"
                                            onclick='obtenerTodasCarreras({{ $carreras }})'
                                            id="flexCheckChecked_todasCarreras">
                                        <label class="form-check-label" for="flexCheckChecked_todasCarreras">
                                            TODAS LAS CARRERAS
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @if (count($arregloIdCarreras) != count($carreras))
                                @foreach ($arregloIdCarreras as $arregloIdCarrera)
                                    @foreach ($carreras as $carrera)
                                        @if ($carrera->idCarrera == $arregloIdCarrera)
                                            <script>
                                                activarCheck({{ $carrera->idCarrera }});

                                                function activarCheck(idCarrera) {
                                                    let id = "flexCheckChecked_" + idCarrera;
                                                    let carrera = document.getElementById(
                                                        id
                                                    );
                                                    carrera.setAttribute("checked", "");

                                                }
                                            </script>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endif
                            <input hidden type="text" name="txtTipoFecha" id="txtTipoFecha"
                                value="{{ $convenios->vigenciaIndefinida }}">
                            <input hidden type="text" name="txtCarreraObj" id="txtCarreraObj" value="{{ $idCarreras }}">
                            <input hidden type="text" name="txtCarreras" id="txtCarreras"
                                value="{{ $convenios->carreras }}">
                            <input hidden type="text" name="txtIdConvenio" id="txtIdConvenio"
                                value="{{ $convenios->idConvenio }}">
                            <input hidden type="text" name="txtEstatus" id="txtEstatus"
                                value="{{ $convenios->estatus }}">
                            <input hidden type="text" name="txtIdTipoCon" id="txtIdTipoCon"
                                value="{{ $convenios->idTipoCon }}">
                            <input hidden type="text" name="txtIdInstancia" id="txtIdInstancia"
                                value="{{ $convenios->idInstancia }}">
                            <input hidden type="text" name="txtIdIndicador" id="txtIdIndicador"
                                value="{{ $convenios->idIndicador }}">
                            <input hidden type="text" name="txtIdUsuario" id="txtIdUsuario"
                                value=" {{ Auth::user()->id }}">
                            <div class="row g-3">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-eraser"></i>
                                    MODIFICAR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        /* -------------------------------------------------------------------------- */
        /* Activar la casilla de las carreras de acuerdo a la BD */
        /* -------------------------------------------------------------------------- */
        window.onload = function() {
            activarCheckCarreras();
            cargarArregloCarrera();
            validarTipoFecha(sltTipoFecha);
        };

        function activarCheckCarreras() {
            let idCarreras = document.getElementById("txtCarreras").value.split(",");
            let objCarreras = document.getElementById("txtCarreraObj").value.split(",");
            if (objCarreras.length == idCarreras.length) {
                let cbTodasCarreras = document.getElementById(
                    "flexCheckChecked_todasCarreras"
                );
                cbTodasCarreras.setAttribute("checked", "");
            }
        }

        function cargarArregloCarrera() {
            let array2 = [];
            let txtCarrera = document.getElementById("txtCarreras");
            let arregloCarrera = txtCarrera.value.split(",");
            arregloCarrera.forEach((elemento) => {
                array.push(elemento);
            });
            txtCarrera.value = array;
        }
        let txtTipoFecha = document.getElementById("txtTipoFecha");
        let divFechaVigencia = document.getElementById("divFechaVigencia");
        let fechaVigencia = document.getElementById("dateFechaVigencia");

        function validarTipoFecha(idSelector) {
            let valorSeleccionado = idSelector.value;
            if (valorSeleccionado == "SI" || valorSeleccionado == "ELIJA EL TIPO DE FECHA") {
                divFechaVigencia.setAttribute("hidden", "");
                txtTipoFecha.value = "SI";
            } else {
                divFechaVigencia.removeAttribute("hidden");
                txtTipoFecha.value = "NO";
            }
        }
        // (function() {
        //     let txtIndicador = document.getElementById("txtIdIndicador");
        //     if (txtIndicador.value) {
        //         let divIndicador = document.getElementById("divIndicador"),
        //             indicador = "";
        //         indicador = `<label for="sltIndicador" class="form-label">INDICADOR</label>
        //                         <select name="sltIndicador" id="sltIndicador" class="form-select"
        //                             onChange="agregarId(sltIndicador, txtIdIndicador)" required>
        //                             <option>ELIJA EL INDICADOR</option>
        //                             @foreach ($indicadores as $indicador)
        //                                 @if ($indicador->idIndicador === $convenios->idIndicador)
        //                                     <option selected value="{{ $indicador->idIndicador }}">
        //                                         {{ $indicador->descripcion }}
        //                                     </option>
        //                                 @else
        //                                     <option value="{{ $indicador->idIndicador }}">
        //                                         {{ $indicador->descripcion }}
        //                                     </option>
        //                                 @endif
        //                             @endforeach
        //                         </select>`;
        //         divIndicador.innerHTML = indicador;
        //     }
        // })();

        // function agregarIdOcultarMarco(idSelector, idInput) {
        //     let valorSeleccionado = idSelector.value;
        //     idInput.value = valorSeleccionado;
        //     let divIndicador = document.getElementById("divIndicador"),
        //         indicador = "";
        //     if (valorSeleccionado === "3") {
        //         indicador = `<label for="sltIndicador" class="form-label">INDICADOR</label>
        //                         <select name="sltIndicador" id="sltIndicador" class="form-select"
        //                             onChange="agregarID(sltIndicador, txtIdIndicador)">
        //                             <option selected disabled value="">ELIJA EL INDICADOR</option>
        //                             @foreach ($indicadores as $indicador)
        //                                 <option value="{{ $indicador->idIndicador }}">{{ $indicador->descripcion }}
        //                                 </option>
        //                             @endforeach
        //                         </select>`;
        //     } else {
        //         indicador = "";
        //         document.getElementById("txtIdIndicador").value = "";
        //     }
        //     divIndicador.innerHTML = indicador;
        // }
    </script>
@endsection
