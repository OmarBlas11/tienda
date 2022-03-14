<?php

namespace App\Http\Livewire\Admin;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isEmpty;

class CategoryIndex extends Component
{
    use WithPagination;

    public $name;
    public $slug;
    public $idcat;
    public $updateMode=false;
    public function resetFilds()
    {
        $this->name = '';
        $this->slug = '';
    }
    public function render()
    {
        $categories = Category::latest('id')->get();
        return view('livewire.admin.category-index', compact('categories'));
    }
    protected $rules = [
        'name' => 'required',
        'slug' => 'required|unique:categories,slug'
    ];
    protected $messages = [
        'name.required' => 'El nombre no debe quedar vacio.',
        'slug.required' => 'El nombre no debe quedar vacio.',
        'slug.unique' => 'El nombre ya existe.',

    ];
    
    public function updated($label)
    {
        $this->validateOnly($label, $this->rules, $this->messages);
    }
    public function store()
    {
        $this->slug = Str::slug($this->name);
            $validatedData = $this->validate();
            Category::create($validatedData);
            $this->resetFilds();
            session()->flash('info', 'Categoria creado correctamente');
    }
    public function editar($id)
    {
        $this->updateMode = true;
        $categories = Category::where('id',$id)->first();
        $this->idcat=$categories->id;
        $this->name=$categories->name;
        $this->slug=$categories->slug;
    }
    public function update()
    {
        $this->slug = Str::slug($this->name);
        $validatedData = $this->validate();
        if ($this->idcat) {
            $categories = Category::find($this->idcat);
            $categories->update($validatedData);
            $this->updateMode = false;
            session()->flash('info', 'Categoria actualizada');
            $this->resetFilds();
        }   
    }
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetFilds();
    }
    public function delete($id)
    {
        if($id){
            Category::where('id',$id)->delete();
            session()->flash('delete', 'Categoria Eliminada');
        }
    }
}
