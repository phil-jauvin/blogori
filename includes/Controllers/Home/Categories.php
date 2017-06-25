<?php
namespace Controllers\Home;

use \Origin\Utilities\Layout;
use \Sosmol\Models\Category;

class Categories {
	public function Category( $name ){
		$category = new Category( $name );
    var_dump( $category->posts() );
	}
}
