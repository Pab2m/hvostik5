<?php

namespace App;

use Illuminate\Notifications\Notifiable;
//use App\Notifications;
//use App\Notifications\MailResetPasswordToken;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','activation_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
 * Send a password reset email to the user
 */
public function sendPasswordResetNotification($token)
{
    $this->notify(new Notifications\MailResetPasswordToken($token));
}

public  function UserActivationMail()
{
  $this->notify(new Notifications\MailActivationUsers($this->id, $this->activation_code));
}

public static function login($data) {
            if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])){
              return Auth::user();
          }else{
              return false;
          }
        }
        public function UserActivatij(){
            $this->activation_code = NULL;
            $this->save();
            return true;
        }

}
