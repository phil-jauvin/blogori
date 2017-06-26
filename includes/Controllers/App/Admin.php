<?php
namespace Controllers\App;

use \Origin\Utilities\Layout;

class Admin {

  public function Dashboard(){
    Layout::Get()->Display('dashboard.tpl');
  }

  public function EditPost(){
    Layout::Get()->Display('editpost.tpl');
  }

}
