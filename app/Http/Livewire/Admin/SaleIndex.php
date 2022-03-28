<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product_Sale;
use App\Models\Sale;
use App\Models\Table;
use DateTime;
use DateTimeZone;
use Livewire\Component;
use Livewire\WithPagination;

class SaleIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $table;
    public $search;
    public $paginar;
    public $date;
    public $report = [];
    public $productsale = [];
    public $Nombre;
    public function mount()
    {
        /* $day = date("d");
        $mes = date("m");
        $anio = date("Y"); */
        $objectdate=new DateTime();
        $objectdate->setTimezone(new DateTimeZone('America/Bogota'));
        $this->date = $objectdate->format('Y-m-d');
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingTable()
    {
        $this->resetPage();
    }
    public function updatingPaginar()
    {
        $this->resetPage();
    }
    public function render()
    {
        if ($this->table) {
            $sales = Sale::where('table_id', $this->table)->orderby('id', 'desc')->paginate($this->paginar);
        } else {
            $sales = Sale::where('id', 'LIKE', '%' . $this->search . '%')->orwhere('fecha_venta', $this->search)->orwhere('Month', 'LIKE', '%' . $this->search . '%')->orderby('id', 'desc')->paginate($this->paginar);
        }
        $salesall = Sale::all();
        $tables = Table::all();
        $categories = Category::all();
        /* $product_sales = $this->productsale; */
        $product_sales = Product_Sale::all();
        $report_customizeds = $this->report;
        return view('livewire.admin.sale-index', compact('sales', 'tables', 'product_sales', 'report_customizeds', 'salesall', 'categories'));
    }
    public function detalles($id)
    {
        # code...
    }
    public function llenarsales()
    {
        $sales = Sale::all();
        $product_sales = Product_Sale::all();

        foreach ($sales as $sale) {
            $total = 0;
            $totalpago = 0;
            $vuelto = 0;
            foreach ($product_sales as $product_sale) {
                if ($sale->id == $product_sale->sale_id) {
                    $total = $total + $product_sale->total;
                }
            }
            $aumentar = rand(15, 25);
            $totalpago = $total + $aumentar;
            $vuelto = $totalpago - $total;
            $updatesale = Sale::find($sale->id);
            $updatesale->update([
                'total' => $total,
                'pago' => $totalpago,
                'vuelto' => $vuelto
            ]);
        }
        session()->flash('llenado', 'LLenado terminado');
    }
    public function renederizarday()
    {
        $dia = substr($this->date, 8, 2);
        $mes = substr($this->date, 5, 2);
        $anio = substr($this->date, 0, 4);
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
        if ($dia == '' || $mes == '' || $anio == '') {
            session()->flash('mensaje', 'Seleccione una fecha');
        } else {
            $this->report = Sale::where('day', $dia)->where('Month', $namemes)->where('year', $anio)->orderby('id','desc')->get();
            $this->Nombre = 'Repostes del: ' . $dia . ' de ' . $namemes . ' del ' . $anio;
            if ($this->report == '') {
                session()->flash('mensaje', 'No hay registros de este dia');
            }
        }
    }
    public function renederizarweek()
    {
        $dia = substr($this->date, 8, 2);
        $mes = substr($this->date, 5, 2);
        $anio = substr($this->date, 0, 4);

        if ($dia == '' || $mes == '' || $anio == '') {
            session()->flash('mensaje', 'Debe ingresar un fecha');
            $this->report = [];
        } else {
            $weekend = date('W', mktime(0, 0, 0, $mes, $dia, $anio));
            $this->report = Sale::where('semana', $weekend)->orderby('id','desc')->get();
            if ($this->report == []) {
                session()->flash('mensaje', 'No hay Registro de esta semana');
            }
            $this->Nombre = 'Repostes de la semana: ' . $weekend;
        }
    }
    public function renederizarmonth()
    {
        $dia = substr($this->date, 8, 2);
        $mes = substr($this->date, 5, 2);
        $anio = substr($this->date, 0, 4);
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
        if ($dia == '' || $mes == '' || $anio == '') {
            session()->flash('mensaje', 'Debe ingresar un fecha');
            $this->report = [];
        } else {
            $this->report = Sale::where('Month', $namemes)->orderby('id','desc')->get();
            if ($this->report == []) {
                session()->flash('mensaje', 'No hay Registro de esta semana');
            }
            $this->Nombre = 'Repostes del mes de: ' . $namemes;
        }
    }
    public function renederizaryear()
    {
        $dia = substr($this->date, 8, 2);
        $mes = substr($this->date, 5, 2);
        $anio = substr($this->date, 0, 4);
        if ($dia == '' || $mes == '' || $anio == '') {
            session()->flash('mensaje', 'Debe ingresar un fecha');
            $this->report = [];
        } else {
            $this->report = Sale::where('year', $anio)->orderby('id','desc')->get();
            if ($this->report == []) {
                session()->flash('mensaje', 'No hay Registro de este año');
            }
            $this->Nombre = 'Repostes del año: ' . $anio;
        }
    }
    /* public function details($id)
    {
        $this->productsale = Product_Sale::where('sale_id', $id)->get();
    } */
}
