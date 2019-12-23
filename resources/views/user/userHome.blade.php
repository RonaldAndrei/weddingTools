@extends('layouts.app')

@section('content')
@if ( Auth::user()->name != "convidado" )
<div class="container">
    <div class="row">
        <div id="infoPanel" class="col align-self-center">
            <div class="panel panel-default">
                <div class="panel-heading">Usuários</div>
                <div class="panel-heading">
                    <div class="form-inline">
                        <div class="">
                            <button type="submit" id="btnUserNew" class="btn btn-primary" onclick="location.href = '/usernew';">Novo Usuário</button>
                        </div>
                        <div class="">
                            <input type="text" id="userSearch" class="input form-control" onkeyup="myFunction()" placeholder="Busca por nomes..">  
                        </div>
                    </div>
                </div>
                <div class="table-responsive-sm">
                    <div class="panel-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Família</th>
                                    <th>Login</th>
                                    <th>Código de acesso</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @if($users)
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->family }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->password }}</td>
                                    <td>
                                        <div><button type="button" class="btn btn-danger btn-xs" onclick="userExcluir('{{ $user->id }}')">Excluir</button></div>
                                    </td>
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