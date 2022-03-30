<div>
    <div class="card">
        <div class="card-header">
            <span class="btn btn-danger" data-toggle="modal" data-target="#ventana_create">Agregar un monto</span>
        </div>
        <div class="card-body table-responsive">
            @if ($boxes->count())
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Monto</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($boxes as $box)
                            <tr>
                                <td>{{ $box->monto }}</td>
                                <td>{{ $box->day }}-{{ $box->month }}-{{ $box->year }}</td>
                                <td>{{ $box->hour }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card-footer">
                    @if ($boxes->hasPages())
                    {{ $boxes->links }}
                    @endif
                </div>
            @else
                <div class="alert alert-info" role="alert">
                    <span class="text-white">No hay ningun registro</span>
                </div>
            @endif
        </div>
    </div>
    <div wire:ignore.self class="modal fade" tabindex="-1" id="ventana_create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center bg-center">Agregar un Monto</h5>
                    <a wire:click="cancel()" data-dismiss="modal" class="fas fa-times-circle" aria-label="Close"></a>
                    </button>
                </div>
                @if (session()->has('info'))
                    <span class="text-primary text-center p-3 mb-2 bg-warning">{{ session('info') }}</span>
                @endif
                <div class="modal-body">
                    <form id="formulario" wire:submit.prevent="store">
                        <div class="form-group mb-3 " id="inputname">
                            <label class="form-label" for="name">monto</label>
                            <input step="any" type="number" wire:model="monto" type="text" class="form-control" id="monto"
                                autocomplete="off" placeholder="ingresar el monto">

                            @error('monto')
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
</div>
