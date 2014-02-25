<?php
class Mkelurahan extends CI_Model{
 /*  public function __construct (){
    parent::Model();
  } */
  public function __construct()
   {
      parent::__construct();
   }
    public function mkelurahan() {
        parent::Model();
    } 

  public function getAll(){
  /*
  $this->db->from('table1');
$this->db->join('table2', 'table1.id = table2.id');
$this->db->join('table3', 'table1.id = table3.id');
  */
    $this->db->select('*');
    $this->db->from('tbl_ref_kelurahan');
//    $this->db->limit(5);
    $this->db->order_by('nama_desa','ASC');
    $query = $this->db->get();
 
    return $query->result();
  }
 
  public function cari( $cari ){
	 $cari = $cari ;	
	$this->db->select('*');
    $this->db->from('tbl_ref_kelurahan');
	if($cari==""){}else{
		$this->db->like('nama_desa',$cari);
	}
    
//	$this->db->limit(5);
    $this->db->order_by('nama_desa','ASC');
    $query = $this->db->get();
 
    return $query->result();
  }
 
 
}