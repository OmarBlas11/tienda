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
            $sales=Sale::where('table_id',$this->table)->orwhere('mes','LIKE','%'.$this->search)->paginate($this->paginar);
        }else{
            $sales=Sale::where('fecha_venta',$this->search)->orwhere('mes','LIKE','%'.$this->search.'%')->orderby('id','desc')->paginate($this->paginar);
        }
        $tables=Table::all();
        return view('livewire.admin.sale-index', compact('sales', 'tables'));
    }
    public function detalles($id)
    {
        # code...
    }
}
