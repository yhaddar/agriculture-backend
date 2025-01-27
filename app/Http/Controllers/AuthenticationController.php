<?php

namespace App\Http\Controllers;

use App\Models\Authentication;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    public function __construct()
    {
        /*
         * regex for security the input's
         */
        $this->regex = [
            "/^[a-zA-Z]+(\s[a-zA-Z]+)*$/", // regex full name
            "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", // regex email
            "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/" // regex password
        ];
    }

    /*
     * method register for creer compte with email unique and password crypted
     */
    public function register(Request $request): JsonResponse {
      try {

          $request->validate([
              "full_name" => "string|required|max:255",
              "email" => "email|required|unique:authentications",
              "password" => "string|min:8"
          ]);

          $full_name = (string) $request["full_name"];
          $email = (string) $request["email"];
          $password = (string) $request["password"];
          $is_accept_privacy_policy = (boolean) $request["is_accept_privacy_policy"];

          if(!preg_match($this->regex[0], $full_name)) throw new \Exception("full name is invalide");
          else if(!preg_match($this->regex[1], $email)) throw new \Exception("email is invalide");
          else if(!preg_match($this->regex[2], $password)) throw new \Exception("password invalide");
          else{

              $authentication = new Authentication();
              $authentication["id"] = Str::uuid();
              $authentication["full_name"] = $full_name;
              $authentication["email"] = $email;
              $authentication["password"] = Hash::make($password);
              $authentication["is_accept_privacy_policy"] = $is_accept_privacy_policy;
              $authentication->save();

              return response()->json([
                  "data" => $request->all()
              ]);
          }

      }catch(\Exception $e){
          return response()->json([
              "error"=> $e->getMessage(),
          ], 400);
      }

    }
}
