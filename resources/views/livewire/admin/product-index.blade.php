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
                            aria-describedby="inputGroup-sizing-default"
                            placeholder="Ingresar el dato que sea buscar">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group">
                        <div class="col">
                            <select class="custom-select" id="paginarahora" wire:model="paginar">
                                <option selected value="">Mostrar</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                            </select>
                        </div>
                    </div>
                </div>
                {{$category}}
                <div class="col">
                    <div class="input-group">
                        <div class="col">
                            <select class="custom-select" id="paginarahora" wire:model="category">
                                <option selected value="">Categorias</option>
                               @foreach ($categories as $category)
                               <option selected value="{{$category->id}}">{{$category->name}}</option>
                               @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>CODIGO</th>
                        <th>NOMBRE</th>
                        <th>PRECIO DE COMPRA</th>
                        <th>PRECIO DE VENTA</th>
                        <th>STOCK</th>
                        <th>CATEGORIA</th>
                        <th colspan="2">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->precio_compra }}</td>
                            <td>{{ $product->precio_venta }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td width="10px">
                                <a id="btneditar" wire:click="editar({{ $product->id }})" data-toggle="modal"
                                    data-target="#ventana_edit" class="btn btn-primary btn-sm">Editar</a>
                            </td>
                            <td width="10px">
                                <a id="btneDelete" wire:click="delete({{ $product->id }})"class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer table-responsive">{{ $products->onEachSide(2)->links() }}</div>
    </div>
</div>
