@extends('layouts.app')

@section('content')
@if ( Auth::user()->name != "convidado" || $url == "confirma")
<div class="container">
    <div class="row">
        <div class="col align-self-center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Convidados
                    @if ( Auth::user()->name != "convidado")
                    <button class="btn btn-light" data-toggle="modal" data-target="#convidadosInfo" href="#convidadosInfo" aria-expanded="false"><span><i class="fas fa-info"></i></span></button>
                    @endif
                </div>
                
                <div class="panel-heading">

                <div class="form-row">
                    <div class="col">
                        <input type="text" id="convidadoSearch" class="input form-control" onkeyup="tableSearch('convidadoSearch','convidadoTable',1)" placeholder="Busca por Família..">
                    </div>
                    <div class="col">
                        <select name="convidadoSituacaoSearch" id="convidadoSituacaoSearch" class="input form-control" onchange="tableSearch('convidadoSituacaoSearch','convidadoTable',2)">
                            <option value="">Todos</option>
                            <option value="pendente">Pendente</option>
                            <option value="ausente">Ausente</option>
                            <option value="presente">Presente</option>
                        </select>
                    </div>
                </div>
                    
                </div>
                <div class="table-responsive-sm">
                    <div class="panel-body">
                        <table id="convidadoTable" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Família</th>
                                    <th style="text-align: center;">Situação</th>
                                    <th>Presente</th>
                                    <th>Ausente</th>
                                    @if( Auth::user()->name != "convidado" )
                                    <th>Excluir</th>
                                    @endif
                                </tr>
                            </thead>
                            @if($convidados)
                            <tbody>
                            @foreach($convidados as $convidado)
                                <tr>
                                    <td>{{ ucwords($convidado->nomeConvidado) }}</td>
                                    <td>{{ ucwords($convidado->familyUser) }}</td>
                                    @if($convidado->confirmadoConvidado == 0)
                                    <td align="center"><span id="confirmadoConvidado{{ $convidado->idConvidado }}" class="label label-warning">Pendente</span></td>
                                    @elseif($convidado->confirmadoConvidado == 1)
                                    <td align="center"><span id="confirmadoConvidado{{ $convidado->idConvidado }}" class="label label-danger">Ausente</span></td>
                                    @else
                                    <td align="center"><span id="confirmadoConvidado{{ $convidado->idConvidado }}" class="label label-primary">Presente</span></td>
                                    @endif
                                    <td>                                        
                                        <div class="col align-self-center"><button type="button" class="btn btn-light btn-xs" onclick="convidadoPresente('{{ $convidado->idConvidado }}' , '{{ csrf_token() }}')"><span><i class="fas fa-check"></i></span></button></div>
                                    </td>
                                    <td>                                        
                                        <div class="col align-self-center"><button type="button" class="btn btn-light btn-xs" onclick="convidadoAusente('{{ $convidado->idConvidado }}' , '{{ csrf_token() }}')"><span><i class="fas fa-times"></i></span></button></div>
                                    </td>
                                    @if( Auth::user()->name != "convidado" )
                                    <td>                                        
                                        <div class="col align-self-center"><button type="button" class="btn btn-light btn-xs" data-toggle="modal" data-target="#convidadoDeleteModal" href="#convidadoDeleteModal" aria-expanded="false" onclick="setIdConvidadoExcluir('{{ $convidado->idConvidado }}' , '{{ ucwords($convidado->nomeConvidado) }}');"><span><i class="fas fa-trash-alt"></i></span></button></div>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if ( Auth::user()->name != "convidado")
<!-- Modal Info content-->
<div class="container">
    <div class="row justify-content-md-center">
        <div class=".col-md-4">
            <div class="modal fade" id="convidadosInfo" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Informações sobre os convidados</h4>
                        </div>
                        <div class="modal-body">
                            <table id="convidadoTable" class="table table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <td>Quantidade Convidados: </td>
                                        <td> <strong>{{ $info['qtdConvidados'] }}</strong> </td>
                                    </tr>
                                    <tr>
                                        <td>Convidados Presentes: </td>
                                        <td> <strong>{{ $info['presentes'] }}</strong> </td>
                                    </tr>
                                    <tr>
                                        <td>Convidados Ausentes: </td>
                                        <td> <strong>{{ $info['ausentes'] }}</strong> </td>
                                    </tr>
                                    <tr>
                                        <td>Convidados Pendentes: </td>
                                        <td> <strong>{{ $info['pendentes'] }}</strong> </td>
                                    </tr>
                                    <tr>
                                        <td>Consumo de Bebidas: </td>
                                        <td> <strong>{{ $info['qtdBebidas'] }}</strong> </td>
                                    </tr>
                                    <tr>
                                        <td>Crianças: </td>
                                        <td> <strong>{{ $info['qtdCriancas'] }}</strong> </td>
                                    </tr>
                                    <tr>
                                        <td>Inscritos Truco: </td>
                                        <td> <strong>{{ $info['qtdTruco'] }}</strong> </td>
                                    </tr>
                                    <tr>
                                        <td>Parentesco Daniela: </td>
                                        <td> <strong>{{ $info['qtdDaniela'] }}</strong> </td>
                                    </tr>
                                    <tr>
                                        <td>Parentesco Ronald: </td>
                                        <td> <strong>{{ $info['qtdRonald'] }}</strong> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer align-self-center">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
@endif
<!-- Modal Presenca content-->
<div class="container">
    <div class="row justify-content-md-center">
        <div class=".col-md-4">
            <div class="modal fade" id="convidadoPresencaModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Presença confirmada!</h4>
                        </div>
                    <div class="modal-body">
                        <p>Obrigado por confirmar sua presença.
                        <br>Sem você a nossa festa não estaria completa.</p>
                    </div>
                    <div class="modal-footer align-self-center">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
<!-- Modal Ausencia content-->
<div class="container">
    <div class="row justify-content-md-center">
        <div class=".col-md-4">
            <div class="modal fade" id="convidadoAusenciaModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Ausência confirmada!</h4>
                        </div>
                        <div class="modal-body">
                            <p>Que pena, entendemos que não será possível comparecer nesta data.
                            <br>Agradecemos por nos avisar.</p>
                        </div>
                        <div class="modal-footer align-self-center">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
<!-- Modal confirma delete content -->
@if($convidados)
<div class="container">
    <div class="row justify-content-md-center">
        <div class=".col-md-4">
            <div class="modal fade" id="convidadoDeleteModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Excluir convidado</h4>
                        </div>
                    <div class="modal-body">
                        <input id="convidadoDeleteId" class="hidden">
                        <p>Deseja mesmo excluir o(a) convidado(a) <span id="convidadoDeleteNome"></span>?</p>
                    </div>
                    <div class="modal-footer align-self-center">
                        <button type="button" class="btn btn-primary" onclick="convidadoExcluir('{{ csrf_token() }}')">Excluir</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
@endif

@endif
@endsection