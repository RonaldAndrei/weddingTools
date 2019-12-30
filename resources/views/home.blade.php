@extends('layouts.app')

@section('content')
@if ($confirmado)
<div class="container">
    <div id="infoPanel" class=".col-md-auto">
        <div class="panel panel-default">
            <div class="panel-heading">Informações</div>

            <div class="panel-body">
                <div class="card">

                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item" onclick="mostraInforCerimonia()">
                                <a id="abaCerimonia" class="nav-link active">Cerimônia</a>
                            </li>
                            <li class="nav-item" onclick="mostraInforChurrasco()">
                                <a id="abaChurrasco" class="nav-link">Churrasco</a>
                            </li>
                        </ul>
                    </div>

                    <div id="infoCerimonia">
                        <div class="card-body">
                            <ul>
                                <li>Data: 14 de Março de 2020</li>
                                <li>Horário: 20:00</li>
                                <li>Local: Igreja São Pedro Apóstolo Sabará</li>
                                <li>Endereço: Av. Melvin Jones, 300 - Chapada, Ponta Grossa - PR, 84062-150</li>
                            </ul>
                        </div>
                    </div>

                    <div id="infoChurrasco">
                        <div class="card-body">
                            <ul>
                                <li>Data: 15 de Março de 2020</li>
                                <li>Horário: 11:00</li>
                                <li>Local: Chácara Recanto dos Amigos</li>
                                <li>Endereço: Estrada da Bocaina, S/N - Bocaina, Ponta Grossa - PR, 84125-200</li>
                                <br>
                                <p>O local possui piscina para as crianças, mesas de bilhar, pebolim e tênis de mesa.
                                <br>Não esqueça sua chuteira, teremos também um amistoso de futebol.</p>

                            </ul>
                        </div>
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
