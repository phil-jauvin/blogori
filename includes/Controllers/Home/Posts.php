<?php
namespace Controllers\Home;

use \Origin\Utilities\Layout;
use \Sosmol\Models\Post;

class Posts {

	public function Post( $id ){
    $post = new Post( $id );
    var_dump( $post );
	}

  public function CreatePost(){
    $post = new Post();
    $post->Create( $_POST['title'], $_POST['category'], $_POST['content'], $_POST['basename'] );
  }

}
