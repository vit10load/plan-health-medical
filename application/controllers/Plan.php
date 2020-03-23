<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plan extends CI_Controller {

	private $data = null;
	
	public function __construct(){

		parent::__construct();
		$this->load->helper('url');
		$this->load->model('plan_model');
		$this->load->model('user_model');
		$this->load->library('session');

	}

	public function index() {

		$this->data['plans'] = $this->plan_model->return_plans_health();

		$this->data['user_for_query'] = $this->user_model->return_all_user_by_type_pacient();

		$this->load->view("plan_profile",$this->data);
		
	}

	public function create() {


		$plan = array(
			'acomodacao'=>$this->input->post('accomodation'),
			'segmentacao'=>$this->input->post('segmentation'),
			'reembolso'=>$this->input->post('refund'),
			'rede_medica'=>$this->input->post('medical_network')
		);

		if ($this->input->post('operation') != "update") {

			if ($this->plan_model->create_plan($plan)==true) {

				$this->session->set_flashdata('succes_msg','Registered Plan Health!');

			}else {

				$this->session->set_flashdata('error_msg','Fail Register!');

			}

		}else {

			$id_plan = $this->input->post('id_plan');

			$plan = array(
				'acomodacao'=>$this->input->post('accomodation'),
				'segmentacao'=>$this->input->post('segmentation'),
				'reembolso'=>$this->input->post('refund'),
				'rede_medica'=>$this->input->post('medical_network')
			);

			if ($this->plan_model->update_plan_by_id($plan,$id_plan)) {
				
				redirect('plan');

				return;
			}


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

	public function delete(){

		$id_plan = $this->input->post('id_plan');

		if ($this->plan_model->exclude_plan_by_id($id_plan)) {
			
			redirect('plan');
		}

	}

	public function bind_plan_by_user_id(){

		$this->data['user_bind'] = array(
			'fk_user_id' => $this->input->post('user_id'),
			'fk_plano_saude_id' => $this->input->post('id_plan')
		);

		if ($this->security->xss_clean($this->data)) {
			
			$this->plan_model->bind_plan_health_by_user($this->data['user_bind']);

			$this->index();
		}

	}



}