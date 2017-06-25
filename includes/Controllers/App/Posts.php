<?php
namespace Controllers\App;

use \Origin\Utilities\Layout;
use \Sosmol\Models\Post;

class Posts {

	public function Post( $id ){
    $post = new Post( $id );
    var_dump( $post );
	}

  public function CreatePost(){
    $post = new Post();
    //$post->Create( $_POST['title'], $_POST['category'], $_POST['content'], $_POST['basename'] );
    $post->Create( 'test post', 'uncategorised', 'test content', 'test-post' );
  }

  public function UpdatePost( $id ){
    $post = new Post( $id );
    $post->Update( $_POST['title'], $_POST['category'], $_POST['content'], $_POST['basename'] );
  }

  public function DeletePost( $id ){
    $post = new Post( $id );
    $post->Delete();
  }

}
