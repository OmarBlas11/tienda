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
                        <th>FECHA</th>
                        <th>MES</th>
                        <th>HORA</th>
                        <th>MESA</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->fecha_venta }}</td>
                            <td>{{ $sale->mes }}</td>
                            <td>{{ $sale->hora }}</td>
                            <td>{{ $sale->table->name }}</td>
                            <td>
                                <a id="btneditar" wire:click="detalles({{ $sale->id }})" data-toggle="modal"
                                    data-target="#ventana_edit" class="btn btn-primary btn-sm">Ver detalles</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer table-responsive">
            {{ $sales->links() }}
        </div>
    </div>
</div>
