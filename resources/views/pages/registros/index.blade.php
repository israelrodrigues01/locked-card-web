@extends('template')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/lib/dataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lib/flatpickr/dark.css') }}">
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row row-cards mb-4">
                <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-primary text-white avatar">
                                        <i class="ti ti-notes icon"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        Registros
                                    </div>
                                    <div class="text-secondary">
                                        Total de registros: {{ $registros->count() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Gerenciamento de registros
                    </div>
                    <h2 class="page-title">
                        Registros de Entrada e Saída
                    </h2>
                </div>

                <div class="col-auto ms-auto">
                    <a href="{{ route('registros.create') }}" class="btn bg-blue text-blue-fg d-none d-sm-inline-block">
                        Novo Registro
                    </a>
                    <a href="{{ route('registros.create') }}" class="btn btn-primary d-sm-none btn-icon">
                        <i class="ti icon ti-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="table-responsive">
                    <table id="registrosTable" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Usuário</th>
                                <th>Entrada</th>
                                <th>Saída</th>
                                <th width="160px">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registros as $registro)
                                <tr>
                                    <td>{{ $registro->user->name }}</td>
                                    <td>
                                        {{ $registro->ENTRADA ? \Carbon\Carbon::parse($registro->ENTRADA)->format('d/m/Y H:i') : 'Não registrada' }}
                                    </td>
                                    <td>
                                        {{ $registro->SAIDA ? \Carbon\Carbon::parse($registro->SAIDA)->format('d/m/Y H:i') : 'Não registrada' }}
                                    </td>
                                    <td class="align-middle">
                                        @if ($registro->ENTRADA && !$registro->SAIDA)
                                            <span class="badge bg-green text-white">Ativo</span>
                                        @elseif ($registro->ENTRADA && $registro->SAIDA)
                                            <span class="badge bg-blue text-white">Finalizado</span>
                                        @else
                                            <span class="badge bg-yellow text-dark">Pendente</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/lib/dataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            let table = new DataTable('#registrosTable', {
                processing: true,
                serverSide: false,
                order: [],
                language: {
                    sProcessing: "Processando...",
                    sLengthMenu: "Mostrar _MENU_ registros",
                    sZeroRecords: "Nenhum registro encontrado",
                    sInfo: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    sInfoEmpty: "Mostrando 0 registros",
                    sInfoFiltered: "(filtrado de _MAX_ registros no total)",
                    sSearch: "Pesquisar:",
                    oAria: {
                        sSortAscending: ": Ordenar colunas de forma ascendente",
                        sSortDescending: ": Ordenar colunas de forma descendente"
                    }
                }
            });
        });
    </script>
@endsection
