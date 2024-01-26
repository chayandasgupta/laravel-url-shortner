<?php

namespace App\Services;

use App\Models\User;

class UserService
{
  public function createUser(array $registrationFormData): User
  {
    return User::create($registrationFormData);
  }

  public function loginUser(array $credentials)
  {
    if (Auth()->attempt($credentials)) {
      $token = Auth()->user()->createToken("APIToken");
      return  $token->plainTextToken;
    }

    return null;
  }
}
