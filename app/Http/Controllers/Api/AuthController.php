<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\email_verification;

class AuthController extends Controller
{
    public function registro(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }
    
        $input = $request->all();
        $input['password'] = bcrypt($request->get('password'));
        $user = User::create($input);
        $token =  $user->createToken('MyApp')->accessToken;


        $verification_code = str_random(30);
        $email_verification = email_verification::create(['user_id'=>$user->id,'token'=>$verification_code]);

        $subject = "Por favor verifica tu correo electrónico.";
        Mail::send('email.verify', ['name' => $name, 'verification_code' => $verification_code],
            function($mail) use ($email, $name, $subject){
                $mail->from(getenv('FROM_EMAIL_ADDRESS'), "KanaimaExchange");
                $mail->to($email, $name);
                $mail->subject($subject);
        });        
        
    
        return response()->json([
            'token' => $token,
            'user' => $user
        ], 200);
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            if($user->is_verified != 1)
            {   
                return response()->json([
                    'error' => 10,
                    'message' => 'El usuario no ha verificado su correo electrónico'
                ], 200);   
            }
            $token =  $user->createToken('token-generico')->accessToken;
            return response()->json([
                'token' => $token,
                'user' => $user
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function verifyUser($verification_code)
    {
        $check = email_verification::where('token',$verification_code)->first();
        if(!is_null($check)){
            $user = User::find($check->user_id);
            if($user->is_verified == 1){
                return response()->json([
                    'success'=> true,
                    'message'=> 'Correo electrónico verificado...'
                ]);
            }
            $user->update(['is_verified' => 1]);
            email_verification::where('token',$verification_code)->delete();
            return response()->json([
                'success'=> true,
                'message'=> 'Haz verificado exitosamente tu correo.'
            ]);
        }
        return response()->json(['success'=> false, 'error'=> "Código de verificación incorrecto."]);
    } 

    public function logout() {
        Auth::user()->AauthAcessToken()->delete();
    }    
}
