<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVentasRequest;
use App\Models\Product;
use App\Models\Product_Sale;
use App\Models\Sale;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.sales.index');
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
    public function store(StoreVentasRequest $request)
    {
        /* dd($request->all()); */
        $stockactual=0;
        $id_product = $request->id_product;
        $cantidad_product = $request->cantidad_product;
        $subtotal_product = $request->subtotal_product;
        for ($i=0; $i<count($id_product); $i++) {
            $products=Product::find($id_product[$i]);
            $stockactual=$products->stock - $cantidad_product[$i];
            $products->update([
                'stock'=>$stockactual,
            ]);
        }
        $total=$request->total;
        $pago=$request->pago;
        $vuelto=$request->vuelto;
        $table_id=$request->table_id;
        $objectdate=new DateTime();
        $objectdate->setTimezone(new DateTimeZone('America/Bogota'));
        $datenow=$objectdate->format('d-m-Y');
        
        $hournow=$objectdate->format('H:i:s');

        $dia = substr($datenow, 0, 2);
        $mes = substr($datenow, 3, 2);
        $anio = substr($datenow, 6, 4);
        $weekend = date('W', mktime(0, 0, 0, $mes, $dia, $anio));
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
        $sales=new Sale();
        $sales->create([
            'total'=>$total,
            'pago'=>$pago,
            'vuelto'=>$vuelto,
            'fecha_venta'=>$datenow,
            'hora'=>$hournow,
            'day'=>$dia,
            'Month'=> $namemes,
            'year'=>$anio,
            'semana'=>$weekend,
            'table_id'=>$table_id,
        ]);
        $lastsaleid=Sale::orderby('id','desc')->first()->id;
        for ($i=0; $i<count($id_product); $i++) {
            $product_sales=new Product_Sale();
            $product_sales->create([
                'sale_id'=>$lastsaleid,
                'product_id'=>$id_product[$i],
                'cantidad'=>$cantidad_product[$i],
                'total'=>$subtotal_product[$i],
            ]);
        }
        return redirect()->route('admin.sales.index');
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
