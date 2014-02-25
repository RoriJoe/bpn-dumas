<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	
class Tanda_terima extends CI_Controller {
   

	public function tanda_terima()
	{
	parent::__construct();
	    // Load library FPDF 
	    $this->load->library('fpdf');
        
        // Load Database
        $this->load->database();
        
       
        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
        
       
		$nomor_pengaduan=$_GET['nomor_pengaduan'];
        $this->load->model('pengaduan_model');
       
		
        $data['pengaduan'] = $this->pengaduan_model->getData($nomor_pengaduan);
        
             
		$this->load->view('report/tanda_terima', $data);
	}
}

