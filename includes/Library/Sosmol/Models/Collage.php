<?php
namespace Sosmol\Models;

use \Origin\Utilities\Bucket\Bucket;
use \Origin\Utilities\Bucket\Common;
use \Origin\DB\DB;

class Collage {

  use Bucket, Common {
    Number as page;
    Hash as posts;
  }

  public function __construct( $page, $amount = 2 ){

    $this->page( $page );

    if( $page !== 1 ){
      $offset = ($page-1) * $amount;
    }
    else{
      $offset = 0;
    }

    $post_query =  DB::Get('blog')->Query(
      "SELECT * FROM posts ORDER BY id DESC LIMIT :amount OFFSET :startrow",
      array( 'amount' => $amount, 'startrow' => $offset )
    );

    $this->posts( $post_query );

  }


}
