<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

class Address extends Model
{

    public $timestamps = false;
    use HasFactory;

  public static function store(Request $request): Address
  {
    $address = new static;

    $address->street_name = $request->input('streetName');
    $address->number = $request->input('number');
    $address->complement = $request->input('complement');
    $address->neighborhood = $request->input('neighborhood');
    $address->city = $request->input('city');
    $address->state = $request->input('state');
    $address->zip_code = $request->input('zipCode');

    return $address;
  }
}
