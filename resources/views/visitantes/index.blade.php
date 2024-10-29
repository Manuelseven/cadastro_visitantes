@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Cadastro de Visitantes</h2>

        <form id="searchForm" class="d-flex mb-4 mt-4">
            <input type="text" id="search" name="search" placeholder="Pesquisar..." class="form-control me-2">
            <button type="button" id="searchButton" class="btn btn-primary mx-2" style="height: 38px; width:110px;"><i
                    class="fa-solid fa-search"></i>
            </button>
        </form>

        <a href="{{ route('visitantes.create') }}" class="btn btn-primary mb-4"><i class="fa-solid fa-plus"></i> Adicionar
            Visitante</a>

        <table class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Data</th>
                    <th>RG</th>
                    <th>Hora de Entrada</th>
                    <th>Hora de Saída</th>
                    <th>Empresa</th>
                    <th>Pessoa Visitada</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="visitantesTableBody">
                @foreach ($visitantes as $visitante)
                    <tr>
                        <td>{{ $visitante->nome }}</td>
                        <td>{{ \Carbon\Carbon::parse($visitante->data)->format('d/m/Y') }}</td>
                        <td>{{ $visitante->rg }}</td>
                        <td>{{ $visitante->hora_entrada }}</td>
                        <td>{{ $visitante->hora_saida }}</td>
                        <td>{{ $visitante->empresa }}</td>
                        <td>{{ $visitante->pessoa_visitada }}</td>
                        <td>
                            <a href="{{ route('visitantes.edit', $visitante) }}" class="btn btn-primary btn-sm"><i
                                    class="fa-solid fa-pencil"></i> Editar</a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#deleteModal{{ $visitante->id }}"><i class="fa-solid fa-trash"></i>
                                Deletar</button>

                            <!-- Modal de Confirmação para Deletar -->
                            <div class="modal fade" id="deleteModal{{ $visitante->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Tem certeza que deseja excluir o visitante {{ $visitante->nome }}?
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="{{ route('visitantes.destroy', $visitante) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="fa-solid fa-trash"></i> Excluir</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                                    class="fa-solid fa-xmark"></i> Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $visitantes->links() }}
    </div>

    <script>
        $(document).ready(function() {
            $('#search').focus();

            function searchVisitantes() {
                let query = $('#search').val();


                $.ajax({
                    url: "{{ route('visitantes.search') }}",
                    method: "GET",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#visitantesTableBody').empty();

                        $.each(data.data, function(index, visitante) {
                            $('#visitantesTableBody').append(`
                                <tr>
                                    <td>${visitante.nome}</td>
                                    <td>${visitante.data}</td>
                                    <td>${visitante.rg}</td>
                                    <td>${visitante.hora_entrada}</td>
                                    <td>${visitante.hora_saida}</td>
                                    <td>${visitante.empresa}</td>
                                    <td>${visitante.pessoa_visitada}</td>
                                    <td>
                                        <a href="{{ url('visitantes') }}/${visitante.id}" class="btn btn-info btn-sm">Ver</a>
                                        <a href="{{ url('visitantes') }}/${visitante.id}/edit" class="btn btn-warning btn-sm">Editar</a>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal${visitante.id}">Deletar</button>
                                        <!-- Modal de Confirmação para Deletar -->
                                        <div class="modal fade" id="deleteModal${visitante.id}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Tem certeza que deseja excluir este visitante?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="POST" action="{{ url('visitantes') }}/${visitante.id}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Sim, Excluir</button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            `);
                        });

                        $('.pagination').html(data.links);
                    }
                });
            }


            $('#searchButton').on('click', function() {
                $('#searchForm').submit();
            });


        });
    </script>
@endsection
