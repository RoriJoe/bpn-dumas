<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->helper('url');

        $this->load->library('grocery_CRUD');
    }

    public function _main_output($output = null) {
        $this->load->view('main.php', $output);
    }

    public function index() {
        $this->_main_output((object) array('output' => '', 'js_files' => array(), 'css_files' => array()));
        $this->load->model('pengaduan_model');
    }

    public function entri_pengaduan() {
        $username = $this->session->userdata('username');

        if ($username == "") {
            redirect("login/index");
        }
        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('tbl_dumas_pengaduan');
            $crud->set_subject('Dumas Pengaduan');
            $crud->required_fields('nomor_pengaduan');
            $crud->where('apl_status', 'REG');
            //$crud->or_where('apl_status','RES');

            $crud->callback_before_insert(array($this, '_created_callback'));
            $crud->callback_before_update(array($this, '_created_callback'));

            //combo jenis pengaduan	
            /* 			$crud->set_relation('jenis_permohonan','tbl_ref_jenis_permohonan','jenis_permohonan');
              $crud->display_as('jenis_permohonan','Jenis Permohonan');
              $crud->set_relation('kode_pos','tbl_ref_lokasi','{kelurahan} - {kecamatan} - {kode_pos}');
              $crud->display_as('kode_pos','Kelurahan - Kecamatan'); */


            $crud->columns('nomor_pengaduan', 'tanggal_pengaduan', 'nama_lengkap', 'bagian', 'telepon');
            //	$crud->field_type('nomor_pengaduan', 'readonly', 1);
            $crud->edit_fields('tanggal_pengaduan', 'nama_lengkap', 'alamat', 'email', 'telepon', 'handphone', 'jenis_permohonan', 'bagian', 'nomor_berkas', 'tanggal_berkas', 'alamat_aduan', 'kode_pos', 'uraian_aduan', 'created', 'last_update');
            $crud->add_fields('tanggal_pengaduan', 'nama_lengkap', 'alamat', 'email', 'telepon', 'handphone', 'jenis_permohonan', 'bagian', 'nomor_berkas', 'tanggal_berkas', 'alamat_aduan', 'kode_pos', 'uraian_aduan', 'created', 'last_update');
//add action
            $crud->add_action('Verifikasi', '', 'Verifikasi', 'ui-icon-person', array($this, 'send2ver'));
            $crud->add_action('Edit', '', 'Edit', 'ui-icon-person', array($this, 'edit_data'));
            $crud->unset_edit();
            $crud->unset_read();
            $crud->unset_add();
            $crud->unset_print();
            $crud->unset_export();
            $output = $crud->render();

            $this->_main_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function _created_callback($post_array) {
        $post_array['kode_bagian_o'] = $post_array['kode_bagian'];
        $post_array['created'] = date('Y-m-d H:i:s');
        $post_array['last_update'] = date('Y-m-d H:i:s');
        return $post_array;
    }

    function send2ver($primary_key, $row) {
        return site_url('kirim_verifikasi') . '?nomor_pengaduan=' . $row->nomor_pengaduan . '&bagian=' . $row->bagian;
    }

    function tambah_data($primary_key, $row) {
        return site_url('main/tambah_data_pengaduan');
    }

    function edit_data($primary_key, $row) {
        return site_url('main/edit_data_pengaduan') . '?nomor_pengaduan=' . $row->nomor_pengaduan;
    }

    function edit_data_pengaduan() {
        // set validation properties
        $level = $this->session->userdata('level');
        $this->_set_fields();
        $nomor_pengaduan = $_GET['nomor_pengaduan'];
        $data['title'] = 'Edit data pengaduan';
        $data['message'] = '';
        $data['action'] = site_url('main/update_data_pengaduan');
        if ($level == "user") {
            $data['link_back'] = anchor('main/entri_pengaduan', 'Kembali ke daftar pengaduan', array('class' => 'back'));
        };
        if ($level == "verifikator") {
            $data['link_back'] = anchor('verifikator_main/entri_pengaduan', 'Kembali ke daftar pengaduan', array('class' => 'back'));
        };
        if ($level == "plt") {
            $data['link_back'] = anchor('disposisi_main/entri_pengaduan', 'Kembali ke daftar pengaduan', array('class' => 'back'));
        };
        $this->load->model('pengaduan_model');
        $data['pengaduan_data'] = $this->pengaduan_model->get_by_id($nomor_pengaduan)->row();

        //load model
        $data['ppp'] = $this->pengaduan_model->getPPP();
        $data['jenis_permohonan'] = $this->pengaduan_model->getJenisPermohonan();
        $data['lokasi'] = $this->pengaduan_model->getLokasi();
        $data['disposisi'] = $this->pengaduan_model->getDisposisi();

        // load view
        $this->load->view('main/main_edit_data', $data);
    }

    function tambah_data_pengaduan() {
        // set validation properties
        $this->_set_fields();
        //die($row->nomor_pengaduan);
        // set common properties
        $data['title'] = 'Tambah data pengaduan';
        $data['message'] = '';
        $data['action'] = site_url('main/simpan_data_pengaduan');
        $data['link_back'] = anchor('main/entri_pengaduan', 'Kembali ke daftar pengaduan', array('class' => 'back'));
        //load model
        $this->load->model('pengaduan_model');
        $data['ppp'] = $this->pengaduan_model->getPPP();
        $data['jenis_permohonan'] = $this->pengaduan_model->getJenisPermohonan();
        $data['lokasi'] = $this->pengaduan_model->getLokasi();
        $data['disposisi'] = $this->pengaduan_model->getDisposisi();

        // load view
        $this->load->view('main/main_tambah_data', $data);
    }

    // validation fields
    function _set_fields() {
        $fields['id'] = 'id';
        $fields['name'] = 'name';
        $fields['gender'] = 'gender';
        $fields['dob'] = 'dob';
        $this->form_validation->set_rules($fields);
        //$this->validation->set_fields($fields);
    }

    function simpan_data_pengaduan() {
        // set common properties
        $data['title'] = 'Tambah data pengaduan';
        $data['message'] = '';
        $data['action'] = site_url('main/simpan_data_pengaduan');
        $data['link_back'] = anchor('main/entri_pengaduan', 'Kembali ke daftar pengaduan', array('class' => 'back'));


        // set validation properties
        //$this->_set_fields();
        // $this->_set_rules();
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->form_validation->set_rules('nomor_pengaduan', 'Nomor Pengaduan', 'callback_required_field');
        $this->form_validation->set_rules('tanggal_pengaduan', 'Tanggal Pengaduan', 'callback_required_field|callback_validate_date');
        $this->form_validation->set_rules('tanggal_berkas', 'Tanggal Berkas', 'callback_required_field|callback_validate_date');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'callback_required_field');
        $this->form_validation->set_rules('jenis_permohonan', 'Jenis Permohonan', 'callback_required_field');
        $this->form_validation->set_rules('telepon', 'Telepon', 'callback_required_field');
        $this->form_validation->set_rules('handphone', 'Handphone', 'callback_required_field');
        $this->form_validation->set_rules('petugas_pelayanan_pengaduan', 'Petugas', 'callback_required_field');
        $this->form_validation->set_rules('bagian', 'Bagian', 'callback_required_field');
        $this->form_validation->set_rules('nomor_identitas', 'No. Identitas', 'callback_required_field');
        $this->form_validation->set_rules('nomor_berkas', 'No. Berkas', 'callback_required_field');
        
        $data['action'] = site_url('main/simpan_data_pengaduan');
        $data['link_back'] = anchor('main/entri_pengaduan', 'Kembali ke daftar pengaduan', array('class' => 'back'));
        //load model
        $this->load->model('pengaduan_model');
        $data['ppp'] = $this->pengaduan_model->getPPP();
        $data['jenis_permohonan'] = $this->pengaduan_model->getJenisPermohonan();
        $data['lokasi'] = $this->pengaduan_model->getLokasi();
        $data['disposisi'] = $this->pengaduan_model->getDisposisi();
        
        if ($this->form_validation->run() == FALSE) {
            $data['message'] = 'Terjadi kesalahan pada saat input data!';
            $data['title'] = 'Tambah data pengaduan';
            $this->load->view('main/main_tambah_data', $data);
        } else {
            // save data
            $this->load->model('pengaduan_model');


            /*   $pengaduan = array('nomor_pengaduan' => $this->input->post('nomor_pengaduan'),
              'petugas_pelayanan_pengaduan' => $this->input->post('petugas_pelayanan_pengaduan'),
              'tanggal_pengaduan' => date("Y-m-d") ); */
            $this->pengaduan_model->save();

            // set form input name="id"
            //$this->validation->id = $id; 
            // set user message
            $data['message'] = '';
        }
        $this->form_validation->nomor_pengaduan = $this->input->post('nomor_pengaduan');
        $this->form_validation->petugas_pelayanan_pengaduan = $this->input->post('petugas_pelayanan_pengaduan');
        $data['link_back'] = "<INPUT TYPE=\"button\" VALUE=\"Back\" onClick=\"window.history.back()\">";
        //		echo "Data tersimpan...<br/>";
//			echo "<INPUT TYPE=\"button\" VALUE=\"Back\" onClick=\"goto_main()\">";
        //$this->load->view('main/tambah_data_pengaduan');
        //$nomor_pengaduan=$nomor_pengaduan;
    }

    function update_data_pengaduan() {
        // set common properties
        $data['title'] = 'Update data pengaduan';
        $data['message'] = '';
        $data['action'] = site_url('main/update_data_pengaduan');
        $level = $this->session->userdata('level');
        //if($level=="user"){ 
        $data['link_back'] = "<INPUT TYPE=\"button\" VALUE=\"Back\" onClick=\"window.history.back()\">";
        //	};//anchor('main/entri_pengaduan','Kembali ke daftar pengaduan',array('class'=>'back'));}	
        //	if($level=="verifikator"){ $data['link_back'] = anchor('verifikator_main/entri_pengaduan','Kembali ke daftar pengaduan',array('class'=>'back'));}	
        
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->form_validation->set_rules('nomor_pengaduan', 'Nomor Pengaduan', 'callback_required_field');
        $this->form_validation->set_rules('tanggal_pengaduan', 'Tanggal Pengaduan', 'callback_required_field|callback_validate_date');
        $this->form_validation->set_rules('tanggal_berkas', 'Tanggal Berkas', 'callback_required_field|callback_validate_date');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'callback_required_field');
        $this->form_validation->set_rules('jenis_permohonan', 'Jenis Permohonan', 'callback_required_field');
        $this->form_validation->set_rules('telepon', 'Telepon', 'callback_required_field');
        $this->form_validation->set_rules('handphone', 'Handphone', 'callback_required_field');
        $this->form_validation->set_rules('petugas_pelayanan_pengaduan', 'Petugas', 'callback_required_field');
        $this->form_validation->set_rules('bagian', 'Bagian', 'callback_required_field');
        $this->form_validation->set_rules('nomor_identitas', 'No. Identitas', 'callback_required_field');
        $this->form_validation->set_rules('nomor_berkas', 'No. Berkas', 'callback_required_field');
        
        //load model
        $this->load->model('pengaduan_model');
        $data['ppp'] = $this->pengaduan_model->getPPP();
        $data['jenis_permohonan'] = $this->pengaduan_model->getJenisPermohonan();
        $data['lokasi'] = $this->pengaduan_model->getLokasi();
        $data['disposisi'] = $this->pengaduan_model->getDisposisi();
        
        // run validation
        if ($this->form_validation->run() == FALSE) {
            $data['message'] = 'Terjadi kesalahan pada saat input data!';
            $data['title'] = 'Update data pengaduan';
            $this->load->view('main/main_edit_data', $data);
        } else {
            // save data
            $this->load->model('pengaduan_model');


            /*   $pengaduan = array('nomor_pengaduan' => $this->input->post('nomor_pengaduan'),
              'petugas_pelayanan_pengaduan' => $this->input->post('petugas_pelayanan_pengaduan'),
              'tanggal_pengaduan' => date("Y-m-d") ); */
            $this->pengaduan_model->update();

            // set form input name="id"
            //$this->validation->id = $id; 
            // set user message
            $data['message'] = '';
        }
        // $this->form_validation->nomor_pengaduan =  $this->input->post('nomor_pengaduan');
        // $this->form_validation->petugas_pelayanan_pengaduan =  $this->input->post('petugas_pelayanan_pengaduan');
        //$this->load->view('main/entri_pengaduan');
        echo "<INPUT TYPE=\"button\" VALUE=\"Back\" onClick=\"window.history.back()\">";
        /* if($level=="user"){ echo anchor('main/entri_pengaduan','Kembali ke daftar pengaduan',array('class'=>'back'));}	
          if($level=="verifikator"){ echo anchor('verifikator_main/entri_pengaduan','Kembali ke daftar pengaduan',array('class'=>'back'));}
          if($level=="plt"){ echo anchor('disposisi_main/entri_pengaduan','Kembali ke daftar pengaduan',array('class'=>'back'));} */
    }

    function update_res() {
        $this->load->helper(array('form', 'url'));
        $this->load->model('pengaduan_model');
        //$pengaduan = array('nomor_pengaduan' => $this->input->post('nomor_pengaduan'));
        $this->pengaduan_model->update_res();

        // set user message
        $data['message'] = 'kirim data sukses';
    }

    function update_ver() {
        $this->load->helper(array('form', 'url'));
        $this->load->model('pengaduan_model');
        //$pengaduan = array('nomor_pengaduan' => $this->input->post('nomor_pengaduan'));
        $this->pengaduan_model->update_ver();

        // set user message
        $data['message'] = 'kirim data sukses';
    }

    function update_dis() {
        $this->load->helper(array('form', 'url'));
        $this->load->model('pengaduan_model');
        //$pengaduan = array('nomor_pengaduan' => $this->input->post('nomor_pengaduan'));
        $this->pengaduan_model->update_dis();

        // set user message
        $data['message'] = 'kirim data sukses';
    }

    // load view
    public function cetak_pdf() {


        /*
          ---- ---- ---- ----
          your code here
          ---- ---- ---- ----
         */
        /* $this->load->helper('pdf_helper');
          $data['message'] = 'add new person success';
          $this->load->view('pdfreport', $data); */
    }

    /* 	
      public function send2ver($data,$nomor_pengaduan){
      try{
      $this->load->model("grocery_crud_model");
      $this->grocery_crud_model->upddataVer($data,$nomor_pengaduan);

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

      $this->_main_output($output);
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

      $this->_main_output($output);
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

      $this->_main_output($output);
      }

      public function products_management()
      {
      $crud = new grocery_CRUD();

      $crud->set_table('products');
      $crud->set_subject('Product');
      $crud->unset_columns('productDescription');
      $crud->callback_column('buyPrice',array($this,'valueToEuro'));

      $output = $crud->render();

      $this->_main_output($output);
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

      $this->_main_output($output);
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
      $this->_main_output($output);

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

      $this->_main_output((object)array(
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
      $this->_main_output($output);
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
      $this->_main_output($output);
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
      $this->_main_output($output);
      } else {
      return $output;
      }
      } */

    public function validate_date($input) {
        $ddmmyyy='(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)[0-9]{2}';
        if(preg_match("/$ddmmyyy$/", $input)) {
           return TRUE;
        } else {
          $this->form_validation->set_message('validate_date', 'Format %s salah! (mm/dd/yyyy)');
          return FALSE;
        }
    }
    public function required_field($input){
        if(empty($input)){
            $this->form_validation->set_message('required_field', '%s tidak boleh kosong!');
            return false;
        }else{
            return true;
        }
    }

}