@extends('layouts.app')

@section('content')
@if ($confirmado)
<div class="container">
    <div class="row">
        <div id="userNewForm" class="col align-self-center">
            <div class="panel panel-default">
                <div class="panel-heading">Novo convidado</div>
                <div class="panel-body">
                    <div class="panel-heading">
                        <form class="form-horizontal" method="POST" action="/truco/new">
                            <!-- envia o token via POST -->
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('nomeDupla') ? ' has-error' : '' }}">
                                <div class=".col-md">
                                    <label>Nome da dupla</label>
                                    <input id="nomeDupla" type="text" class="form-control" name="nomeDupla" placeholder="Crie um nome para sua dupla" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" required>
                                    @if ($errors->has('nomeDupla'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nomeDupla') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('idParticipante1') ? ' has-error' : '' }}">
                                <div class=".col-md">
                                    <label>Família</label>
                                    <select id="idParticipante1" name="idParticipante1" class="form-control" required>
                                    @if($listaConvidados1)
                                        <option value="">Escolha o primeiro participante</option>
                                        @foreach($listaConvidados1 as $convidado)
                                        <option value="{{ $convidado->idConvidado }}">{{ ucfirst($convidado->nomeConvidado) }}</option>
                                        @endforeach
                                    @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('idParticipante2') ? ' has-error' : '' }}">
                                <div class=".col-md">
                                    <label>Família</label>
                                    <select id="idParticipante2" name="idParticipante2" class="form-control" required>
                                    @if($listaConvidados2)
                                        <option value="">Escolha o segundo participante</option>
                                        @foreach($listaConvidados2 as $convidado)
                                        <option value="{{ $convidado->idConvidado }}">{{ ucfirst($convidado->nomeConvidado) }}</option>
                                        @endforeach
                                    @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class=".col-md .col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">
                                        Salvar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
    @include('avisos.avisoConfirmaPresenca')
@endif
@endsection
