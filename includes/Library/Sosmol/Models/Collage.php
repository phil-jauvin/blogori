<?php
namespace Sosmol\Models;

use \Origin\Utilities\Bucket\Bucket;
use \Origin\Utilities\Bucket\Common;
use \Origin\DB\DB;

/**
 * Collage model
 * A collage is a page in the context of pagination
 * @package Sosmol\Models
 */

class Collage {

    // Class traits
    use Bucket, Common {
        Number as page;
        Hash as posts;
    }

    /**
     * Collage constructor
     * @param $page int Page number / selection offset
     * @param $amount int Amount of posts per page
     */

    public function __construct( $page, $amount = 2 ){

        $this->page( $page );

        $offset = ($page-1) * $amount;

        $post_query =  DB::Get('blog')->Query(
          "SELECT * FROM posts ORDER BY id DESC LIMIT :amount OFFSET :startrow",
          array( 'amount' => $amount, 'startrow' => $offset )
        );

        $this->posts( $post_query );

    }


}
