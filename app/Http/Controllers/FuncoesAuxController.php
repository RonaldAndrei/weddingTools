<?php

namespace App\Http\Controllers;

use App\Convidado;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;

class FuncoesAuxController extends Controller
{

    /* 
        Retorna a string informada sem acentos, sem caracter '=' em minusculo
    */
    public static function formatString($string) {
         
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

    /* 
        Retorna booleano conforme se houver um convidado com presença confirmada na familia do usuário
    */
    public static function validaConfirmacaoFamilia() {
        $convidadoConfirma = DB::select("SELECT 
                                            t1.id idConvidado
                                           FROM convidado t1
                                           JOIN user t2 ON t2.id = t1.idFamilia
                                          WHERE t1.ativo = 1
                                            AND t2.status = 1
                                            AND t1.confirmado = 2
                                            AND t1.idFamilia = " . Auth::id());
        return ($convidadoConfirma != null);
    }

}
