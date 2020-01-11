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
                                    <td>{{ ucwords($user->family) }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->password }}</td>
                                    <td>                                        
                                        <div><button type="button" class="btn btn-light btn-xs" data-toggle="modal" data-target="#userDeleteModal" href="#userDeleteModal" aria-expanded="false" onclick="setIdUserExcluir('{{ $user->id }}' , '{{ ucfirst($user->family) }}');"><span><i class="fas fa-trash-alt"></i></span></button></div>
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
<!-- Modal confirma delete content -->
@if($users)
<div class="container">
    <div class="row justify-content-md-center">
        <div class=".col-md-4">
            <div class="modal fade" id="userDeleteModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Excluir usuário</h4>
                        </div>
                    <div class="modal-body">
                        <input id="userDeleteId" class="hidden">
                        <p>Deseja mesmo excluir o usuário da família <span id="userDeleteFamily"></span>?</p>
                    </div>
                    <div class="modal-footer align-self-center">
                        <button type="button" class="btn btn-primary" onclick="userExcluir('{{ csrf_token() }}')">Excluir</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
@endif

@endif
@endsection