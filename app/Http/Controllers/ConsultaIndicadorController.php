<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ConsultaIndicadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $carrera = DB::table('carrera')->get();
        $instancia = DB::table('instancia')->get();
        $tipoConvenio = DB::table('tipoconvenio')->get();

        /* -------------------------------------------------------------------------- */
        /*                obtener el id de los convenios que sean marco               */
        /* -------------------------------------------------------------------------- */
        // $tipoConvenios = DB::table('tipoconvenio')
        //     ->select('idTipoConvenio')
        //     ->where(
        //         'nomtipoConvenio',
        //         '=',
        //         'CONVENIO MARCO DE COLABORACIÓN ACADÉMICA, CIENTÍFICA Y TECNOLÓGICA'
        //     )
        //     ->get();
        /* -------------------------------------------------------------------------- */
        /*                         variable para obtener el id                        */
        /* -------------------------------------------------------------------------- */
        // foreach ($tipoConvenios as $tipoConvenio) {
        //     $tipoConvenio = $tipoConvenio->idTipoConvenio;
        // }
        /* -------------------------------------------------------------------------- */
        /*                         obtener fechas e indicador                         */
        /* -------------------------------------------------------------------------- */
        $fechaInicio = $request->input('txtFechaInicial');
        $fechaFinal = $request->input('txtFechaFinal');
        $indicadorRequest = $request->input('sltIndicador');
        $trimestreRequest = $request->input('sltTrimestre');
        $anioRequest = $request->input('sltAnio');
        /* -------------------------------------------------------------------------- */
        /*                obtener el numero del indicador para mostrar                */
        /* -------------------------------------------------------------------------- */
        $convenios = DB::table('convenio')
            // ->where('idTipoCon', '=', $tipoConvenio)
            ->where('idIndicador', '=', $indicadorRequest)
            ->where('estatus', '=', 'VIGENTE')
            ->whereBetween('fechaFirma', [$fechaInicio, $fechaFinal])
            ->get();
        // $indicadorCount = count($convenioIndicador);
        $indicador = DB::table('indicador')
            // ->where('descripcion', 'like', '%FIRMAR%')
            ->get();
        return view('ConsultaIndicador.index', [
            'indicadores' => $indicador,
            'convenios' => $convenios,
            'indicadorRequest' => $indicadorRequest,
            'trimestreRequest' => $trimestreRequest,
            'anioRequest' => $anioRequest,
            'fechaInicio' => $fechaInicio,
            'fechaFinal' => $fechaFinal,
            'tipoConvenios' => $tipoConvenio,
            'instancias' => $instancia,
            'carreras' => $carrera,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
