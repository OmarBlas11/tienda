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
                {{-- @if (session()->has('llenado'))
                    <span class="text-primary text-center p-3 mb-2 bg-warning">{{ session('llenado') }}</span>
                @endif
                <a id="btneditar" wire:click="llenarsales()" data-toggle="modal" data-target="#ventana_edit"
                    class="btn btn-primary btn-sm">Ver detalles</a> --}}
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
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $sale->id }}</td>
                            <td>S/.{{ $sale->total }}</td>
                            <td>S/.{{ $sale->pago }}</td>
                            <td>S/.{{ $sale->vuelto }}</td>
                            <td>{{ $sale->day }}-{{ $sale->Month }}-{{ $sale->year }}</td>
                            <td>{{ $sale->hora }}</td>
                            <td>{{ $sale->table->name }}</td>
                            <td width>
                                <a ddata-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"
                                    class="btn btn-primary btn-sm">Ver detalles</a>
                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                        Button with data-bs-target
                                    </button>
                            </td>
                        </tr>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                            </div>
                        </div>
                        <tr class="collapse" id="collapseExample" style="background: red; height: 0px; display: none">
                                <thead>
                                    <tr>
                                        <th>CODIGO</th>
                                        <th>PRODUCTO</th>
                                        <th>P.Venta</th>
                                        <th>CATIDAD</th>
                                        <th>TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product_sales as $produt_sale)
                                        @if ($sale->id == $produt_sale->sale_id)
                                            <tr>
                                                <td>{{ $produt_sale->id }}</td>
                                                <td>{{ $produt_sale->product->name }}</td>
                                                <td>{{ $produt_sale->product->precio_venta }}</td>
                                                <td>{{ $produt_sale->cantidad }}</td>
                                                <td>{{ $produt_sale->total }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                    @endforeach
                </tbody>
            </table>
        </div>
    <div class="card-footer table-responsive">
        {{ $sales->links() }}
    </div>
</div>
<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="true">DÍA</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="true">MES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="true">AÑO</a>
            </li>
        </ul>
    </div>
    <div class="card-body table-responsive">
        <h5 class="card-title">Special title treatment</h5>
        <table class="table table-striped table-hover">
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
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>
                        <td>S/.{{ $sale->total }}</td>
                        <td>S/.{{ $sale->pago }}</td>
                        <td>S/.{{ $sale->vuelto }}</td>
                        <td>{{ $sale->day }}-{{ $sale->Month }}-{{ $sale->year }}</td>
                        <td>{{ $sale->hora }}</td>
                        <td>{{ $sale->table->name }}</td>
                        <td width>
                            <a id="btneditar" wire:click="detalles({{ $sale->id }})" data-toggle="modal"
                                data-target="#ventana_edit" class="btn btn-primary btn-sm">Ver detalles</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
