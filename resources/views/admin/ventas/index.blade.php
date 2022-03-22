@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
    <h1 class="text-center">Ralizar Ventas</h1>
@stop

@section('content')
    @livewire('admin.venta')
@stop

@section('css')
    @livewireStyles
@stop

@section('js')
    @livewireScripts
    <script>
        var callback = (function(e) {
            const names = document.querySelectorAll('#name');
            const precies = document.querySelectorAll('#preci');
            const stocks = document.querySelectorAll('#stock');
            const btnSeleccionar = document.querySelectorAll('#btnSelecionar');
            let llenar = document.querySelector('#llenar');
            let cantidad = 0;
            let name = '';
            let preci = '';
            let stock = '';
            for (let index = 0; index < btnSeleccionar.length; index++) {
                btnSeleccionar[index].addEventListener("click", function(e) {
                    name = names[index].innerText;
                    preci = precies[index].innerText;
                    stock = stocks[index].innerText;
                    llenar.innerHTML += "<tr><td><input class='form-control' value=" + name +
                        " ></td><td><input class='form-control' value=" + preci +
                        " ></td><td><input class='form-control' value=" + stock + " ></td><td><input id=" +
                        'cantidad' + " type=" + 'number' + " class='form-control' value=" + cantidad+ " ></td></tr>";
                        cantidad =document.querySelector('#cantidad').value;
                        console.log(cantidad);
                });
            }

        });

        const table = document.querySelector('.table');
        const observer = new MutationObserver(callback);
        const observerOptios = {
            attributes: true,
            childList: true,
            subtree: true,
        };
        observer.observe(table, observerOptios);



        if (!document.querySelectorAll('#cantidad')) {
            var llenardatos = (function(e) {
                console.log('cantidad');
            });
            const table_form = document.querySelector('#cantidad');
            const observer_form = new MutationObserver(llenardatos);
            const observerOptios_form = {
                attributes: true,
                childList: true,
                subtree: true,
            };
            observer_form.observe(table_form, observerOptios_form);
        }
    </script>
@stop
