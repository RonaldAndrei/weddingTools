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
                                <ul>
                                    <li>Próximo ao supermercado Vitor</li>
                                </ul>
                                <br>
                                <a href="https://www.google.com/maps/place/Av.+Melvin+Jones,+300+-+Chapada,+Ponta+Grossa+-+PR,+84062-150/@-25.0833722,-50.2044112,17z/data=!3m1!4b1!4m5!3m4!1s0x94e8174a58b3a369:0xc3813029065cee63!8m2!3d-25.0833771!4d-50.2022225" target="_blank" class="btn btn-primary">Ver no mapa</a>
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
                                <ul>
                                    <li>Siga na estrada da bocaina, após 6 km vire à esquerda nas próximas três bifurcações</li>
                                    <li>Fique atento às placas na estrada indicando as entradas</li>
                                </ul>
                                <br>
                                <p>O local possui piscina para as crianças, mesas de bilhar, pebolim e tênis de mesa.
                                <br>Não esqueça sua chuteira, teremos também um amistoso de futebol.</p>
                                <br>
                                <a href="https://www.google.com/maps/place/Estr.+da+Bocaina,+Ponta+Grossa+-+PR/@-25.0284699,-50.2611622,14.5z/data=!4m5!3m4!1s0x94e8161a7deec7df:0x758088631a5e2d98!8m2!3d-25.0323401!4d-50.2532338" target="_blank" class="btn btn-primary">Ver no mapa</a>
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
