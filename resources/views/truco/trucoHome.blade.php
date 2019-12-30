@extends('layouts.app')

@section('content')
@if ($confirmado)
<div class="container">
    <div class="row">
        <div class="col align-self-center">
            <div class="panel panel-default">
                <div class="panel-heading">Duplas inscritas</div>

                @if($duplas)
                <div class="table-responsive-sm">
                    <div class="panel-body">
    
                        <div class="form-row" style="float:left;">
                        
                            @foreach($duplas as $dupla)
                            <div class="col">
                                <div class="card bg-light mb-3" style="min-width: 15rem; max-width: 15rem;">
                                <div class="card-header">
                                    <strong>{{ ucwords($dupla->nomeDupla) }}</strong>
                                    @if($dupla->adminDupla == Auth::id())
                                    <button style="float:right;" type="button" class="btn btn-light btn-xs" onclick="duplaTrucoExcluir('{{ $dupla->idDupla }}' , '{{ $dupla->idParticipante1 }}' , '{{ $dupla->idParticipante2 }}' , '{{ csrf_token() }}')"><span><i class="fas fa-trash-alt"></i></span></button>
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
                @endif
            </div>
        </div>
    </div>
</div>
@else
    @include('avisos.avisoConfirmaPresenca')
@endif
@endsection