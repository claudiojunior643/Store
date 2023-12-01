<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

  public $timestamps = false;

    protected $hidden = ['password', 'token'];

  public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

  public static function store(Request $request, int $RoleId): User
  {
    $user = new static;

    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));
    $user->birthdate = $request->input('birthdate');
    $user->phone = $request->input('phone');
    $user->document = $request->input('document');
    $user->profile_id = $RoleId;

    return $user;
  }

}
