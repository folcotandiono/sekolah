<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Murid extends Rest_Controller {

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
			$this->load->helper('date');
    }
	public function index()
	{
		$data = array(
	    "sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true)
		);
		$this->load->view('index', $data);
	}
	public function waktu_get()
	{
		$message = array("waktu" => time());

        $this->response($message, 200);
	}
    public function login_post()
    {
        $id = $this->post("id");
        $password = $this->post("password");

        $this->db->select('*');
        $this->db->from('murid');
        $this->db->where('id', $id);
        $this->db->where('password', $password);
        $result = $this->db->get()->result();

        $message = array("list_murid" => $result);

        $this->response($message, 200);
	}
	public function data_jadwal_ujian_get()
    {
		$id = $this->get("id");

        $this->db->select('jadwal_ujian.id, jadwal_ujian.nama, jadwal_ujian.id_soal_ujian, soal_ujian.nama as nama_soal_ujian, jadwal_ujian.tanggal, jadwal_ujian.durasi');
        $this->db->from('jadwal_ujian');
		$this->db->join('soal_ujian', 'jadwal_ujian.id_soal_ujian = soal_ujian.id');
		$this->db->join('mata_pelajaran', 'soal_ujian.id_mata_pelajaran = mata_pelajaran.id');
		$this->db->join('murid', 'mata_pelajaran.id_kelas = murid.id_kelas');
		$this->db->where('murid.id', $id);
        $result = $this->db->get()->result();

        $message = array("list_jadwal_ujian"=> $result);

        $this->response($message, 200);
	}
	
	public function data_soal_ujian_detail_by_id_soal_ujian_get()
	{
		$id_soal_ujian = $this->get("id_soal_ujian");

		$this->db->select('soal_ujian_detail.id, soal_ujian_detail.id_soal_ujian, soal_ujian_detail.id_jenis_soal_ujian_detail, soal_ujian_detail.soal_tulisan, soal_ujian_detail.soal_gambar, soal_ujian_detail.pilihan_jawaban_tulisan, soal_ujian_detail.pilihan_jawaban_gambar, soal_ujian_detail.kunci_jawaban');
        $this->db->from('soal_ujian_detail');
		$this->db->where('soal_ujian_detail.id_soal_ujian', $id_soal_ujian);
		$result = $this->db->get()->result();

		$message = array("list_soal_ujian_detail"=> $result);

        $this->response($message, 200);
	}

	public function tambah_jawaban_soal_ujian_detail_post()
	{
		$jawaban_soal_ujian_detail['id_soal_ujian_detail'] = $this->post("id_soal_ujian_detail");
		$jawaban_soal_ujian_detail['id_murid'] = $this->post("id_murid");
		$jawaban_soal_ujian_detail['id_jadwal_ujian'] = $this->post('id_jadwal_ujian');
		$jawaban_soal_ujian_detail['jawaban_tulisan'] = $this->post('jawaban_tulisan');

		print_r($jawaban_soal_ujian_detail);

		$this->db->insert('jawaban_soal_ujian_detail', $jawaban_soal_ujian_detail);

        $message = array("list_jawaban_soal_ujian_detail"=> $jawaban_soal_ujian_detail);

        $this->response($message, 200);
	}

	public function sudah_ujian_get()
	{
		$id_soal_ujian = $this->get("id_soal_ujian");
		$id_murid = $this->get("id_murid");
		$id_jadwal_ujian = $this->get("id_jadwal_ujian");

		$this->db->select('*');
		$this->db->from('soal_ujian');
		$this->db->join('soal_ujian_detail', 'soal_ujian.id = soal_ujian_detail.id_soal_ujian');
		$this->db->join('jawaban_soal_ujian_detail', 'soal_ujian_detail.id = jawaban_soal_ujian_detail.id_soal_ujian_detail');
		$this->db->where('soal_ujian.id', $id_soal_ujian);
		$this->db->where('jawaban_soal_ujian_detail.id_murid', $id_murid);
		$this->db->where('jawaban_soal_ujian_detail.id_jadwal_ujian', $id_jadwal_ujian);
		$result = $this->db->get()->result();

		$message = array("banyak" => count($result));

		$this->response($message, 200);
	}
}
