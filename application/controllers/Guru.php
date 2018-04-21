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
        $id = $this->get("id");

        $this->db->select('mata_pelajaran.id, mata_pelajaran.nama, mata_pelajaran.id_kelas, kelas.nama as nama_kelas, mata_pelajaran.id_guru, guru.nama as nama_guru');
        $this->db->from('mata_pelajaran');
        $this->db->join('kelas', 'mata_pelajaran.id_kelas = kelas.id');
        $this->db->join('guru', 'mata_pelajaran.id_guru = guru.id');
        $this->db->where('mata_pelajaran.id_guru', $id);
        $result = $this->db->get()->result();

        $message = array("list_mata_pelajaran"=> $result);

        $this->response($message, 200);
    }
    public function data_soal_ujian_get()
    {
        $id = $this->get("id");

        $this->db->select('soal_ujian.id, soal_ujian.nama, soal_ujian.id_mata_pelajaran, mata_pelajaran.nama as nama_mata_pelajaran, soal_ujian.id_guru, guru.nama as nama_guru');
        $this->db->from('soal_ujian');
        $this->db->join('mata_pelajaran', 'soal_ujian.id_mata_pelajaran = mata_pelajaran.id');
        $this->db->join('guru', 'soal_ujian.id_guru = guru.id');
        $this->db->where('soal_ujian.id_guru', $id);
        $result = $this->db->get()->result();

        $message = array("list_soal_ujian"=> $result);

        $this->response($message, 200);
    }
    public function data_soal_ujian_detail_get()
    {
        $id = $this->get("id");

        $this->db->select('soal_ujian_detail.id, soal_ujian_detail.id_soal_ujian, soal_ujian.nama as nama_soal_ujian, soal_ujian_detail.id_jenis_soal_ujian_detail, jenis_soal_ujian_detail.nama as nama_jenis_soal_ujian_detail, soal_ujian_detail.soal_tulisan, soal_ujian_detail.soal_gambar, soal_ujian_detail.pilihan_jawaban_tulisan, soal_ujian_detail.pilihan_jawaban_gambar, soal_ujian_detail.kunci_jawaban');
        $this->db->from('soal_ujian_detail');
        $this->db->join('soal_ujian', 'soal_ujian_detail.id_soal_ujian = soal_ujian.id');
        $this->db->join('jenis_soal_ujian_detail', 'soal_ujian_detail.id_jenis_soal_ujian_detail = jenis_soal_ujian_detail.id');
        $this->db->where('soal_ujian.id_guru', $id);
        $result = $this->db->get()->result();

        $message = array("list_soal_ujian_detail"=> $result);

        $this->response($message, 200);
    }
    public function tambah_soal_ujian_post()
    {
        $soal_ujian["id_mata_pelajaran"] = $this->post("id_mata_pelajaran");
        $soal_ujian["id_guru"] = $this->post("id_guru");
        $soal_ujian["nama"] = $this->post("nama");
        
        $this->db->insert('soal_ujian', $soal_ujian);

        $message = array("list_soal_ujian", $soal_ujian);

        $this->response($message, 200);
    }
    public function tambah_soal_ujian_detail_post()
    {
        $soal_ujian_detail["id_soal_ujian"] = $this->post("id_soal_ujian");
        $soal_ujian_detail["id_jenis_soal_ujian_detail"] = $this->post("id_jenis_soal_ujian_detail");
        $soal_ujian_detail["soal_tulisan"] = $this->post("soal_tulisan");

        $soal_ujian_detail["soal_gambar"] = $this->post("soal_gambar");
		$filesCount = count($soal_ujian_detail["soal_gambar"]);
		for($i = 0; $i < $filesCount; $i++){
            $soal_ujian_detail["soal_gambar"][$i] = base64_decode($soal_ujian_detail["soal_gambar"][$i]);
            $namaFile = md5(uniqid(rand(), true)) . ".png";
            file_put_contents('uploads/'.$namaFile, $soal_ujian_detail["soal_gambar"][$i]);
            $soal_ujian_detail["soal_gambar"][$i] = $namaFile;
		}
		$soal_ujian_detail["soal_gambar"] = json_encode($soal_ujian_detail["soal_gambar"]);
        
        $this->db->insert('soal_ujian', $soal_ujian);

        $message = array("list_soal_ujian_detail", $soal_ujian_detail);

        $this->response($message, 200);
    }
}
