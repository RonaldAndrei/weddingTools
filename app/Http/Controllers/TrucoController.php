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
                    return $this->retornaViewTrucoHome();
                    break;
                }
                case "delete": {
                    $this->deleteInscricaoDupla($data);
                    return $this->retornaViewTrucoHome();
                    break;
                }
                default : return view('home'); break;
            }
        }
    }

    public function retornaViewTrucoHome() {
        if (Auth::check()) {
            $confirmado = FuncoesAuxController::validaConfirmacaoFamilia();
            $duplas = DB::select("SELECT
                                    t1.id idDupla,
                                    t1.nomeDupla,
                                    t1.adminDupla,
                                    t1.idParticipante1,
                                    t1.idParticipante2,
                                    t2.nome nomeParticipante1,
                                    t3.nome nomeParticipante2
                                    FROM torneio_truco t1
                                    JOIN convidado t2
                                      ON t2.id = t1.idParticipante1 AND t2.ativo = 1
                                    JOIN convidado t3
                                      ON t3.id = t1.idParticipante2 AND t3.ativo = 1
                                   WHERE t1.ativo = 1;");

            return view('truco.trucoHome', compact('duplas', 'confirmado'));

        } else {

            return view('auth.login');
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
                                              JOIN user t2 ON t2.id = t1.idFamilia AND t1.confirmado != 1
                                             WHERE t1.ativo = 1
                                               AND t2.status = 1
                                               AND t1.inscritoTruco = 0
                                               AND t1.faixaEtaria = 'A'
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
                                             JOIN user t2 ON t2.id = t1.idFamilia AND t1.confirmado != 1
                                            WHERE t1.ativo = 1
                                              AND t2.status = 1
                                              AND t1.inscritoTruco = 0
                                              AND t1.faixaEtaria = 'A'
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
            'nomeDupla' => $nomeDupla, 
            'idParticipante1' => $idParticipante1, 
            'idParticipante2' => $idParticipante2,
            'adminDupla' => Auth::id(),
            'ativo' => 1
        ]);
    }

    public function deleteInscricaoDupla(array $data) {
        $id = $data['id'];
        $idParticipante1 = $data['idParticipante1'];
        $idParticipante2 = $data['idParticipante2'];

        DB::table('torneio_truco')
            ->where('id', $id)
            ->update(['ativo' => 0]);
        
        DB::table('convidado')
            ->where('id', $idParticipante1)
            ->update(['inscritoTruco' => 0]);

        DB::table('convidado')
            ->where('id', $idParticipante2)
            ->update(['inscritoTruco' => 0]);
    }
}
