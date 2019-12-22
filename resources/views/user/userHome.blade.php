@extends('layouts.app')

@section('content')
@if ( Auth::user()->name != "convidado" )
<div class="container">
    <div class="row">
        <div id="infoPanel" class="col-md-8 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Usuários</div>
                <div class="panel-heading">
                    <button type="submit" class="btn btn-primary" onclick="location.href = '/usernew';">Novo Usuário</button>
                </div>
                <div class="panel-body">
                <div class="ibox">
                        <div class="ibox-content">
                            <div class="input-group">
                                <input type="text" placeholder="Search client " class="input form-control">
                                <span class="input-group-btn">
                                        <button type="button" class="btn btn btn-primary"> <i class="fa fa-search"></i> Search</button>
                                </span>
                            </div>
                            <div class="clients-list">
                                <div class="tab-content">
                                    <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Família</th>
                                                        <th>Login</th>
                                                        <th>Código de acesso</th>
                                                        <th>Situação</th>
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
                                                        <td class="client-status" onclick="userExcluir('{{ $user->id }}')"><span class="label label-danger">Excluir</span></td>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection