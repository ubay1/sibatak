<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        // $this->middleware('guest');
    }

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
            'statuscode' => 200,
            'data' => $user_baru
        ]);
    }
}
