<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Projectfactory {
	
		private $_ci;
 		function __construct()
    {
    	//When the class is constructed get an instance of codeigniter so we can access it locally
    	  $this->_ci =& get_instance();
        $this->_ci->load->model("project_model");
    }
    public function createObjectFromData($id) {
    	//Create a new user_model object
    	$user = new Project_Model();
    	//Set the ID on the user model
    	$user->setId($id);
    	return $user;
    }
}
?>
