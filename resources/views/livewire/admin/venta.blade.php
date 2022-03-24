<div>
    <div class="card">
        <div class="card-header">
            <input class="form-control" type="text" wire:model="search" placeholder="buscar producto">
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>NOMBRE</th>
                        <th>P.VENTA</th>
                        <th>STOCK</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td id="id" hidden>{{ $product->id }}</td>
                            <td id="name">{{ $product->name }}</td>
                            <td id="preci">{{ $product->precio_venta }}</td>
                            <td id="stock">{{ $product->stock }}</td>
                            <td>
                                <a id="btnSelecionar" class="btn btn-primary">Seleccionar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-subtitle text-center">Productos selecionados</h5>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div wire:ignore class="card-body">
            <form action=""></form>
            <form action="{{ route('admin.sales.store') }}" method="POST">
                @csrf
                <table class="table table-form">
                    <thead>
                        <tr>
                            <th>NOMBRE</th>
                            <th>P.VENTA</th>
                            <th>CANTIDAD</th>
                            <th>SubTotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="llenar">
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td><input class="form-control" style="width: auto;" id="total" type="number" step="any" name="total"
                                    readonly value=""></td>
                            <td>
                                <div class="form-group mb-3">
                                    <select id="mesa" class="custom-select" name="table_id" onchange="capturarvalueSelectedMesa()">
                                        <option selected value="">Mesa</option>
                                        @foreach ($tables as $table)
                                            <option value="{{ $table->id }}">{{ $table->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Pago</td>
                            <td><input class="form-control" style="width: auto;" id="pago" type="number" step="any" name="pago"
                                    value=""></td>
                            <td>
                                <a class="form-control btn-dark" style="cursor: pointer;"
                                    onclick="calcular();">Calcular</a>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Vuelto</td>
                            <td><input class="form-control" style="width: auto;" step="any" id="vuelto" type="number"
                                    name="vuelto" readonly value=""></td>
                        </tr>
                    </tfoot>
                </table>
                <button id="btnVender" class="btn btn-primary" disabled type="submit">Realizar venta</button>
            </form>
        </div>
    </div>
</div>
