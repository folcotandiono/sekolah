<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Guru extends Rest_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/home
	 *	- or -
	 * 		http://example.com/index.php/home/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/home/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct()
    {
            parent::__construct();

            // load Pagination library
            $this->load->library('pagination');
        $this->load->database();

            // load URL helper
            $this->load->helper('url');
    }
	public function index()
	{
		$data = array(
	    "sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true)
		);
		$this->load->view('index', $data);
	}
    public function login_post()
    {
        $id = $this->post("id");
        $password = $this->post("password");

        $this->db->select('*');
        $this->db->from('guru');
        $this->db->where('id', $id);
        $this->db->where('password', $password);
        $result = $this->db->get()->result();

        $message = array("list_guru" => $result);

        $this->response($message, 200);
    }
    public function data_mata_pelajaran_get()
    {
        $id = $this->post("id");

        $this->db->select('mata_pelajaran.id, mata_pelajaran.nama, mata_pelajaran.id_kelas, kelas.nama as nama_kelas, mata_pelajaran.id_guru, guru.nama as nama_guru');
        $this->db->from('mata_pelajaran');
        $this->db->join('kelas', 'mata_pelajaran.id_kelas = kelas.id');
        $this->db->join('guru', 'mata_pelajaran.id_guru = guru.id');
        $this->db->where('mata_pelajaran.id_guru', $id);
        $result = $this->db->get()->result();

        $message = array("list_mata_pelajaran"=> $result);

        $this->response($message, 200);
    }
}
