@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <h1 class="text-center">Lista de Categorias</h1>
@stop

@section('content')
    @livewire('admin.category-index')
@stop

@section('css')
@livewireStyles
@stop
@section('js')
@livewireScripts
@stop
