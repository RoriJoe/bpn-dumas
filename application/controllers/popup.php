<?php
class Popup extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

/*		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');*/
	}

	public function popup()
	{
		$this->load->view('popup.php');
	}
/* 
	public function offices()
	{
		$output = $this->grocery_crud->render();

		$this->_main_output($output);
	}
 
	public function index()
	{
		$this->_main_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
		$this->load->model('pengaduan_model');
	}
    
    public    function popup() {
		$this->load->view('popup');
	}
 
class Popup extends Controller {

    function Popup() {
        parent::Controller();
        session_start();
    }

    function popup() {
        $query = $this->db->query("
            SELECT
                    COUNT(*)AS jml
            FROM
                    satker
            ");
        foreach ($query->result() as $row) {
            $row = $row->jml;
        }
        $config['base_url'] = base_url() . 'index.php/user/popup/';
        $config['total_rows'] = $row;
        $config['per_page'] = '15';
        $config['uri_segment'] = 3;
        $config['first_link'] = 'Awal';
        $config['last_link'] = 'Akhir';
        $config['next_link'] = 'Selanjutnya';
        $config['prev_link'] = 'Sebelumnya';
        $this->pagination->initialize($config);
        $data['satker'] = $this->MSatker->getAllSatkerPagination($config['per_page'], $this->uri->segment(3));

        $atts = array(
            'width' => '800',
            'height' => '600',
            'scrollbars' => 'yes',
            'status' => 'yes',
            'resizable' => 'yes',
            'screenx' => '0',
            'screeny' => '0'
        );

        $data['title'] = "Satuan Kerja";
        $data['main'] = 'satker/satker';
        $this->load->vars($data);
        $this->load->view('satker/popup');
    }

    function pencarian() {
        if (isset($_POST['submit'])) {
            $data['inst_nama'] = $this->input->post('inst_nama');
            $this->session->set_userdata('sess_inst_nama', $data['inst_nama']);
        } else {
            $data['inst_nama'] = $this->session->userdata('sess_inst_nama');
        }
        $this->db->like('inst_nama', $data['inst_nama']);
        $this->db->from('satker');

        $pagination['base_url'] = base_url() . 'index.php/user/pencarian/';
        $pagination['total_rows'] = $this->db->count_all_results();
        $pagination['full_tag_open'] = "<p><div class=\"pagination\">";
        $pagination['full_tag_close'] = "</div></p>";
        $pagination['cur_tag_open'] = "<span class=\"current\">";
        $pagination['cur_tag_close'] = "</span>";
        $pagination['num_tag_open'] = "<span class=\"disabled\">";
        $pagination['num_tag_close'] = "</span>";
        $pagination['first_link'] = 'Awal';
        $pagination['last_link'] = 'Akhir';
        $pagination['next_link'] = 'Selanjutnya';
        $pagination['prev_link'] = 'Sebelumnya';
        $pagination['per_page'] = '15';
        $pagination['uri_segment'] = 3;
        $pagination['num_links'] = 4;
        $this->pagination->initialize($pagination);
        $data['ListSatker'] = $this->MSatker->SearchResult($pagination['per_page'], $this->uri->segment(3, 0), $data['inst_nama']);

        $data['title'] = "Pencarian Satuan Kerja";
        $data['main'] = 'satker/pencarian';
        $this->load->vars($data);
        $this->load->view('satker/popup');
    }
 */
}
?>