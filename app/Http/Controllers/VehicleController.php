<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\User;

use Illuminate\Http\Request;

class VehicleController extends Controller
{
    function list(Request $request) {

      $array = ['error' => '', 'users' => []];

      $txt = $request->input('txt');

      if($txt) {

          // Busca de usuários
          $userList = Vehicle::where('chassi', 'like', '%'.$txt.'%')->get();
          foreach($userList as $userItem) {
              $array['users'][] = [
                  'id' => $userItem['id'],
                  'brand' => $userItem['brand'],
                  'model' => $userItem['model'],
                  'plate' => $userItem['plate'],
                  'year_manufacture	' => $userItem['year_manufacture	'],
                  'year_model' => $userItem['year_model'],
                  'chassi' => $userItem['chassi'],
                  'color' => $userItem['color'],
                  'created_at' => $userItem['created_at'],
                  'updated_at' => $userItem['updated_at'],


              ];
          }

      } else {
          $array['error'] = 'Digite alguma coisa para buscar.';
          return $array;
      }


       return $array;
    }



}
