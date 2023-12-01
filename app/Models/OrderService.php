<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

class OrderService extends Model
{
    use HasFactory;

    public function user () {
        return $this->hasOne('App\Models\User');
    }

    public function address () {
        return $this->hasOne('App\Models\Address');
    }

    public function vehicle () {
        return $this->hasOne('App\Models\Vehicle');
    }

  public static function store(Request $request, object $tableIds): OrderService
  {
    $orderService = new static;

    $orderService->status = $request->input('status');
    $orderService->type = $request->input('type');
    $orderService->price = $request->input('price');
    $orderService->user_id = $tableIds->user;
    $orderService->address_id = $tableIds->address;
    $orderService->vehicle_id = $tableIds->vehicle;



    return $orderService;
  }



}
