@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div id="infoPanel" class="col-md-8 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Informações</h3></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4>Cerimônia</h4>
                    <ul>
                        <li>Data: 14 de Março de 2020</li>
                        <li>Horário: 20:00</li>
                        <li>Local: Igreja São Pedro Apóstolo Sabará</li>
                        <li>Endereço: Av. Melvin Jones, 300 - Chapada, Ponta Grossa - PR, 84062-150</li>
                    </ul>
                    <br>
                    <h4>Churrasco</h4>
                    <ul>
                        <li>Data: 15 de Março de 2020</li>
                        <li>Horário: 11:00</li>
                        <li>Local: Chácara Recanto dos Amigos</li>
                        <li>Endereço: Estrada da Bocaina, S/N - Bocaina, Ponta Grossa - PR, 84125-200</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
