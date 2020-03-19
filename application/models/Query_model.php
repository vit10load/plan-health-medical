
<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Query_model extends CI_model {


  public function __construct() {

    parent::__construct();

  }

  /**
   *CREATE TRIGGER salary_medical AFTER INSERT ON consulta FOR EACH ROW BEGIN UPDATE user SET user.value = (OLD.user.value + NEW.consulta.value) WHERE user.user_id = NEW.fk_user_id AND user.user_type = 'medico'; END 
   * */

  public function create_query($data){

    return $this->db->insert('consulta', $data);

  }

  public function return_query_health() {

    $this->db->select('*');
    $this->db->from('consulta');

    if($query=$this->db->get())
    {
      return $query->result_array();
    }
    else{

      return false;
    }


  }

  public function return_query_by_date($query_date){

    $this->db->select('*');
    $this->db->from('consulta');
    $this->db->where('query_date',$query_date);
    $query=$this->db->get();

    if ($query->num_rows() > 0) {

      return $query->result();

    }else {

      return false;
    }

  }

  public function return_query_by_id($id){

    $this->db->select('*');
    $this->db->from('consulta');
    $this->db->where('id_consulta',$id);
    $query=$this->db->get();

    if ($query->num_rows() > 0) {

      return $query->result();

    }else {

      return false;
    }

  }

  public function exclude_query_by_id($id){

    return $this->db->delete('consulta', array('id_consulta' => $id));

  }

  public function update_query_by_id($data,$id){

    $this->db->where('id_consulta', $id);

    return $this->db->update('consulta', $data);


  }


  


}

