<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 function __construct(){
	$this->load->helper('url');
	$this->load->database();
	$this->load->dbforge();
	$this->load->library('session');
}


class Contact extends CI_Controller {

	public function index()
	{
		$this->load->view('contact');
	}

	public function save_info(){

		$data = array();
		$content = array();
		$count = 0;
		$fields = array();
		foreach(explode('&', trim($_POST['dataValues'])) as $value)
		{
			$count++;
			$value1 = explode('=', $value);
	
			if(strpos($value1[0], 'databaseVal') !== false){
				$value1[0] = $value1[1];
				array_push($data,$value1[0]);
				$content = $content;
			}
			else
			if(strpos($value1[0], 'content') !== false){
				$data = $data;
				array_push($content,$value1[1]);
				
			}else{
				array_push($data,$value1[0]);
				array_push($content,$value1[1]);
			}
		}
		
		$this->load->model('contact_model');

		$this->load->dbforge();
		$this->contact_model->modify_table($data);
		$this->contact_model->add_user($content, $data);
		$saved = true;

		if($saved){
			$this->load->helper('url'); 
			redirect(base_url('index.php/contact/view_info')); 
		}else{
			$this->session->set_flashdata('error_msg', 'Error occured,Try again.');
			redirect(base_url('index.php/contact'));
		}
	}

	public function view_info(){

		$this->load->model('contact_model');
		$table_fields = $this->contact_model->get_table_columns();
		$query = $this->contact_model->get_data();
		
		$this->load->view('info',array(
			'data' => $query->result(),
			'table_fields' => $table_fields
		));
	}


}
