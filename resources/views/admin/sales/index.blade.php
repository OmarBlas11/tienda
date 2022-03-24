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
        .menos {
            height: 0px;

        }

        .details_pro {
            display: block;
            transition: all 0.5s;
            height: 0;
            overflow: hidden;

        }

        .details {
            transition: all 0.5s;
            display: block;
            height: 0;
            overflow: hidden;
        }

        /* clases para los reportes */
        .details_reportitle {
            transition: all 0.5s;
            display: block;
            height: 0;
            overflow: hidden;
            background: wheat;
        }

        .details_report {
            transition: all 0.5s;
            display: block;
            height: 0;
            overflow: hidden;
            background: wheat;
        }

        /*  .mostrar{
                transition: all 0.5s;
                height: 200px;
                overflow: visible;
                
            } */

    </style>
@stop

@section('js')
    @livewireScripts
    <script>
        const nav = document.querySelectorAll('.nav-report > a');
        for (let index = 0; index < nav.length; index++) {
            nav[index].addEventListener("click", function(e) {
                observer.observe(table_report, observerOptios);
                nav.forEach(el => el.classList.remove('active'));
                if (this.classList.contains("active")) {
                    this.classList.remove("active")
                } else {
                    this.classList.add('active');
                }
            })

        }
        const btn = document.querySelectorAll(".select");
        const table = document.querySelectorAll(".details");
        const table_details = document.querySelectorAll(".details_pro");
        /* const table_person=document.querySelector(".table-person"); */
        console.log('tamanio del tr: ' + table_details.length + "tamanio de los titulos: " + table.length)
        for (let index = 0; index < btn.length; index++) {
            btn[index].addEventListener("click", function(e) {
                const height = table_details[index].scrollHeight;
                const height_header = table[index].scrollHeight;
                if (table[index].classList.contains("mostrar")) {
                    table[index].classList.remove('mostrar');
                    table[index].removeAttribute("style");
                    table_details[index].removeAttribute("style");
                } else {
                    table[index].classList.add('mostrar');
                    table[index].style.height = height_header + "px";
                    table_details[index].style.height = height + "px";
                }
            });
        }
        var callback = (function(e) {
            const select_details = document.querySelectorAll('.select_details');
            const table_title = document.querySelectorAll('.details_reportitle');
            const table_product = document.querySelectorAll('.details_report');
            console.log("btns: "+select_details.length+"  subtablas:  "+table_title.length);
            for (let index = 0; index < select_details.length; index++) {
                
                select_details[index].addEventListener("click", function(e) {
                    
                    const height = table_product[index].scrollHeight;
                    const height_header = table_title[index].scrollHeight;
                    if (table_title[index].classList.contains("mostrar")) {
                        table_title[index].classList.remove('mostrar');
                        table_title[index].removeAttribute("style");
                        table_product[index].removeAttribute("style");
                    } else {
                        table_title[index].classList.add('mostrar');
                        table_title[index].style.height = height_header + "px";
                        table_product[index].style.height = height + "px";
                    }
                });
                observer.disconnect();
            }
            
        });
        
        const table_report = document.querySelector('#products');
        const observer = new MutationObserver(callback);
        const observerOptios = {
            attributes: true,
            childList: true,
            subtree: true,
        };
        
        /* window.onload=function(){
            var fecha = new Date();
            var mes =fecha.getMonth()+1;
            var dia =fecha.getDate();
            var anio = fecha.getFullYear();
            if(dia<10){
                dia="0"+dia;
            }
            if (mes<10) {
                mes="0"+mes;
            }
            document.querySelector("#fechadate").value=anio+"-"+mes+"-"+dia;
        } */
    </script>
@stop
