<?php
namespace Controllers\Home;

use \Origin\Utilities\Layout;
use \PDO;
use \PHPAuth\Auth;
use \PHPAuth\Config;

class Index {

	public function Main(){
        Layout::Get()->Display('index');
	}

}
