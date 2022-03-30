<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Box;
use App\Models\Expense;
use App\Models\Sale;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.boxes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $objectdate=new DateTime();
        $objectdate->setTimezone(new DateTimeZone('America/Bogota'));
        $datenow=$objectdate->format('Y-m-d');
        
        $hournow=$objectdate->format('H:i:s');

        $dia = substr($datenow, 8, 2);
        $mes = substr($datenow, 5, 2);
        $anio = substr($datenow, 0, 4);
        $namemes = '';
        switch ($mes) {
            case '01':
                $namemes = 'Enero';
                break;
            case '02':
                $namemes = 'Febrero';
                break;
            case '03':
                $namemes = 'Marzo';
                break;
            case '04':
                $namemes = 'Abril';
                break;
            case '05':
                $namemes = 'Mayo';
                break;
            case '06':
                $namemes = 'Junio';
                break;
            case '07':
                $namemes = 'Julio';
                break;
            case '08':
                $namemes = 'Agosto';
                break;
            case '09':
                $namemes = 'Septiembre';
                break;
            case '10':
                $namemes = 'Octubre';
                break;
            case '11':
                $namemes = 'Noviembre';
                break;
            case '12':
                $namemes = 'Diciembre';
                break;
        }
        $boxes=Box::where('day', $dia)->where('month', $namemes)->where('year', $anio)->get();
        $expenses=Expense::where('day', $dia)->where('month', $namemes)->where('year', $anio)->latest('id')->get();
        $sales=Sale::where('day', $dia)->where('Month', $namemes)->where('year', $anio)->latest('id')->paginate();
        $gasto=0;
        $venta=0;
        $montofinal=0;
        foreach ($expenses as $expense) {
            $gasto=$gasto + $expense->monto;
        }
        foreach ($sales as $sale) {
            $venta = $venta + $sale->total;
        }
        foreach ($boxes as $boxe) {
            $montofinal=($venta + $boxe->monto) - $gasto;
        }
        return view('admin.boxes.create', compact('datenow','boxes', 'expenses', 'sales','gasto','venta','montofinal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datenow=$request->date;
        $dia = substr($request->date, 8, 2);
        $mes = substr($request->date, 5, 2);
        $anio = substr($request->date, 0, 4);
        $namemes = '';
        switch ($mes) {
            case '01':
                $namemes = 'Enero';
                break;
            case '02':
                $namemes = 'Febrero';
                break;
            case '03':
                $namemes = 'Marzo';
                break;
            case '04':
                $namemes = 'Abril';
                break;
            case '05':
                $namemes = 'Mayo';
                break;
            case '06':
                $namemes = 'Junio';
                break;
            case '07':
                $namemes = 'Julio';
                break;
            case '08':
                $namemes = 'Agosto';
                break;
            case '09':
                $namemes = 'Septiembre';
                break;
            case '10':
                $namemes = 'Octubre';
                break;
            case '11':
                $namemes = 'Noviembre';
                break;
            case '12':
                $namemes = 'Diciembre';
                break;
        }
        $boxes=Box::where('day', $dia)->where('month', $namemes)->where('year', $anio)->get();
        $expenses=Expense::where('day', $dia)->where('month', $namemes)->where('year', $anio)->latest('id')->get();
        $sales=Sale::where('day', $dia)->where('Month', $namemes)->where('year', $anio)->latest('id')
        ->get();
        $gasto=0;
        $venta=0;
        $montofinal=0;
        foreach ($expenses as $expense) {
            $gasto=$gasto + $expense->monto;
        }
        foreach ($sales as $sale) {
            $venta = $venta + $sale->total;
        }
        foreach ($boxes as $boxe) {
            $montofinal=($venta + $boxe->monto) - $gasto;
        }
        return view('admin.boxes.create', compact('datenow','boxes', 'expenses', 'sales','gasto','venta','montofinal'));
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
