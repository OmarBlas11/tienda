@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <h1 class="text-center">Lista de Categorias</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-secondary" href="{{ route('admin.categories.create') }}">Agregar Nueva Categoria</a>
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
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td width="10px">
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                    class="btn btn-primary btn-sm">Editar</a>
                            </td>
                            <td width="10px">
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">

        </div>
    </div>
    
@stop

@section('css')
@stop

@section('js')
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('myModal'), options)
    </script>
@stop
