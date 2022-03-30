<?php

namespace App\Http\Livewire\Admin;

use App\Models\Expense;
use DateTime;
use DateTimeZone;
use Livewire\Component;
use Livewire\WithPagination;

class ExpenseIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $gasto;
    public $concepto;
    public function render()
    {
        $expenses = Expense::orderby('id','desc')->paginate();
        return view('livewire.admin.expense-index', compact('expenses'));
    }
    protected $rules = [
        'gasto' => 'required',
        'concepto' => 'required'
    ];
    protected $messages = [
        'gasto.required' => 'El gasto no debe quedar vacio',
        'concepto.required' => 'El concepto no debe quedar vacio',
    ];
    public function resetFilds()
    {
        $this->gasto='';
        $this->concepto = '';
    }
    public function updated($label)
    {
        $this->validateOnly($label, $this->rules, $this->messages);
    }
    public function store()
    {
        $montos = $this->validate();
        $objectdate = new DateTime();
        $objectdate->setTimezone(new DateTimeZone('America/Bogota'));
        $datenow = $objectdate->format('d-m-Y');

        $hournow = $objectdate->format('H:i:s');

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
        Expense::create([
            'monto' => $this->gasto,
            'concepto' => $this->concepto,
            'day' => $dia,
            'month' => $namemes,
            'year' => $anio,
            'hour' => $hournow,
        ]);
        session()->flash("info", 'El gasto fue agregado correctamente');
        $this->resetFilds();
    }
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetFilds();
    }
}
