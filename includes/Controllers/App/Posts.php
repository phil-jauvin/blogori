<?php
namespace Controllers\App;

use \Sosmol\Models\Post;
use \Sosmol\Models\Collage;

class Posts {

	public function Post( $id ){

		if( $_SERVER['REQUEST_METHOD'] === 'GET' ){
			$post = new Post( $id );
			echo $post->ToJson();
		}

		else if( $_SERVER['REQUEST_METHOD'] === 'PUT' ){

		    // TODO: figure out to parse PUT requests securely
			$request = file_get_contents('php://input');
			parse_str($request, $params);
			$post = new Post( $id );

			// Prevent stored XSS
			foreach( $params as $key => $value ){
			    $params[$key] = htmlspecialchars( $value );
            }

			$post->Update( $params['title'], $params['category'], $params['content'], $params['basename'] );

		}

		else if( $_SERVER['REQUEST_METHOD'] === 'DELETE' ){
			$post = new Post( $id );
			$post->Delete();
		}

		else{
			http_response_code(405);
			die;
		}

	}

	public function CreatePost(){

		if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

            // Prevent stored XSS
            foreach( $_POST as $key => $value ){
                $_POST[$key] = htmlspecialchars( $value );
            }

		    $basename = $_POST['title'];
		    $basename = strtolower( $basename );
		    $basename = str_replace( " ", "-", $basename );
			$post = new Post();
			$post->Create( $_POST['title'], $_POST['category'], $_POST['content'], $basename );
		}

		else{
			http_response_code(405);
		}

	}

	public function Collage( $page ){

		// TODO: Collages are pagination objects, make pagination
		if( $_SERVER['REQUEST_METHOD'] === 'GET' ){
			$collage = new Collage($page);
			echo $collage->ToJson();
		}

		else{
			http_response_code(405);
		}

	}

}
