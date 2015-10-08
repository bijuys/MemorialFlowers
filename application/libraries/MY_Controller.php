<?php

class MY_Controller extends Controller{

  public $data;

  function MY_Controller(){  
    parent::__construct()
    $GLOBALS['EXT']->_call_hook('post_controller_constructor');
  }

}

