<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductIndex extends Component
{
    use WithPagination;
    public $search;
    public $paginar;
    public $category;
    protected $paginationTheme = 'bootstrap';
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingPaginar()
    {
        $this->resetPage();
    }
    public function updatingCategory()
    {
        $this->resetPage();
    }
    public function render()
    {   
        if ($this->category) {
            $products = Product::where('category_id',$this->category)->orderby('id','desc')->paginate($this->paginar);
        }else{
            $products = Product::where('id','LIKE','%'.$this->search.'%')
            ->orwhere('name','LIKE','%'.$this->search.'%')
            ->orwhere('precio_compra','LIKE','%'.$this->search.'%')
            ->orwhere('precio_venta','LIKE','%'.$this->search.'%')
            ->orwhere('stock','LIKE','%'.$this->search.'%')->orderby('id','desc')->paginate($this->paginar);
        }
        $categories = Category::all();
        return view('livewire.admin.product-index', compact('products', 'categories'));
    }
    public function editar()
    {
        # code...
    }
    public function delete()
    {
        # code...
    }
}
