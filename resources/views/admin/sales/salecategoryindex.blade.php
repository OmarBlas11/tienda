@extends('adminlte::page')

@section('title', 'Reportes de Categoria')

@section('content_header')
    <h1 class="text-center">Ventas por Categoria</h1>
@stop

@section('css')
    @livewireStyles
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <style>
        .nav-bar{
            background: #E38646;
            padding: 20px;
            display: block;
            color: white;
            cursor: pointer;
            font-size: 1.5em;
            width: 100%;
        }
        .menu_item{
            cursor: pointer;
        }
        .menu{
            list-style: none;
            padding: 0;
            margin: 0;
            background: #343a40;
            width: 100%;
            transition: all 0.5s;
            margin-left: -110%;
        }
        .menu_link{
            display: block;
            padding: 20px;
            color: white;
            font-size: 1.2em;
            text-decoration: none;
        }
        .menu_link:hover{
            background: #6c757d;
            color: white;
        }
        .mostrar{
            margin-left: 0
        }
        .select{
            background: #6c757d;
        }
        @media(min-width:1024px){
            .nav-bar{
                display: none;
            }
            .menu{
                margin-left: 0;
                display: flex;
            }
        }
    </style>
@stop
@section('content')
<span class="nav-bar" id="btnMenu"><i class="fas fa-bars"></i></span>
<nav class="main-nav">
    <ul class="menu" id="menu">
        @foreach ($categories as $salecategory)
            <li class="menu_item <?php if ($id==$salecategory->id) {echo 'select';}?>"><a class="menu_link" href="{{ route('admin.salecategories.show', $salecategory) }}">{{ $salecategory->name }}</a>

            </li>
        @endforeach
        <li class="menu_item {{ request()->routeIs('admin.salecategories.index') ? 'select': '' }}"><a class="menu_link" href="{{ route('admin.salecategories.index') }}" >Todas</a>
            
        </li>

    </ul>
</nav>
<div class="card">
    <div class="card-body">
        <table class="table table-striped" id="categorias">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>P.Venta</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Ganancia</th>
                    <th>Mesa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product_sales as $product_sale)
                    <tr>
                        <td>{{ $product_sale->product->name }}</td>
                        <td>{{ $product_sale->product->precio_venta }}</td>
                        <td>{{ $product_sale->cantidad }}</td>
                        <td>{{ $product_sale->total }}</td>
                        <td>{{ $product_sale->total - $product_sale->product->precio_compra * $product_sale->cantidad }}
                        </td>
                        <td>{{ $product_sale->sale->table->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('js')
    @livewireScripts
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#categorias').DataTable();
        const btnMneu=document.querySelector("#btnMenu");
        const menu=document.querySelector("#menu");
        btnMenu.addEventListener("click", function (e) {
            menu.classList.toggle("mostrar");
        });
        const nav=document.querySelectorAll(".menu_link");
    for (let index = 0; index < nav.length; index++) {
        nav[index].addEventListener("click", function (e) {
            nav.forEach(el => el.classList.remove('select'));
            if (this.classList.contains("select")) {
                this.classList.remove("select")
            }else{
                this.classList.add('select');
            }
        })
        
    }
    </script>
@stop
