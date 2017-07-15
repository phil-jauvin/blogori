<?php

namespace Controllers\App;

use \Sosmol\Models\User;

class Users {

    public function IsLoggedIn(){

        $user = new User();
        echo json_encode($user->isLogged());

    }

    public function Login(){

        $user = new User();
        $email = $_POST['username'];
        $password = $_POST['password'];
        $res = $user->login( $email, $password, 1 );
        setcookie('authID', $res["hash"], $res["expire"], '/');
        echo json_encode($res);

    }

    public function Logout(){

        $user = new User();
        $user->FetchActiveUser();
        $res = $user->LogUserOut();
        var_dump( $res );

    }


}