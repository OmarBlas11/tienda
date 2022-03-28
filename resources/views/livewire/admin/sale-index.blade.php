<div>
    <div class="card">
        <div class="card-header">
            <div class="row form-inline">
                <div class="col-7">
                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-lg">Buscar</span>
                        </div>
                        <input type="text" wire:model="search" class="form-control" aria-label="Default"
                            aria-describedby="inputGroup-sizing-default" placeholder="Ingresar el dato que sea buscar">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group">
                        <div class="col">
                            <select class="custom-select" id="paginarahora" wire:model="paginar">
                                <option selected value="">Mostrar</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                </div>
                @if (session()->has('llenado'))
                    <span class="text-primary text-center p-3 mb-2 bg-warning">{{ session('llenado') }}</span>
                @endif
                <a id="btneditar" wire:click="llenarsales()" data-toggle="modal" data-target="#ventana_edit"
                    class="btn btn-primary btn-sm">Ver detalles</a>
                <div class="col">
                    <div class="input-group">
                        <div class="col">
                            <select class="custom-select" id="paginarahora" wire:model="table">
                                <option selected value="">Mesas</option>
                                @foreach ($tables as $table)
                                    <option selected value="{{ $table->id }}">{{ $table->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                {{-- {{ $search }}
                <div class="col">
                    <div class="input-group">
                        <div class="col">
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-lg">Buscar</span>
                                </div>
                                <input type="date" class="form-control" wire:model="search" aria-label="Default"
                                    aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">CODIGO_VENTA</th>
                        <th scope="col">TOTAL</th>
                        <th scope="col">PAGO</th>
                        <th scope="col">VUELTO</th>
                        <th scope="col">GANANCIA</th>
                        <th scope="col">FECHA</th>
                        <th scope="col">HORA</th>
                        <th scope="col">MESA</th>
                        <th scope="col">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td style="padding: 5px;">{{ $sale->id }}</td>
                            <td style="padding: 5px;">S/.{{ $sale->total }}</td>
                            <td style="padding: 5px;">S/.{{ $sale->pago }}</td>
                            <td style="padding: 5px;">S/.{{ $sale->vuelto }}</td>
                            <td style="padding: 5px;">
                                <?php
                                $subtotalganancia = 0;
                                foreach ($product_sales as $produt_sale) {
                                    if ($sale->id == $produt_sale->sale_id) {
                                        $subtotalganancia += $produt_sale->total - $produt_sale->product->precio_compra * $produt_sale->cantidad;
                                    }
                                }
                                echo 'S/.  ' . $subtotalganancia;
                                ?>
                            </td>
                            <td style="padding: 5px;">{{ $sale->day }}-{{ $sale->Month }}-{{ $sale->year }}
                            </td>
                            <td style="padding: 5px;">{{ $sale->hora }}</td>
                            <td style="padding: 5px;">{{ $sale->table->name }}</td>
                            <td style="padding: 5px;">
                                <a class="btn btn-primary select">detalles</a>
                            </td>
                        </tr>
                        <td colspan="10" style="padding: 0;">
                            <table style="background-color: wheat">
                                <thead class="details">
                                    <tr>
                                        <th>Sub.Total</th>
                                        <th>P.Venta</th>
                                        <th>P.Compra</th>
                                        <th>Cantidad</th>
                                        <th>Producto</th>
                                        <th>Ganancia_Parcial</th>
                                    </tr>
                                </thead>
                                <tbody class="details_pro">
                                    @foreach ($product_sales as $produt_sale)
                                        @if ($sale->id == $produt_sale->sale_id)
                                            <tr>
                                                <td></td>
                                                <td>{{ $produt_sale->total }}</td>
                                                <td>{{ $produt_sale->product->precio_venta }}</td>
                                                <td></td>
                                                <td>{{ $produt_sale->product->precio_compra }}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $produt_sale->cantidad }}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $produt_sale->product->name }}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $produt_sale->total - $produt_sale->product->precio_compra * $produt_sale->cantidad }}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-header table-responsive">
            <?php
            $total = 0;
            foreach ($salesall as $saleall) {
                $total += $saleall->total;
            }
            $subtotalganancia = 0;
            foreach ($product_sales as $produt_sale) {
                $subtotalganancia += $produt_sale->product->precio_compra * $produt_sale->cantidad;
            }
            echo 'La ganancia total es de: S/.  ' . $total - $subtotalganancia;
            ?>
        </div>
        <div class="card-footer table-responsive">
            {{ $sales->links() }}
        </div>
    </div>
    <div class="card text-center row">
        <nav class="navbar navbar-light bg-light" style="display: flex; flex-direction: row">
            <div class="container-fluid">
                <form class="d-flex">
                    <input class="form-control" id="fechadate" type="date" wire:model.defer="date" value="">
                </form>
            </div>
        </nav>
        <div wire:ignore class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item nav-report">
                    <a class="nav-link" style="cursor: pointer" aria-current="true"
                        wire:click='renederizarday'>DÍA</a>
                </li>
                <li class="nav-item nav-report">
                    <a class="nav-link" style="cursor: pointer" aria-current="true"
                        wire:click='renederizarweek'>SEMANA</a>
                </li>
                <li class="nav-item nav-report">
                    <a class="nav-link" style="cursor: pointer" aria-current="true"
                        wire:click='renederizarmonth'>MES</a>
                </li>
                <li class="nav-item nav-report">
                    <a class="nav-link" style="cursor: pointer" aria-current="true"
                        wire:click='renederizaryear'>AÑO</a>
                </li>
            </ul>
        </div>
        @if (session()->has('mensaje'))
            <span class="text-primary text-center p-3 mb-2 bg-warning">{{ session('mensaje') }}</span>
        @endif
        <div class="card-body table-responsive">
            <h5 class="card-subtitle text-center">{{ $Nombre }}</h5>
            <table id="products" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>CODIGO_VENTA</th>
                        <th>TOTAL</th>
                        <th>PAGO</th>
                        <th>VUELTO</th>
                        <th>FECHA</th>
                        <th>HORA</th>
                        <th>MESA</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody id="subtable">
                    <?php $total = 0;
                    $gasto = 0;
                    $ganancia = 0; ?>
                    @foreach ($report_customizeds as $report_customizeds)
                        <tr>
                            <td>{{ $report_customizeds->id }}</td>
                            <td>S/.{{ $report_customizeds->total }}</td>
                            <td>S/.{{ $report_customizeds->pago }}</td>
                            <td>S/.{{ $report_customizeds->vuelto }}</td>
                            <td>{{ $report_customizeds->day }}-{{ $report_customizeds->Month }}-{{ $report_customizeds->year }}
                            </td>
                            <td>{{ $report_customizeds->hora }}</td>
                            <td>{{ $report_customizeds->table->name }}</td>
                            <td style="padding: 5px;">
                                <a class="btn btn-primary select_details">detalles</a>
                            </td>
                        </tr>
                        <td colspan="10" style="padding: 0;">
                            <table>
                                <thead class="details_reportitle">
                                    <tr>
                                        <th>Sub.Total</th>
                                        <th>P.Venta</th>
                                        <th>P.Compra</th>
                                        <th>Cantidad</th>
                                        <th>Producto</th>
                                        <th>Ganancia_Parcial</th>
                                    </tr>
                                </thead>
                                <tbody class="details_report">
                                    @foreach ($product_sales as $produt_sale)
                                        @if ($report_customizeds->id == $produt_sale->sale_id)
                                            <tr></tr>
                                            <tr>
                                                <td>{{ $produt_sale->total }}</td>
                                                <td></td>
                                                <td>{{ $produt_sale->product->precio_venta }}</td>
                                                <td></td>
                                                <td>{{ $produt_sale->product->precio_compra }}</td>
                                                <td></td>
                                                <td>{{ $produt_sale->cantidad }}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $produt_sale->product->name }}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $produt_sale->total - $produt_sale->product->precio_compra * $produt_sale->cantidad }}
                                                </td>
                                            </tr>
                                            <?php $gasto += $produt_sale->product->precio_compra * $produt_sale->cantidad; ?>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                        <?php
                        $total = $total + $report_customizeds->total;
                        $ganancia = $total - $gasto;
                        ?>
                    @endforeach
                    <tr>
                        <td>
                            TOTAL:
                        </td>
                        <td>
                            <?php
                            echo 'S/.  ' . $total;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            GASTO:
                        </td>
                        <td>
                            {{ 'S/.  ' . $gasto }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            GANANCIAS:
                        </td>
                        <td>
                            {{ 'S/.  ' . $ganancia }}
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
        <div class="card-footer">

        </div>
    </div>
</div>
