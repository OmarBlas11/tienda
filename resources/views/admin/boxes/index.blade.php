@extends('adminlte::page')

@section('title', 'Caja')

@section('content_header')
    <h1 class="text-center">Abrir Caja</h1>
@stop

@section('content')
@livewire('admin.box-index')
@stop

@section('css')
@livewireStyles
@stop
@section('js')
@livewireScripts
@stop