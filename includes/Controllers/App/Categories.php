<?php
namespace Controllers\App;

use \Sosmol\Models\Category;

/**
 * Category controller
 * Fetch categories
 * @package Controllers\App
 */

class Categories {

    /*
    * Description of HTTP response codes in this controller:
    * 200 - OK
    * 405 - Method not allowed (is sent if user uses wrong HTTP verb for a route)
    */

    /**
     * Fetch category posts
     * @param $name String name of the category want to fetch
     */

	public function Category( $name ){

		if( $_SERVER['REQUEST_METHOD'] === 'GET' ){
			$category = new Category( $name );
            http_response_code(200);
			echo $category->toJson();
			exit;
		}

		else{
			http_response_code(405);
			exit;
		}

	}

}
