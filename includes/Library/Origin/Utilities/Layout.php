<?php
namespace Origin\Utilities;

class Layout extends \Origin\Utilities\Types\Singleton {
	private $holder;

  /*
  * Display a template to a user and exit.
  */
	public function Display($template){

		$template .= '.html';
		$template_dir = Settings::Get('settings')->Value(['origin', 'template_dir']);
		exit(readfile( $template_dir.$template ));

	}


}
