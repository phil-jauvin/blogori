<?php
namespace Sosmol\Models;

use \Origin\Utilities\Bucket\Bucket;
use \Origin\Utilities\Bucket\Common;
use \Origin\DB\DB;

class Post {

  use Bucket, Common {
    Number as id;
    String as title;
    String as basename;
    String as category;
    String as content;
  }

  public function __construct( $post_id = null ){

    // If we pass in a post id, we grab an existing post from the db
    if( $post_id !== null ){

      // Get post data from database
      $post_query = DB::Get('blog')->QueryFirstRow(
        "SELECT * FROM posts where id = :id",
        array( 'id' => $post_id )
      );

      // Populate post object
      $this->Populate( $post_query );

    }

  }

  public function Create( $title, $category, $content, $basename ){

    // Check if ID is null so we're not creating a duplicate
    if( $this->id() === null ){

      $this->title( $title );
      $this->category( $category );
      $this->content( $content );
      $this->basename( $basename );

      $insert_query = DB::Get('blog')->Insert( 'posts', $this->things );

    }

  }

  public function Update( $title, $category, $content, $basename ){

    if( $this->ID() !== null ){

      $this->title( $title );
      $this->category( $category );
      $this->content( $content );
      $this->basename( $basename );

      $params = array(
        'title' => $title,
        'category' => $category,
        'content' => $content,
        'basename' => $basename
      );

      $update_query = DB::Get('blog')->Update( 'posts', $params, "id = :id", array('id' => $this->ID()) );

    }

  }

  public function Delete(){

      if( $this->ID() !== null ){

        $delete_query = DB::Get('blog')->RawQuery(
          "DELETE FROM posts where id = :id",
          array( 'id' => $this->ID() )
        );

      }

  }

  private function Populate( $post_query ){

    $this->id( $post_query['id'] );
    $this->title( $post_query['title'] );
    $this->basename( $post_query['basename'] );
    $this->category( $post_query['category'] );
    $this->content( $post_query['content'] );

  }


}
