<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	
	public function __construct(){

		parent::__construct();
		$this->load->helper('url');
		$this->load->model('user_model');
		$this->load->library('session');

	}

	public function index()
	{
		$this->load->view("register.php");
	}

	public function register_user(){

		$user=array(
			'user_name'=>$this->input->post('user_name'),
			'user_email'=>$this->input->post('user_email'),
			'user_password'=>md5($this->input->post('user_password')),
			'user_age'=>$this->input->post('user_age'),
			'user_mobile'=>$this->input->post('user_mobile'),
			'user_type'=>$this->input->post('user_type')
		);
		
		$email_check=$this->user_model->email_check($user['user_email']);

		if($email_check){
			$this->user_model->register_user($user);
			$this->session->set_flashdata('success_msg', 'Registered successfully.Now login to your account.');
			redirect('user/login_view');

		}
		else{

			$this->session->set_flashdata('error_msg', 'Error occured,Try again.');
			redirect('user');


		}

	}

	public function login_view(){

		$this->load->view("login.php");

	}

	function login_user(){ 
		$user_login=array(

			'user_email'=>$this->input->post('user_email'),
			'user_password'=>md5($this->input->post('user_password'))

		); 

		$data['users']=$this->user_model->login_user($user_login['user_email'],$user_login['user_password']);


		$this->session->set_userdata('user_id',$data['users'][0]['user_id']);

		$this->session->set_userdata('user_email',$data['users'][0]['user_email']);

		$this->session->set_userdata('user_name',$data['users'][0]['user_name']);

		$this->session->set_userdata('user_age',$data['users'][0]['user_age']);

		$this->session->set_userdata('user_mobile',$data['users'][0]['user_mobile']);

		$this->session->set_userdata('user_type',$data['users'][0]['user_type']);

		$this->load->view('user_profile.php',$data);


	}


	public function return_user_name() {

		$name = $this->input->post('user_name');

		$data['arr']=$this->user_model->return_user_by_name($name);

		$this->load->view('user_profile.php',$data);
	}



	function user_profile(){

		$this->load->view('user_profile.php');

	}
	public function user_logout(){

		$this->session->sess_destroy();

		redirect('user/login_view', 'refresh');
	}

	public function exclude_user(){

		$id = $this->input->post('user_id');

		$this->user_model->excluir_usuario($id);
		
		redirect('user/login_user');
	}

	public function list_user(){

		$this->return_user_name();
	}


	public function update_user(){

		$user_id = $this->input->post('user_id');
		$name = $this->input->post('user_name');
		$user_email = $this->input->post('user_email');
		$user_age = $this->input->post('user_age');
		$user_mobile = $this->input->post('user_mobile');
		$user_type = $this->input->post('user_type');

		$data  = array(
			'user_name' => $name,
			'user_email' => $user_email,
			'user_age' => $user_age,
			'user_mobile' => $user_mobile,
			'user_type' => $user_type
		);

		$this->user_model->update_user_by_id($data,$user_id);

		redirect('user/login_user');
	}
}
