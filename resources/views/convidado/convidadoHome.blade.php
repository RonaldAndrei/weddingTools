@extends('layouts.app')

@section('content')
@if ( Auth::user()->name != "convidado" || $url == "convidadoconfirma")
<div class="container">
    <div class="row">
        <div class="col align-self-center">
            <div class="panel panel-default">
                <div class="panel-heading">Convidados</div>
                <div class="panel-heading">

                <div class="form-row">
                    <div class="col">
                        <input type="text" id="convidadoSearch" class="input form-control" onkeyup="tableSearch('convidadoSearch','convidadoTable',1)" placeholder="Busca por Família..">
                    </div>
                    <div class="col">
                        <button type="button" id="convidadoSituacaoPendenteSearch" class="btn btn-warning btn-sm" value="pendente" onclick="tableSearch('convidadoSituacaoPendenteSearch','convidadoTable',2)">Pendente</button>
                        <button type="button" id="convidadoSituacaoAusenteSearch" class="btn btn-danger btn-sm" value="ausência" onclick="tableSearch('convidadoSituacaoAusenteSearch','convidadoTable',2)">Ausente</button>
                        <button type="button" id="convidadoSituacaoPresenteSearch" class="btn btn-success btn-sm" value="presença" onclick="tableSearch('convidadoSituacaoPresenteSearch','convidadoTable',2)">Presente</button>
                        <button type="button" id="convidadoSituacaoTodasSearch" class="btn btn-light btn-sm" value="" onclick="tableSearch('convidadoSituacaoTodasSearch','convidadoTable',2)">Todas</button>
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
                                    <th>Situação</th>
                                    <th>Presente</th>
                                    <th>Ausente</th>
                                    <th>Excluir</th>
                                </tr>
                            </thead>
                            @if($convidados)
                            <tbody>
                            @foreach($convidados as $convidado)
                                <tr>
                                    <td>{{ ucwords($convidado->nomeConvidado) }}</td>
                                    <td>{{ ucfirst($convidado->familyUser) }}</td>
                                    @if($convidado->confirmadoConvidado == 0)
                                    <td><span class="label label-warning">Pendente</span></td>
                                    @elseif($convidado->confirmadoConvidado == 1)
                                    <td><span class="label label-danger">Ausência Confirmada</span></td>
                                    @else
                                    <td><span class="label label-success">Presença Confirmada</span></td>
                                    @endif
                                    <td>                                        
                                        <div class="col align-self-center"><button type="button" class="btn btn-light btn-xs" onclick="convidadoPresente('{{ $convidado->idConvidado }}' , '{{ csrf_token() }}')"><span><i class="fas fa-thumbs-up"></i></span></button></div>
                                    </td>
                                    <td>                                        
                                        <div class="col align-self-center"><button type="button" class="btn btn-light btn-xs" onclick="convidadoAusente('{{ $convidado->idConvidado }}' , '{{ csrf_token() }}')"><span><i class="fas fa-thumbs-down"></i></span></button></div>
                                    </td>
                                    @if( Auth::user()->name != "convidado" )
                                    <td>                                        
                                        <div class="col align-self-center"><button type="button" class="btn btn-light btn-xs" onclick="convidadoExcluir('{{ $convidado->idConvidado }}' , '{{ csrf_token() }}')"><span><i class="fas fa-trash-alt"></i></span></button></div>
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
@endif
@endsection