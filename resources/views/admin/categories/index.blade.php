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
{{-- <script>
    const btneditar=document.querySelectorAll('#btneditar');
    const idvalue = document.querySelectorAll('#idcat')
    const namevalue = document.querySelectorAll('#namecat')
    for (let index = 0; index < btneditar.length; index++) {
        
        btneditar[index].addEventListener("click", function (e) {
            const nameInput = document.querySelector('#name');
            const divcont = document.querySelector('#agregar');
            const idvalor=idvalue[index].innerText;
            const namevalor=namevalue[index].innerText;
            divcont.innerHTML +='<input name="id" type="text" name="id" id="id" wire:model="idcat" value="'+idvalor+'">';
            /* const crearElemento = document.createElement("input");
            crearElemento.placerholer="Ingrear aqui";
            crearElemento.id = "app";
            crearElemento.value = idvalor;
            crearElemento.name = "id";
            crearElemento.type= "text";
            crearElemento.type= "hidden";
            crearElemento.= "id";
             divcont.insertAdjacentElement("beforebegin", crearElemento); */
             nameInput.value=namevalor;
        });
        
    }
</script> --}}
{{-- <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        });
    </script> --}}
@stop
