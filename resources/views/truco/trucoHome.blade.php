@extends('layouts.app')

@section('content')
@if ($confirmado)
<div class="container">
    <div class="row">
        <div class="col align-self-center">
            <div class="panel panel-default">
                <div class="panel-heading">Duplas inscritas</div>
                
                @if($duplas)
                <div class="panel-heading">
                    <div class="form-row">
                        <div class="col">
                            <input type="text" id="duplaSearch" class="input form-control" onkeyup="divSearch('duplaSearch','duplaDiv')" placeholder="Busca por Nome da Dupla ou Participante..">
                        </div>
                    </div>
                </div>

                <div class="table-responsive-sm">
                    <div class="panel-body">
    
                        <div class="form-row" style="float:left;" id="duplaDiv">
                        
                            @foreach($duplas as $dupla)
                            <div class="col">
                                <div class="card bg-light mb-3" style="min-width: 15rem; max-width: 15rem;">
                                <div class="card-header">
                                    <strong>{{ ucwords($dupla->nomeDupla) }}</strong>
                                    @if($dupla->adminDupla == Auth::id())
                                    <button style="float:right;" type="button" class="btn btn-light btn-xs" data-toggle="modal" data-target="#trucoDeleteModal" href="#trucoDeleteModal" aria-expanded="false" onclick="setIdDuplaTrucoExcluir('{{ $dupla->idDupla }}' , '{{ $dupla->idParticipante1 }}' , '{{ $dupla->idParticipante2 }}' , '{{ ucwords($dupla->nomeDupla) }}')"><span><i class="fas fa-trash-alt"></i></span></button>
                                    @endif
                                </div>
                                    <div class="card-body">
                                        <p class="card-text">- {{ ucwords($dupla->nomeParticipante1) }}</p>
                                        <p class="card-text">- {{ ucwords($dupla->nomeParticipante2) }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>

                    </div>
                </div>
                @else
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Ainda não há nenhuma dupla cadastrada!</strong></h5>
                        <a href="/truconew" class="btn btn-primary">Cadastre sua dupla</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Modal confirma delete content -->
@if($duplas)
<div class="container">
    <div class="row justify-content-md-center">
        <div class=".col-md-4">
            <div class="modal fade" id="trucoDeleteModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Excluir dupla</h4>
                        </div>
                    <div class="modal-body">
                        <input id="trucoDeleteIdDupla" class="hidden">
                        <input id="trucoDeleteIdParticipante1" class="hidden">
                        <input id="trucoDeleteIdParticipante2" class="hidden">
                        <p>Deseja mesmo excluir a dupla "<span id="trucoDeleteDupla"></span>"?</p>
                    </div>
                    <div class="modal-footer align-self-center">
                        <button type="button" class="btn btn-primary" onclick="duplaTrucoExcluir('{{ csrf_token() }}')">Excluir</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
@endif
@else
    @include('avisos.avisoConfirmaPresenca')
@endif
@endsection