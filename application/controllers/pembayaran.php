<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class pembayaran extends REST_Controller {
	
	function __construct($config = 'rest') {
		parent::__Construct($config);
	}
	
	//Menampilkan data
	public function index_get() {
		
		$id = $this->get('id');
		if ($id == '') {
			$data = $this->db->get('pembayaran')->result();
		} else {
			$this->db->where('id_pembayaran', $id);
			$data = $this->db->get('pembayaran')->result();
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
        'id_pembayaran'  => $this->post('id_pembayaran'),
        'tgl_bayar' => $this->post('tgl_bayar'),
        'total_bayar' => $this->post('total_bayar'),
        'id_transaksi' => $this->post('id_transaksi'));
    $insert = $this->db->insert('pembayaran', $data);
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
            'id_pembayaran'  => $this->put('id_pembayaran'),
            'tgl_bayar' => $this->put('tgl_bayar'),
            'total_bayar' => $this->put('total_bayar'),
            'id_transaksi' => $this->put('id_transaksi'));
        $this->db->where('id_pembayaran', $id);
        $update = $this->db->update('pembayaran', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
     }

    //Menghapus data pembayaran
    public function index_delete() {
        $id = $this->delete('id'); // ini yang ditulis pada key di postman ya...., bukan customerID
        $this->db->where('id_pembayaran', $id);
        $delete = $this->db->delete('pembayaran');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
  
}
?>