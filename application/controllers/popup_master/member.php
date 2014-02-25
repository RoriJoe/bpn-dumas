<?php
class Member extends CI_Controller{
  /*public function __construct (){
       $this->load->model('MDaily');
  }*/
 
public function Index(){

    parent::__construct();
		
	$this->load->model('popup_master/mmember');
    $data['query'] = $this->mmember->getAll();
    $this->load->view('popup_master/list_member',$data);
}

public function cariData(){
    parent::__construct();
		
	 $cari    =   $this->input->post('cari');
	 $this->load->model('popup_master/mmember');
     $data['query'] = $this->mmember->cari($cari);
     $this->load->view('popup_master/list_member',$data);
}
/*   public function index(){
   parent::CI_Controller();
   $this->load->model('MDaily');
    $data['query'] = $this->MDaily->getAll();
    $this->load->view('daily/input',$data);
  } */
 }