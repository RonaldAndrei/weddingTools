@extends('layouts.app')

@section('content')
@if ( Auth::user()->name != "convidado" )
<div class="container">
    <div class="row">
        <div class="col align-self-center">
            <div class="panel panel-default">
                <div class="panel-heading">Usuários</div>
                <div class="panel-heading">
                    <input type="text" id="userSearch" class="input form-control" onkeyup="tableSearch('userSearch','userTable')" placeholder="Busca por nomes..">  
                </div>
                <div class="table-responsive-sm">
                    <div class="panel-body">
                        <table id="userTable" class="table table-striped table-hover">
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
                                        <div><button type="button" class="btn btn-danger btn-xs" onclick="userExcluir('{{ $user->id }}' , '{{ csrf_token() }}')">Excluir</button></div>
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