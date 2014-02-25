<?php
class Daily extends CI_Controller{
  /*public function __construct (){
       $this->load->model('MDaily');
  }*/
 
public function Index(){

    //if i remove this parent::__construct(); the error is gone
    //parent::CI_Controller(); 
    //or
    parent::__construct();
    
	// load 'url' helper
/*     $this->load->helper('url');

    // load 'form' helper
    $this->load->helper('form');

// load 'session' 
	$this->load->library('session');
    // load 'validation' class
    $this->load->library('form_validation'); */
	
   $this->load->model('MDaily');
    $data['query'] = $this->MDaily->getAll();
    $this->load->view('input',$data);
}
/*   public function index(){
   parent::CI_Controller();
   $this->load->model('MDaily');
    $data['query'] = $this->MDaily->getAll();
    $this->load->view('daily/input',$data);
  } */
 
  public function submit(){
  
    if ($this->input->post('ajax')){
	$this->load->model('MDaily');
      if ($this->input->post('id')){
        $this->MDaily->update();
        $data['query'] = $this->MDaily->getAll();
        $this->load->view('show',$data);
      }else{
		//$this->load->model('MDaily');
        $this->MDaily->save();
        $data['query'] = $this->MDaily->getAll();
        $this->load->view('show',$data);
      }
    }
  }
 
  public function delete(){
  $this->load->model('MDaily');
    $id = $this->input->post('id');
    $this->db->delete('daily', array('id' => $id));
    $data['query'] = $this->MDaily->getAll();
    $this->load->view('show',$data);
  }
}