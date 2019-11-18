<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Hashids\Hashids;
use Carbon\Carbon;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    public function LoginUser(Request $request){
        $logindata = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = request(['email', 'password']);

        $user = User::where('email', strtolower($request->email))->first();

        if (!$user) {
            return response()->json([
                'message'	  => 'User tidak terdaftar',
                'success'	  => false,
                'statuscode' => 400,
            ]);
        } else{
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'message'       => 'Email atau password salah',
                    'success'       => false,
                    'statuscode'   => 400
                ]);
            }

            // Send an internal API request to get an access token
            $client = \DB::table('oauth_clients')->where('password_client', true)->first();

            // Make sure a Password Client exists in the DB
            if (!$client) {
              return response()->json([
                'message' => 'Laravel Passport is not setup properly.',
                'status' => 500
              ], 500);
            }

            $request = Request::create('/oauth/token', 'POST', [
              'grant_type' => 'password',
              'client_id' => $client->id,
              'client_secret' => $client->secret,
              'username' => request('email'),
              'password' => request('password'),
            ]);

            $response = app()->handle($request);

            // Get data dari response
            $data = json_decode($response->getContent());

            // return $data->access_token;

            $hashids = new Hashids('batako',6);

            // login sukses
            return response()->json([
              'message'			=> 'Login sukses',
              'success' 		=> true,
              'statuscode'	    => 200,
              'user' 		    =>
              [
                    'id' => $hashids->encode($user->id),
                    'name' => $user->name,
                    'email' => $user->email,
                    'token' =>
                    [
                        'token_type'   => $data->token_type,
                        'access_token' => $data->access_token,
                        'expires_in' => $data->expires_in,
                        'refresh_token' => $data->refresh_token,
                    ]
                ]
            ]);
        }

    }
}
