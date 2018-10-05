<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_guest_book extends CI_Model {  

  var $nama_tabel = 'guest_book';
  var $daftar_field = array('id', 'nama', 'email', 'alamat', 'notes');
  var $primary_key = 'id';

	  
  public function __construct(){
        parent::__construct();
  }
  public function fetch_all(){   
		   $getdata = $this->db->get($this->nama_tabel)->result();
		   $data = array();  
		   $no = 1;
           foreach($getdata as $row)  
           {        
                $sub_array = array();  
                $sub_array[] = $no;
                $sub_array[] = $row->nama;  
                $sub_array[] = $row->email;
                $sub_array[] = $row->alamat; 
			          $sub_array[] = $row->notes; 
			          $sub_array[] = '&nbsp; <a href="javascript:void(0)" id="delete" class="btn btn-warning btn-xs waves-effect" onclick="Ubah_Data('.$row->id.');" > <i class="material-icons">build</i> Ubah </a>
								&nbsp; <a href="javascript:void(0)" id="delete" class="btn btn-danger btn-xs waves-effect" onclick="Hapus_Data('.$row->id.');" > <i class="material-icons">delete</i> Hapus </a>';  
               
                $data[] = $sub_array;  
                 $no++;
           }  
          
		   return $output = array("data"=>$data);
		    
    }

  
  
	 
 
}
