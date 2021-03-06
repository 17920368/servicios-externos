<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProyectoController extends Controller
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
    public function index()
    {
        $proyecto = DB::table('proyecto')->get();
        $alumno = DB::table('alumno')->get();
        $periodo = DB::table('periodo')->get();
        $asesorInterno = DB::table('asesorinterno')->get();
        $asesorExterno = DB::table('asesorexterno')->get();
        $instancia = DB::table('instancia')->get();
        return view('Proyecto.index', [
            'proyectos' => $proyecto,
            'alumnos' => $alumno,
            'periodos' => $periodo,
            'asesoresInternos' => $asesorInterno,
            'asesoresExternos' => $asesorExterno,
            'instancias' => $instancia,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alumno = DB::table('alumno')->get();
        $periodo = DB::table('periodo')->get();
        $asesorInterno = DB::table('asesorinterno')->get();
        $asesorExterno = DB::table('asesorexterno')->get();
        $instancia = DB::table('instancia')->get();
        return view('Proyecto.nuevo', [
            'alumnos' => $alumno,
            'periodos' => $periodo,
            'periodos' => $periodo,
            'asesoresInternos' => $asesorInterno,
            'asesoresExternos' => $asesorExterno,
            'instancias' => $instancia,
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
        $proyecto = DB::table('proyecto')->insert([
            'nomProyecto' => $request->input('txtNombre'),
            'modalidad' => $request->input('txtModalidad'),
            'idAlumno' => $request->input('txtIdAlumno'),
            'idPeriodo' => $request->input('txtIdPeriodo'),
            'idAsesorI' => $request->input('txtIdAsesorInterno'),
            'idAsesorE' => $request->input('txtIdAsesorExterno'),
            'idInstancia' => $request->input('txtIdInstancia'),
        ]);
        return redirect()->route('proyecto.index');
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
        $alumno = DB::table('alumno')->get();
        $periodo = DB::table('periodo')->get();
        $asesorInterno = DB::table('asesorinterno')->get();
        $asesorExterno = DB::table('asesorexterno')->get();
        $instancia = DB::table('instancia')->get();
        $proyecto = DB::table('proyecto')
            ->where('idProyecto', '=', $id)
            ->first();
        return view('Proyecto.actualizar', [
            'alumnos' => $alumno,
            'periodos' => $periodo,
            'asesoresInternos' => $asesorInterno,
            'asesoresExternos' => $asesorExterno,
            'instancias' => $instancia,
            'proyectos' => $proyecto,
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
        $proyecto = DB::table('proyecto')
            ->where('idProyecto', '=', $id)
            ->update([
                'nomProyecto' => $request->input('txtNombre'),
                'modalidad' => $request->input('txtModalidad'),
                'idAlumno' => $request->input('txtIdAlumno'),
                'idPeriodo' => $request->input('txtIdPeriodo'),
                'idAsesorI' => $request->input('txtIdAsesorInterno'),
                'idAsesorE' => $request->input('txtIdAsesorExterno'),
                'idInstancia' => $request->input('txtIdInstancia'),
            ]);
        return redirect()->route('proyecto.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('proyecto')
            ->where('idProyecto', '=', $id)
            ->delete();
        return redirect()->route('proyecto.index');
    }
}