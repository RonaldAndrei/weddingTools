<?php

namespace App\Http\Controllers;

use App\Convidado;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;

class ConvidadoController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Convidado Controller
    |--------------------------------------------------------------------------    |
    */

    protected function validator()
    {
        $data = $_POST;
        if ($data != null) 
        {
            switch ($data["url"]) {
                case "/convidadonew": {
                    $this->createConvidado($data);
                    return $this->retornaViewConvidadoNew();
                    break;
                }
                case "/convidadodelete": {
                    if($data['id'] != null)
                        $this->deleteConvidado($data);
                    return $this->retornaViewConvidadoHome();
                    break;
                }
                default : return view('home'); break;
            }
        }
    }

    public function retornaViewConvidadoHome($url) {
        if (Auth::check()) {

            switch ($url) {
                case "convidadohome": {
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
                                                 AND t2.status = 1;");

                    return view('convidado.convidadoHome', compact('convidados'));
                    break;
                }
                case "convidadoconfirma": {
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
                                                 AND t1.idFamilia = " . Auth::id() . ";");

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

            $familias = DB::table('user')
                        ->where('status', '=', '1')
                        ->where('name', '=', 'convidado')
                        ->get();

            return view('convidado.convidadoNew', compact('familias'));
        } else {
            return view('auth.login');
        }
    }

    protected function createConvidado(array $data) {

        $nome = $this->formatString($data['convidadoName']); 
        $idFamilia = $data['familiaConvidado']; 
        $confirmado = $data['confirmado'];

        return Convidado::create([
            'nome' => $nome,
            'idFamilia' => $idFamilia,
            'confirmado' => $confirmado,
            'ativo' => 1,
        ]);
    }

    public function deleteConvidado(array $data) {
        $id = $data['id'];

        DB::table('convidado')
            ->where('id', $id)
            ->update(['ativo' => 0]);
    }

    public function formatString($string) {
         
        $string = preg_replace(
            array(
                "/(á|à|ã|â|ä)/",
                "/(Á|À|Ã|Â|Ä)/",
                "/(é|è|ê|ë)/",
                "/(É|È|Ê|Ë)/",
                "/(í|ì|î|ï)/",
                "/(Í|Ì|Î|Ï)/",
                "/(ó|ò|õ|ô|ö)/",
                "/(Ó|Ò|Õ|Ô|Ö)/",
                "/(ú|ù|û|ü)/",
                "/(Ú|Ù|Û|Ü)/",
                "/(ñ)/",
                "/(Ñ)/"
            ),
            explode(" ", "a A e E i I o O u U n N"),
            $string
        );
        $string = strtolower($string);
        $string = str_replace('=','',$string);

        return $string;
    }
}
