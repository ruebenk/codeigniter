<?php


<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PhpExample extends CI_Controller {


public function __construct(){
 parent::__construct();
$this->load->helper(array('form','url'));
$this->load->database();
$this->load->model('Project_model');
$this->load->model('Emailmodel');
$this->load->library("Projectfactory");
$this->load->driver('session');
}

public function index()
{

	$this->projectModel = new Project_model();
	$res = 	$this->projectModel->function1();
	
	var_dump($res);
	$json_response = json_encode($res);

	# Optionally: Wrap the response in a callback function for JSONP cross-domain support
	if($_GET["callback"]) {
	    $json_response = $_GET["callback"] . "(" . $json_response . ")";
	}

	# Return the response
	echo $json_response;
}

}

?>
