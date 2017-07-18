<?php
namespace Sosmol\Models;

use \Origin\Utilities\Bucket\Bucket;
use \Origin\Utilities\Bucket\Common;
use \Origin\DB\DB;

/**
 * Post model
 * Perform CRUD operations on Posts
 * @package Sosmol\Models
 */

class Post {

  // Class traits
  use Bucket, Common {
    Number as id;
    String as title;
    String as basename;
    String as category;
    String as content;
  }

    /**
     * Post model constructor
     * Will fetch post information if post ID is passed in
     * @param mixed $post_id
     */

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

    /**
     * Create a new post
     * @param $title string Post title
     * @param $category Post category
     * @param $content Post content
     * @param $basename Post basename
     */

  public function Create( $title, $category, $content, $basename ){

    //TODO: Move basename creation from Posts controller to this function

    // Check if ID is null so we're not creating a duplicate
    if( $this->id() === null ){

      $this->title( $title );
      $this->category( $category );
      $this->content( $content );
      $this->basename( $basename );

      $insert_query = DB::Get('blog')->Insert( 'posts', $this->things );

    }

  }

    /**
     * Update an existing
     * @param $title string New post title
     * @param $category New post category
     * @param $content New post content
     * @param $basename New post basename
     */

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

    /**
     * Delete post
     * @param $id int ID of the post to delete
     */

  public function Delete( $id ){

    if( $this->ID() !== null ){

      // RawQuery is like Query except it won't attempt to fetch results
      $delete_query = DB::Get('blog')->RawQuery(
        "DELETE FROM posts where id = :id",
        array( 'id' => $this->ID() )
      );

    }

  }

    /**
     * Populate class traits
     * @param $post_query array Array of post data from SQL query
     */
  private function Populate( $post_query ){

    $this->id( $post_query['id'] );
    $this->title( $post_query['title'] );
    $this->basename( $post_query['basename'] );
    $this->category( $post_query['category'] );
    $this->content( $post_query['content'] );

  }


}
