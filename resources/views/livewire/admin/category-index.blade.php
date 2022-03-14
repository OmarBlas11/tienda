<div>
    <div class="card">
        @if (session()->has('delete'))
                    <span class="text-primary text-center p-3 mb-2 bg-warning">{{ session('delete') }}</span>
                @endif
        <div class="card-header">
            <a class="btn btn-secondary" data-toggle="modal" data-target="#ventana_create">Agregar
                Nueva
                Categoria</a>

        </div>
        <div class="card-body table-responsive-sm">
            <table class="table table-striped table-hover ">
                <thead>
                    <tr>
                        <td>CODIGO</td>
                        <td>NOMBRE</td>
                        <td colspan="2">ACCIONES</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td id="idcat">{{ $category->id }}</td>
                            <td id="namecat">{{ $category->name }}</td>
                            <td width="10px">
                                <a id="btneditar" wire:click="editar({{ $category->id }})" data-toggle="modal"
                                    data-target="#ventana_edit" class="btn btn-primary btn-sm">Editar</a>
                            </td>
                            <td width="10px">
                                <a id="btneDelete" wire:click="delete({{ $category->id }})"class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
        </div>
    </div>
    <div wire:ignore.self class="modal fade" tabindex="-1" id="ventana_create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center bg-center">Nueva Categoria</h5>
                    <button wire:click="cancel()" data-dismiss="modal" class="fas fa-times-circle" aria-label="Close"></button>
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

                        {{-- <input type="text" wire:model="slug" type="text" name="name" hidden class="form-control" id="slug"
                            placeholder="ingresar el nombre"> --}}
                        <div class="modal-footer">
                            <button wire:click="cancel()" data-dismiss="modal" class="btn btn-secondary">Cancelar</button>
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
                    <h5 class="modal-title text-center bg-center">Editar Categoria</h5>
                    <button wire:click="cancel()" data-dismiss="modal" class="fas fa-times-circle" aria-label="Close"></button>
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

                        {{-- <input type="text" wire:model="slug" type="text" name="name" hidden class="form-control" id="slug"
                            placeholder="ingresar el nombre"> --}}
                        <div class="modal-footer">
                            <button wire:click="cancel()" data-dismiss="modal" class="btn btn-secondary">Cacelar</button>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
