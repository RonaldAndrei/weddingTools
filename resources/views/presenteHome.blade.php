@extends('layouts.app')

@section('content')
@if ($confirmado)
<div class="container">
    <div id="infoPanel" class=".col-md-auto">
        <div class="panel panel-default">
            <div class="panel-heading">Presentes</div>
            <div id="presenteDiv" class="card bg-light">
                <div class="form-row">
                    <div class="col">
                        <div class="card-body">
                            <p class="card-text">Para nós o mais importante é a sua presença neste momento tão especial.</p>
                            <p class="card-text">Mesmo assim, caso deseje nos presentear, poderá fazer um depósito de qualquer quantia na conta abaixo.</p>
                            <p class="card-text">Este valor nos ajudará com as despesas do churrasco.</p>
                            <br>
                            <p class="card-text"><strong>Caixa Econômica Federal (104):</strong></p>
                            <p>Agência: 1757 
                            <br>Conta Poupança: 0036525-5
                            <br>Operação: 013
                            <br>Nome: Daniela Santos
                            <br>CPF: 107.901.059-93</p>
                        </div>
                    </div>
                    <div class="col">
                        <img id="presenteImg" class="card-img" src="/img/gift.png" alt="Card image">
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
