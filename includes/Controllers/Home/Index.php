<?php
namespace Controllers\Home;

use \Origin\Utilities\Layout;

/**
 * Index controller
 * All this controller does is pass routing control to Backbone.js
 * @package Controllers\Home
 */
class Index {

    /**
     * Display site's front-end
     */

	public function Main(){
        Layout::Get()->Display('index');
	}

}
