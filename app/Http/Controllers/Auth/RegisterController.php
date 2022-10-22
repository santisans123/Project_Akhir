<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Exception\FirebaseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
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


   use RegistersUsers;
   protected $auth;
   private $database;

   /**
    * Where to redirect users after registration.
    *
    * @var string
    */
   protected $redirectTo = RouteServiceProvider::HOME;
   public function __construct(FirebaseAuth $auth)
   {
      $this->middleware('guest');
      $this->auth = $auth;

      $this->database = \App\Services\FirebaseService::connect();
   }
   protected function validator(array $data)
   {
      return Validator::make($data, [
         'name' => ['required', 'string', 'max:255'],
         'email' => ['required', 'string', 'email', 'max:255'],
         'password' => ['required', 'string', 'min:8', 'max:12', 'confirmed'],
      ]);
   }

   public function register(Request $request)
   {
      try {

         $this->validator($request->all())->validate();
         $userProperties = [
            'email' => $request->input('email'),
            'emailVerified' => true,
            'password' => $request->input('password'),
            'displayName' => $request->input('name'),
            'disabled' => false,
         ];
         $createdUser = $this->auth->createUser($userProperties);

         $this->database->getReference('profile')

            ->push([
               'name' => $request->input('name'),
               'email' => $request->input('email'),
               'password' => $request->input('password'),

               'user_id' => $createdUser->uid
            ]);

         return redirect()->route('login');
      } catch (FirebaseException $e) {
         Session::flash('error', $e->getMessage());
         return back()->withInput();
      }
   }
}

