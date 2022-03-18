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
<style>
    
</style>
@stop

@section('js')
@livewireScripts
<script>
    const nav=document.querySelector('.nav-link');
    for (let index = 0; index < nav.length; index++) {
        nav[index].addEventListener("click", function (e) {
            this.classList
        })
        
    }
</script>
@stop