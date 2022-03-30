@extends('adminlte::page')

@section('title', 'Reporte de caja')

@section('content_header')
    <h1 class="text-center">Reporte de Caja</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form class="form-inline" action="{{ route('admin.boxes.store') }}" method="POST">
                @csrf
                <label for="date" class="mr-sm-2 mb-2">Fecha</label>
                <input type="date" class="form-control mb-2 mr-sm-2" name="date" placeholder="Ingresar Fecha" id="date"
                    value="{{ $datenow }}">
                <button type="submit" class="btn btn-primary mb-2">Aceptar</button>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row g-3 align-items-center">
                @foreach ($boxes as $box)
                <div class="col-auto">
                    <label for="inputPassword6" class="col-form-label">Monto Inicial</label>
                </div>
                <div class="col-auto">
                    <input type="number" step="any" id="montoinicial" class="form-control" aria-describedby="passwordHelpInline" value="{{ $box->monto }}" readonly>
                </div>
                @endforeach
                <div class="col-auto">
                    <label for="inputPassword6" class="col-form-label">Total Ventas</label>
                </div>
                <div class="col-auto">
                    <input type="number" step="any" id="montoinicial" class="form-control" aria-describedby="passwordHelpInline" value="{{ $venta }}" readonly>
                </div>
                <div class="col-auto">
                    <label for="inputPassword6" class="col-form-label">Total Gastos</label>
                </div>
                <div class="col-auto">
                    <input type="number" step="any" id="montoinicial" class="form-control" aria-describedby="passwordHelpInline" value="{{ $gasto }}" readonly>
                </div>
                <div class="col-auto">
                    <label for="inputPassword6" class="col-form-label">Monto Final de Caja</label>
                </div>
                <div class="col-auto">
                    <input type="number" step="any" id="montoinicial" class="form-control" aria-describedby="passwordHelpInline" value="{{ $montofinal }}" readonly>
                </div>
            </div>
        </div>
        <div class="card-header">
            <h4 class="text-center form-label ">Tabla de Gastos</h4>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Monto</th>
                        <th>Concepto</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenses as $expense)
                    <tr>
                        <td>{{ $expense->monto }}</td>
                        <td>{{ $expense->concepto }}</td>
                        <td>{{ $expense->day }}-{{ $expense->month }}-{{ $expense->year }}</td>
                        <td>{{ $expense->hour }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-header">
            <h4 class="text-center form-label ">Tabla de Ventas</h4>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                    <tr>
                        <td>{{ $sale->total }}</td>
                        <td>{{ $sale->day }}-{{ $sale->Month }}-{{ $sale->year }}</td>
                        <td>{{ $sale->hora }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    @livewireStyles
@stop
@section('js')
    @livewireScripts
@stop
