@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div id="userNewForm" class="col align-self-center">
            <div class="panel panel-default">
                <div class="panel-heading">Novo convidado</div>
                <div class="panel-body">
                    <div class="panel-heading">
                        <form class="form-horizontal" method="POST" action="/convidado/new">
                            <!-- envia o token via POST -->
                            {{ csrf_field() }}
                            <!-- envia a URL via POST -->
                            <input id="url" name="url" type="text" value="/convidado/new">

                            <div class="form-group{{ $errors->has('convidadoName') ? ' has-error' : '' }}">
                                <div class=".col-md">
                                    <label>Nome</label>
                                    <input id="convidadoName" type="text" class="form-control" name="convidadoName" placeholder="Nome" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" required>
                                    @if ($errors->has('convidadoName'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('convidadoName') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('familiaConvidado') ? ' has-error' : '' }}">
                                <div class=".col-md">
                                    <label>Família</label>
                                    <select id="familiaConvidado" name="familiaConvidado" class="form-control" required>
                                    @if($familias)
                                        <option value="">Escolha uma família</option>
                                        @foreach($familias as $familia)
                                        <option value="{{ $familia->id }}">Família {{ ucwords($familia->family) }}</option>
                                        @endforeach
                                    @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('parentesco') ? ' has-error' : '' }}">
                                <div class=".col-md">
                                    <label>Parentesco</label>
                                    <select id="parentesco" name="parentesco" class="form-control" required>
                                        <option value="D">Daniela</option>
                                        <option value="R">Ronald</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('faixaEtaria') ? ' has-error' : '' }}">
                                <div class=".col-md">
                                    <label>Faixa Etária</label>
                                    <select id="faixaEtaria" name="faixaEtaria" class="form-control" required>
                                        <option value="A">Adulto</option>
                                        <option value="C">Criança</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('bebida') ? ' has-error' : '' }}">
                                <div class=".col-md">
                                    <label>Consumo de bebida</label>
                                    <select id="bebida" name="bebida" class="form-control" required>
                                        <option value="0">Não</option>
                                        <option value="1">Sim</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('confirmado') ? ' has-error' : '' }}">
                                <div class=".col-md">
                                    <label>Presença</label>
                                    <select id="confirmado" name="confirmado" class="form-control" required>
                                        <option value="0">Pendente</option>
                                        <option value="1">Ausência Confirmada</option>
                                        <option value="2">Presença Confirmada</option>
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
@endsection
