@extends('template')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/lib/dataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lib/flatpickr/dark.css') }}">
@endsection

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Usuários
                    </h2>
                </div>
                <div class="col-auto ms-auto">
                    <a href="#" class="btn bg-blue text-blue-fg d-none d-sm-inline-block" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasUsuarioCreate">
                        Novo Usuário
                    </a>
                    <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasUsuarioCreate">
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
                    <table id="usuariosTable" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Data de Criação</th>
                                <th width="10%">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $user)
                                <tr>
                                    <td class="align-middle">{{ $user->name }}</td>
                                    <td class="align-middle">{{ $user->email }}</td>
                                    <td class="align-middle">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="#" class="btn btn-icon btn-primary" data-bs-toggle="offcanvas"
                                            data-bs-target="#offcanvasUsuarioEdit" title="Editar">
                                            <i class="ti ti-edit icon"></i>
                                        </a>
                                        <form action="{{ route('usuarios.destroy', $user->CODUSU) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-danger" title="Excluir"
                                                onclick="return confirm('Tem certeza que deseja excluir?')">
                                                <i class="ti ti-trash icon"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Offcanvas para edit usuário -->
                                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasUsuarioEdit"
                                    aria-labelledby="offcanvasUsuarioEditLabel">
                                    <div class="offcanvas-header">
                                        <h2 class="offcanvas-title" id="offcanvasUsuarioEditLabel">Editar Usuário</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                            aria-label="Fechar"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <form id="formUsuario" method="POST"
                                            action="{{ route('usuarios.update', $user->CODUSU) }}">
                                            @method('PUT')
                                            @csrf

                                            <div class="mb-3">
                                                <label class="form-label">Nome</label>
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="Digite o nome" value="{{ $user->name }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    placeholder="Digite o Email" value="{{ $user->email }}" required>
                                            </div>

                                            <div class="mb-3" id="campoSenha">
                                                <label class="form-label">Senha</label>
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="Digite a senha">
                                            </div>

                                            <div class="text-end">
                                                <button type="reset" class="btn btn-secondary"
                                                    data-bs-dismiss="offcanvas">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Adicionar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Offcanvas para criar usuário -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasUsuarioCreate"
        aria-labelledby="offcanvasUsuarioCreateLabel">
        <div class="offcanvas-header">
            <h2 class="offcanvas-title" id="offcanvasUsuarioCreateLabel">Novo Usuário</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
        </div>
        <div class="offcanvas-body">
            <form id="formUsuario" method="POST" action="{{ route('usuarios.store') }}">
                @csrf
                <input type="hidden" name="create_form" value="active">

                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                        placeholder="Digite o nome" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                        placeholder="Digite o Email" required>
                </div>

                <div class="mb-3" id="campoSenha">
                    <label class="form-label">Senha</label>
                    <input type="password" name="password" class="form-control" placeholder="Digite a senha">
                </div>

                <div class="text-end">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="offcanvas">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/lib/dataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).ready(function() {
                let table = new DataTable('#usuariosTable', {
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
        });
    </script>
@endsection
