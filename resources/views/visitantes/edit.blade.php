@extends('layouts.app')

@section('title', 'Editar de Visitante')

@section('content')
    <div class="container">
        <h2>Editar de Visitante</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('visitantes.update', $visitante->id) }}" method="POST" class="mb-4">
            @csrf

            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" class="form-control" id="nome" value="{{ $visitante->nome }}"
                    required>
            </div>

            <div class="form-group">
                <label for="data">Data:</label>
                <input type="date" name="data" class="form-control" id="data" value="{{ $visitante->data }}"
                    required>
            </div>

            <div class="form-group">
                <label for="rg">RG:</label>
                <input type="text" name="rg" class="form-control" id="rg" value="{{ $visitante->rg }}"
                    required>
            </div>

            <div class="form-group">
                <label for="hora_entrada">Hora de Entrada:</label>
                <input type="time" name="hora_entrada" class="form-control" id="hora_entrada"
                    value="{{ $visitante->hora_entrada }}" required>
            </div>

            <div class="form-group">
                <label for="hora_saida">Hora de Saída:</label>
                <input type="time" name="hora_saida" class="form-control" id="hora_saida"
                    value="{{ $visitante->hora_saida }}" required>
            </div>

            <div class="form-group">
                <label for="empresa">Empresa:</label>
                <input type="text" name="empresa" class="form-control" id="empresa" value="{{ $visitante->empresa }}"
                    required>
            </div>

            <div class="form-group">
                <label for="pessoa_visitada">Pessoa Visitada:</label>
                <input type="text" name="pessoa_visitada" class="form-control" id="pessoa_visitada"
                    value="{{ $visitante->pessoa_visitada }}" required>
            </div>

            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
            <a href="{{ route('visitantes.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>
                Voltar</a>
        </form>
    </div>
@endsection
