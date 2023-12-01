<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private $responseData = array('data' => array());

    public function __construct() {
        $this->middleware('auth:api', [
            'except'=>[
                'login',
                'create',
                'unauthorized'
            ]
        ]);
    }




    public function unauthorized() {
        return response()->json(['error'=>'Não autorizado'], 401);
    }






    public function logout(Request $request) {
        $array = ['error' => ''];

        $email = $request->input('email');
        $password = $request->input('password');

        $token = auth()->attempt([
            'email' => $email,
            'password' => $password
        ]);

        if(!$token) {
            $array['error'] = 'Email e/ou senha errados!';
            return $array;
        }

        $responseData = ['data' => ['token' => $token]];

        if ($array->count()) {
            return response()->json($responseData, Response::HTTP_NOT_FOUND);
        }

        return response()->json($array, Response::HTTP_OK);

    }



    public function update(Request $request) {

      $array = ['error' => ''];

      $name = $request->input('name');
      $email = $request->input('email');
      $password = $request->input('password');
      $password_confirm = $request->input('password_confirm');
      $birthdate = $request->input('birthdate');
      $phone = $request->input('phone');
      $document = $request->input('document');
      $role = $request->input('role');


      $user = User::find($this->loggedUser['id']);


      if($name) {
          $user->name = $name;
      }

      if($email) {
          if($email != $user->email) {
              $emailExists = User::where('email', $email)->count();
              if($emailExists === 0) {
                  $user->email = $email;
              } else {
                  $array['error'] = 'E-mail já existe!';
                  return $array;
              }
          }
      }


      if($birthdate) {
          if(strtotime($birthdate) === false) {
              $array['error'] = 'Data de nascimento inválida!';
              return $array;
          }
          $user->birthdate = $birthdate;
      }

      if($phone) {
          $user->phone = $phone;
      }


      if($document) {
          $user->document = $document;
      }

      if($role) {
        $user->role = $role;
    }


      if($password && $password_confirm) {
          if($password === $password_confirm) {
              $hash = password_hash($password, PASSWORD_DEFAULT);
              $user->password = $hash;
          } else {
              $array['error'] = 'As senhas não batem.';
              return $array;
          }
      }

      $user->save();

      return $array;
  }

    public function login(Request $request) {
        $array = ['error' => ''];

        $email = $request->input('email');
        $password = $request->input('password');

        if($email && $password) {
            $token = auth()->attempt([
                'email' => $email,
                'password' => $password
            ]);

            if(!$token) {
                $loginErrorResponse = $this->responseData;

                $loginErrorResponse['data']['error'] = 'E-mail e/ou senha errados!';

                return response()->json($loginErrorResponse, Response::HTTP_NOT_FOUND);
            }

            $loginResponse = $this->responseData;

            $loginResponse['data']['token'] = $token;

            return response()->json($loginResponse, Response::HTTP_OK);
        }

        if ($array->count()) {
            return response()->json('Dados não enviados!', Response::HTTP_NOT_FOUND);
        }
    }

    public function refresh() {
        $token = auth()->refresh();
        return [
            'error' => '',
            'token' => $token
        ];
    }

    public function deleteuser($id) {

      $profile = User::where('id', $id)->first();

      if(empty($profile)) {
        return ['error' => 'o ID não existe'];
      } else {

      $profileAdm =  $profile->profile_id;


      if ($profileAdm  === 1) {

        return ['error' => 'Não é possivel deletar o administrador'];
      } else {

        $device = User::find($id);
        $result = $device->delete();

        if($result) {
          return ['error' => 'Usuario deletado'];
        }
         else {
          return ['error' => 'Não foi possivél deletar o usuario'];
         };

      }

      }

    }

    public function create(Request $request) {
        $array = ['error'=>''];

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $birthdate = $request->input('birthdate');
        $phone = $request->input('phone');
        $document = $request->input('document');
        $role = $request->input('role');


        if($name && $email && $password && $birthdate) {
            if(!strtotime($birthdate)) {
                $array['error'] = 'Data de nascimento inválida!';
                return $array;
            }

            $emailExists = User::where('email', $email)->count();

            if(!$emailExists) {

                $hash = password_hash($password, PASSWORD_DEFAULT);

                $profileId = -1;

                $profile = Profile::where('role', 'admin')->first();

                if ($profile) {
                    $profileId = $profile->id;
                } else {
                    $newProfile = new Profile();
                    $newProfile->role = 'admin';
                    $newProfile->active = true;

                    $newProfile->save();

                    $profileId = $newProfile->id;
                }

                $newUser = new User();
                $newUser->name = $name;
                $newUser->email = $email;
                $newUser->password = $hash;
                $newUser->birthdate = $birthdate;
                $newUser->phone = $phone;
                $newUser->document = $document;
                $newUser->profile_id = $profileId;

                $newUser->save();

                $token = auth()->attempt([
                    'email' => $email,
                    'password' => $password
                ]);
                if(!$token) {
                    $array['error'] = 'Ocorreu um erro!';
                    return $array;
                }

                $array['token'] = $token;
            } else {
                $array['error'] = 'E-mail já cadastrado!';
                return $array;
            }
        } else {
            $array['error'] = 'Não enviou todos os campos.';
            return $array;
        }


        return response()->json($array, Response::HTTP_OK);
    }
}
