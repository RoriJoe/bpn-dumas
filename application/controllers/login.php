<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
Class Login extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->model('mlogin');
		
		$this->load->library('grocery_CRUD');
    }
    public function index(){
        $data['optionlist'] = $this->mlogin->getdropdownsup();
        $this->load->view("login",$data);
    }
    public function cekuser(){
        $data['user'] = $this->input->POST('user');
        $data['pass'] = $this->input->POST('pass');
        $data['level'] = $this->input->post('level');
         
        $data['temukkan'] =$this->mlogin->cekdb();
        if($data['temukkan'] == null){
            return "no";
        }else{
            return "yes";
        }
       }
    public function usermasuk(){
        if($this->cekuser()=="yes"){
            $data['user'] = $this->input->post('user');
            $data['pass'] = $this->input->POST('pass');
			$level = $this->mlogin->cek_level(); 
            $bagian = $this->cek_bagian();
            $seksi = $this->cek_seksi();
            $newdata = array('username' => $data['user'],'level' => $level, 'status'=>'ok', 'bagian'=>$bagian, 'seksi'=>$seksi);
            $this->session->set_userdata($newdata);
            //$data['tampil']=$this->mlogin->get_by_id(member)->row();
           
			
            if($level == "user"){
               redirect("main/entri_pengaduan");
            }elseif ($level == "verifikator"){
                redirect("verifikator_main/entri_pengaduan");
            }elseif($level == "kakan"){
                redirect("su_main/entri_pengaduan");
            }elseif($level == "kde"){
                redirect("kode_etik_main/entri_pengaduan");
            }elseif($level == "plt"){
                redirect("disposisi_main/entri_pengaduan");
            }elseif($level == "admin"){
                redirect("master/entri_jenis_permohonan");
            }else{
                echo "error";
            } ; 
			
			
        }else{
            echo "login gagal";
        }
    }
    public function gagallogin(){
        if($this->cekuser()=="no"){
            echo "gagal login";
        }
    }
		
    public function logout(){
        $this->session->sess_destroy();
        redirect("login/index");
        echo "anda telah berhasil logout";
    }
//update by me
	public function cek_bagian(){
		return $this->mlogin->cek_kode_bagian();
	}
	public function cek_seksi(){
		return $this->mlogin->cek_kode_seksi();
	}
	public function cek_user_exist($username){
		return $this->mlogin->cek_username_exist($username);
	}
}