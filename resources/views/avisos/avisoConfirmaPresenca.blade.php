@if( time() < mktime(0, 0, 0, 2, 10, 2020) )
<div class="card text-center">
    <div class="card-body">
        <h5 class="card-title"><strong>Nenhum convidado confirmou presença ainda!</strong></h5>
        <p class="card-text">Para mais informações confirme a presença de seus familiares.</p>
        <a href="/convidadoconfirma/confirma" class="btn btn-primary">Confirmar presença!</a>
    </div>
</div>
@else
<div class="card text-center">
    <div class="card-body">
        <h5 class="card-title"><strong>Período esgotado!</strong></h5>
        <p class="card-text">O período estabelecido para confirmação de presença já acabou.</p>
    </div>
</div>
@endif