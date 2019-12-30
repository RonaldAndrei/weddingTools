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
                    return $this->retornaViewConvidadoNew();
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
                                                t2.id idUser,
                                                t2.family familyUser
                                                FROM convidado t1
                                                JOIN user t2 ON t2.id = t1.idFamilia
                                               WHERE t1.ativo = 1
                                                 AND t2.status = 1
                                               ORDER BY t2.family, nome;");

                    return view('convidado.convidadoHome', compact('convidados'));
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

                    return view('convidado.convidadoHome', compact('convidados','url'));
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
