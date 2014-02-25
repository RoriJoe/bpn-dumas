<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master extends CI_Controller {
    private $title;
    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->helper('url');

        $this->load->library('grocery_CRUD');
    }

    public function _master_output($output = null) {
        $this->load->view('master.php', $output);
    }

    /*
      public function offices()
      {
      $output = $this->grocery_crud->render();

      $this->_master_output($output);
      }
     */

    public function index() {
        $this->_master_output((object) array('output' => '', 'js_files' => array(), 'css_files' => array()));
    }

    public function entri_jenis_permohonan() {
        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('tbl_ref_jenis_permohonan');
            $crud->set_subject('Master Jenis Permohonan');
            $crud->required_fields('kode_jenis_permohonan');

            $crud->columns('kode_jenis_permohonan', 'jenis_permohonan');
            $crud->edit_fields('jenis_permohonan');
            $crud->add_fields('jenis_permohonan');
//add action
            //$crud->add_action('Verifikasi', '', 'Verifikasi','ui-icon-person',array($this,'send2ver'));

            $output = $crud->render();
            $output->title = 'Ref Jenis Permohonan';
            $this->_master_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function entri_type_pengaduan() {
        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('tbl_ref_type_pengaduan');
            $crud->set_subject('Master Type Pengaduan');
            $crud->required_fields('kode_type_pengaduan');

            $crud->columns('kode_type_pengaduan', 'type_pengaduan');
            $crud->edit_fields('type_pengaduan');
            $crud->add_fields('type_pengaduan');
//add action
            //$crud->add_action('Verifikasi', '', 'Verifikasi','ui-icon-person',array($this,'send2ver'));

            $output = $crud->render();
            $output->title = 'Ref Tipe Pengaduan';
            $this->_master_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function entri_bagian() {
        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('tbl_ref_bagian');
            $crud->set_subject('Master Referensi Bagian');
            $crud->required_fields('kode_bagian');

            $crud->columns('kode_bagian', 'bagian');
            $crud->edit_fields('bagian');
            $crud->add_fields('bagian');
//add action
            //$crud->add_action('Verifikasi', '', 'Verifikasi','ui-icon-person',array($this,'send2ver'));
            
            $output = $crud->render();
            $output->title = 'Ref Bagian';
            $this->_master_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function entri_seksi() {
        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('tbl_ref_seksi');
            $crud->set_subject('Master Referensi Seksi');
            $crud->required_fields('kode_seksi');
            $crud->set_relation('kode_bagian', 'tbl_ref_bagian', 'bagian');
            $crud->display_as('kode_bagian', 'Bagian');
            $crud->columns('kode_seksi', 'seksi', 'kode_bagian');
            $crud->edit_fields('kode_bagian', 'seksi');
            $crud->add_fields('kode_bagian', 'seksi');
//add action
            //$crud->add_action('Verifikasi', '', 'Verifikasi','ui-icon-person',array($this,'send2ver'));

            $output = $crud->render();
            $output->title = 'Ref Seksi';
            
            $this->_master_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function entri_ref_lokasi() {
        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('tbl_ref_lokasi');
            $crud->set_subject('Master Lokasi');
            $crud->required_fields('nomor_lokasi');

            $crud->columns('kode_pos', 'kelurahan', 'kecamatan', 'kab_kota', 'provinsi');
            $crud->edit_fields('kode_pos', 'kelurahan', 'kecamatan', 'kab_kota', 'provinsi');
            $crud->edit_fields('kode_pos', 'kelurahan', 'kecamatan', 'kab_kota', 'provinsi');
//add action
            //$crud->add_action('Verifikasi', '', 'Verifikasi','ui-icon-person',array($this,'send2ver'));

            $output = $crud->render();
            $output->title = 'Ref Lokasi';
            $this->_master_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function entri_user() {
        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('member');
            $crud->set_subject('Master User');
            $crud->required_fields('nama');
            $crud->required_fields('user');
            $crud->required_fields('pass');

            $crud->set_relation('kode_bagian', 'tbl_ref_bagian', 'bagian');
            $crud->display_as('kode_bagian', 'Bagian');

            $crud->set_relation('kode_seksi', 'tbl_ref_seksi', 'seksi');
            $crud->display_as('kode_seksi', 'Seksi');

            $crud->set_relation('levelid', 'levelid', 'levelname');
            $crud->display_as('levelid', 'Level');
            $crud->callback_before_update(array($this, '_created_callback'));
            $crud->columns('nama', 'user', 'pass', 'kode_seksi', 'kode_bagian');
            $crud->edit_fields('nama', 'user', 'pass', 'levelid', 'kode_seksi', 'kode_bagian');
            $crud->add_fields('nama', 'user', 'pass', 'levelid', 'kode_seksi', 'kode_bagian');
//add action
            //$crud->add_action('Verifikasi', '', 'Verifikasi','ui-icon-person',array($this,'send2ver'));
            
            $output = $crud->render();
            $output->title = 'Ref User';
            $this->_master_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function _created_callback($post_array) {
        $level = "";
        if ($post_array['levelid'] == 1) {
            $level = "user";
        };
        if ($post_array['levelid'] == 1) {
            $level = "verifikator";
        };
        if ($post_array['levelid'] == 1) {
            $level = "kakan";
        };
        if ($post_array['levelid'] == 1) {
            $level = "plt";
        };
        if ($post_array['levelid'] == 1) {
            $level = "admin";
        };
        $post_array['level'] = $level;
        return $post_array;
    }

    public function entri_level() {
        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('tbl_ref_lokasi');
            $crud->set_subject('Master Lokasi');
            $crud->required_fields('nomor_lokasi');

            $crud->columns('kode_pos', 'kelurahan', 'kecamatan', 'kab_kota', 'provinsi');
            $crud->edit_fields('kode_pos', 'kelurahan', 'kecamatan', 'kab_kota', 'provinsi');
            $crud->edit_fields('kode_pos', 'kelurahan', 'kecamatan', 'kab_kota', 'provinsi');
//add action
            //$crud->add_action('Verifikasi', '', 'Verifikasi','ui-icon-person',array($this,'send2ver'));
            $output->title = 'Ref Level';
            $output = $crud->render();

            $this->_master_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }


}