<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class pembeli extends REST_Controller {
	
	function __construct($config = 'rest') {
		parent::__Construct($config);
	}
	
	//Menampilkan data
	public function index_get() {
		
		$id = $this->get('id');
		if ($id == '') {
			$data = $this->db->get('pembeli')->result();
		} else {
			$this->db->where('id_pembeli', $id);
			$data = $this->db->get('pembeli')->result();
		}
		$result = ["took"=>$_SERVER["REQUEST_TIME_FLOAT"],
				   "code"=>200,
				   "message"=>"Response successfully",
				   "data"=>$data];
		$this->response($result, 200);
	    }


   //Menambah data 
   public function index_post() {
    $data = array(
        'id_pembeli'  => $this->post('id_pembeli'),
        'nama_pembeli' => $this->post('nama_pembeli'),
        'jk' => $this->post('jk'),
        'no_telp' => $this->post('no_telp'),
        'alamat' => $this->post('alamat'));
    $insert = $this->db->insert('pembeli', $data);
    if ($insert) {
        //$this->response($data, 200);
        $result = ["took"=>$_SERVER["REQUEST_TIME_FLOAT"],
            "Code"=>201,
            "message"=>"Data has successfully added",
            "data"=>$data];
        $this->response($result, 201);
    } else {
        $result = ["took"=>$_SERVER["REQUEST_TIME_FLOAT"],
            "code"=>502,
            "message"=>"Failed adding data",
            "data"=>null];
        $this->response($result, 502);  
        }
    }

     //Memperbarui data yang telah ada
     public function index_put() {
        $id = $this->put('id');
        $data = array (
            'id_pembeli'  => $this->put('id_pembeli'),
            'nama_pembeli' => $this->put('nama_pembeli'),
            'jk' => $this->put('jk'),
            'no_telp' => $this->put('no_telp'),
            'alamat' => $this->put('alamat'));
        $this->db->where('id_pembeli', $id);
        $update = $this->db->update('pembeli', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
     }

    //Menghapus data pembeli
    public function index_delete() {
        $id = $this->delete('id'); // ini yang ditulis pada key di postman ya...., bukan customerID
        $this->db->where('id_pembeli', $id);
        $delete = $this->db->delete('pembeli');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
  
}
?>