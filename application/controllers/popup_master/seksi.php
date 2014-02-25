<?php
class Seksi extends CI_Controller{
  /*public function __construct (){
       $this->load->model('MDaily');
  }*/
 
public function Index(){

    parent::__construct();
	
	$this->load->model('popup_master/mseksi');
    $data['query'] = $this->mseksi->getAll();
    $this->load->view('popup_master/seksi',$data);
}

public function cariData(){
    parent::__construct();
		
	 $cari    =   $this->input->post('cari');
	 $this->load->model('popup_master/mseksi');
     $data['query'] = $this->mseksi->cari($cari);
     $this->load->view('popup_master/seksi',$data);
}
 }