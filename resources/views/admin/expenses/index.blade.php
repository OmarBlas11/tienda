@extends('adminlte::page')

@section('title', 'Gastos')

@section('content_header')
    <h1 class="text-center">Registrar Gastos</h1>
@stop

@section('content')
@livewire('admin.expense-index')
@stop

@section('css')
@livewireStyles
@stop
@section('js')
@livewireScripts
@stop