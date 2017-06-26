<?php
namespace Controllers\App;

use \Origin\Utilities\Layout;
use \Sosmol\Models\Post;

class Posts {

	public function Post( $id ){
		if( $_SERVER['REQUEST_METHOD'] === 'GET' ){
			$post = new Post( $id );
			var_dump( $post );
		}
	}

  public function CreatePost(){
		if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
	    $post = new Post();
			$post->Create( $_POST['title'], $_POST['category'], $_POST['content'], $_POST['basename'] );
		}
    //$post->Create( 'test post', 'uncategorised', 'test content', 'test-post' );
  }

  public function UpdatePost( $id ){
		if( $_SERVER['REQUEST_METHOD'] === 'PUT' ){
			$request = file_get_contents('php://input');
			parse_str($request, $params);
			$post = new Post( $id );
			$post->Update( $params['title'], $params['category'], $params['content'], $params['basename'] );
		}
  }

  public function DeletePost( $id ){
		if( $_SERVER['REQUEST_METHOD'] === 'DELETE' ){
			$post = new Post( $id );
			$post->Delete();
		}
  }

}
