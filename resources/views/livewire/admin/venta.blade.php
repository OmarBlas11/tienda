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
        <div wire:ignore class="card-body">
            <table class="table table-form">
                <thead>
                    <tr>
                        <th>NOMBRE</th>
                        <th>P.VENTA</th>
                        <th>STOCK</th>
                        <th>CANTIDAD</th>
                    </tr>
                </thead>
                <tbody id="llenar">

                </tbody>
            </table>
        </div>
    </div>
</div>
