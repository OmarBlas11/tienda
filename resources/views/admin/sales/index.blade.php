@extends('adminlte::page')

@section('title', 'Reportes')

@section('content_header')
    <h1 class="text-center">Todas las Ventas</h1>
@stop

@section('content')
    @livewire('admin.sale-index')
@stop

@section('css')
@livewireStyles
@stop

@section('js')
@livewireScripts
@stop