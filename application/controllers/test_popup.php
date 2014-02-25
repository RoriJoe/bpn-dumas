<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* class Test_popup extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _main_output($output = null)
	{
		$this->load->view('test_popup.php',$output);
	}

}
 */
class Test_popup extends CI_Controller {

var $nama;
var $color;

function Index(){

    //if i remove this parent::__construct(); the error is gone
    parent::CI_Controller(); 
    /*or
    parent::__construct();
    */
	$this->nama = 'rahmad';
	$this->color = 'red';
}

/* 
public function test_popup() {
//parent::Controller();
$this->nama = 'rahmad';
$this->color = 'red';
} */

public function you($nama_depan='',$nama_belakang='') {
$newdata = array(
                   'username'  => 'johndoe',
                   'email'     => 'johndoe@some-site.com',
                   'logged_in' => TRUE
               );

$this->session->set_userdata($newdata);

$data['nama'] = ($nama_depan)?$nama_depan.' '.$nama_belakang:$this->nama;
$data['color'] = $this->color;
//echo $data['color'];
$this->load->view('test_popup.php',$data);
}
}