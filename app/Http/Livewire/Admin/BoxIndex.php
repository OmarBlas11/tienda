<?php

namespace App\Http\Livewire\Admin;

use App\Models\Box;
use DateTime;
use DateTimeZone;
use Livewire\Component;
use Livewire\WithPagination;

class BoxIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $monto;
    public function render()
    {
        $boxes=Box::orderby('id','desc')->paginate();
        return view('livewire.admin.box-index', compact('boxes'));
    }
    protected $rules = [
        'monto' => 'required',
    ];
    protected $messages = [
        'monto.required' => 'El monto no debe quedar vacio',
    ];
    public function resetFilds()
    {
        $this->monto = '';
    }
    public function updated($label)
    {
        $this->validateOnly($label, $this->rules, $this->messages);
    }
    public function store()
    {
        $montos=$this->validate();
        $objectdate=new DateTime();
        $objectdate->setTimezone(new DateTimeZone('America/Bogota'));
        $datenow=$objectdate->format('d-m-Y');
        
        $hournow=$objectdate->format('H:i:s');

        $dia = substr($datenow, 0, 2);
        $mes = substr($datenow, 3, 2);
        $anio = substr($datenow, 6, 4);
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

        $validar=Box::where('day', $dia)->where('month', $namemes)->where('year',$anio)->get();

        if (count($validar)) {
            session()->flash('info','No puedo ingresar un monto, porque ya ingresó uno');
        }else {
            Box::create([
                'monto' => $this->monto,
                'day' => $dia,
                'month' => $namemes,
                'year' => $anio,
                'hour'=>$hournow,
            ]);
            session()->flash("info", 'El monto fue agregado correctamente');
            $this->resetFilds();
        }
        $this->resetFilds();
    }
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetFilds();
    }
}
