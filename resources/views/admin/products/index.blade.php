@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
    <h1 class="text-center">Lista de Productos</h1>
@stop

@section('content')
    @livewire('admin.product-index')
@stop

@section('css')
@livewireStyles
@stop

@section('js')
@livewireScripts
@stop