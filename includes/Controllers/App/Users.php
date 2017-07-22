<?php

namespace Controllers\App;

use \Sosmol\Models\User;
use \Sosmol\Helpers\UserInput;

/**
 * User controller
 * Login and User status functions
 * @package Controllers\App
 */

class Users {

    /*
    * Description of HTTP response codes in this controller:
    * 200 - OK
    * 201 - Created (sent upon successful POST)
    * 405 - Method not allowed (is sent if user uses wrong HTTP verb for a route)
    * 403 - Forbidden
    */


    /**
     * Fetch user login status
     */

    public function IsLoggedIn(){

        if( $_SERVER['REQUEST_METHOD'] === 'GET' ){
            $user = new User();
            http_response_code(200);
            echo json_encode($user->isLogged());
            exit;
        }
        else{
            http_response_code(405);
            die;
        }

    }

    /**
     * Log a user in
     */

    public function Login(){

        if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

            $userinput = new UserInput( $_POST );
            $user = new User();

            if( $userinput->safe() === true && $user->isLogged() === true ){

                $userdata = $userinput->data();

                $email = $userdata['username'];
                $password = $userdata['password'];
                $res = $user->login( $email, $password, 1 );

                setcookie('authID', $res["hash"], $res["expire"], '/');

                http_response_code(201);
                echo json_encode($res);
                exit;

            }

            else{
                http_response_code(403);
                echo 'Please don\'t hack me :)';
                die;
            }

        }

        else{
            http_response_code(405);
            die;
        }


    }

    /**
     * Logs out the current active user
     */

    public function Logout(){

        if( $_SERVER['REQUEST_METHOD'] === 'GET' ){
            $user = new User();
            $user->FetchActiveUser();
            $res = $user->LogUserOut();
            http_response_code(200);
            echo json_encode($res);
            exit;
        }
        else{
            http_response_code(405);
            die;
        }

    }


}