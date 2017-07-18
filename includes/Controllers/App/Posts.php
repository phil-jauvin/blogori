<?php
namespace Controllers\App;

use \Sosmol\Models\Post;
use \Sosmol\Models\Collage;
use \Sosmol\Helpers\UserInput;

/**
 * Posts controller
 * Interface to perform CRUD operations on posts
 * @package Controllers\App
 */

class Posts {

    /*
     * Description of HTTP response codes in this controller:
     * 200 - OK
     * 201 - Created (sent upon successful POST)
     * 405 - Method not allowed (is sent if user uses wrong HTTP verb for a route)
     * 503 - Forbidden
     */


    /**
     * Process GET/PUT/DELETE requests - return, update or delete posts
     * @param $id ID of the post to perform operation on
     */

	public function Post( $id ){

		if( $_SERVER['REQUEST_METHOD'] === 'GET' ){
			$post = new Post( $id );
			echo $post->ToJson();
            http_response_code(200);
            exit;
		}

		else if( $_SERVER['REQUEST_METHOD'] === 'PUT' ){

		    // TODO: figure out to parse PUT requests securely
			$request = file_get_contents('php://input');
			parse_str($request, $params);
			//

            // Prevent stored XSS and CSRF
            $userinput = new UserInput( $params );

            if( $userinput->safe() === true ){
                $params = $userinput->data();
                $post = new Post( $id );
                $post->Update( $params['title'], $params['category'], $params['content'], $params['basename'] );
                http_response_code(200);
                exit;
            }
            else{
                http_response_code(503);
                echo 'Please don\'t hack me :)';
                die;
            }

		}

		else if( $_SERVER['REQUEST_METHOD'] === 'DELETE' ){
			$post = new Post( $id );
			$post->Delete();
            http_response_code(200);
			echo 'Post '.$id.' has been deleted successfully';
			exit;
		}

		else{
			http_response_code(405);
			die;
		}

	}


    /**
     * Create a new post from POST request
     */

	public function CreatePost(){

		if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

            // Prevent stored XSS and CSRF
            $userinput = new UserInput( $_POST );

            if( $userinput->safe() === true ){

                $userdata = $userinput->data();

                $basename = $userdata['title'];
                $basename = strtolower( $basename );
                $basename = str_replace( " ", "-", $basename );

                $post = new Post();
                $post->Create( $userdata['title'], $userdata['category'], $userdata['content'], $basename );

                http_response_code(201);
                exit;

            }
            else{
                http_response_code(503);
                echo 'Please don\'t hack me :)';
                die;
            }

		}


		else{
			http_response_code(405);
			die;
		}

	}


    /**
     * Return collection of posts to be displayed at a certain page
     * @param $page Page number in the context of pagination
     */

	public function Collage( $page ){

		// TODO: Collages are pagination objects, make pagination
		if( $_SERVER['REQUEST_METHOD'] === 'GET' ){
			$collage = new Collage($page);
			echo $collage->ToJson();
			exit;
		}

		else{
			http_response_code(405);
			die;
		}

	}

}
