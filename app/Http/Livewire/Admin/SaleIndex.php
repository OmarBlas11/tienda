<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product_Sale;
use App\Models\Sale;
use App\Models\Table;
use Livewire\Component;
use Livewire\WithPagination;

class SaleIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $table;
    public $search;
    public $paginar;
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
            $sales=Sale::where('table_id',$this->table)->orwhere('Month','LIKE','%'.$this->search)->paginate($this->paginar);
        }else{
            $sales=Sale::where('fecha_venta',$this->search)->orwhere('Month','LIKE','%'.$this->search.'%')->orderby('id','desc')->paginate($this->paginar);
        }
        $tables=Table::all();
        $product_sales = Product_Sale::all();
        return view('livewire.admin.sale-index', compact('sales', 'tables', 'product_sales'));
    }
    public function detalles($id)
    {
        # code...
    }
    public function llenarsales()
    {
        $sales=Sale::all();
        $product_sales=Product_Sale::all();

        foreach ($sales as $sale ) {
            $total=0;
            $totalpago=0;
            $vuelto=0;
            foreach ($product_sales as $product_sale ) {
                if ($sale->id == $product_sale->sale_id) {
                    $total=$total+$product_sale->total;
                }
            }
            $aumentar=rand(15,25);
            $totalpago=$total+$aumentar;
            $vuelto=$totalpago-$total;
            $updatesale=Sale::find($sale->id);
            $updatesale->update([
                'total' => $total,
                'pago' => $totalpago,
                'vuelto' => $vuelto
            ]);
        }
        session()->flash('llenado', 'LLenado terminado');
    }
}
