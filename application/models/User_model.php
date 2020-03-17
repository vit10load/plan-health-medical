<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_model {


  public function __construct() {

    parent::__construct();

  }

  public function register_user($user){


    $this->db->insert('user', $user);

  }

  public function login_user($email,$password) {

    $this->db->select('*');
    $this->db->from('user');
    $this->db->where('user_email',$email);
    $this->db->where("user_password",$password);


    if($query=$this->db->get())
    {
      return $query->result_array();
    }
    else{

      return false;
    }


  }

  public function email_check($email){

    $this->db->select('*');
    $this->db->from('user');
    $this->db->where('user_email',$email);

    $query=$this->db->get();

    if($query->num_rows() > 0){

      return false;

    }else{

      return true;

    }

  }

  public function return_all_user_by_type_pacient($type="paciente"){

    $this->db->select('*');
    $this->db->from('user');
    $this->db->where('user_type',$type);

    $query=$this->db->get();

    if ($query->num_rows() > 0) {

      return $query->result();

    }else {

      return false;
      
    }


  }

  /***
    Search user by name
  ***/

    public function return_user_by_name($name){

      $this->db->select('*');
      $this->db->from('user');
      $this->db->like('user_name',$name);
      $query=$this->db->get();

      if ($query->num_rows() > 0) {

        return $query->result();

      }else {

        return false;
      }

    }

    public function excluir_usuario($id){

      $this->db->delete('user', array('user_id' => $id));

    }

    public function update_user_by_id($data,$user_id){

      $this->db->where('user_id', $user_id);
      $this->db->update('user', $data);

    }


  }