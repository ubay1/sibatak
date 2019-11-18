<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Hashids\Hashids;
use Carbon\Carbon;

class UserController extends Controller
{
    public function RegisterUser(Request $request){
        $pesan = [
            'required' => ':attribute wajib diisi',
            'unique'   => ':attribute telah terdaftar',
            'same' 	   => ':attribute harus sama dengan password',
            'min'	   => ':attribute minimal :min karakter'
        ];
        $validator = Validator::make($request->all(), [
            'nama' => 'required|min:2',
            'email' => 'required|unique:users|email',
            'phone' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ], $pesan);

        // cek error tiap" request
        if ($validator->fails()) {
            if ($validator->errors()->first('nama')) {
                return response()->json([
                    'success'       => false,
                    'statuscode'    => 4001,
                    'message'       => $validator->errors()->first('nama'),
                    'error'         => $validator->errors()->first('nama'),
                    'data'          => null
                ]);
            } elseif ($validator->errors()->first('email')) {
                return response()->json([
                    'success'       => false,
                    'statuscode'    => 4001,
                    'message'       => $validator->errors()->first('email'),
                    'error'         => $validator->errors()->first('email'),
                    'data'          => null
                ]);
            } elseif ($validator->errors()->first('phone')) {
                return response()->json([
                        'success'       => false,
                        'statuscode'    => 4001,
                        'message'       => $validator->errors()->first('phone'),
                        'error'         => $validator->errors()->first('phone'),
                        'data'          => null
                ]);
            } elseif ($validator->errors()->first('password')) {
                return response()->json([
                        'success'       => false,
                        'statuscode'    => 4001,
                        'message'       => $validator->errors()->first('password'),
                        'error'         => $validator->errors()->first('password'),
                        'data'          => null
                ]);
            } elseif ($validator->errors()->first('password_confirmation')) {
                return response()->json([
                        'success'       => false,
                        'statuscode'    => 4001,
                        'message'       => $validator->errors()->first('password_confirmation'),
                        'error'         => $validator->errors()->first('password_confirmation'),
                        'data'          => null
                ]);
            }
        }

        $nama 		= strtolower($request->nama);
        $email 		= strtolower($request->email);
        $phone 		= $request->phone;
        $password   = bcrypt($request->password);

        $cek_email = User::where('email', $email )->first();

        if ($cek_email != null) {
            return response()->json([
                'message'=>'email telah digunakan',
                'success'=>false,
                'statuscode'=>400
            ]);
        }

        $user_baru = new User;
        $user_baru->nama =  $nama;
        $user_baru->email =  $email;
        $user_baru->phone =  $phone;
        $user_baru->role_id  = 2;
        $user_baru->password = $password;
        $user_baru->created_at = Carbon::now('Asia/Jakarta');
        $user_baru->updated_at = Carbon::now('Asia/Jakarta');
        $user_baru->save();

        return response()->json([
            'message' => 'Selamat pendaftaran sukses, silahkan login untuk masuk ke aplikasi',
            'success' => true,
            'statuscode' => 200
        ]);
    }

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
              'grant_type'    => 'password',
              'client_id'     => $client->id,
              'client_secret' => $client->secret,
              'username'      => request('email'),
              'password'      => request('password'),
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
                        'expires_in'    => $data->expires_in,
                        'refresh_token' => $data->refresh_token,
                    ]
                ]
            ]);
        }

    }

    public function logout(Request $request){
        // $header = Auth::user()->token();
        // return $header;

        $accessToken = Auth::user()->token();

        // change revoked from 0(false) to 1(true)
        $logout = DB::table('oauth_refresh_tokens')
        ->where('access_token_id', $accessToken->id)
        ->update(['revoked' => true]);

        // change revoked from 0(false) to 1(true)
        DB::table('oauth_access_tokens')
        ->where('id', $accessToken->id)
        ->update(['revoked' => true]);

        $accessToken->revoke();

        if ($logout) {
            return response()->json([
                'message'		=> 'Logout sukses',
                'success' 		=> true,
                'status_code'	=> 200,
            ]);
        }
        return response()->json([
            'message'			=> 'Logout gagal',
            'success' 		=> false,
            'status_code'	=> 400,
            ]);
    }

    public function refreshtoken(Request $request){
        $logindata = $request->validate([
        'refresh_token' => 'required'
        ]);

        $credentials = request('refresh_token');

        if (!$credentials) {
            return response()->json([
                'message'			=> 'refresh token harus diisi',
                'success'			=> false,
                'status_code' => 400,
                'error'				=> '',
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
            'grant_type' 		=> 'refresh_token',
            'refresh_token' =>  $request->refresh_token,
            'client_id' 		=> $client->id,
            'client_secret' => $client->secret,
            'scope'=>''
        ]);

        $response = app()->handle($request);

        // Get data dari response
        $data = json_decode($response->getContent());

        // $akses = $data->access_token;
        // return Auth::user();

        // refresh sukses
        return response()->json([
            'message'			=> 'Token telah di refresh',
            'success' 		=> true,
            'status_code'	=> 200,
            'error'				=> '',
            'token'				=>
            [
                // 'token_type'   => $data->token_type,
                'access_token' => $data->access_token,
                'expires_in'	 => $data->expires_in,
                'refresh_token' => $data->refresh_token,
            ]
        ]);
    }
}
