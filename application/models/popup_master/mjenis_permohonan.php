<?php
class Mjenis_permohonan extends CI_Model{
 /*  public function __construct (){
    parent::Model();
  } */
  public function __construct()
   {
      parent::__construct();
   }
    public function mjenis_permohonan() {
        parent::Model();
    } 

  public function getAll(){
  /*
  $this->db->from('table1');
$this->db->join('table2', 'table1.id = table2.id');
$this->db->join('table3', 'table1.id = table3.id');
  */
    $this->db->select('*');
    $this->db->from('tbl_ref_jenis_permohonan');
//    $this->db->limit(5);
    $this->db->order_by('jenis_permohonan','ASC');
    $query = $this->db->get();
 
    return $query->result();
  }
 
  public function cari( $cari ){
	 $cari = $cari ;	
	$this->db->select('*');
    $this->db->from('tbl_ref_jenis_permohonan');
	if($cari==""){}else{
		$this->db->like('jenis_permohonan',$cari);
	}
    
//	$this->db->limit(5);
    $this->db->order_by('jenis_permohonan','ASC');
    $query = $this->db->get();
 
    return $query->result();
  }
 
 
}