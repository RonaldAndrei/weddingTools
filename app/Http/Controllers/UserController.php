<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    public function retornaViewUserHome() {
        if (Auth::check()) {

            $users = DB::table('user')
                        ->where('status', '=', '1')
                        ->get();

            return view('user.userHome', compact('users'));

        } else {

            return view('auth.login');
        }
    }

    public function retornaViewUserNew() {

        if (Auth::check()) {

            return view('user.userNew');
        } else {

            return view('auth.login');
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator()
    {
        $data = $_POST;

        if ($data != null) 
        {
            if($data['name'] != null && $data['family'] != null)
                UserController::create($data);

            return UserController::retornaViewUserNew();
        }
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $name = UserController::formatString($data['name']);
        $family = UserController::formatString($data['family']);
        $password = UserController::formatString(base64_encode($family));

        return User::create([
            'status' => 1,
            'name' => $name,
            'family' => $family,
            'password' =>$password,
        ]);
    }

    public function formatString($string){
         
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
