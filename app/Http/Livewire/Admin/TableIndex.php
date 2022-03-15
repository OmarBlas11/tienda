<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Table;
use Livewire\Component;
use Illuminate\Support\Str;

class TableIndex extends Component
{
    public $name;
    public $slug;
    public $id_mesa;
    public $updateMode=false;
    public function resetFilds()
    {
        $this->name = '';
        $this->slug = '';
    }
    public function render()
    {
        $tables = Table::latest('id')->get();
        return view('livewire.admin.table-index', compact('tables'));
    }
    protected $rules = [
        'name' => 'required',
        'slug' => 'required|unique:tables,slug',
    ];
    protected $messages = [
        'name.required' => 'El nombre no puede quedar vacio',
        'slug.required' => 'El nombre no puedo quedar vacio',
        'slug.unique' => 'El nombre ya existe',
    ];
    public function updated($label)
    {
        $this->validateOnly($label, $this->rules, $this->messages);
    }
    public function store()
    {
        $this->slug = Str::slug($this->name);
        $tables = $this->validate();
        Table::create($tables);
        session()->flash('info', 'La categoria fue creada');
    }
    public function editar($id)
    {
        $this->updateMode=true;
        $tables = Table::where('id', $id)->first();
        $this->id_mesa = $tables->id;
        $this->name = $tables->name;
        $this->slug = $tables->slug;
    }
    public function update()
    {
        $this->slug= Str::slug($this->name);
        $validateTables= $this->validate();
        if ($this->id_mesa) {
            $tables = Table::find($this->id_mesa);
            $tables->update($validateTables);
            $this->updateMode=false;
            session()->flash('info', 'la mesa se actualizo');
            $this->resetFilds();
        }
    }
    public function delete($id)
    {
        if($id){
            Table::where('id',$id)->delete();
            session()->flash('delete', 'Mesa Eliminada');
        }
    }
    public function cancel()
    {
        $this->updateMode=false;
        $this->resetFilds();
    }
}
