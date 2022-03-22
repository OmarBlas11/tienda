<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;

class Venta extends Component
{
    public $search;
    public function render()
    {
        $products=[];
        if ($this->search) {
            $products=Product::where('name','LIKE','%'.$this->search.'%')->paginate(3);
        }
        return view('livewire.admin.venta',compact('products'));
    }
}
