@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')


@stop

@section('content')

    <div class="row mt-2">
        <form action="{{ route('Personal-excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
                <input type="file" name="file" id="file" class="form-control" aria-describedby="inputGroupFileAddon04"
                    aria-label="Upload">
                <button class="btn btn-outline-secondary" type="submit" id="id">Masivo</button>

            </div>
        </form>
    </div>

    <button type="button" class="btn btn-info btn-sm mt-1" data-bs-toggle="modal" data-bs-target="#solicitud">
        Agregar solicitud
    </button>


    <!-- Modal -->
    <div class="modal fade" id="solicitud" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Crear nueva solicitud de compra</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <input type="number" class="form-control" placeholder="Nombre" name="numero_solicitud"
                                    required>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" placeholder="motivo_solicitud"
                                    name="motivo_solicitud" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <input type="number" class="form-control" placeholder="nivel_prioridad"
                                    name="nivel_prioridad" required>
                            </div>

                            <div class="col-6">
                                <input type="text" class="form-control" placeholder="equipo_solicitado"
                                    name="equipo_solicitado" required>
                            </div>
                        </div>


                        <div class="row mt-3">
                            <div class="col-12">
                                <select name="personal" id="personal" class="form-select">
                                    {{--   @foreach ($personals as $personal)
                                        <option value="{{ $personal->id }}">{{ $personal->nombres }}</option>
                                    @endforeach --}}
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-info btn-xs mt-2">Guardar</button>
                            </div>

                        </div>
                </div>



                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>

        </div>
    </div>


    <table class="table table-striped mt-1" id="solictudes">
        <thead class="thead-dark ">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Numero Solicitud</th>
                <th scope="col">Motivo Solicitud</th>
                <th scope="col">Personal</th>
                <th scope="col">Equipo Solicitado</th>
                <th scope="col">Prioridad de compra</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>


        </tbody>
    </table>



    <div class="d-flex">
        {{-- {{ $personals->links() }} --}}
    </div>


@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'Aceptar'
                });
            @elseif (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'Aceptar'
                });
            @endif ;




        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stop
