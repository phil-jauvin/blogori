<?php
namespace Controllers\View;

use \Origin\Utilities\Layout;

class Admin {

  public function Dashboard(){
    if( $_SERVER['REQUEST_METHOD'] === 'GET' ){
      Layout::Get()->Display('dashboard.tpl');
    }
  }

  public function EditPost(){
    if( $_SERVER['REQUEST_METHOD'] === 'GET' ){
      Layout::Get()->Display('editpost.tpl');
    }

  }

}
