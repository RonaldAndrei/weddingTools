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
                default : break;
            }
        }
    }

    public function retornaViewConvidadoHome() {
        // if (Auth::check()) {

        //     $users = DB::table('user')
        //                 ->where('status', '=', '1')
        //                 ->get();

        //     return view('user.userHome', compact('users'));
        // } else {
        //     return view('auth.login');
        // }
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
        // $id = $data['id'];

        // DB::table('user')
        //     ->where('id', $id)
        //     ->update(['status' => 0]);
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
