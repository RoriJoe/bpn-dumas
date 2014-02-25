<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kode_etik_main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _kode_etik_main_output($output = null)
	{
		$this->load->view('kode_etik_main.php',$output);
	}
/* 
	public function offices()
	{
		$output = $this->grocery_crud->render();

		$this->_kode_etik_main_output($output);
	}
 */
	public function index()
	{
		$this->_kode_etik_main_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}

	public function entri_pengaduan()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('tbl_dumas_pengaduan');
			$crud->set_subject('Dumas Pengaduan');
			$crud->required_fields('nomor_pengaduan');
			$crud->where('apl_status','PDU');
	//combo jenis pengaduan	
			$crud->set_relation('kode_jenis_pengaduan','tbl_ref_jenis_pengaduan','jenis_pengaduan');
			$crud->display_as('kode_jenis_pengaduan','Jenis Pengaduan');
			$crud->set_relation('kode_type_pengaduan','tbl_ref_type_pengaduan','type_pengaduan');
			$crud->display_as('kode_type_pengaduan','Type Pengaduan');
			$crud->set_relation('kode_pos','tbl_ref_lokasi','{kelurahan} - {kecamatan} - {kode_pos}');
			$crud->display_as('kode_pos','Kelurahan - Kecamatan');
			$crud->set_relation('kode_bagian','tbl_ref_bagian','bagian');
			$crud->display_as('kode_bagian','Bagian');

			$crud->columns('nomor_pengaduan','tanggal_pengaduan','nama_lengkap','telepon','kepada');
		//	$crud->field_type('nomor_pengaduan', 'readonly', 1);
			$crud->edit_fields('tanggal_pengaduan','nama_lengkap','alamat','email','telepon','handphone','kode_jenis_pengaduan','kode_type_pengaduan','kepada','kode_bagian','tanggal_masuk_dokumen','alamat_aduan','kode_pos','uraian_aduan');
			$crud->add_fields('tanggal_pengaduan','nama_lengkap','alamat','email','telepon','handphone','kode_jenis_pengaduan','kode_type_pengaduan','kepada','kode_bagian','tanggal_masuk_dokumen','alamat_aduan','kode_pos','uraian_aduan');
//add action
			$crud->add_action('Verifikasi', '', 'Login','ui-icon-person',array($this,'just_a_test'));
			
			$output = $crud->render();

			$this->_kode_etik_main_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	function just_a_test($primary_key , $row)
	{
		return site_url('kirim_verifikasi').'?nomor_pengaduan='.$row->nomor_pengaduan;
	}

 	public function offices_management()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('offices');
			$crud->set_subject('Office');
			//$crud->required_fields('city');
			$crud->order_by('city', 'descending');
			$crud->columns('city','country','phone','addressLine1','postalCode');

			$output = $crud->render();

			$this->_kode_etik_main_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
/*
	//batas script tidak dipakai
	public function employees_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('employees');
			$crud->set_relation('officeCode','offices','city');
			$crud->display_as('officeCode','Office City');

			$crud->set_relation('pangkat','tbl_pangkat','nama_pangkat');
			$crud->display_as('pangkat','Pangkat Jabatan');

			$crud->set_subject('Employee');

			$crud->required_fields('lastName');

			$crud->set_field_upload('file_url','assets/uploads/files');

			$output = $crud->render();

			$this->_kode_etik_main_output($output);
	}

	public function customers_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('customers');
			$crud->columns('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit');
			$crud->display_as('salesRepEmployeeNumber','from Employeer')
				 ->display_as('customerName','Name')
				 ->display_as('contactLastName','Last Name');
			$crud->set_subject('Customer');
			$crud->set_relation('salesRepEmployeeNumber','employees','lastName');

			$output = $crud->render();

			$this->_kode_etik_main_output($output);
	}

	public function orders_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_relation('customerNumber','customers','{contactLastName} {contactFirstName}');
			$crud->display_as('customerNumber','Customer');
			$crud->set_table('orders');
			$crud->set_subject('Order');
			$crud->unset_add();
			$crud->unset_delete();

			$output = $crud->render();

			$this->_kode_etik_main_output($output);
	}

	public function products_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('products');
			$crud->set_subject('Product');
			$crud->unset_columns('productDescription');
			$crud->callback_column('buyPrice',array($this,'valueToEuro'));

			$output = $crud->render();

			$this->_kode_etik_main_output($output);
	}

	public function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}

	public function film_management()
	{
		$crud = new grocery_CRUD();

		$crud->set_table('film');
		$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
		$crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
		$crud->unset_columns('special_features','description','actors');

		$crud->fields('title', 'description', 'actors' ,  'category' ,'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');

		$output = $crud->render();

		$this->_kode_etik_main_output($output);
	}

	public function film_management_twitter_bootstrap()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('twitter-bootstrap');
			$crud->set_table('film');
			$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
			$crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
			$crud->unset_columns('special_features','description','actors');

			$crud->fields('title', 'description', 'actors' ,  'category' ,'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');

			$output = $crud->render();
			$this->_kode_etik_main_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	function multigrids()
	{
		$this->config->load('grocery_crud');
		$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$output1 = $this->offices_management2();

		$output2 = $this->employees_management2();

		$output3 = $this->customers_management2();

		$js_files = $output1->js_files + $output2->js_files + $output3->js_files;
		$css_files = $output1->css_files + $output2->css_files + $output3->css_files;
		$output = "<h1>List 1</h1>".$output1->output."<h1>List 2</h1>".$output2->output."<h1>List 3</h1>".$output3->output;

		$this->_kode_etik_main_output((object)array(
				'js_files' => $js_files,
				'css_files' => $css_files,
				'output'	=> $output
		));
	}

	public function offices_management2()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('offices');
		$crud->set_subject('Office');

		$crud->set_crud_url_path(site_url(strtolower(__CLASS__."/".__FUNCTION__)),site_url(strtolower(__CLASS__."/multigrids")));

		$output = $crud->render();

		if($crud->getState() != 'list') {
			$this->_kode_etik_main_output($output);
		} else {
			return $output;
		}
	}

	public function employees_management2()
	{
		$crud = new grocery_CRUD();

		$crud->set_theme('datatables');
		$crud->set_table('employees');
		$crud->set_relation('officeCode','offices','city');
		$crud->display_as('officeCode','Office City');
		

			$crud->set_relation('pangkat','tbl_pangkat','nama_pangkat');
			$crud->display_as('pangkat','Pangkat Jabatan'); 
			
		$crud->set_subject('Employee');	
		$crud->required_fields('lastName');

		$crud->set_field_upload('file_url','assets/uploads/files');

		$crud->set_crud_url_path(site_url(strtolower(__CLASS__."/".__FUNCTION__)),site_url(strtolower(__CLASS__."/multigrids")));

		$output = $crud->render();

		if($crud->getState() != 'list') {
			$this->_kode_etik_main_output($output);
		} else {
			return $output;
		}
	}

	public function customers_management2()
	{

		$crud = new grocery_CRUD();

		$crud->set_table('customers');
		$crud->columns('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit');
		$crud->display_as('salesRepEmployeeNumber','from Employeer')
			 ->display_as('customerName','Name')
			 ->display_as('contactLastName','Last Name');
		$crud->set_subject('Customer');
		$crud->set_relation('salesRepEmployeeNumber','employees','lastName');

		$crud->set_crud_url_path(site_url(strtolower(__CLASS__."/".__FUNCTION__)),site_url(strtolower(__CLASS__."/multigrids")));

		$output = $crud->render();

		if($crud->getState() != 'list') {
			$this->_kode_etik_main_output($output);
		} else {
			return $output;
		}
	} */
}