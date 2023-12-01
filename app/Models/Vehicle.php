<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

class Vehicle extends Model
{

    public $timestamps = false;


    use HasFactory;

  public static function store(Request $request): Vehicle
  {
    $vehicle = new static;

    $vehicle->brand = $request->input('brand');
    $vehicle->model = $request->input('model');
    $vehicle->plate = $request->input('plate');
    $vehicle->year_manufacture = $request->input('yearManufacture');
    $vehicle->year_model = $request->input('yearModel');
    $vehicle->chassi = $request->input('chassi');
    $vehicle->color = $request->input('color');

    $vehicle->key = $request->input('key');
    $vehicle->manual = $request->input('manual');
    $vehicle->sound = $request->input('sound');
    $vehicle->optional = $request->input('optional');
    $vehicle->ipva = $request->input('ipva');
    $vehicle->km = $request->input('km');




    return $vehicle;
  }
}
