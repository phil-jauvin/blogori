<?php
namespace Controllers\App;

use \Origin\Utilities\Layout;
use \Sosmol\Models\Post;
use \Sosmol\Models\Collage;

class Posts {

	public function Post( $id ){

		if( $_SERVER['REQUEST_METHOD'] === 'GET' ){
			$post = new Post( $id );
			echo $post->ToJson();
		}

		else if( $_SERVER['REQUEST_METHOD'] === 'PUT' ){
			$request = file_get_contents('php://input');
			parse_str($request, $params);
			$post = new Post( $id );
			$post->Update( $params['title'], $params['category'], $params['content'], $params['basename'] );
		}

		else if( $_SERVER['REQUEST_METHOD'] === 'DELETE' ){
			$post = new Post( $id );
			$post->Delete();
		}

		else{
			http_response_code(405);
		}

	}

	public function CreatePost(){

		if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
			$post = new Post();
			$post->Create( $_POST['title'], $_POST['category'], $_POST['content'], $_POST['basename'] );
		}

		else{
			http_response_code(405);
		}

	}

	public function Collage(){

		$collage = new Collage(1);
		echo $collage->ToJson();

	}

}
