<?php
namespace Sosmol\Models;

use \Origin\Utilities\Bucket\Bucket;
use \Origin\Utilities\Bucket\Common;
use \Origin\DB\DB;

/**
 * Category model
 * @package Sosmol\Models
 */

class Category {

  // Class traits
  use Bucket, Common {
    String as name;
    Number as count;
    Hash as posts;
  }

    /**
     * Category mode constructor
     * @param $name string name of the category we want to initialise
     */

  public function __construct( $name ){

    if( $name !== null ){

      $category_query = DB::Get('blog')->Query(
        "SELECT * FROM posts where category = :category",
        array( 'category' => $name )
      );

      $this->Populate( $category_query );

    }

  }

    /**
     * Populate class traits
     * @param $category_query array Array of category data from SQL query
     */

  private function Populate( $category_query ){

    $this->name( $category_query[0]['category'] );
    $this->count( count($category_query) );
    $this->posts( $category_query );

  }


}
