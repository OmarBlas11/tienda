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
            const ids = document.querySelectorAll('#id');
            const names = document.querySelectorAll('#name');
            const precies = document.querySelectorAll('#preci');
            const stocks = document.querySelectorAll('#stock');
            const btnSeleccionar = document.querySelectorAll('#btnSelecionar');
            let llenar = document.querySelector('#llenar');
            let name = '';
            let preci = '';
            let stock = '';
            let id = '';
            let total=0;
            let subtotal='subtotal';
            for (let index = 0; index < btnSeleccionar.length; index++) {
                btnSeleccionar[index].addEventListener("click", function(e) {
                    let subtotal='subtotal';
                    let foo = prompt('Ingresar la Cantidad');
                    let bar = confirm('Confirm or deny');
                    if (bar) {
                        name = names[index].innerText;
                        preci = precies[index].innerText;
                        stock = stocks[index].innerText;
                        id = ids[index].innerText;
                        llenar.innerHTML += "<tr><td hidden><input wire:model='id_product[]' name=" + 'id_product[]' +
                            " class='form-control' value=" + id +
                            " ></td><td>" + name + "</td><td>" + preci + "</td><td><input wire:model='cantidad_product[]' name=" +
                            'cantidad_product[]' + " id=" + 'cantidad' + " type=" + 'number' +
                            " class='form-control' value=" + foo +
                            " ></td><td><input step='any' wire:model='subtotal_product[]' class='form-control subtotal' id='subtotal' type='number' name=" + 'subtotal_product[]' +
                            " readonly value=" + (preci * foo ).toFixed(1)+
                            " ></td><td><a class='btn btn-danger btn-sm borrar'>Borrar</a></td></tr>";
                    }

                });
            }
            

        });

        var llenar = (function() {
            $(document).on('click', '.borrar', function(event) {
                event.preventDefault();
                $(this).closest('tr').remove();
            });
            var subtotal=new Array();
            var elementos=document.getElementsByClassName('subtotal'),
            namesValues=[].map.call(elementos, function(datainputs) {
                subtotal.push(datainputs.value);
            })
            console.log(": "+subtotal+" tmaño: "+subtotal.length);
            var suma=0;
            for (let index = 0; index < subtotal.length; index++) {
                suma += parseFloat(subtotal[index]);
                document.querySelector("#total").value=suma.toFixed(1);
            }

            const borrar=document.querySelectorAll('.borrar');
            const subtotalDelte=document.querySelectorAll('.subtotal');
            for (let index = 0; index < borrar.length; index++) {
                borrar[index].addEventListener("click", function (e) {
                    document.querySelector("#total").value=parseFloat(subtotalDelte[index].value)-document.querySelector("#total").value;
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

        const table_llenar = document.querySelector('#llenar');
        const observer_llenar = new MutationObserver(llenar);

        observer_llenar.observe(table_llenar, observerOptios);

        function calcular(){
            document.querySelector('#vuelto').value=(document.querySelector('#pago').value-document.querySelector('#total').value).toFixed(1);
        }
        function capturarvalueSelectedMesa() {
            var mesa=document.getElementById("mesa").value;
            if (!mesa=="") {
                document.getElementById("btnVender").disabled=false;
            }else{
                document.getElementById("btnVender").disabled=true;
            }
        }
    </script>
@stop
