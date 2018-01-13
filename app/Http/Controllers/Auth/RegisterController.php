<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Contracts\Routing\UrlGenerator;

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
     | Этот контроллер обрабатывает регистрацию новых пользователей, а также их
     | валидация и создание. По умолчанию этот контроллер использует свойство
     | обеспечивают эту функциональность, не требуя дополнительного кода.
    */

    use RegistersUsers;

    /**
     * Где перенаправить пользователей после регистрации.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6|same:repeat_password',
            'repeat_password' =>'required|min:6|required'
        ]);
    }

    /**
     * Создайте новый экземпляр пользователя после действительной регистрации.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'activation_code'=>  $data['activation_code']
        ]);
    }
    public function RegistrationUser(Request $request){
           $data = $request->input();
            $validator = $this->validator($data);
        if($validator->fails()){
            return  redirect()->back()->withErrors($validator)->withInput();
        } 
          foreach($data as &$value){
             $value = strip_tags($value);
          }
           $data['activation_code']=Str::random(14);
           $user = $this->create($data);
           
           $this->guard()->login($user);
           $user->UserActivationMail();
           return redirect('/message')->with('message', 'На ваш адрес было выслано письмо с подтверждением регистрации'); 
        
    }

    
}
