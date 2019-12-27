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
                        <select name="convidadoSituacaoSearch" id="convidadoSituacaoSearch" class="input form-control" onclick="tableSearch('convidadoSituacaoSearch','convidadoTable',2)">
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
                                    <td>{{ ucfirst($convidado->familyUser) }}</td>
                                    @if($convidado->confirmadoConvidado == 0)
                                    <td align="center"><span class="label label-warning">Pendente</span></td>
                                    @elseif($convidado->confirmadoConvidado == 1)
                                    <td align="center"><span class="label label-danger">Ausente</span></td>
                                    @else
                                    <td align="center"><span class="label label-primary">Presente</span></td>
                                    @endif
                                    <td>                                        
                                        <div class="col align-self-center"><button type="button" class="btn btn-light btn-xs" onclick="convidadoPresente('{{ $convidado->idConvidado }}' , '{{ csrf_token() }}')"><span><i class="fas fa-check"></i></span></button></div>
                                    </td>
                                    <td>                                        
                                        <div class="col align-self-center"><button type="button" class="btn btn-light btn-xs" onclick="convidadoAusente('{{ $convidado->idConvidado }}' , '{{ csrf_token() }}')"><span><i class="fas fa-times"></i></span></button></div>
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