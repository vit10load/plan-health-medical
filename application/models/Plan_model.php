
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

    $data = $this->db->query('SELECT * FROM plano_saude, plano_saude_has_user, user WHERE fk_plano_saude_id = id_plano AND user.user_id = fk_user_id');

    if ($data->num_rows() > 0) {
      
      return $data->result();

    }else {

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

  public function exclude_plan_by_id($id){

    return $this->db->delete('plano_saude', array('id_plano' => $id));

  }

  public function update_plan_by_id($data,$id_plano){

    $this->db->where('id_plano', $id_plano);

    return $this->db->update('plano_saude', $data);


  }

  public function bind_plan_health_by_user($data){

    return $this->db->insert('plano_saude_has_user', $data);

  }


  


}

