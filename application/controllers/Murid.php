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

        $this->db->select('jadwal_ujian.id, jadwal_ujian.nama, jadwal_ujian.id_judul_ujian, judul_ujian.nama as nama_judul_ujian, jadwal_ujian.tanggal, jadwal_ujian.durasi, mata_pelajaran.nama as nama_mata_pelajaran, guru.nama as nama_guru, kelas.nama as nama_kelas');
        $this->db->from('jadwal_ujian');
		$this->db->join('judul_ujian', 'jadwal_ujian.id_judul_ujian = judul_ujian.id');
		$this->db->join('mata_pelajaran', 'judul_ujian.id_mata_pelajaran = mata_pelajaran.id');
		$this->db->join('guru', 'judul_ujian.id_guru = guru.id');
		$this->db->join('kelas', 'judul_ujian.id_kelas = kelas.id');
		$this->db->join('murid', 'mata_pelajaran.id_kelas = murid.id_kelas');
		$this->db->where('murid.id', $id);
        $result = $this->db->get()->result();

        $message = array("list_jadwal_ujian"=> $result);

        $this->response($message, 200);
	}
	
	public function data_soal_ujian_by_id_judul_ujian_get()
	{
		$id_judul_ujian = $this->get("id_judul_ujian");

		$this->db->select('soal_ujian.id, soal_ujian.id_judul_ujian, soal_ujian.id_jenis_soal_ujian, soal_ujian.soal_tulisan, soal_ujian.soal_gambar, soal_ujian.pilihan_jawaban_tulisan, soal_ujian.pilihan_jawaban_gambar, soal_ujian.kunci_jawaban');
        $this->db->from('soal_ujian');
		$this->db->where('soal_ujian.id_judul_ujian', $id_judul_ujian);
		$result = $this->db->get()->result();

		$message = array("list_soal_ujian"=> $result);

        $this->response($message, 200);
	}

	public function tambah_jawaban_soal_ujian_post()
	{
		$jawaban_soal_ujian['id_soal_ujian'] = $this->post("id_soal_ujian");
		$jawaban_soal_ujian['id_murid'] = $this->post("id_murid");
		$jawaban_soal_ujian['id_jadwal_ujian'] = $this->post('id_jadwal_ujian');
		$jawaban_soal_ujian['jawaban_tulisan'] = $this->post('jawaban_tulisan');

		print_r($jawaban_soal_ujian);

		$this->db->insert('jawaban_soal_ujian', $jawaban_soal_ujian);

        $message = array("list_jawaban_soal_ujian"=> $jawaban_soal_ujian);

        $this->response($message, 200);
	}

	public function sudah_ujian_get()
	{
		$id_judul_ujian = $this->get("id_judul_ujian");
		$id_murid = $this->get("id_murid");
		$id_jadwal_ujian = $this->get("id_jadwal_ujian");

		$this->db->select('*');
		$this->db->from('jawaban_soal_ujian');
		$this->db->join('soal_ujian', 'jawaban_soal_ujian.id_soal_ujian = soal_ujian.id');
		$this->db->join('judul_ujian', 'jawaban_soal_ujian.id_judul_ujian = judul_ujian.id');
		$this->db->where('judul_ujian.id', $id_judul_ujian);
		$this->db->where('jawaban_soal_ujian.id_murid', $id_murid);
		$this->db->where('jawaban_soal_ujian.id_jadwal_ujian', $id_jadwal_ujian);
		$result = $this->db->get()->result();

		$message = array("banyak" => count($result));

		$this->response($message, 200);
	}
}
