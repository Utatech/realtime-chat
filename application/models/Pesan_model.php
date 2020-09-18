<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan_model extends CI_Model{

    function panggil_nama(){
        $query = $this->db->get('pesan');
        return $query;
    }

    function insert($nama,$pesan){
        $data = array(
            'nama' => $nama,
            'pesan' => $pesan
        );
        $this->db->insert('pesan', $data);
    }
}