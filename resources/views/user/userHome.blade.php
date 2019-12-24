@extends('layouts.app')

@section('content')
@if ( Auth::user()->name != "convidado" )
<div class="container">
    <div class="row">
        <div class="col align-self-center">
            <div class="panel panel-default">
                <div class="panel-heading">Usuários</div>
                <div class="panel-heading">
                    <input type="text" id="userSearch" class="input form-control" onkeyup="tableSearch('userSearch','userTable',0)" placeholder="Busca por nomes..">  
                </div>
                <div class="table-responsive-sm">
                    <div class="panel-body">
                        <table id="userTable" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Família</th>
                                    <th>Login</th>
                                    <th>Código de acesso</th>
                                    <th>Excluir</th>
                                </tr>
                            </thead>
                            @if($users)
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ ucfirst($user->family) }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->password }}</td>
                                    <td>                                        
                                        <div><button type="button" class="btn btn-light btn-xs" onclick="userExcluir('{{ $user->id }}' , '{{ csrf_token() }}')"><span><i class="fas fa-trash-alt"></i></span></button></div>
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