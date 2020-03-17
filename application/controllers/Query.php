<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Query extends CI_Controller {

    private $data_query = null;
    private $operation = null;

    public function __construct(){

        parent::__construct();
        $this->load->model('query_model');
        $this->load->helper('url');
        $this->load->model('user_model');
    }
	
	public function index()
	{

        $this->data_query['user_for_query'] = $this->user_model->return_all_user_by_type_pacient();

        $this->data_query['all_query'] = $this->query_model->return_query_health();

		$this->load->view('query_index',$this->data_query,$this->operation);
    }
    
    public function create(){

        $description = $this->input->post('description');
        $date_query = $this->input->post('date_query');
        $user_id = $this->input->post('user_id');


        $data = array(
            'description' => $description,
            'query_date' =>  $date_query,
            'fk_user_id' =>  $user_id
        );

        if (!($this->input->post('operation') === 'update')) {

            if ($this->query_model->create_query($data)) {
            
                $message['sucess'] = "Registered with sucess!";
    
                $this->load->view('query_index',$message);
    
            }
        }else {

            $id_query = $this->input->post('id_query');

            if($this->query_model->update_query_by_id($data,$id_query)) {

                redirect('query');

                return;
            }
        }

      


    }

    public function update() {

        $id_query = $this->input->post('id_query');

        $this->data_query['all_query_id'] = $this->query_model->return_query_by_id($id_query);

        $this->data_query['user_for_query'] = $this->user_model->return_all_user_by_type_pacient();

        $this->data_query['all_query'] = $this->query_model->return_query_health();

        $this->data_query['action'] = 'update';

        $this->load->view('query_index',$this->data_query);


    }

    public function delete(){

        $id_query = $this->input->post('id_query');

        if ($this->query_model->exclude_query_by_id($id_query)) {
            
            $this->data_query['message'] = 'Register delete with sucess!!!';

            $this->index();
        }

    }
}