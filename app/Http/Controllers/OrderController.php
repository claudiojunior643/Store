<?php

namespace App\Http\Controllers;

use PDOException;
use App\Models\User;
use App\Models\Address;
use App\Models\Vehicle;
use App\Models\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Exception;
use Illuminate\Database\QueryException;

class OrderController extends Controller
{

  private $loggedUser;

  public function orderBuy(Request $request) {

    $RoleId = DB::table('profiles')
      ->where('role', 'customer')
      ->first()
      ->id;

    try {
      $newUser = User::store($request, $RoleId);

      $newUser->save();

      $newAddress = Address::store($request);

      $newVehicle = Vehicle::store($request);

      $newUser->save();

      $newAddress->save();

      $newVehicle->save();

      $tableIds = (object) array(
        'user' => $newUser->id,
        'address' => $newAddress->id,
        'vehicle' => $newUser->id,
      );

      $newOrderService = OrderService::store($request, $tableIds);

      $newOrderService->save();
      return response()->json('Dados armazenados.', Response::HTTP_CREATED);
    } catch (QueryException $e) {
      // tratamento de exceções do tipo 'QueryException'
      return response()->json(['error' => 'Erro ao salvar usuário na tabela.'], Response::HTTP_BAD_REQUEST);
    } catch (PDOException $e) {
      // tratamento de exceções do tipo 'PDOException'
      return response()->json(['error' => 'Erro no banco de dados.'], Response::HTTP_BAD_REQUEST);
    }
  }
}
