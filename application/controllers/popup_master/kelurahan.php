<?php
class Kelurahan extends CI_Controller{
  /*public function __construct (){
       $this->load->model('MDaily');
  }*/
 
public function Index(){

    parent::__construct();
		
	$this->load->model('popup_master/mkelurahan');
    $data['query'] = $this->mkelurahan->getAll();
    $this->load->view('popup_master/kelurahan',$data);
}

public function cariData(){
    parent::__construct();
		
	 $cari    =   $this->input->post('cari');
	 $this->load->model('popup_master/mkelurahan');
     $data['query'] = $this->mkelurahan->cari($cari);
     $this->load->view('popup_master/kelurahan',$data);
}
/*   public function index(){
   parent::CI_Controller();
   $this->load->model('MDaily');
    $data['query'] = $this->MDaily->getAll();
    $this->load->view('daily/input',$data);
  } */
 }