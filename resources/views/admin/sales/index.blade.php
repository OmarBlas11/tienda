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
    .menos{
        height: 0px;
        
    }
    .details_pro{
        display: none;
        height: 0;
        overflow: hidden;
        transition: all 05s;
        
    }
    .details{
        display: none;
        height: 0;
        overflow: hidden;
        transition: all 05s;
    }
    .mostrar{
        display: block;
        height: auto;
        overflow: visible;
    }
</style>
@stop

@section('js')
@livewireScripts
<script>
    const nav=document.querySelectorAll('.nav-report > a');
    for (let index = 0; index < nav.length; index++) {
        nav[index].addEventListener("click", function (e) {
            nav.forEach(el => el.classList.remove('active'));
            if (this.classList.contains("active")) {
                this.classList.remove("active")
            }else{
                this.classList.add('active');
            }
        })
        
    }
    const btn=document.querySelectorAll(".select");
    const table=document.querySelectorAll(".details");
    const table_details=document.querySelectorAll(".details_pro");
    const table_person=document.querySelector(".table-person");
    console.log('tamanio del tr: '+table_details.length+"tamanio de los titulos: "+table.length)
    for (let index = 0; index < btn.length; index++) {
        btn[index].addEventListener("click", function (e) {
            
            if (table[index].classList.contains("mostrar")) {
                table[index].classList.remove('mostrar');
                table_details[index].classList.remove('mostrar');
            }else{
                table[index].classList.add('mostrar');
                table_details[index].classList.add('mostrar');
            }
        });
    }
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