<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Torneio_truco;
use DB;
use App\Http\Controllers\FuncoesAuxController;

class TrucoController extends Controller
{
    protected function validator($url)
    {
        $data = $_POST;
        if ($data != null) 
        {
            switch ($url) {
                case "new": {
                    $this->createInscricaoDupla($data);
                    //return $this->retornaViewDuplas();
                    break;
                }
                default : return view('home'); break;
            }
        }
    }

    public function retornaViewTrucoNew() {

        if (Auth::check()) {
            $confirmado = FuncoesAuxController::validaConfirmacaoFamilia();

            $listaConvidados1 = DB::select("SELECT 
                                                t1.id idConvidado,
                                                t1.ativo ativoConvidado,
                                                t1.nome nomeConvidado,
                                                t1.confirmado confirmadoConvidado,
                                                t1.inscritoTruco,
                                                t2.id idUser,
                                                t2.family familyUser
                                              FROM convidado t1
                                              JOIN user t2 ON t2.id = t1.idFamilia
                                             WHERE t1.ativo = 1
                                               AND t2.status = 1
                                               AND t1.inscritoTruco = 0
                                               AND t1.idFamilia = " . Auth::id() . " 
                                             ORDER BY t2.family, nome;");
            
            $listaConvidados2 = DB::select("SELECT 
                                                t1.id idConvidado,
                                                t1.ativo ativoConvidado,
                                                t1.nome nomeConvidado,
                                                t1.confirmado confirmadoConvidado,
                                                t1.inscritoTruco,
                                                t2.id idUser,
                                                t2.family familyUser
                                             FROM convidado t1
                                             JOIN user t2 ON t2.id = t1.idFamilia
                                            WHERE t1.ativo = 1
                                              AND t2.status = 1
                                              AND t1.inscritoTruco = 0
                                            ORDER BY t2.family, nome;");

            return view('truco.trucoNew', compact('confirmado', 'listaConvidados1', 'listaConvidados2'));
        } else {
            return view('auth.login');
        }
    }

    protected function createInscricaoDupla(array $data) {

        $nomeDupla = FuncoesAuxController::formatString($data['nomeDupla']); 
        $idParticipante1 = $data['idParticipante1']; 
        $idParticipante2 = $data['idParticipante2'];

        return Torneio_truco::create([
            'id' => $id, 
            'nomeDupla' => $nomeDupla, 
            'idParticipante1' => $idParticipante1, 
            'idParticipante2' => $idParticipante2
        ]);
    }
}
