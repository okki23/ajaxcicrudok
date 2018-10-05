<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guest_book extends CI_Controller {
 
 	var $judul = 'TESTING BISNIS INDONESIA';

 	var $nama_tabel = 'guest_book';
  	var $daftar_field = array('id', 'nama', 'email', 'alamat', 'notes');
  	var $primary_key = 'id';

 	public function __construct(){
 		parent::__construct();
 		$this->load->model('m_guest_book');
 	}

 	 public function array_from_post($fields) {
        $data = array();
        foreach ($fields as $field) {
            $data[$field] = $this->input->post($field);
        }
        return $data;
    }


	public function index()
	{
		$data['judul'] = $this->judul;  
		$this->load->view('guest_book',$data);
	}

	public function fetch_data(){
		$data = $this->m_guest_book->fetch_all();
		echo json_encode($data);
	}

	public function get_data_edit(){
		$id = $this->uri->segment(3); 
		$get = $this->db->where($this->primary_key,$id)->get($this->nama_tabel)->row();
		echo json_encode($get,TRUE);
	}
	
  
	public function hapus_data(){
	$id = $this->uri->segment(3);  
    $sqlhapus = $this->db->where('id',$id)->delete($this->nama_tabel);
 
		if($sqlhapus){
			$result = array("response"=>array('message'=>'success'));
		}else{
			$result = array("response"=>array('message'=>'failed'));
		}
		
		echo json_encode($result,TRUE);
	}
	
 
	public function simpan_data(){
    
    
    $data_form = $this->array_from_post($this->daftar_field);

    $id = isset($data_form['id']) ? $data_form['id'] : NULL; 


 		if($id === NULL || $id == '') { 
            $this->db->set($data_form);
            $save = $this->db->insert($this->nama_tabel);
           
        } else { 
            $this->db->set($data_form);
            $this->db->where($this->primary_key, $id);
            $save = $this->db->update($this->nama_tabel); 
        }

       if($save){
			$result = array("response"=>array('message'=>'success'));
		}else{
			$result = array("response"=>array('message'=>'failed'));
		}
		
		echo json_encode($result,TRUE); 

	}
	


}
