<div>
    <div class="card">
        <div class="card-header">
            <span class="btn btn-danger" data-toggle="modal" data-target="#ventana_create">Registrar Nuevo Gasto</span>
        </div>
        <div class="card-body table-responsive">
            @if ($expenses->count())
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Monto</th>
                            <th>Concepto</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $expense)
                            <tr>
                                <td>{{ $expense->monto }}</td>
                                <td>{{ $expense->concepto }}</td>
                                <td>{{ $expense->day }}-{{ $expense->month }}-{{ $expense->year }}</td>
                                <td>{{ $expense->hour }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card-footer">
                    @if ($expenses->hasPages())
                        {{ $expenses->links }}
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
                    <h5 class="modal-title text-center bg-center">Registrar Gasto</h5>
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
                            <input step="any" type="number" wire:model="gasto" type="text" class="form-control"
                                id="gasto" autocomplete="off" placeholder="ingresar el gasto">

                            @error('gasto')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="name">Conepto</label>
                            <input type="text" wire:model="concepto" type="text" class="form-control"
                                id="concepto" autocomplete="off" placeholder="ingresar el motivo del gasto">
                            @error('concepto')
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
</div>
