<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class ProductIndex extends Component
{
    use WithPagination;
    public $search;
    public $paginar;
    public $category;
    public $idproducto;
    public $name;
    public $slug;
    public $precio_compra;
    public $precio_venta;
    public $stock;
    public $category_id;
    protected $paginationTheme = 'bootstrap';
    public $updateMode = false;
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
            $products = Product::where('category_id', $this->category)->orderby('id', 'desc')->paginate($this->paginar);
        } else {
            $products = Product::where('id', 'LIKE', '%' . $this->search . '%')
                ->orwhere('name', 'LIKE', '%' . $this->search . '%')
                ->orwhere('precio_compra', 'LIKE', '%' . $this->search . '%')
                ->orwhere('precio_venta', 'LIKE', '%' . $this->search . '%')
                ->orwhere('stock', 'LIKE', '%' . $this->search . '%')->orderby('id', 'desc')->paginate($this->paginar);
        }
        $product_all=Product::all();
        $categories = Category::all();
        return view('livewire.admin.product-index', compact('products', 'categories','product_all'));
    }
    protected $rules;
    protected function rules()
    {
        if ($this->idproducto) {
            $products = Product::where('id', $this->idproducto)->first();
            $this->rules = [
                'name' => 'required',
                'slug' => "required|unique:products,slug,$products->id",
                'precio_venta' => 'required|numeric|regex:/^[\d]{0,5}(\.[\d]{1,2})?$/',
                'precio_compra' => 'required|numeric|regex:/^[\d]{0,5}(\.[\d]{1,2})?$/',
                'stock' => 'required|numeric',
                'category_id' => 'required',
            ];
        }else {
            $this->rules = [
                'name' => 'required',
                'slug' => 'required|unique:products,slug',
                'precio_venta' => 'required|numeric|regex:/^[\d]{0,5}(\.[\d]{1,2})?$/',
                'precio_compra' => 'required|numeric|regex:/^[\d]{0,5}(\.[\d]{1,2})?$/',
                'stock' => 'required|numeric',
                'category_id' => 'required',
            ];
        }
        return $this->rules;
    }
    protected $messages = [
        'name.required' => 'El nombre no debe quedar vacio',
        'slug.required' => 'El nombre no debe quedar vacio',
        'slug.unique' => 'El nombre ya existe',
        'precio_compra.required' => 'El precio de compra no debe quedar vacio',
        'precio_compra.numeric' => 'El percio de compra debe ser un numero',
        'precio_compra.regex' => 'El precio debe contener como maximo 5 numeros enteros y 2 decimales',
        'precio_venta.required' => 'El precio de venta no debe quedar vacio',
        'precio_venta.numeric' => 'El percio de venta debe ser un numero',
        'precio_venta.regex' => 'El precio de venta debe contener como maximo 5 numeros enteros y 2 decimales',
        'stock.required' => 'La cantidad no debe quedar vacio',
        'stock.numeric' => 'La cantidad se numerico',
        'category_id.required' => 'La categoria no debe quedar vacio',
    ];
    public function resetFilds()
    {
        $this->name = '';
        $this->slug = '';
        $this->precio_compra = '';
        $this->precio_venta = '';
        $this->stock = '';
        $this->category_id = '';
    }
    public function updated($label)
    {
        $this->validateOnly($label, $this->rules, $this->messages);
    }
    public function store()
    {
        $this->slug = Str::slug($this->name);
        $products = $this->validate();
        Product::create($products);
        session()->flash('info', 'El producto fue guardado correctamente');
        $this->resetFilds();
    }
    public function editar($id)
    {
        $this->updateMode = true;
        $products = Product::where('id', $id)->first();
        $this->idproducto = $products->id;
        $this->name = $products->name;
        $this->slug = $products->slug;
        $this->precio_compra = $products->precio_compra;
        $this->precio_venta = $products->precio_venta;
        $this->stock = $products->stock;
        $this->category_id = $products->category_id;
    }
    public function delete($id)
    {
        if($id){
            Product::where('id',$id)->delete();
            session()->flash('delete', 'Producto Eliminado');
        }
    }
    public function update()
    {

        $this->slug = Str::slug($this->name);
        $validatedData = $this->validate();
        if ($this->idproducto) {
            $products = Product::find($this->idproducto);
            $products->update($validatedData);
            $this->updateMode=false;
            session()->flash('info', 'Producto actualizado corretamente');
        }
    }
    public function cancel()
    {
        $this->resetFilds();
    }
}
