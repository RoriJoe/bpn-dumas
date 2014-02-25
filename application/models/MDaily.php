<?php
class MDaily extends CI_Model{
 /*  public function __construct (){
    parent::Model();
  } */
  public function __construct()
   {
      parent::__construct();
   }
    public function mDaily() {
        parent::Model();
    } 

  public function getAll(){
    $this->db->select('*');
    $this->db->from('daily');
    $this->db->limit(5);
    $this->db->order_by('id','ASC');
    $query = $this->db->get();
 
    return $query->result();
  }
 
  public function get($id){
    $query = $this->db->getwhere('daily',array('id'=>$id));
    return $query->row_array();
  }
 
  public function save(){
    $date = $this->input->post('date');
    $name = $this->input->post('name');
    $amount=$this->input->post('amount');
    $data = array(
      'date'=>$date,
      'name'=>$name,
      'amount'=>$amount
    );
    $this->db->insert('daily',$data);
  }
 
  public function update(){
    $id   = $this->input->post('id');
    $date = $this->input->post('date');
    $name = $this->input->post('name');
    $amount=$this->input->post('amount');
    $data = array(
      'date'=>$date,
      'name'=>$name,
      'amount'=>$amount
    );
    $this->db->where('id',$id);
    $this->db->update('daily',$data);
  }
 
}