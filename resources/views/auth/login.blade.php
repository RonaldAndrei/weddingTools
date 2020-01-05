@extends('layouts.app')

@section('content')
@guest
<div class="container">
    <div class="row justify-content-md-center">
        <div class=".col-md-4">
            <div class="panel panel-default col align-self-center">
                <div class="panel-heading">Digite o código de acesso impresso no verso do seu convite</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div id="nameDiv" class="col align-self-center collapse">
                                <input id="name" type="text" class="form-control" name="name" value="convidado" autocomplete="off" onkeyup="this.value = this.value.toLowerCase().trim();">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col align-self-center">
                                <input id="password" type="text" class="form-control" name="password" placeholder="Código de acesso" autocomplete="off" onkeyup="this.value = this.value.toLowerCase().trim();mostraInputName();" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col align-self-center">
                                <button type="submit" class="btn btn-primary">
                                    Entrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endguest
@endsection
