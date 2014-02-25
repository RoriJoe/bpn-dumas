<?php
class Petugas_pengaduan extends CI_Controller{
  /*public function __construct (){
       $this->load->model('MDaily');
  }*/
 
public function Index(){

    parent::__construct();
		
	$this->load->model('Mpetugas_pengadaan');
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