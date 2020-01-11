@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div id="userNewForm" class="col align-self-center">
            <div class="panel panel-default">
                <div class="panel-heading">Importar Usuários</div>
                <div class="panel-body">
                    <div class="panel-heading">
                        <form class="form-horizontal" method="POST" action="/user/import">
                            <!-- envia o token via POST -->
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('family') ? ' has-error' : '' }}">
                                <div class=".col-md">
                                    <label>Lista de nomes</label>
                                    <textarea id="namesImport" name="namesImport" class="form-control" placeholder="Digite os nomes para importar separados por ';'" rows="10" cols="30" onkeyup="this.value = removeAcentos(this.value);" autocomplete="off" required></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class=".col-md .col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">Importar</button>
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
