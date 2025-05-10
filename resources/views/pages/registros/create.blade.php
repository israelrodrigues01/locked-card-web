@extends('template')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/lib/flatpickr/dark.css') }}">
@endsection

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3>{{ isset($registro) ? 'Editar Registro' : 'Novo Registro' }}</h3>
            </div>
            <div class="card-body">
                <form
                    action="{{ isset($registro) ? route('registros.update', $registro->CODREGIS) : route('registros.store') }}"
                    method="POST">
                    @csrf
                    @if (isset($registro))
                        @method('PUT')
                    @endif
                    <div class="mb-3">
                        <label for="user" class="form-label">Usuário</label>
                        <select name="CODUSU" id="user" class="form-control" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->CODUSU }}"
                                    {{ isset($registro) && $registro->CODUSU == $user->CODUSU ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="entrada" class="form-label">Entrada</label>
                        <input type="text" class="form-control flatpickr" name="ENTRADA" id="entrada"
                            value="{{ isset($registro) ? $registro->ENTRADA->format('d/m/Y H:i') : '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="saida" class="form-label">Saída</label>
                        <input type="text" class="form-control flatpickr" name="SAIDA" id="saida"
                            value="{{ isset($registro) ? $registro->SAIDA->format('d/m/Y H:i') : '' }}">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit"
                            class="btn btn-primary">{{ isset($registro) ? 'Atualizar Registro' : 'Salvar Registro' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/lib/flatpickr/flatpickr.min.js') }}"></script>
    <script>
        flatpickr("#entrada", {
            enableTime: true,
            dateFormat: "d/m/Y H:i",
        });
        flatpickr("#saida", {
            enableTime: true,
            dateFormat: "d/m/Y H:i",
        });
    </script>
@endsection
