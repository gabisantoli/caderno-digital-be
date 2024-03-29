<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';
    
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

  
    public function logout(Request $request){
        Auth::logout();
        return view('pages.index');    
    }

    public function apiLogin(Request $request){
        $this->validateLogin($request);
        
        if($this->attemptLogin($request)){
            $user = $this->guard()->user();
            $user->generateToken();

            return response()->json([
                'data' => $user->toArray(),
            ]);
        }
        return $this->sendFailedLoginResponse($request);
    }

    public function apiLogout(Request $request){
        $user = Auth::guard('api')->user();
        if($user){
            $user->api_token = null;
            $user->save();
        }
        return response()->json(['data' => 'User deslogadoooOOOOOO SAI DAQUI'], 200);
    }
}
