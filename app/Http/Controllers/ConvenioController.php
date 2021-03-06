<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConvenioController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('index', 'create', 'store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /* -------------------------------------------------------------------------- */
        /*                         Datos previos para la vista                        */
        /* -------------------------------------------------------------------------- */
        $carrera = DB::table('carrera')->get();
        $instancia = DB::table('instancia')->get();
        $tipoConvenio = DB::table('tipoconvenio')->get();
        $convenio = DB::table('convenio')->get();
        /* -------------------------------------------------------------------------- */
        /*                            obtener id y validar del select                 */
        /* -------------------------------------------------------------------------- */
        $carreraRequest = $request->input('sltCarrera');
        if ($carreraRequest == 0) {
            $convenio = DB::table('convenio')->get();
        } else {
            $convenio = DB::table('convenio')
                ->where('carreras', 'like', '%' . $carreraRequest . '%')
                ->get();
        }
        /* -------------------------------------------------------------------------- */
        /*                            Retorno de los datos                            */
        /* -------------------------------------------------------------------------- */
        return view('Convenio.index', [
            'tipoConvenios' => $tipoConvenio,
            'instancias' => $instancia,
            'carreras' => $carrera,
            'convenios' => $convenio,
            'carreraRequest' => $carreraRequest,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carrera = DB::table('carrera')->get();
        $indicador = DB::table('indicador')->get();
        $otroIndicador = DB::table('otroIndicador')->get();
        $tipoConvenio = DB::table('tipoconvenio')->get();
        $instancia = DB::table('instancia')->get();
        return view('Convenio.nuevo', [
            'tiposConvenios' => $tipoConvenio,
            'instancias' => $instancia,
            'indicadores' => $indicador,
            'otrosIndicadores' => $otroIndicador,
            'carreras' => $carrera,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->input('txtIdTipoCon'));
        $validarIndefinido = $request->input('txtTipoFecha');
        $fechaVigencia = $request->input('dateFechaVigencia');
        if ($validarIndefinido == 'SI') {
            $fechaVigencia = null;
        }
        // dd($fechaVigencia);
        $convenio = DB::table('convenio')->insert([
            'folio' => $request->input('txtFolio'),
            'vigenciaIndefinida' => $request->input('txtTipoFecha'),
            'fechaFirma' => $request->input('dateFechaFirma'),
            'fechaVigencia' => $fechaVigencia,
            'estatus' => $request->input('txtEstatus'),
            'urlConvenio' => $request->input('txtUrlConvenio'),
            'carreras' => $request->input('txtCarreras'),
            'idTipoCon' => $request->input('txtIdTipoCon'),
            'idInstancia' => $request->input('txtIdInstancia'),
            'idUsuario' => $request->input('txtIdUsuario'),
            'idIndicador' => $request->input('txtIdIndicador'),
            'idOtroIndicador' => $request->input('txtIdOtroIndicador'),
        ]);
        return redirect()->route('convenio.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $idCarreraBD = DB::table('carrera')
            ->select('idCarrera')
            ->get();
        $indicador = DB::table('indicador')->get();
        $otroIndicador = DB::table('otroIndicador')->get();
        $carrera = DB::table('carrera')->get();
        $tipoConvenio = DB::table('tipoconvenio')->get();
        $instancia = DB::table('instancia')->get();
        $convenio = DB::table('convenio')
            ->where('idConvenio', '=', $id)
            ->first();
        $idCarreras = $convenio->carreras;
        $arregloIdCarreras = explode(',', $idCarreras);

        return view('Convenio.actualizar', [
            'convenios' => $convenio,
            'tipoConvenios' => $tipoConvenio,
            'instancias' => $instancia,
            'indicadores' => $indicador,
            'carreras' => $carrera,
            'idCarreras' => $idCarreraBD,
            'arregloIdCarreras' => $arregloIdCarreras,
            'otrosIndicadores' => $otroIndicador,
        ]);
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
        $validarIndefinido = $request->input('txtTipoFecha');
        $fechaVigencia = $request->input('dateFechaVigencia');
        if ($validarIndefinido == 'SI') {
            $fechaVigencia = null;
        }
        $convenio = DB::table('convenio')
            ->where('idConvenio', '=', $id)
            ->update([
                'folio' => $request->input('txtFolio'),
                'vigenciaIndefinida' => $request->input('txtTipoFecha'),
                'fechaFirma' => $request->input('dateFechaFirma'),
                'fechaVigencia' => $fechaVigencia,
                'estatus' => $request->input('txtEstatus'),
                'urlConvenio' => $request->input('txtUrlConvenio'),
                'carreras' => $request->input('txtCarreras'),
                'idTipoCon' => $request->input('txtIdTipoCon'),
                'idInstancia' => $request->input('txtIdInstancia'),
                'idUsuario' => $request->input('txtIdUsuario'),
                'idIndicador' => $request->input('txtIdIndicador'),
                'idOtroIndicador' => $request->input('txtIdOtroIndicador'),
            ]);
        return redirect()->route('convenio.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('convenio')
            ->where('idConvenio', '=', $id)
            ->delete();
        return redirect()->route('convenio.index');
    }
}
