<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verifikator_main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');
		$this->load->model('mlogin');

		$this->load->library('grocery_CRUD');
	}

	public function _verifikator_main_output($output = null)
	{
		$this->load->view('verifikator_main.php',$output);
	}
/* 
	public function offices()
	{
		$output = $this->grocery_crud->render();

		$this->_verifikator_main_output($output);
	}
 */
	public function index()
	{
		$this->_verifikator_main_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}

	public function entri_pengaduan()
	{
		$usernameN =$this->session->userdata('username');
		//echo $usernameN." dd ".$this->mlogin->cek_username_exist($usernameN);
		if ($usernameN==""){
			redirect("login/index");
		}
		try{
			$crud = new grocery_CRUD();
			$bagian=$this->session->userdata('bagian');
			$crud->set_theme('datatables');
			$crud->set_table('tbl_dumas_pengaduan');
			$crud->set_subject('Dumas Pengaduan');
			$crud->required_fields('nomor_pengaduan');
			$crud->where('apl_status','VER');
			$crud->where('tbl_dumas_pengaduan.kode_bagian',$bagian);
	//combo jenis pengaduan	
		/* $crud->set_relation('kode_jenis_permohonan','tbl_ref_jenis_permohonan','jenis_permohonan');
			$crud->display_as('kode_jenis_permohonan','Jenis Permohonan');
			$crud->set_relation('kode_pos','tbl_ref_lokasi','{kelurahan} - {kecamatan} - {kode_pos}');
			$crud->display_as('kode_pos','Kelurahan - Kecamatan'); */
			//$crud->columns('nomor_pengaduan', 'tanggal_pengaduan', 'nama_lengkap', 'alamat', 'email', 'telepon', 'handphone', 'nama_kuasa', 'alamat_kuasa', 'kode_jenis_permohonan', 'kepada', 'kode_bagian', 'kode_bagian_o', 'kode_seksi', 'nomor_berkas', 'tanggal_berkas', 'status_permohonan', 'alamat_aduan', 'kode_pos', 'uraian_aduan', 'petugas_pelayanan_pengaduan', 'apl_status', 'created', 'last_update');
			//$crud->set_relation('kode_bagian','tbl_ref_bagian','bagian');
			//$crud->display_as('kode_bagian','Bagian');
		//dependence dropdown	
			$crud->callback_column('kode_bagian',array($this,'kode_bagian'));
			$crud->set_relation('kode_bagian', 'tbl_ref_bagian', 'bagian');
			$crud->set_relation('kode_seksi', 'tbl_ref_seksi', 'seksi');
				$this->load->library('gc_dependent_select');
			$fields = array(
						// first field:
						/* 
						'kode_bagian' => array( 
						'table_name' => 'tbl_ref_bagian',
						'id_field' => 'kode_bagian',
						'title' => 'bagian', 
						'relate' => null  */
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

		
			  $crud->callback_before_update(array($this, '_created_callback'));
			$crud->columns('nomor_pengaduan','tanggal_pengaduan','nama_lengkap','telepon');
		//$crud->field_type('kode_bagian','enabled');
		$state = $crud->getState();
		if($state == "edit")
		{
			//$crud->unset_fields('status', 'notification_amount', 'password');
						$crud->edit_fields('kode_bagian','kode_seksi');
		}

			 $crud->unset_delete();
			 $crud->unset_edit();
			 $crud->unset_add();
			 $crud->unset_print();
			 $crud->unset_export();
			//$crud->read_fields('nomor_pengaduan','tanggal_pengaduan','nama_lengkap','telepon','kepada');
//add action
			$crud->add_action('Edit', '', 'Edit','ui-icon-person',array($this,'edit_data'));
			//getKodeBagian();
		//	$crud->field_type('kode_bagian','readonly');
			$output = $crud->render();
	
			$this->_verifikator_main_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

function _created_callback($post_array) {
			$post_array['kode_bagian'] = 	$post_array['kode_bagian_o'] ;
			$post_array['apl_status'] = 	"DIS";
			$post_array['last_update'] = 	date('Y-m-d H:i:s');
			
			return $post_array;
	}
		
function send2KKT($primary_key , $row)
	{
		//return site_url('kirim_kakan').'?nomor_pengaduan='.$row->nomor_pengaduan;
		return site_url('verifikator_main/entri_pengaduan/edit').'/'.$row->nomor_pengaduan;
		
	}
	function edit_data($primary_key , $row)
	{
		
		return site_url('verifikator_main/form_verifikator').'?nomor_pengaduan='.$row->nomor_pengaduan;
	}
	public function form_verifikator(){
		// set validation properties
$level=$this->session->userdata('level');			
        //$this->_set_fields();
		$nomor_pengaduan=$_GET['nomor_pengaduan'];
        $data['title'] = 'Edit data pengaduan';
        $data['message'] = '';
        $data['action'] = site_url('verifikator_main/update_data_pengaduan');
	if($level=="user"){   $data['link_back'] = anchor('main/entri_pengaduan','Kembali ke daftar pengaduan',array('class'=>'back'));};
	if($level=="verifikator"){   $data['link_back'] = anchor('verifikator_main/entri_pengaduan','Kembali ke daftar pengaduan',array('class'=>'back'));};
	if($level=="plt"){   $data['link_back'] = anchor('disposisi_main/entri_pengaduan','Kembali ke daftar pengaduan',array('class'=>'back'));};
		$this->load->model('pengaduan_model');
		        $data['pengaduan_data'] = $this->pengaduan_model->get_by_id($nomor_pengaduan)->row(); 
		
      //load model
		$data['ppp']	= $this->pengaduan_model->getPPP();
		$data['jenis_permohonan']	= $this->pengaduan_model->getJenisPermohonan();
		$data['lokasi']	= $this->pengaduan_model->getLokasi();
		$data['subsi']	= $this->pengaduan_model->getSubsi();
		
		$this->load->view('main/form_verifikator',$data);
	}
	
 function update_data_pengaduan(){
 
        // set common properties
         $data['title'] = 'Tambah data pengaduan';
        $data['message'] = '';
        $data['action'] = site_url('verifikator_main/update_data_pengaduan');
		$level=$this->session->userdata('level');
		
		//if($level=="user"){ 
		$data['link_back'] = "<INPUT TYPE=\"button\" VALUE=\"Back\" onClick=\"window.history.back()\">";
	//	};//anchor('main/entri_pengaduan','Kembali ke daftar pengaduan',array('class'=>'back'));}	
	//	if($level=="verifikator"){ $data['link_back'] = anchor('verifikator_main/entri_pengaduan','Kembali ke daftar pengaduan',array('class'=>'back'));}	
     
         
        // set validation properties
// 		 $this->_set_fields();
       // $this->_set_rules();
         $this->load->helper(array('form', 'url'));

		//$this->load->library('form_validation');
		//$this->form_validation->set_rules('nomor_pengaduan', 'nomor_pengaduan', 'required');
		//$this->form_validation->set_rules('tanggal_pengaduan', 'tanggal_berkas', 'perkiraan_penyelesaian', 'required');
		

		
        // run validation
        // if ($this->form_validation->run() == FALSE){
			$data['message'] = '';
           // $this->load->view('main/main_tambah_data', $data);
       // }else{ 
            // save data
			$this->load->model('pengaduan_model');
			
	
          /*   $pengaduan = array('nomor_pengaduan' => $this->input->post('nomor_pengaduan'),
                            'petugas_pelayanan_pengaduan' => $this->input->post('petugas_pelayanan_pengaduan'),
                            'tanggal_pengaduan' => date("Y-m-d") ); */
						
             $this->pengaduan_model->update_verifikator();
             
            // set form input name="id"
            
             //$this->validation->id = $id; 
             
            // set user message
            $data['message'] = 'Edit new person success';
			
		//	}
			// $this->form_validation->nomor_pengaduan =  $this->input->post('nomor_pengaduan');
            // $this->form_validation->petugas_pelayanan_pengaduan =  $this->input->post('petugas_pelayanan_pengaduan');
			//$this->load->view('main/entri_pengaduan');
			echo "<INPUT TYPE=\"button\" VALUE=\"Back\" onClick=\"window.history.back()\">";
				/*if($level=="user"){ echo anchor('main/entri_pengaduan','Kembali ke daftar pengaduan',array('class'=>'back'));}	
				if($level=="verifikator"){ echo anchor('verifikator_main/entri_pengaduan','Kembali ke daftar pengaduan',array('class'=>'back'));}	
				if($level=="plt"){ echo anchor('disposisi_main/entri_pengaduan','Kembali ke daftar pengaduan',array('class'=>'back'));}	*/
			
        }	
	/*
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

			$this->_verifikator_main_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

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

			$this->_verifikator_main_output($output);
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

			$this->_verifikator_main_output($output);
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

			$this->_verifikator_main_output($output);
	}

	public function products_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('products');
			$crud->set_subject('Product');
			$crud->unset_columns('productDescription');
			$crud->callback_column('buyPrice',array($this,'valueToEuro'));

			$output = $crud->render();

			$this->_verifikator_main_output($output);
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

		$this->_verifikator_main_output($output);
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
			$this->_verifikator_main_output($output);

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

		$this->_verifikator_main_output((object)array(
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
			$this->_verifikator_main_output($output);
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
			$this->_verifikator_main_output($output);
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
			$this->_verifikator_main_output($output);
		} else {
			return $output;
		}
	} */
}