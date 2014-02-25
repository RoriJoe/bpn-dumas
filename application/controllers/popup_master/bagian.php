<?php
class Bagian extends CI_Controller{
  /*public function __construct (){
       $this->load->model('MDaily');
  }*/
 
public function Index(){

    parent::__construct();
		
	$this->load->model('popup_master/mbagian');
    $data['query'] = $this->mbagian->getAll();
    $this->load->view('popup_master/bagian',$data);
}

public function cariData(){
    parent::__construct();
		
	 $cari    =   $this->input->post('cari');
	 $this->load->model('popup_master/mbagian');
     $data['query'] = $this->mbagian->cari($cari);
     $this->load->view('popup_master/bagian',$data);
}
 }