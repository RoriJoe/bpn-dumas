<?php
class Mseksi extends CI_Model{
 /*  public function __construct (){
    parent::Model();
  } */
  public function __construct()
   {
      parent::__construct();
   }
    public function mseksi() {
        parent::Model();
    } 

  public function getAll(){
  /*
  $this->db->from('table1');
$this->db->join('table2', 'table1.id = table2.id');
$this->db->join('table3', 'table1.id = table3.id');
  */
  $bagian=$this->session->userdata('bagian');	
    $this->db->select('*');
    $this->db->from('tbl_ref_seksi');
    $this->db->where('kode_bagian',$bagian);
//    $this->db->limit(5);
    $this->db->order_by('seksi','ASC');
    $query = $this->db->get();
 
    return $query->result();
  }
 
  public function cari( $cari ){
  $bagian=$this->session->userdata('bagian');	
	 $cari = $cari ;	
	$this->db->select('*');
    $this->db->from('tbl_ref_seksi');
	$this->db->where('kode_bagian',$bagian);
	if($cari==""){}else{
		$this->db->like('seksi',$cari);
	}
    
//	$this->db->limit(5);
    $this->db->order_by('seksi','ASC');
    $query = $this->db->get();
 
    return $query->result();
  }
 
 
}