<?php
namespace Sosmol\Helpers;

use \Origin\Utilities\Bucket\Bucket;
use \Origin\Utilities\Bucket\Common;
use \Origin\Utilities\Settings;

/**
 * UserInput helper
 * Tidier way of making sure user input and request are secure
 * @package Sosmol\Helpers
 */

class UserInput {

    use Bucket, Common {
        Hash as data;
        Boolean as safe;
    }

    /**
     * UserInput constructor
     * @param $data array data we want to secure
     */

    public function __construct( $data ){

        $data = $this->Sanitise( $data );
        $safe = $this->CheckCSRF();

        $this->safe( $safe );

        if( $safe === true ){
            $this->data( $data );
        }

    }

    /**
     * Escape user input - we should only allow plain text
     * @param $data array HTTP Request data
     * @return array Escaped request data
     */

    private function Sanitise( $data ){

        // Escape all request items
        foreach( $data as $key => $value ){
            $data[$key] = htmlspecialchars( $value );
        }

        return $data;
    }

    /**
     * Check if the request might be a CSRF attempt
     * For more information, please see the 'Protecting REST Services' section of the
     * OWASP Cross-Site Request Forgery (CSRF) Prevention Cheat Sheet
     * @return bool true if the request is unlikely to be CSRF, false otherwise
     */

    private function CheckCSRF(){

        $headers = getallheaders();

        // Grab site url from hidden/config/settings.json
        $host = Settings::Get()->Value(['origin', 'sitehost']);

        // Has the resource been request with JS ?
        $jsrequest = $headers['X-Requested-With'] === 'XMLHttpRequest' ? true : false;

        // Is the request coming from our site ?
        // Parse URL is converting the origin/referer to hostname only
        $referer = parse_url($headers['Referer'], PHP_URL_HOST);
        $referer = $referer === $host ? true : false;

        $origin = parse_url($headers['Origin'], PHP_URL_HOST);
        $origin = $origin === $host ? true : false;

        return $jsrequest && $referer && $origin;

    }


}