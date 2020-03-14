
<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Plan_model extends CI_model {


  public function __construct() {

    parent::__construct();

  }

  public function create_plan($plan){


    return $this->db->insert('plano_saude', $plan);

  }

  public function return_plans_health() {

    $this->db->select('*');
    $this->db->from('plano_saude');

    if($query=$this->db->get())
    {
      return $query->result_array();
    }
    else{

      return false;
    }


  }

  public function return_plan_by_name($name){

    $this->db->select('*');
    $this->db->from('plano_saude');
    $this->db->like('segmentacao',$name);
    $query=$this->db->get();

    if ($query->num_rows() > 0) {

      return $query->result();

    }else {

      return false;
    }

  }

  public function return_plan_by_id($id){

    $this->db->select('*');
    $this->db->from('plano_saude');
    $this->db->where('id_plano',$id);
    $query=$this->db->get();

    if ($query->num_rows() > 0) {

      return $query->result();

    }else {

      return false;
    }

  }

  public function exclude_plan($id){

    $this->db->delete('plano_saude', array('id_plano' => $id));

  }

  public function update_plan_by_id($data,$id_plano){

    $this->db->where('id_plano', $id_plano);

    return $this->db->update('plano_saude', $data);


  }


  


}

