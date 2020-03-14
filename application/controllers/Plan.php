<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plan extends CI_Controller {

	private $data = null;

	
	public function __construct(){

		parent::__construct();
		$this->load->helper('url');
		$this->load->model('plan_model');
		$this->load->library('session');

	}

	public function index() {

		$this->data['plans'] = $this->plan_model->return_plans_health();

		$this->load->view("plan_profile",$this->data);
		
	}

	public function create() {

		$data['plans'] = null;

		$plan = array(
			'acomodacao'=>$this->input->post('accomodation'),
			'segmentacao'=>$this->input->post('segmentation'),
			'reembolso'=>$this->input->post('refund'),
			'rede_medica'=>$this->input->post('medical_network')
		);
		
		if ($this->plan_model->create_plan($plan)==true) {

			$this->session->set_flashdata('succes_msg','Registered Plan Health!');

		}else {

			$this->session->set_flashdata('error_msg','Fail Register!');

		}

		redirect('plan');

	}

	//TODO: use function for update plan health

	public function update() {

		if (!empty($this->plan_model->return_plan_by_id($this->input->post('id_plan')))) {
			
			$this->data['plansUpdate'] = $this->plan_model->return_plan_by_id($this->input->post('id_plan'));

			$this->session->set_flashdata('succes_msg','Registered Plan Health!');

		}else {

			$this->session->set_flashdata('error_msg','Fail Register!');
		}

		$this->index();

	}

	//TODO: exclude plan health by id


}