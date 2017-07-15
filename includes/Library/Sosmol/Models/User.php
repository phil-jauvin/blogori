<?php

namespace Sosmol\Models;

use \Origin\Utilities\Bucket\Bucket;
use \Origin\Utilities\Bucket\Common;
use \Origin\DB\DB;
use \PHPAuth\Config;

class User extends \PHPAuth\Auth {

    use Bucket, Common {
        Number as id;
        String as email;
        Number as isactive;
        String as dt;
    }


    public function __construct(){

            $dbh = DB::Get('blog')->GetConnection();
            $config = new Config($dbh);
            parent::__construct( $dbh, $config );

    }

    public function FetchActiveUser(){

        $hash = $this->getSessionHash();

        if( $this->checkSession($hash) === true ){
            $uid = $this->getSessionUID( $hash );
            $user = $this->getUser( $uid );
            $this->Populate( $user );
            //var_dump( $user );
        }

    }

    public function FetchUserByID( $id ){

        $user_query = DB::Get('blog')->QueryFirstRow(
            "SELECT * FROM users where id = :id",
            array( 'id' => $id )
        );

        $this->Populate( $user_query );

    }

    public function LogUserOut(){
        $hash = $this->getSessionHash();
        return $this->logout( $hash );
    }

    private function Populate( $user_data ){
        $this->id( $user_data['id'] );
        $this->email( $user_data['email'] );
        $this->isactive( $user_data['isactive'] );
        $this->dt( $user_data['dt'] );
    }

}