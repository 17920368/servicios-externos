<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstanciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('index', 'create', 'show', 'store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $giro = DB::table('giro')->get();
        $sector = DB::table('sector')->get();
        $tipoSector = DB::table('tiposector')->get();
        $tamanio = DB::table('tamanio')->get();
        $areaConocimiento = DB::table('areaconoc')->get();
        $alcance = DB::table('alcance')->get();
        $instancia = DB::table('instancia')->get();
        return view('Instancia.index', [
            'instancias' => $instancia,
            'giros' => $giro,
            'sectores' => $sector,
            'tipoSectores' => $tipoSector,
            'tamanios' => $tamanio,
            'areaConocimientos' => $areaConocimiento,
            'alcances' => $alcance,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $giro = DB::table('giro')->get();
        $sector = DB::table('sector')->get();
        $tipoSector = DB::table('tiposector')->get();
        $tamanio = DB::table('tamanio')->get();
        $areaConocimiento = DB::table('areaconoc')->get();
        $alcance = DB::table('alcance')->get();
        return view('Instancia.nuevo', [
            'giros' => $giro,
            'sectores' => $sector,
            'tipoSectores' => $tipoSector,
            'tamanios' => $tamanio,
            'areaConocimientos' => $areaConocimiento,
            'alcances' => $alcance,
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
        $instancia = DB::table('instancia')->insert([
            'nombre' => $request->input('txtNombre'),
            'responsable' => $request->input('txtResponsable'),
            'email' => $request->input('txtEmail'),
            'telefono' => $request->input('txtTelefono'),
            'idGiro' => $request->input('txtIdGiro'),
            'idSector' => $request->input('txtIdSector'),
            'idTipoSec' => $request->input('txtIdTipoSec'),
            'idTamanio' => $request->input('txtIdTamanio'),
            'idAreaC' => $request->input('txtIdAreaC'),
            'idAlcance' => $request->input('txtIdAlcance'),
        ]);
        return redirect()->route('instancia.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoConvenio = DB::table('tipoconvenio')->get();
        $giro = DB::table('giro')->get();
        $sector = DB::table('sector')->get();
        $tipoSector = DB::table('tiposector')->get();
        $tamanio = DB::table('tamanio')->get();
        $areaConocimiento = DB::table('areaconoc')->get();
        $alcance = DB::table('alcance')->get();
        $instancia = DB::table('instancia')
            ->where('idInstancia', '=', $id)
            ->first();
        $convenio = DB::table('convenio')
            ->where('idInstancia', '=', $id)
            ->get();
        return view('Instancia.detalle', [
            'instancias' => $instancia,
            'giros' => $giro,
            'sectores' => $sector,
            'tipoSectores' => $tipoSector,
            'tamanios' => $tamanio,
            'areaConocimientos' => $areaConocimiento,
            'alcances' => $alcance,
            'tipoConvenios' => $tipoConvenio,
            'convenios' => $convenio,
        ]);
        return $convenio;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $giro = DB::table('giro')->get();
        $sector = DB::table('sector')->get();
        $tipoSector = DB::table('tiposector')->get();
        $tamanio = DB::table('tamanio')->get();
        $areaConocimiento = DB::table('areaconoc')->get();
        $alcance = DB::table('alcance')->get();
        $instancia = DB::table('instancia')
            ->where('idInstancia', '=', $id)
            ->first();
        return view('Instancia.actualizar', [
            'instancias' => $instancia,
            'giros' => $giro,
            'sectores' => $sector,
            'tipoSectores' => $tipoSector,
            'tamanios' => $tamanio,
            'areaConocimientos' => $areaConocimiento,
            'alcances' => $alcance,
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
        $instancia = DB::table('instancia')
            ->where('idInstancia', '=', $id)
            ->update([
                'nombre' => $request->input('txtNombre'),
                'responsable' => $request->input('txtResponsable'),
                'email' => $request->input('txtEmail'),
                'telefono' => $request->input('txtTelefono'),
                'idGiro' => $request->input('txtIdGiro'),
                'idSector' => $request->input('txtIdSector'),
                'idTipoSec' => $request->input('txtIdTipoSec'),
                'idTamanio' => $request->input('txtIdTamanio'),
                'idAlcance' => $request->input('txtIdAlcance'),
                'idAreaC' => $request->input('txtIdAreaC'),
            ]);
        return redirect()->route('instancia.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('instancia')
            ->where('idInstancia', '=', $id)
            ->delete();
        return redirect()->route('instancia.index');
    }
}