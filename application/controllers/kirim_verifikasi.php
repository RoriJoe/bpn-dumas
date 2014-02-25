<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
Class Kirim_verifikasi extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form','url'));
        //$this->load->model('mkirim_verifikasi');
		
		//$this->load->library('grocery_CRUD');
    }
    public function index(){
       $this->load->view('kirim_verifikasi.php');
    }
}	