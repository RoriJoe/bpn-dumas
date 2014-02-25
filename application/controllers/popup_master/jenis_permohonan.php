<?php
class Jenis_permohonan extends CI_Controller{
  /*public function __construct (){
       $this->load->model('MDaily');
  }*/
 
public function Index(){

    parent::__construct();
		
	$this->load->model('popup_master/mjenis_permohonan');
    $data['query'] = $this->mjenis_permohonan->getAll();
    $this->load->view('popup_master/jenis_permohonan',$data);
}

public function cariData(){
    parent::__construct();
		
	 $cari    =   $this->input->post('cari');
	 $this->load->model('popup_master/mjenis_permohonan');
     $data['query'] = $this->mmember->cari($cari);
     $this->load->view('popup_master/jenis_permohonan',$data);
}
/*   public function index(){
   parent::CI_Controller();
   $this->load->model('MDaily');
    $data['query'] = $this->MDaily->getAll();
    $this->load->view('daily/input',$data);
  } */
 }