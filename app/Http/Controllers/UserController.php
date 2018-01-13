<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function cabinet(){ 
        $user = Auth::user();
        return view('auth.cabinet', ['email'=>$user->email]);
    }
    
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
    public function login(){
        if(Auth::check()){
            return $this->cabinet();
        }
        return view('auth.login');
    }
    public function authorization(Request $request){
        $data = $request->input();
        foreach($data as &$value){
             $value = strip_tags($value);
          }
         if(User::login($data) instanceof Illuminate\Support\Facades\Auth){
             return redirect('/');
         } 
         return  back()->withInput()-> with('message','Вы ввели неправильный email или пароль!');//->flash('message', 'Вы ввели неправильный email или пароль!')
    }
    public function getActivate($id, $activation_code){
        if(!Auth::check()){
            $user = User::find($id);
        } else {$user = Auth::user();}
        
        if(!$user instanceof User){
            return dd(404);
        }
        $message = "";
        if($user->activation_code === $activation_code){ 
           if($user->UserActivatij()){ 
              if(Auth::check()){$message = " <a href='".action('\App\Http\Controllers\Auth\RegisterController@RegistrationUser')."'>Вы можете авторизоваться!</a>";} 
              return redirect('/message')->with('message', 'Ваш Email успешно подвержден!'.$message); 
           } else { return dd(404); }
        } else { 
            if($user->activation_code === NULL){
                return redirect('/message')->with('message', 'Ваш Email уже подвержден!'.$message);     
            }
        }
        return dd(404);
    }

}
