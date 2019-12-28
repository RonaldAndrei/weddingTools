<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Controllers\FuncoesAuxController;

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
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator($url)
    {
        $data = $_POST;
        if ($data != null) 
        {
            switch ($url) {
                case "/new": {
                    if($data['name'] != null && $data['family'] != null)
                        $this->createUser($data);
                    return $this->retornaViewUserNew();
                    break;
                }
                case "/delete": {
                    if($data['id'] != null)
                        $this->deleteUser($data);
                    return $this->retornaViewUserHome();
                    break;
                }
                default : break;
            }
        }
    }

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
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function createUser(array $data) {
        $name = FuncoesAuxController::formatString($data['name']);
        $family = FuncoesAuxController::formatString($data['family']);
        $password = FuncoesAuxController::formatString(base64_encode($family));

        return User::create([
            'status' => 1,
            'name' => $name,
            'family' => $family,
            'password' =>$password,
        ]);
    }

    public function deleteUser(array $data) {
        $id = $data['id'];

        DB::table('user')
            ->where('id', $id)
            ->update(['status' => 0]);
    }
}
