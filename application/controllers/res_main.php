<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Res_main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _res_main_output($output = null)
	{
		$this->load->view('res_main.php',$output);
	}
/* 
	public function offices()
	{
		$output = $this->grocery_crud->render();

		$this->_res_main_output($output);
	}
 */
	public function index()
	{
		$this->_res_main_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}

	public function entri_pengaduan()
	{
		$username = $this->session->userdata('username');
		
		if ($username==""){
			redirect("login/index");
		}
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('tbl_dumas_pengaduan');
			$crud->set_subject('Dumas Pengaduan');
			$crud->required_fields('nomor_pengaduan');
			$crud->where('apl_status','RES');
			$crud->or_where('apl_status','FIN');
			
		 $crud->callback_before_insert(array($this, '_created_callback'));
    $crud->callback_before_update(array($this, '_created_callback'));
	
	//combo jenis pengaduan	
		/*	$crud->set_relation('kode_jenis_permohonan','tbl_ref_jenis_permohonan','jenis_permohonan');
			$crud->display_as('kode_jenis_permohonan','Jenis Permohonan');
			$crud->set_relation('kode_pos','tbl_ref_lokasi','{kelurahan} - {kecamatan} - {kode_pos}');
			$crud->display_as('kode_pos','Kelurahan - Kecamatan');
			$crud->set_relation('kode_bagian','tbl_ref_bagian','bagian');
			$crud->display_as('kode_bagian','Bagian');*/

			$crud->columns('nomor_pengaduan','tanggal_pengaduan','nama_lengkap','telepon','kepada','apl_status');
			$state = $crud->getState();
			if($state == "edit")
				{
				//`respon_melalui_telepon`, `respon_melalui_surat`, `respon_pengadu_datang`
						$crud->unset_columns('respon_melalui_telepon','respon_melalui_surat','respon_pengadu_datang');
						$crud->edit_fields('respon_melalui_telepon', 'tanggal_telepon', 'keterangan_dari_telepon', 'respon_melalui_surat', 'tanggal_kirim_surat', 'keterangan_dari_surat', 'respon_pengadu_datang', 'tanggal_datang', 'keterangan_kedatangan','keterangan_respon');
				} 
			 $crud->unset_delete();
			 $crud->unset_add();
			// $crud->unset_edit();
			 $crud->add_action('Edit Status', '', 'Edit Status','ui-icon-person',array($this,'edit_data'));
		//	$crud->field_type('nomor_pengaduan', 'readonly', 1);
		//	$crud->edit_fields('tanggal_pengaduan','nama_lengkap','alamat','email','telepon','handphone','kode_jenis_permohonan','kepada','kode_bagian','kode_bagian_o','nomor_berkas','tanggal_berkas','alamat_aduan','kode_pos','uraian_aduan');
			$crud->add_fields('tanggal_pengaduan','nama_lengkap','alamat','email','telepon','handphone','kode_jenis_permohonan','kode_bagian','nomor_berkas','tanggal_berkas','alamat_aduan','kode_pos','uraian_aduan');
//add action
		//	$crud->add_action('Verifikasi', '', 'Verifikasi','ui-icon-person',array($this,'send2ver'));
			
			$output = $crud->render();

			$this->_res_main_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	function _created_callback($post_array) {
			$post_array['apl_status'] = 	"RES1" ;
			$post_array['last_update'] = 	date('Y-m-d H:i:s');
			
			return $post_array;
	}
	
	function send2ver($primary_key , $row)
	{
		return site_url('kirim_verifikasi').'?nomor_pengaduan='.$row->nomor_pengaduan;
		
	}

 	function edit_data($primary_key , $row)
	{
		
		return site_url('main/edit_data_pengaduan').'?nomor_pengaduan='.$row->nomor_pengaduan;
	}
}