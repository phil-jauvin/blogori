<?php
namespace Controllers\App;

use \Origin\Utilities\Layout;
use \Sosmol\Models\Category;

class Categories {
	public function Category( $name ){

		if( $_SERVER['REQUEST_METHOD'] === 'GET' ){
			$category = new Category( $name );
			var_dump( $category->posts() );
		}

		else{
			http_response_code(405);
		}

	}
}
