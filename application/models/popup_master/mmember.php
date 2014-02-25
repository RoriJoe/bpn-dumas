<?php
class Mmember extends CI_Model{
 /*  public function __construct (){
    parent::Model();
  } */
  public function __construct()
   {
      parent::__construct();
   }
    public function mmember() {
        parent::Model();
    } 

  public function getAll(){
  /*
  $this->db->from('table1');
$this->db->join('table2', 'table1.id = table2.id');
$this->db->join('table3', 'table1.id = table3.id');
  */
    $this->db->select('*');
    $this->db->from('member');
	$this->db->join('tbl_ref_bagian', 'member.kode_bagian = tbl_ref_bagian.kode_bagian', 'left');
	$this->db->join('tbl_ref_seksi', 'member.kode_seksi = tbl_ref_seksi.kode_seksi and member.kode_bagian = tbl_ref_bagian.kode_bagian', 'left');
//    $this->db->limit(5);
    $this->db->order_by('nama','ASC');
    $query = $this->db->get();
 
    return $query->result();
  }
 
  public function cari( $cari ){
	 $cari = $cari ;	
	$this->db->select('*');
    $this->db->from('member');
	$this->db->join('tbl_ref_bagian', 'member.kode_bagian = tbl_ref_bagian.kode_bagian', 'left');
	$this->db->join('tbl_ref_seksi', 'member.kode_seksi = tbl_ref_seksi.kode_seksi and member.kode_bagian = tbl_ref_bagian.kode_bagian', 'left');
	if($cari==""){}else{
		$this->db->like('member.nama',$cari);
	}
    
//	$this->db->limit(5);
    $this->db->order_by('member.nama','ASC');
    $query = $this->db->get();
 
    return $query->result();
  }
 
 
}