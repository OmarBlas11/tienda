<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Product_Sale;
use Livewire\Component;
use Livewire\WithPagination;

class SaleCategoryIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $product_sales;
    public $idcat;
    public function mount()
    {
        $this->product_sales=Product_Sale::all();
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.sale-category-index', compact('categories'));
    }
    public function ShowForCategory($id)
    {
        $this->idcat=$id;

        $products = Product::where('category_id', $id)->get();

        if ($this->product_sales) {
            $this->product_sales = collect([]);
        }
        foreach ($products as $product) {
            $product=Product_Sale::where('product_id', $product->id)->get();
            $this->product_sales=$this->product_sales->concat( $product);
        }
        
    }
    public function todas()
    {
        $this->product_sales=Product_Sale::all();
    }
}
