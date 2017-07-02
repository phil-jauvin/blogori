<?php
namespace Controllers\Home;

use \Origin\Utilities\Layout;

class Index {

	public function Main(){
		Layout::Get()->Display('index.tpl');
	}

	public function About(){
		Layout::Get()->Display('about.tpl');
	}
	
}
