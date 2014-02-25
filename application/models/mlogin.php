<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Mlogin extends CI_Model{
     
    public function cekdb(){
        $user = $this->input->post('user');
        $pass = md5($this->input->post('pass'));
        //$level = $this->input->post('level');
                     $data['user'] = $this->input->post('user');
        $level = $this->input->post('level');
		
        $this->db->where('user',$user);
        $this->db->where('pass',$pass);
      //  $this->db->where('level',$level);
        $query = $this->db->get('member');
        return $query->result();
    }
    public function getdropdownsup(){
        $dbres = $this->db->get('levelid');
        $ddmenu = array();
        foreach ($dbres->result_array() as $tablerow){
            $ddmenu[0] = '--Choose Mode--';
            $ddmenu[$tablerow['levelname']] = $tablerow['levelname'];
        }
        return $ddmenu;
    }
    public function getsupply($id){
        $data = array();
        $options = array('id' => $id);
        $Q = $this->db->get_where('member',$options,1);
        if($Q->num_rows() > 0){
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }
//update by me
     
    public function cek_kode_bagian(){
        $user = $this->input->post('user');
        $pass = md5($this->input->post('pass'));
        $level = $this->input->post('level');
         
		$this->db->select('kode_bagian');

        $this->db->where('user',$user);
        $this->db->where('pass',$pass);
        $this->db->where('level',$level);

        //$this->db->from('member');
		$query = $this->db->get('member');		
		foreach ($query->result() as $row)
		{
			return $row->kode_bagian;
		}
		
        //return $query->result();
    }	
   
    public function cek_kode_seksi(){
        $user = $this->input->post('user');
        $pass = md5($this->input->post('pass'));
        $level = $this->input->post('level');
         
		$this->db->select('kode_seksi');

        $this->db->where('user',$user);
        $this->db->where('pass',$pass);
        $this->db->where('level',$level);

        //$this->db->from('member');
		$query = $this->db->get('member');		
		foreach ($query->result() as $row)
		{
			return $row->kode_seksi;
		}
		
        //return $query->result();
    }	
   
    public function cek_level(){
        $user = $this->input->post('user');
        $pass = md5($this->input->post('pass'));
         
		$this->db->select('level');

        $this->db->where('user',$user);
        $this->db->where('pass',$pass);

        //$this->db->from('member');
		$query = $this->db->get('member');		
		foreach ($query->result() as $row)
		{
			return $row->level;
		}
		
        //return $query->result();
    }	
    public function cek_username_exist($username){
		$this->db->select('user');

        $this->db->where('user',$username);

        //$this->db->from('member');
		$query = $this->db->get('member');	
		$userN=0;
		foreach ($query->result() as $row)
		{
			$userN=1;
		}
		return $userN;
        //return $query->result();
    }	
	

}
?>