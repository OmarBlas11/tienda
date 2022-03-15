@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
    <h1 class="text-center">Lista de Mesas</h1>
@stop

@section('content')
    @livewire('admin.table-index')
@stop

@section('css')
@livewireStyles
@stop

@section('js')
@livewireScripts
@stop