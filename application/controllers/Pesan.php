<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Pesan_model','pesan_model');
    }

    function index(){
        $this->load->view('pesan_view');
    }

    function panggil_nama(){
        $data = $this->pesan_model->panggil_nama()->result();
        echo json_encode($data);
    }

    function create(){
        $nama = $this->input->post('nama',TRUE);
        $pesan = $this->input->post('pesan',TRUE);
        $this->pesan_model->insert($nama,$pesan);

		require_once(APPPATH.'views/vendor/autoload.php');
		$options = array(
			'cluster' => 'ap1',
			'useTLS' => true
		);
		$pusher = new Pusher\Pusher(
			'27763f91179d21c27a1f', //ganti dengan App_key pusher Anda
			'6999c8a03b83781e4602', //ganti dengan App_secret pusher Anda
			'1075133', //ganti dengan App_key pusher Anda
			$options
		);

		$data['message'] = 'success';
		$pusher->trigger('my-channel', 'my-event', $data);
    }
}