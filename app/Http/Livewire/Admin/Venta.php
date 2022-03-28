<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Table;
use Livewire\Component;

class Venta extends Component
{
    public $search;
    public function render()
    {
        $tables=Table::all();
        $products=[];
        if ($this->search) {
            $products=Product::where('name','LIKE','%'.$this->search.'%')->orderby('name','ASC')->paginate(3);
        }
        return view('livewire.admin.venta',compact('products','tables'));
    }

    public function store()
    {
        dd("Aqui es donde guardaremos");
    }
}
