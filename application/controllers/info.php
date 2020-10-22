<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 function __construct(){
	$this->load->helper('url');
	$this->load->database();
	$this->load->dbforge();
}


class Info extends CI_Controller {


	public function index()
	{
		$this->load->view('info');
	}	

}
