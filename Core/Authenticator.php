<?php

namespace Core;

use Core\Session;

class Authenticator
{
    public function attempt($email, $password)
    {
        $user = App::resolve(Database::class)->query('select * from users where email = :email',[
            'email' => $email
        ])->find();

        if ($user){
            if (password_verify($password, $user['password'])) {
                $this->login([
                    'email' => $email
                ]);
            
                return true;
            }
        }
    }
    public function login($user) {
        $_SESSION['user'] = [
            'email' => $user['email']
        ];
    
        session_regenerate_id(
            delete_old_session: true
        );
    }
    
    public function logout(){
        Session::destroy();
    }
}