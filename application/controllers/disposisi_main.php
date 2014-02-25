<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Disposisi_main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _disposisi_main_output($output = null)
	{
		$this->load->view('disposisi_main.php',$output);
	}
/* 
	public function offices()
	{
		$output = $this->grocery_crud->render();

		$this->_disposisi_main_output($output);
	}
 */
	public function index()
	{
		$this->_disposisi_main_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}

	public function entri_pengaduan()
	{
		try{
			$crud = new grocery_CRUD();
			$bagian=$this->session->userdata('bagian');
			$seksi=$this->session->userdata('seksi');
			$crud->set_theme('datatables');
			$crud->set_table('tbl_dumas_pengaduan');
			$crud->set_subject('Dumas Pengaduan');
			$crud->required_fields('nomor_pengaduan');
			$crud->where('apl_status','DIS');
			$crud->where('tbl_dumas_pengaduan.kode_bagian',$bagian);
			$crud->where('tbl_dumas_pengaduan.kode_seksi',$seksi);
	//combo jenis pengaduan	
		/*$crud->set_relation('kode_jenis_permohonan','tbl_ref_jenis_permohonan','jenis_permohonan');
			$crud->display_as('kode_jenis_permohonan','Jenis Permohonan');
			$crud->set_relation('kode_pos','tbl_ref_lokasi','{kelurahan} - {kecamatan} - {kode_pos}');
			$crud->display_as('kode_pos','Kelurahan - Kecamatan');
			$crud->callback_column('kode_bagian',array($this,'kode_bagian'));
			$crud->set_relation('kode_bagian', 'tbl_ref_bagian', 'bagian');
			$crud->set_relation('kode_seksi', 'tbl_ref_seksi', 'seksi');
			$this->load->library('gc_dependent_select');
			$fields = array(
						'kode_bagian' => array( // first dropdown name
						'table_name' => 'tbl_ref_bagian', // table of country
						'id_field' => 'kode_bagian', // table of state: primary key
						'title' => 'bagian', // country title
						'relate' => null // the first dropdown hasn't a relation
						),
						// second field
						'kode_seksi' => array( // second dropdown name
						'table_name' => 'tbl_ref_seksi', // table of state
						'title' => 'seksi', // state title
						'id_field' => 'kode_seksi', // table of state: primary key
						'relate' => 'kode_bagian', // table of state:
						'data-placeholder' => 'seksi' //dropdown's data-placeholder:

						),
						
						);

						$config = array(
						'main_table' => 'tbl_dumas_pengaduan',
						'main_table_primary' => 'nomor_pengaduan',
						"url" => base_url() . __CLASS__ . '/' . __FUNCTION__ . '/', //path to method
						'ajax_loader' => base_url() . 'ajax-loader.gif' ,// path to ajax-loader image. It's an optional parameter
						'segment_name' =>'Kode Seksi' // It's an optional parameter. by default "get_items"
						);
						$seksi = new gc_dependent_select($crud, $fields, $config);

						// first method:
						//$output = $categories->render();

						// the second method:
						$js = $seksi->get_js();

		
			  
		//$crud->field_type('kode_bagian','enabled');
		*/
					 $crud->unset_delete();
			 $crud->unset_edit();
			 $crud->unset_add();
		$crud->callback_before_update(array($this, '_created_callback'));
		$crud->columns('nomor_pengaduan','tanggal_pengaduan','nama_lengkap','telepon');
		$state = $crud->getState();
		if($state == "edit")
		{
			//$crud->unset_fields('status', 'notification_amount', 'password');
				$crud->edit_fields('tanggapan_aduan');
		}
$crud->add_action('Edit', '', 'Edit','ui-icon-person',array($this,'edit_data'));
			// $crud->unset_delete();
			 //$crud->unset_edit();
			 //$crud->unset_read();
			//$crud->read_fields('nomor_pengaduan','tanggal_pengaduan','nama_lengkap','telepon','kepada');
//add action
			//$crud->add_action('Kirim ke Kakan', '', 'Login','ui-icon-person',array($this,'send2KKT'));
			//getKodeBagian();
		//	$crud->field_type('kode_bagian','readonly');
			$output = $crud->render();
	
			$this->_disposisi_main_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	function edit_data($primary_key , $row)
	{
		
		return site_url('main/edit_data_pengaduan').'?nomor_pengaduan='.$row->nomor_pengaduan;
	}
function _created_callback($post_array) {
			$post_array['apl_status'] = 	"RES";
			$post_array['last_update'] = 	date('Y-m-d H:i:s');
			
			return $post_array;
	}
		
function send2KKT($primary_key , $row)
	{
		//return site_url('kirim_kakan').'?nomor_pengaduan='.$row->nomor_pengaduan;
		return site_url('disposisi_main/entri_pengaduan/edit').'/'.$row->nomor_pengaduan;
		
	}

 	public function logout()
	{
		redirect("login/logout");
	}	
}