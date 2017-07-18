<?php

namespace Sosmol\Models;

use \Origin\Utilities\Bucket\Bucket;
use \Origin\Utilities\Bucket\Common;
use \Origin\DB\DB;
use \PHPAuth\Config;

/**
 * User model
 * Essentially a wrapper for \PHPAuth\Auth
 * @package Sosmol\Models
 */

class User extends \PHPAuth\Auth {

    // Class traits
    use Bucket, Common {
        Number as id;
        String as email;
        Number as isactive;
        String as dt;
    }

    /**
     * User model constructor
     */

    public function __construct(){

            // Fetch PDO connection
            $dbh = DB::Get('blog')->GetConnection();

            // Create new PHPAuth config
            $config = new Config($dbh);

            // Pass it to parent
            parent::__construct( $dbh, $config );

    }

    /**
     * Fetch information about a logged in user
     * Will populate class traits if user information is found
     */

    public function FetchActiveUser(){

        $hash = $this->getSessionHash();

        if( $this->checkSession($hash) === true ){
            $uid = $this->getSessionUID( $hash );
            $user = $this->getUser( $uid );
            $this->Populate( $user );
            //var_dump( $user );
        }

    }

    /**
     * Fetch information about a specific user
     * @param $id int User ID
     */

    public function FetchUserByID( $id ){

        $user_query = DB::Get('blog')->QueryFirstRow(
            "SELECT * FROM users where id = :id",
            array( 'id' => $id )
        );

        $this->Populate( $user_query );

    }

    /**
     * Log the current user out
     * @return bool Logout is successful
     */

    public function LogUserOut(){
        $hash = $this->getSessionHash();
        return $this->logout( $hash );
    }

    /**
     * Populate class traits
     * @param $user_data array Array of user data from SQL query
     */

    private function Populate( $user_data ){
        $this->id( $user_data['id'] );
        $this->email( $user_data['email'] );
        $this->isactive( $user_data['isactive'] );
        $this->dt( $user_data['dt'] );
    }

}