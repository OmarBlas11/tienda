<div>
    <div class="card">
        <div class="card-header">
            <a class="btn btn-secondary" data-toggle="modal" data-target="#ventana_create">Agregar Nuevo Producto</a>
        </div>
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
                <div class="col">
                    <div class="input-group">
                        <div class="col">
                            <select class="custom-select" id="paginarahora" wire:model="category">
                                <option selected value="">Categorias</option>
                                @foreach ($categories as $category)
                                    <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (session()->has('delete'))
            <span class="text-primary text-center p-3 mb-2 bg-warning">{{ session('delete') }}</span>
        @endif
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>CODIGO</th>
                        <th>NOMBRE</th>
                        <th>P.COMPRA</th>
                        <th>P.VENTA</th>
                        <th>STOCK</th>
                        <th>GASTO</th>
                        <th>CATEGORIA</th>
                        <th colspan="2">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>S/. {{ $product->precio_compra }}</td>
                            <td>S/. {{ $product->precio_venta }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>S/. {{ $product->precio_compra * $product->stock }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td width="10px">
                                <a id="btneditar" wire:click="editar({{ $product->id }})" data-toggle="modal"
                                    data-target="#ventana_edit" class="btn btn-primary btn-sm">Editar</a>
                            </td>
                            <td width="10px">
                                <a id="btneDelete" wire:click="delete({{ $product->id }})"
                                    class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer table-responsive">{{ $products->onEachSide(2)->links() }}</div>
    </div>
    <p>
        <button class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button"
            aria-expanded="false" aria-controls="multiCollapseExample1">Ver Gasto Total</button>
    </p>
    <div class="row">
        <div class="col-sm-6">
            <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="card card-body">
                    <?php
                    $sumadeltotal_de_gastos = 0;
                    foreach ($product_all as $products_ind) {
                        $sumadeltotal_de_gastos += $products_ind->precio_compra * $products_ind->stock;
                    }
                    echo 'El Gasto Total es de:   S/.  ' . $sumadeltotal_de_gastos;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($categories as $category)
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gasto en: <strong
                                class="text-danger">{{ $category->name }}</strong></h5>
                        <p class="card-text">
                            <?php
                            $suma = 0;
                            foreach ($product_all as $products_ind) {
                                if ($products_ind->category_id == $category->id) {
                                    $suma += $products_ind->precio_compra * $products_ind->stock;
                                }
                            }
                            echo 'S/.  ' . $suma;
                            ?>
                        </p>
                        <span class="btn btn-primary">Es la cantidad esacta de inversión en esta categoria</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div wire:ignore.self class="modal fade" tabindex="-1" id="ventana_create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center bg-center">Nueva Producto</h5>
                    <a wire:click="cancel()" data-dismiss="modal" class="fas fa-times-circle" aria-label="Close"></a>
                    </button>
                </div>
                @if (session()->has('info'))
                    <span class="text-primary text-center p-3 mb-2 bg-warning">{{ session('info') }}</span>
                @endif
                <div class="modal-body">
                    <form id="formulario" wire:submit.prevent="store">
                        <div class="form-group mb-3 " id="inputname">
                            <label class="form-label" for="name">Nombre</label>
                            <input type="text" wire:model="name" type="text" class="form-control" id="name"
                                autocomplete="off" placeholder="ingresar el nombre">
                            @error('slug')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="precio_compra" class="form-label">Precio de Compra</label>
                            <input type="number" step="any" name="precio_compra"
                                placeholder="Ingresar el precio de compra" class="form-control"
                                wire:model="precio_compra" autocomplete="off">
                            @error('precio_compra')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="percio_venta" class="form-label">Precio de Venta</label>
                            <input type="number" step="any" name="precio_venta" wire:model="precio_venta"
                                class="form-control" placeholder="Ingresar el precio de venta" autocomplete="off">
                            @error('precio_venta')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="stock" class="form-label">Cantidad</label>
                            <input type="number" name="stock" wire:model="stock" class="form-control"
                                placeholder="Ingresar la cantidad del producto" autocomplete="off">
                            @error('stock')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="category_id">Categoria</label>
                            <select class="custom-select" id="paginarahora" wire:model="category_id">
                                <option selected value="">Categorias</option>
                                @foreach ($categories as $category)
                                    <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <input type="text" wire:model="slug" type="text" name="name" hidden class="form-control" id="slug"
                            placeholder="ingresar el nombre"> --}}
                        <div class="modal-footer">
                            <button wire:click="cancel()" data-dismiss="modal"
                                class="btn btn-secondary">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" tabindex="-1" id="ventana_edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center bg-center">Editar Producto</h5>
                    <a wire:click="cancel()" data-dismiss="modal" class="fas fa-times-circle" aria-label="Close"></a>
                    </button>
                </div>
                @if (session()->has('info'))
                    <span class="text-primary text-center p-3 mb-2 bg-warning">{{ session('info') }}</span>
                @endif
                <div class="modal-body">
                    <form id="formulario" wire:submit.prevent="update">
                        <div class="form-group mb-3 " id="inputname">
                            <label class="form-label" for="name">Nombre</label>
                            <input type="text" wire:model="name" type="text" class="form-control" id="name"
                                autocomplete="off" placeholder="ingresar el nombre">
                            @error('slug')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="precio_compra" class="form-label">Precio de Compra</label>
                            <input type="number" step="any" name="precio_compra"
                                placeholder="Ingresar el precio de compra" class="form-control"
                                wire:model="precio_compra" autocomplete="off">
                            @error('precio_compra')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="percio_venta" class="form-label">Precio de Venta</label>
                            <input type="number" step="any" name="precio_venta" wire:model="precio_venta"
                                class="form-control" placeholder="Ingresar el precio de venta" autocomplete="off">
                            @error('precio_venta')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="stock" class="form-label">Cantidad</label>
                            <input type="number" name="stock" wire:model="stock" class="form-control"
                                placeholder="Ingresar la cantidad del producto" autocomplete="off">
                            @error('stock')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="category_id">Categoria</label>
                            <select class="custom-select" id="paginarahora" wire:model="category_id">
                                <option selected value="">Categorias</option>
                                @foreach ($categories as $category)
                                    <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <input type="text" wire:model="slug" type="text" name="name" hidden class="form-control" id="slug"
                            placeholder="ingresar el nombre"> --}}
                        <div class="modal-footer">
                            <button wire:click="cancel()" data-dismiss="modal"
                                class="btn btn-secondary">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
