<?php

namespace App\Http\Controllers;

use App\Convidado;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Controllers\FuncoesAuxController;

class ConvidadoController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Convidado Controller
    |--------------------------------------------------------------------------    |
    */

    protected function validator($url)
    {
        $data = $_POST;
        if ($data != null) 
        {
            switch ($url) {
                case "new": {
                    $this->createConvidado($data);
                    return redirect('/convidadonew');
                    break;
                }
                case "delete": {
                    if($data['id'] != null)
                        $this->deleteConvidado($data);
                    break;
                }
                case "presente": {
                    if($data['id'] != null)
                        $this->presenteConvidado($data);
                    break;
                }
                case "ausente": {
                    if($data['id'] != null)
                        $this->ausenteConvidado($data);
                    break;
                }
                default : return view('home'); break;
            }
        }
    }

    public function retornaViewConvidadoHome($url) {
        if (Auth::check()) {

            switch ($url) {
                case "home": {
                    $convidados = DB::select("SELECT 
                                                t1.id idConvidado,
                                                t1.ativo ativoConvidado,
                                                t1.nome nomeConvidado,
                                                t1.confirmado confirmadoConvidado,
                                                t1.bebida,
                                                t1.faixaEtaria,
                                                t1.inscritoTruco,
                                                t1.parentesco,
                                                t2.id idUser,
                                                t2.family familyUser
                                                FROM convidado t1
                                                JOIN user t2 ON t2.id = t1.idFamilia
                                               WHERE t1.ativo = 1
                                                 AND t2.status = 1
                                               ORDER BY t2.family, nome;");

                    $qtdConvidados = count($convidados);
                    $presentes = 0; 
                    $ausentes = 0;
                    $pendentes = 0;
                    $qtdBebidas = 0;
                    $qtdCriancas = 0;
                    $qtdTruco = 0;
                    $qtdDaniela = 0;
                    $qtdRonald = 0;

                    foreach ($convidados as $convidado) {

                        if($convidado->confirmadoConvidado == 2){
                            $presentes++;
                            if($convidado->bebida == 1)
                                $qtdBebidas++;
                            if($convidado->faixaEtaria == 'C')
                                $qtdCriancas++;
                            if($convidado->inscritoTruco == 1)
                                $qtdTruco++;
                            if($convidado->parentesco == 'D')
                                $qtdDaniela++;
                            if($convidado->parentesco == 'R')
                                $qtdRonald++;                 
                        }
                        else if($convidado->confirmadoConvidado == 1)
                            $ausentes++;
                        else if($convidado->confirmadoConvidado == 0)
                            $pendentes++;       
                    }

                    $info = array(
                        "qtdConvidados" => $qtdConvidados,
                        "presentes" => $presentes,
                        "ausentes" => $ausentes,
                        "pendentes" => $pendentes,
                        "qtdBebidas" => $qtdBebidas,
                        "qtdCriancas" => $qtdCriancas,
                        "qtdTruco" => $qtdTruco,
                        "qtdDaniela" => $qtdDaniela,
                        "qtdRonald" => $qtdRonald,
                    );

                    return view('convidado.convidadoHome', compact('convidados', 'info'));
                    break;
                }
                case "confirma": {
                    $convidados = DB::select("SELECT 
                                                t1.id idConvidado,
                                                t1.ativo ativoConvidado,
                                                t1.nome nomeConvidado,
                                                t1.confirmado confirmadoConvidado,
                                                t2.id idUser,
                                                t2.family familyUser
                                                FROM convidado t1
                                                JOIN user t2 ON t2.id = t1.idFamilia
                                               WHERE t1.ativo = 1
                                                 AND t2.status = 1
                                                 AND t1.idFamilia = " . Auth::id() . " 
                                               ORDER BY t2.family, nome;");

                    $info = false;

                    return view('convidado.convidadoHome', compact('convidados','url', 'info'));
                    break;
                }
                default : return view('home'); break;
            }
        } else {
            return view('auth.login');
        }
    }

    public function retornaViewConvidadoNew() {

        if (Auth::check()) {

            $familias = DB::select("SELECT * 
                                      FROM user
                                     WHERE status = 1
                                       AND name = 'convidado'
                                     ORDER BY family");

            return view('convidado.convidadoNew', compact('familias'));
        } else {
            return view('auth.login');
        }
    }

    protected function createConvidado(array $data) {

        $nome = FuncoesAuxController::formatString($data['convidadoName']); 
        $idFamilia = $data['familiaConvidado']; 
        $confirmado = $data['confirmado'];
        $parentesco = $data['parentesco'];
        $faixaEtaria = $data['faixaEtaria'];
        $bebida = $data['bebida'];

        return Convidado::create([
            'nome' => $nome,
            'idFamilia' => $idFamilia,
            'confirmado' => $confirmado,
            'inscritoTruco' => 0,
            'parentesco' => $parentesco,
            'faixaEtaria' => $faixaEtaria,
            'bebida' => $bebida,
            'ativo' => 1,
        ]);
    }

    public function deleteConvidado(array $data) {
        $id = $data['id'];

        DB::table('convidado')
            ->where('id', $id)
            ->update(['ativo' => 0]);
    }

    public function presenteConvidado(array $data) {
        $id = $data['id'];

        DB::table('convidado')
            ->where('id', $id)
            ->update(['confirmado' => 2]);
    }

    public function ausenteConvidado(array $data) {
        $id = $data['id'];

        DB::table('convidado')
            ->where('id', $id)
            ->update(['confirmado' => 1]);
    }
}
