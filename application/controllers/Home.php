<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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

	public function dataGuru()
	{
		// $data = array(
	  //   "sidebar" => $this->load->view('sidebar', NULL, true),
		// 	"content" => $this->load->view('data_guru', NULL, true)
		// );
		// load db and model
		$this->load->model('Guru');

		// init params
		$params = array();
		$limit_per_page = 10;
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->Guru->get_total();

		if ($total_records > 0)
		{
				// get current page records
				$params["results"] = $this->Guru->get_current_page_records($limit_per_page, $start_index);

				$config['base_url'] = base_url() . 'index.php/home/dataGuru';
				$config['total_rows'] = $total_records;
				$config['per_page'] = $limit_per_page;
				$config["uri_segment"] = 3;

				$config['full_tag_open'] = '<div class="pagination">';
				$config['full_tag_close'] = '</div>';

				$config['first_link'] = 'First Page';
				$config['first_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['first_tag_close'] = '</button>';

				$config['last_link'] = 'Last Page';
				$config['last_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['last_tag_close'] = '</button>';

				$config['next_link'] = 'Next Page';
				$config['next_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['next_tag_close'] = '</button>';

				$config['prev_link'] = 'Prev Page';
				$config['prev_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['prev_tag_close'] = '</button>';

				$config['cur_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['cur_tag_close'] = '</button>';

				$config['num_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['num_tag_close'] = '</button>';

				$this->pagination->initialize($config);

				// build paging links
				$params["links"] = $this->pagination->create_links();
		}

		$params["sidebar"] = $this->load->view('sidebar', NULL, true);
		$params["footer"] = $this->load->view('footer', NULL, true);

		$this->load->view('data_guru', $params);
	}

	public function tambahDataGuru() {
		$data = array(
	    "sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true)
		);
		$this->load->view('tambah_data_guru', $data);
	}

	public function tambahDataGuruSimpan() {
		$guru["nama"] = $this->input->post("nama");
		$guru["password"] = $this->input->post("password");
		$guru["no_telepon"] = $this->input->post("no_telepon");
		$guru["nik"] = $this->input->post("nik");
    $this->db->insert("guru", $guru);
	}

	public function lihatDataGuru($id) {
		$guru = $this->db->query('select * from guru where id = '.$id)->result();
		$data = array(
	    "sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true),
			"guru" => $guru
		);
		$this->load->view('lihat_data_guru', $data);
	}

	public function updateDataGuru($id) {
		$guru = $this->db->query('select * from guru where id = '.$id)->result();
		$data = array(
	    "sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true),
			"guru" => $guru
		);
		$this->load->view('update_data_guru', $data);
	}

	public function updateDataGuruSimpan() {
		$guru["id"] = $this->input->post("id");
		$guru["nama"] = $this->input->post("nama");
		$guru["password"] = $this->input->post("password");
		$guru["no_telepon"] = $this->input->post("no_telepon");
		$guru["nik"] = $this->input->post("nik");
		$this->db->where("id", $guru["id"]);
    $this->db->update("guru", $guru);
	}

	public function hapusDataGuru($id) {
		$this->db->where('id', $id);
		$this->db->delete('guru');
		redirect("/home/dataGuru", 'location');
	}

	public function banyakDataGuru($record_per_page) {
		$result = $this->db->get('guru')->num_rows();
		$result = ceil((float) $result / $record_per_page);
		echo (int) $result;
	}

	public function loadDataGuru($page, $record_per_page) {
		$output = '';
		$start_from = ($page - 1) * $record_per_page;
		$this->db->select('*');
		$this->db->limit($record_per_page, $start_from);
		$results = $this->db->get('guru')->result();
		$output .= "
			<table class='table table-bordered'>
				<tr>
					<th>Id</th>
					<th>Nama</th>
					<th>No Telepon</th>
					<th>NIK</th>
					<th>Action</th>
				</tr>
		";
		foreach($results as $result) {
			$chooseKelas = "chooseGuru('" . $result->id . "','" . $result->nama . "')";
			$output .= "
				<tr>
					<td>$result->id</td>
					<td>$result->nama</td>
					<td>$result->no_telepon</td>
					<td>$result->nik</td>
					<td>
						<button class='btn btn-primary' onclick=\"$chooseKelas\">Choose</button>
					</td>
				</tr>
			";
		}
		$output .= "</table>";
		echo $output;
	}

	public function dataTahunAjaran()
	{
		// $data = array(
	  //   "sidebar" => $this->load->view('sidebar', NULL, true),
		// 	"content" => $this->load->view('data_guru', NULL, true)
		// );
		// load db and model
		$this->load->model('TahunAjaran');

		// init params
		$params = array();
		$limit_per_page = 10;
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->TahunAjaran->get_total();

		if ($total_records > 0)
		{
				// get current page records
				$params["results"] = $this->TahunAjaran->get_current_page_records($limit_per_page, $start_index);

				$config['base_url'] = base_url() . 'index.php/home/dataTahunAjaran';
				$config['total_rows'] = $total_records;
				$config['per_page'] = $limit_per_page;
				$config["uri_segment"] = 3;

				$config['full_tag_open'] = '<div class="pagination">';
				$config['full_tag_close'] = '</div>';

				$config['first_link'] = 'First Page';
				$config['first_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['first_tag_close'] = '</button>';

				$config['last_link'] = 'Last Page';
				$config['last_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['last_tag_close'] = '</button>';

				$config['next_link'] = 'Next Page';
				$config['next_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['next_tag_close'] = '</button>';

				$config['prev_link'] = 'Prev Page';
				$config['prev_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['prev_tag_close'] = '</button>';

				$config['cur_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['cur_tag_close'] = '</button>';

				$config['num_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['num_tag_close'] = '</button>';

				$this->pagination->initialize($config);

				// build paging links
				$params["links"] = $this->pagination->create_links();
		}

		$params["sidebar"] = $this->load->view('sidebar', NULL, true);
		$params["footer"] = $this->load->view('footer', NULL, true);

		$this->load->view('data_tahun_ajaran', $params);
	}

	public function tambahDataTahunAjaran() {
		$data = array(
	    "sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true)
		);
		$this->load->view('tambah_data_tahun_ajaran', $data);
	}

	public function tambahDataTahunAjaranSimpan() {
		$tahunAjaran["tahun"] = $this->input->post("tahun");
    $this->db->insert("tahun_ajaran", $tahunAjaran);
	}

	public function lihatDataTahunAjaran($id) {
		$tahunAjaran = $this->db->query('select * from tahun_ajaran where id = '.$id)->result();
		$data = array(
	    "sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true),
			"tahunAjaran" => $tahunAjaran
		);
		$this->load->view('lihat_data_tahun_ajaran', $data);
	}

	public function updateDataTahunAjaran($id) {
		$tahunAjaran = $this->db->query('select * from tahun_ajaran where id = '.$id)->result();
		$data = array(
	    "sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true),
			"tahunAjaran" => $tahunAjaran
		);
		$this->load->view('update_data_tahun_ajaran', $data);
	}

	public function updateDataTahunAjaranSimpan() {
		$tahunAjaran["id"] = $this->input->post("id");
		$tahunAjaran["tahun"] = $this->input->post("tahun");
		$this->db->where("id", $tahunAjaran["id"]);
    $this->db->update("tahun_ajaran", $tahunAjaran);
	}

	public function hapusDataTahunAjaran($id) {
		$this->db->where('id', $id);
		$this->db->delete('tahun_ajaran');
		redirect("/home/dataTahunAjaran", 'location');
	}

	public function banyakDataTahunAjaran($record_per_page) {
		$result = $this->db->get('tahun_ajaran')->num_rows();
		$result = ceil((float) $result / $record_per_page);
		echo (int) $result;
	}

	public function loadDataTahunAjaran($page, $record_per_page) {
		$output = '';
		$start_from = ($page - 1) * $record_per_page;
		$this->db->select('*');
		$this->db->limit($record_per_page, $start_from);
		$results = $this->db->get('tahun_ajaran')->result();
		$output .= "
			<table class='table table-bordered'>
				<tr>
					<th>Id</th>
					<th>Tahun</th>
					<th>Action</th>
				</tr>
		";
		foreach($results as $result) {
			$chooseTahunAjaran = "chooseTahunAjaran('" . $result->id . "','" . $result->tahun . "')";
			$output .= "
				<tr>
					<td>$result->id</td>
					<td>$result->tahun</td>
					<td>
						<button class='btn btn-primary' onclick=\"$chooseTahunAjaran\">Choose</button>
					</td>
				</tr>
			";
		}
		$output .= "</table>";
		echo $output;
	}


	public function dataMurid()
	{
		// $data = array(
	  //   "sidebar" => $this->load->view('sidebar', NULL, true),
		// 	"content" => $this->load->view('data_guru', NULL, true)
		// );
		// load db and model
		$this->load->model('Murid');

		// init params
		$params = array();
		$limit_per_page = 10;
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->Murid->get_total();

		if ($total_records > 0)
		{
				// get current page records
				$params["results"] = $this->Murid->get_current_page_records($limit_per_page, $start_index);

				$config['base_url'] = base_url() . 'index.php/home/dataMurid';
				$config['total_rows'] = $total_records;
				$config['per_page'] = $limit_per_page;
				$config["uri_segment"] = 3;

				$config['full_tag_open'] = '<div class="pagination">';
				$config['full_tag_close'] = '</div>';

				$config['first_link'] = 'First Page';
				$config['first_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['first_tag_close'] = '</button>';

				$config['last_link'] = 'Last Page';
				$config['last_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['last_tag_close'] = '</button>';

				$config['next_link'] = 'Next Page';
				$config['next_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['next_tag_close'] = '</button>';

				$config['prev_link'] = 'Prev Page';
				$config['prev_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['prev_tag_close'] = '</button>';

				$config['cur_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['cur_tag_close'] = '</button>';

				$config['num_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['num_tag_close'] = '</button>';

				$this->pagination->initialize($config);

				// build paging links
				$params["links"] = $this->pagination->create_links();
		}

		$params["sidebar"] = $this->load->view('sidebar', NULL, true);
		$params["footer"] = $this->load->view('footer', NULL, true);

		$this->load->view('data_murid', $params);
	}

	public function tambahDataMurid() {
		$data = array(
	    "sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true)
		);
		$this->load->view('tambah_data_murid', $data);
	}

	public function tambahDataMuridSimpan() {
		$murid["nama"] = $this->input->post("nama");
		$murid["password"] = $this->input->post("password");
		$murid["id_kelas"] = $this->input->post("id_kelas");
		$murid["nama_ayah"] = $this->input->post("nama_ayah");
		$murid["nama_ibu"] = $this->input->post("nama_ibu");
		$murid["no_telepon"] = $this->input->post("no_telepon");
		$murid["no_induk"] = $this->input->post("no_induk");
    $this->db->insert("murid", $murid);
	}
	public function lihatDataMurid($id) {
		$murid = $this->db->query('SELECT murid.id, murid.nama as nama, kelas.id as id_kelas, kelas.nama as nama_kelas, murid.password, murid.nama_ayah, murid.nama_ibu, murid.no_telepon, murid.no_induk
									FROM murid
									join kelas on murid.id_kelas = kelas.id
									where murid.id = ' . $id)->result();
		$data = array(
	    "sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true),
			"murid" => $murid
		);
		$this->load->view('lihat_data_murid', $data);
	}
	public function updateDataMurid($id) {
		$murid = $this->db->query('SELECT murid.id, murid.nama as nama, kelas.id as id_kelas, kelas.nama as nama_kelas, murid.password, murid.nama_ayah, murid.nama_ibu, murid.no_telepon, murid.no_induk 
									FROM murid
									join kelas on murid.id_kelas = kelas.id
									where murid.id = ' . $id)->result();
		$data = array(
	    "sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true),
			"murid" => $murid
		);
		$this->load->view('update_data_murid', $data);
	}

	public function updateDataMuridSimpan() {
		$murid["id"] = $this->input->post("id");
		$murid["nama"] = $this->input->post("nama");
		$murid["password"] = $this->input->post("password");
		$murid["id_kelas"] = $this->input->post("id_kelas");
		$murid["nama_ayah"] = $this->input->post("nama_ayah");
		$murid["nama_ibu"] = $this->input->post("nama_ibu");
		$murid["no_telepon"] = $this->input->post("no_telepon");
		$murid["no_induk"] = $this->input->post("no_induk");
		$this->db->where("id", $murid["id"]);
		$this->db->update('murid', $murid);
	}

	public function hapusDataMurid($id) {
		$this->db->where('id', $id);
		$this->db->delete('murid');
		redirect("/home/dataMurid", 'location');
	}

	public function loadDataMurid($page, $record_per_page) {
		$output = '';
		$start_from = ($page - 1) * $record_per_page;
		$results = $this->db->query('SELECT murid.id, murid.nama as nama, kelas.id as id_kelas, kelas.nama as nama_kelas, murid.password, murid.nama_ayah, murid.nama_ibu, murid.no_telepon, 
											murid.no_induk, murid.nisn 
															FROM murid
															join kelas on murid.id_kelas = kelas.id
															where murid.id = ' . $id . ' LIMIT ' . $start_from . ',' . $record_per_page)->result();
		$output .= "
			<table class='table table-bordered'>
				<tr>
					<th>Id</th>
					<th>Nama</th>
					<th>Kelas</th>
					<th>Nama Ayah</th>
					<th>Nama Ibu</th>
					<th>No Telepon</th>
					<th>No Induk</th>
					<th>Action</th>
				</tr>
		";
		foreach($results as $result) {
			$chooseMurid = "chooseMurid('" . $result->id . "','" . $result->nama . "')";
			$output .= "
				<tr>
					<td>$result->id</td>
					<td>$result->nama</td>
					<td>$result->nama_kelas</td>
					<td>$result->nama_ayah</td>
					<td>$result->nama_ibu</td>
					<td>$result->no_telepon</td>
					<td>$result->no_induk</td>
					<td>
						<button class='btn btn-primary' onclick=\"$chooseMurid\">Choose</button>
					</td>
				</tr>
			";
		}
		$output .= "</table>";
		echo $output;
	}

	public function dataKelas()
	{
		// $data = array(
	  //   "sidebar" => $this->load->view('sidebar', NULL, true),
		// 	"content" => $this->load->view('data_guru', NULL, true)
		// );
		// load db and model
		$this->load->model('Kelas');

		// init params
		$params = array();
		$limit_per_page = 10;
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->Kelas->get_total();

		if ($total_records > 0)
		{
				// get current page records
				$params["results"] = $this->Kelas->get_current_page_records($limit_per_page, $start_index);

				$config['base_url'] = base_url() . 'index.php/home/dataKelas';
				$config['total_rows'] = $total_records;
				$config['per_page'] = $limit_per_page;
				$config["uri_segment"] = 3;

				$config['full_tag_open'] = '<div class="pagination">';
				$config['full_tag_close'] = '</div>';

				$config['first_link'] = 'First Page';
				$config['first_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['first_tag_close'] = '</button>';

				$config['last_link'] = 'Last Page';
				$config['last_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['last_tag_close'] = '</button>';

				$config['next_link'] = 'Next Page';
				$config['next_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['next_tag_close'] = '</button>';

				$config['prev_link'] = 'Prev Page';
				$config['prev_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['prev_tag_close'] = '</button>';

				$config['cur_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['cur_tag_close'] = '</button>';

				$config['num_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['num_tag_close'] = '</button>';

				$this->pagination->initialize($config);

				// build paging links
				$params["links"] = $this->pagination->create_links();
		}

		$params["sidebar"] = $this->load->view('sidebar', NULL, true);
		$params["footer"] = $this->load->view('footer', NULL, true);

		$this->load->view('data_kelas', $params);
	}

	public function tambahDataKelas() {
		$data = array(
	    "sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true)
		);
		$this->load->view('tambah_data_kelas', $data);
	}

	public function tambahDataKelasSimpan() {
		$kelas["nama"] = $this->input->post("nama");
		$kelas["id_tahun_ajaran"] = $this->input->post("id_tahun_ajaran");
    $this->db->insert("kelas", $kelas);
	}

	public function lihatDataKelas($id) {
		$kelas = $this->db->query('Select kelas.id as id, kelas.nama as nama, kelas.id_tahun_ajaran, tahun_ajaran.tahun as tahun_tahun_ajaran
									from kelas 
									join tahun_ajaran on kelas.id_tahun_ajaran = tahun_ajaran.id
									where kelas.id = ' . $id)->result();
		$data = array(
	    "sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true),
			"kelas" => $kelas
		);
		$this->load->view('lihat_data_kelas', $data);
	}

	public function updateDataKelas($id) {
		$kelas = $this->db->query('Select kelas.id as id, kelas.nama as nama, kelas.id_tahun_ajaran, tahun_ajaran.tahun as tahun_tahun_ajaran
									from kelas 
									join tahun_ajaran on kelas.id_tahun_ajaran = tahun_ajaran.id
									where kelas.id = ' . $id)->result();
		$data = array(
	    "sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true),
			"kelas" => $kelas
		);
		$this->load->view('update_data_kelas', $data);
	}

	public function updateDataKelasSimpan() {
		$kelas["id"] = $this->input->post("id");
		$kelas["nama"] = $this->input->post("nama");
		$kelas["id_tahun_ajaran"] = $this->input->post("id_tahun_ajaran");
    $this->db->where("id", $kelas["id"]);
		$this->db->update('kelas', $kelas);
	}

	public function hapusDataKelas($id) {
		$this->db->where('id', $id);
		$this->db->delete('kelas');
		redirect("/home/dataKelas", 'location');
	}

	public function banyakDataKelas($record_per_page) {
		$result = $this->db->get('kelas')->num_rows();
		$result = ceil((float) $result / $record_per_page);
		echo (int) $result;
	}

	public function loadDataKelas($page, $record_per_page) {
		$output = '';
		$start_from = ($page - 1) * $record_per_page;
		$this->db->select('kelas.id, kelas.nama, tahun_ajaran.tahun as tahun_tahun_ajaran');
		$this->db->from('kelas');
		$this->db->join('tahun_ajaran', 'kelas.id_tahun_ajaran = tahun_ajaran.id');
		$this->db->limit($record_per_page, $start_from);
		$results = $this->db->get()->result();
		$output .= "
			<table class='table table-bordered'>
				<tr>
					<th>Id</th>
					<th>Nama</th>
					<th>Tahun Ajaran</th>
					<th>Action</th>
				</tr>
		";
		foreach($results as $result) {
			$chooseKelas = "chooseKelas('" . $result->id . "','" . $result->nama . "')";
			$output .= "
				<tr>
					<td>$result->id</td>
					<td>$result->nama</td>
					<td>$result->tahun_tahun_ajaran</td>
					<td>
						<button class='btn btn-primary' onclick=\"$chooseKelas\">Choose</button>
					</td>
				</tr>
			";
		}
		$output .= "</table>";
		echo $output;
	}
	public function dataMataPelajaran()
	{
		// $data = array(
	  //   "sidebar" => $this->load->view('sidebar', NULL, true),
		// 	"content" => $this->load->view('data_guru', NULL, true)
		// );
		// load db and model
		$this->load->model('MataPelajaran');

		// init params
		$params = array();
		$limit_per_page = 10;
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->MataPelajaran->get_total();

		if ($total_records > 0)
		{
				// get current page records
				$params["results"] = $this->MataPelajaran->get_current_page_records($limit_per_page, $start_index);

				$config['base_url'] = base_url() . 'index.php/home/dataMataPelajaran';
				$config['total_rows'] = $total_records;
				$config['per_page'] = $limit_per_page;
				$config["uri_segment"] = 3;

				$config['full_tag_open'] = '<div class="pagination">';
				$config['full_tag_close'] = '</div>';

				$config['first_link'] = 'First Page';
				$config['first_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['first_tag_close'] = '</button>';

				$config['last_link'] = 'Last Page';
				$config['last_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['last_tag_close'] = '</button>';

				$config['next_link'] = 'Next Page';
				$config['next_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['next_tag_close'] = '</button>';

				$config['prev_link'] = 'Prev Page';
				$config['prev_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['prev_tag_close'] = '</button>';

				$config['cur_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['cur_tag_close'] = '</button>';

				$config['num_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['num_tag_close'] = '</button>';

				$this->pagination->initialize($config);

				// build paging links
				$params["links"] = $this->pagination->create_links();
		}

		$params["sidebar"] = $this->load->view('sidebar', NULL, true);
		$params["footer"] = $this->load->view('footer', NULL, true);

		$this->load->view('data_mata_pelajaran', $params);
	}

	public function tambahDataMataPelajaran() {
		$data = array(
	    "sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true)
		);
		$this->load->view('tambah_data_mata_pelajaran', $data);
	}

	public function tambahDataMataPelajaranSimpan() {
		$mata_pelajaran["nama"] = $this->input->post("nama");
		$mata_pelajaran["id_tahun_ajaran"] = $this->input->post("id_tahun_ajaran");
    $this->db->insert("mata_pelajaran", $mata_pelajaran);
	}

	public function lihatDataMataPelajaran($id) {
		$mataPelajaran = $this->db->query('Select mata_pelajaran.id, mata_pelajaran.nama, mata_pelajaran.id_tahun_ajaran, tahun_ajaran.tahun
		 													from mata_pelajaran
															join tahun_ajaran on mata_pelajaran.id_tahun_ajaran = tahun_ajaran.id
															where mata_pelajaran.id = ' . $id)->result();
		$data = array(
	    "sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true),
			"mata_pelajaran" => $mataPelajaran
		);
		$this->load->view('lihat_data_mata_pelajaran', $data);
	}

	public function updateDataMataPelajaran($id) {
		$mataPelajaran = $this->db->query('Select mata_pelajaran.id, mata_pelajaran.nama, mata_pelajaran.id_tahun_ajaran, tahun_ajaran.tahun
		 													from mata_pelajaran
															join tahun_ajaran on mata_pelajaran.id_tahun_ajaran = tahun_ajaran.id
															where mata_pelajaran.id = ' . $id)->result();
		$data = array(
	    "sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true),
			"mata_pelajaran" => $mataPelajaran
		);
		$this->load->view('update_data_mata_pelajaran', $data);
	}

	public function updateDataMataPelajaranSimpan() {
		$mata_pelajaran["id"] = $this->input->post("id");
		$mata_pelajaran["nama"] = $this->input->post("nama");
		$mata_pelajaran["id_tahun_ajaran"] = $this->input->post("id_tahun_ajaran");
    $this->db->where("id", $mata_pelajaran["id"]);
		$this->db->update('mata_pelajaran', $mata_pelajaran);
	}

	public function hapusDataMataPelajaran($id) {
		$this->db->where('id', $id);
		$this->db->delete('mata_pelajaran');
		redirect("/home/dataMataPelajaran", 'location');
	}

	public function banyakDataMataPelajaran($record_per_page) {
		$result = $this->db->get('mata_pelajaran')->num_rows();
		$result = ceil((float) $result / $record_per_page);
		echo (int) $result;
	}

	public function loadDataMataPelajaran($page, $record_per_page) {
		$output = '';
		$start_from = ($page - 1) * $record_per_page;
		$this->db->select('mata_pelajaran.id, mata_pelajaran.nama, mata_pelajaran.id_tahun_ajaran, tahun_ajaran.tahun');
		$this->db->from('mata_pelajaran');
		$this->db->join('tahun_ajaran', 'mata_pelajaran.id_tahun_ajaran = tahun_ajaran.id');
		$this->db->limit($record_per_page, $start_from);
		$results = $this->db->get()->result();
		$output .= "
			<table class='table table-bordered'>
				<tr>
					<th>Id</th>
					<th>Nama</th>
					<th>Tahun Ajaran</th>
					<th>Action</th>
				</tr>
		";
		foreach($results as $result) {
			$chooseMataPelajaran = "chooseMataPelajaran('" . $result->id . "','" . $result->nama . "')";
			$output .= "
				<tr>
					<td>$result->id</td>
					<td>$result->nama</td>
					<td>$result->tahun</td>
					<td>
						<button class='btn btn-primary' onclick=\"$chooseMataPelajaran\">Choose</button>
					</td>
				</tr>
			";
		}
		$output .= "</table>";
		echo $output;
	}
	public function dataJudulUjian()
	{
		// $data = array(
	  //   "sidebar" => $this->load->view('sidebar', NULL, true),
		// 	"content" => $this->load->view('data_guru', NULL, true)
		// );
		// load db and model
		$this->load->model('JudulUjian');

		// init params
		$params = array();
		$limit_per_page = 10;
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->JudulUjian->get_total();

		if ($total_records > 0)
		{
				// get current page records
				$params["results"] = $this->SoalUjian->get_current_page_records($limit_per_page, $start_index);

				$config['base_url'] = base_url() . 'index.php/home/dataJudulUjian';
				$config['total_rows'] = $total_records;
				$config['per_page'] = $limit_per_page;
				$config["uri_segment"] = 3;

				$config['full_tag_open'] = '<div class="pagination">';
				$config['full_tag_close'] = '</div>';

				$config['first_link'] = 'First Page';
				$config['first_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['first_tag_close'] = '</button>';

				$config['last_link'] = 'Last Page';
				$config['last_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['last_tag_close'] = '</button>';

				$config['next_link'] = 'Next Page';
				$config['next_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['next_tag_close'] = '</button>';

				$config['prev_link'] = 'Prev Page';
				$config['prev_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['prev_tag_close'] = '</button>';

				$config['cur_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['cur_tag_close'] = '</button>';

				$config['num_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['num_tag_close'] = '</button>';

				$this->pagination->initialize($config);

				// build paging links
				$params["links"] = $this->pagination->create_links();
		}

		$params["sidebar"] = $this->load->view('sidebar', NULL, true);
		$params["footer"] = $this->load->view('footer', NULL, true);

		$this->load->view('data_judul_ujian', $params);
	}

	public function tambahDataJudulUjian() {
		$data = array(
	    "sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true)
		);
		$this->load->view('tambah_data_judul_ujian', $data);
	}

	public function tambahDataJudulUjianSimpan() {
		$judul_ujian["id_mata_pelajaran"] = $this->input->post("id_mata_pelajaran");
		$judul_ujian["id_guru"] = $this->input->post("id_guru");
		$judul_ujian["id_kelas"] = $this->input->post("id_kelas");
		$judul_ujian["nama"] = $this->input->post("nama");
    $this->db->insert("judul_ujian", $judul_ujian);
	}

	public function lihatDataJudulUjian($id) {
	$judul_ujian = $this->db->query('Select judul_ujian.id, judul_ujian.id_mata_pelajaran, mata_pelajaran.nama as nama_mata_pelajaran, judul_ujian.id_guru, guru.nama as nama_guru, judul_ujian.id_kelas, kelas.nama as nama_kelas, judul_ujian.nama
		 													from judul_ujian
															join mata_pelajaran on judul_ujian.id_mata_pelajaran = mata_pelajaran.id
															join guru on judul_ujian.id_guru = guru.id
															join kelas on judul_ujian.id_kelas = kelas.id 
															where judul_ujian.id = ' . $id)->result();
		$data = array(
	    "sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true),
			"judul_ujian" => $judul_ujian
		);
		$this->load->view('lihat_data_judul_ujian', $data);
	}

	public function updateDataJudulUjian($id) {
		$judul_ujian = $this->db->query('Select judul_ujian.id, judul_ujian.id_mata_pelajaran, mata_pelajaran.nama as nama_mata_pelajaran, judul_ujian.id_guru, guru.nama as nama_guru, judul_ujian.id_kelas, kelas.nama as nama_kelas, judul_ujian.nama
		 													from judul_ujian
															join mata_pelajaran on judul_ujian.id_mata_pelajaran = mata_pelajaran.id
															join guru on judul_ujian.id_guru = guru.id
															join kelas on judul_ujian.id_kelas = kelas.id 
															where judul_ujian.id = ' . $id)->result();
		$data = array(
	    "sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true),
			"judul_ujian" => $judul_ujian
		);
		$this->load->view('update_data_judul_ujian', $data);
	}

	public function updateDataJudulUjianSimpan() {
		$judul_ujian["id"] = $this->input->post("id");
		$judul_ujian["id_mata_pelajaran"] = $this->input->post("id_mata_pelajaran");
		$judul_ujian["id_guru"] = $this->input->post("id_guru");
		$judul_ujian["id_kelas"] = $this->input->post("id_kelas");
		$judul_ujian["nama"] = $this->input->post("nama");
    $this->db->where("id", $judul_ujian["id"]);
		$this->db->update('judul_ujian', $judul_ujian);
	}

	public function hapusDataJudulUjian($id) {
		$this->db->where('id', $id);
		$this->db->delete('judul_ujian');
		redirect("/home/dataJudulUjian", 'location');
	}

	public function banyakDataJudulUjian($record_per_page) {
		$result = $this->db->get('judul_ujian')->num_rows();
		$result = ceil((float) $result / $record_per_page);
		echo (int) $result;
	}

	public function loadDataJudulUjian($page, $record_per_page) {
		$output = '';
		$start_from = ($page - 1) * $record_per_page;
		$this->db->select('judul_ujian.id, judul_ujian.id_mata_pelajaran, mata_pelajaran.nama as nama_mata_pelajaran, judul_ujian.id_guru, guru.nama as nama_guru, judul_ujian.id_kelas, kelas.nama as nama_kelas, judul_ujian.nama');
		$this->db->from('judul_ujian');
		$this->db->join('mata_pelajaran', 'mata_pelajaran.id = judul_ujian.id_mata_pelajaran');
		$this->db->join('guru', 'guru.id = judul_ujian.id_guru');
		$this->db->join('kelas', 'judul_ujian.id_kelas = kelas.id');
		$this->db->limit($record_per_page, $start_from);
		$results = $this->db->get()->result();
		$output .= "
			<table class='table table-bordered'>
				<tr>
					<th>Id</th>
					<th>Mata Pelajaran</th>
					<th>Guru</th>
					<th>Kelas</th>
					<th>Nama</th>
					<th>Action</th>
				</tr>
		";
		foreach($results as $result) {
			$chooseSoalUjian = "chooseSoalUjian('" . $result->id . "' , '" . $result->nama . "')";
			$output .= "
				<tr>
					<td>$result->id</td>
					<td>$result->nama_mata_pelajaran</td>
					<td>$result->nama_guru</td>
					<td>$result->nama_kelas</td>
					<td>$result->nama</td>
					<td>
						<button class='btn btn-primary' onclick=\"$chooseSoalUjian\">Choose</button>
					</td>
				</tr>
			";
		}
		$output .= "</table>";
		echo $output;
	}
	public function dataJenisSoalUjian()
	{
		// $data = array(
	  //   "sidebar" => $this->load->view('sidebar', NULL, true),
		// 	"content" => $this->load->view('data_guru', NULL, true)
		// );
		// load db and model
		$this->load->model('JenisSoalUjian');

		// init params
		$params = array();
		$limit_per_page = 10;
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->JenisSoalUjian->get_total();

		if ($total_records > 0)
		{
				// get current page records
				$params["results"] = $this->JenisSoalUjian->get_current_page_records($limit_per_page, $start_index);

				$config['base_url'] = base_url() . 'index.php/home/dataJenisSoalUjian';
				$config['total_rows'] = $total_records;
				$config['per_page'] = $limit_per_page;
				$config["uri_segment"] = 3;

				$config['full_tag_open'] = '<div class="pagination">';
				$config['full_tag_close'] = '</div>';

				$config['first_link'] = 'First Page';
				$config['first_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['first_tag_close'] = '</button>';

				$config['last_link'] = 'Last Page';
				$config['last_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['last_tag_close'] = '</button>';

				$config['next_link'] = 'Next Page';
				$config['next_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['next_tag_close'] = '</button>';

				$config['prev_link'] = 'Prev Page';
				$config['prev_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['prev_tag_close'] = '</button>';

				$config['cur_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['cur_tag_close'] = '</button>';

				$config['num_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['num_tag_close'] = '</button>';

				$this->pagination->initialize($config);

				// build paging links
				$params["links"] = $this->pagination->create_links();
		}

		$params["sidebar"] = $this->load->view('sidebar', NULL, true);
		$params["footer"] = $this->load->view('footer', NULL, true);

		$this->load->view('data_jenis_soal_ujian', $params);
	}

	public function tambahDataJenisSoalUjian() {
		$data = array(
	    "sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true)
		);
		$this->load->view('tambah_data_jenis_soal_ujian', $data);
	}

	public function tambahDataJenisSoalUjianSimpan() {
		$jenis_soal_ujian_detail["nama"] = $this->input->post("nama");
    $this->db->insert("jenis_soal_ujian", $jenis_soal_ujian_detail);
	}

	public function lihatDataJenisSoalUjian($id) {
		$jenis_soal_ujian = $this->db->query('Select *
		 													from jenis_soal_ujian
															where id = ' . $id)->result();
		$data = array(
	    "sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true),
			"jenis_soal_ujian" => $jenis_soal_ujian
		);
		$this->load->view('lihat_data_jenis_soal_ujian', $data);
	}

	public function updateDataJenisSoalUjian($id) {
		$jenis_soal_ujian = $this->db->query('Select *
		 													from jenis_soal_ujian
															where id = ' . $id)->result();
		$data = array(
	    "sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true),
			"jenis_soal_ujian" => $jenis_soal_ujian
		);
		$this->load->view('update_data_jenis_soal_ujian', $data);
	}

	public function updateDataJenisSoalUjianSimpan() {
		$jenis_soal_ujian["id"] = $this->input->post("id");
		$jenis_soal_ujian["nama"] = $this->input->post("nama");
    $this->db->where("id", $jenis_soal_ujian["id"]);
		$this->db->update('jenis_soal_ujian', $jenis_soal_ujian);
	}

	public function hapusDataJenisSoalUjian($id) {
		$this->db->where('id', $id);
		$this->db->delete('jenis_soal_ujian');
		redirect("/home/dataJenisSoalUjian", 'location');
	}

	public function banyakDataJenisSoalUjian($record_per_page) {
		$result = $this->db->get('jenis_soal_ujian')->num_rows();
		$result = ceil((float) $result / $record_per_page);
		echo (int) $result;
	}

	public function loadDataJenisSoalUjian($page, $record_per_page) {
		$output = '';
		$start_from = ($page - 1) * $record_per_page;
		$this->db->select('*');
		$this->db->from('jenis_soal_ujian');
		$this->db->limit($record_per_page, $start_from);
		$results = $this->db->get()->result();
		$output .= "
			<table class='table table-bordered'>
				<tr>
					<th>Id</th>
					<th>Nama</th>
					<th>Action</th>
				</tr>
		";
		foreach($results as $result) {
			$chooseJenisSoalUjian = "chooseJenisSoalUjian('" . $result->id . "','" . $result->nama . "')";
			$output .= "
				<tr>
					<td>$result->id</td>
					<td>$result->nama</td>
					<td>
						<button class='btn btn-primary' onclick=\"$chooseJenisSoalUjian\">Choose</button>
					</td>
				</tr>
			";
		}
		$output .= "</table>";
		echo $output;
	}
	public function dataSoalUjian()
	{
		// $data = array(
	  //   "sidebar" => $this->load->view('sidebar', NULL, true),
		// 	"content" => $this->load->view('data_guru', NULL, true)
		// );
		// load db and model
		$this->load->model('SoalUjian');

		// init params
		$params = array();
		$limit_per_page = 10;
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->SoalUjian->get_total();

		if ($total_records > 0)
		{
				// get current page records
				$params["results"] = $this->SoalUjianDetail->get_current_page_records($limit_per_page, $start_index);

				$config['base_url'] = base_url() . 'index.php/home/dataSoalUjian';
				$config['total_rows'] = $total_records;
				$config['per_page'] = $limit_per_page;
				$config["uri_segment"] = 3;

				$config['full_tag_open'] = '<div class="pagination">';
				$config['full_tag_close'] = '</div>';

				$config['first_link'] = 'First Page';
				$config['first_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['first_tag_close'] = '</button>';

				$config['last_link'] = 'Last Page';
				$config['last_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['last_tag_close'] = '</button>';

				$config['next_link'] = 'Next Page';
				$config['next_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['next_tag_close'] = '</button>';

				$config['prev_link'] = 'Prev Page';
				$config['prev_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['prev_tag_close'] = '</button>';

				$config['cur_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['cur_tag_close'] = '</button>';

				$config['num_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['num_tag_close'] = '</button>';

				$this->pagination->initialize($config);

				// build paging links
				$params["links"] = $this->pagination->create_links();
		}

		$params["sidebar"] = $this->load->view('sidebar', NULL, true);
		$params["footer"] = $this->load->view('footer', NULL, true);

		$this->load->view('data_soal_ujian', $params);
	}

	public function tambahDataSoalUjian() {
		$data = array(
	    	"sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true)
		);
		$this->load->view('tambah_data_soal_ujian', $data);
	}

	public function tambahDataSoalUjianSimpan() {
		$soal_ujian["id_judul_ujian"] = $this->input->post("id_judul_ujian");
		$soal_ujian["id_jenis_soal_ujian"] = $this->input->post("id_jenis_soal_ujian");
		$soal_ujian["soal_tulisan"] = $this->input->post("soal_tulisan");
		$soal_ujian["soal_gambar"] = array();
		$filesCount = count($_FILES['soal_gambar']['name']);
		for($i = 0; $i < $filesCount; $i++){
			$_FILES['userFile']['name'] = $_FILES['soal_gambar']['name'][$i];
			$_FILES['userFile']['type'] = $_FILES['soal_gambar']['type'][$i];
			$_FILES['userFile']['tmp_name'] = $_FILES['soal_gambar']['tmp_name'][$i];
			$_FILES['userFile']['error'] = $_FILES['soal_gambar']['error'][$i];
			$_FILES['userFile']['size'] = $_FILES['soal_gambar']['size'][$i];

			$uploadPath = './uploads/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = TRUE;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('userFile')){
				$fileData = $this->upload->data();
				array_push($soal_ujian["soal_gambar"], $fileData['file_name']);
			}
		}
		$soal_ujian["soal_gambar"] = json_encode($soal_ujian["soal_gambar"]);

		$soal_ujian["pilihan_jawaban_tulisan"] = array();
		array_push($soal_ujian["pilihan_jawaban_tulisan"], $this->input->post("pilihan_jawaban_tulisan_a"));
		array_push($soal_ujian["pilihan_jawaban_tulisan"], $this->input->post("pilihan_jawaban_tulisan_b"));
		array_push($soal_ujian["pilihan_jawaban_tulisan"], $this->input->post("pilihan_jawaban_tulisan_c"));
		array_push($soal_ujian["pilihan_jawaban_tulisan"], $this->input->post("pilihan_jawaban_tulisan_d"));
		array_push($soal_ujian["pilihan_jawaban_tulisan"], $this->input->post("pilihan_jawaban_tulisan_e"));
		$soal_ujian["pilihan_jawaban_tulisan"] = json_encode($soal_ujian["pilihan_jawaban_tulisan"]);

		$soal_ujian["pilihan_jawaban_gambar"] = array();
		$filesCount = count($_FILES['pilihan_jawaban_gambar_a']['name']);
		$temp = array();
		for($i = 0; $i < $filesCount; $i++){
			$_FILES['userFile']['name'] = $_FILES['pilihan_jawaban_gambar_a']['name'][$i];
			$_FILES['userFile']['type'] = $_FILES['pilihan_jawaban_gambar_a']['type'][$i];
			$_FILES['userFile']['tmp_name'] = $_FILES['pilihan_jawaban_gambar_a']['tmp_name'][$i];
			$_FILES['userFile']['error'] = $_FILES['pilihan_jawaban_gambar_a']['error'][$i];
			$_FILES['userFile']['size'] = $_FILES['pilihan_jawaban_gambar_a']['size'][$i];

			$uploadPath = './uploads/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = TRUE;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('userFile')){
				$fileData = $this->upload->data();
				array_push($temp, $fileData['file_name']);
			}
		}
		array_push($soal_ujian["pilihan_jawaban_gambar"], $temp);

		$filesCount = count($_FILES['pilihan_jawaban_gambar_b']['name']);
		$temp = array();
		for($i = 0; $i < $filesCount; $i++){
			$_FILES['userFile']['name'] = $_FILES['pilihan_jawaban_gambar_b']['name'][$i];
			$_FILES['userFile']['type'] = $_FILES['pilihan_jawaban_gambar_b']['type'][$i];
			$_FILES['userFile']['tmp_name'] = $_FILES['pilihan_jawaban_gambar_b']['tmp_name'][$i];
			$_FILES['userFile']['error'] = $_FILES['pilihan_jawaban_gambar_b']['error'][$i];
			$_FILES['userFile']['size'] = $_FILES['pilihan_jawaban_gambar_b']['size'][$i];

			$uploadPath = './uploads/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = TRUE;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('userFile')){
				$fileData = $this->upload->data();
				array_push($temp, $fileData['file_name']);
			}
		}
		array_push($soal_ujian_detail["pilihan_jawaban_gambar"], $temp);

		$filesCount = count($_FILES['pilihan_jawaban_gambar_c']['name']);
		$temp = array();
		for($i = 0; $i < $filesCount; $i++){
			$_FILES['userFile']['name'] = $_FILES['pilihan_jawaban_gambar_c']['name'][$i];
			$_FILES['userFile']['type'] = $_FILES['pilihan_jawaban_gambar_c']['type'][$i];
			$_FILES['userFile']['tmp_name'] = $_FILES['pilihan_jawaban_gambar_c']['tmp_name'][$i];
			$_FILES['userFile']['error'] = $_FILES['pilihan_jawaban_gambar_c']['error'][$i];
			$_FILES['userFile']['size'] = $_FILES['pilihan_jawaban_gambar_c']['size'][$i];

			$uploadPath = './uploads/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = TRUE;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('userFile')){
				$fileData = $this->upload->data();
				array_push($temp, $fileData['file_name']);
			}
		}
		array_push($soal_ujian_detail["pilihan_jawaban_gambar"], $temp);

		$filesCount = count($_FILES['pilihan_jawaban_gambar_d']['name']);
		$temp = array();
		for($i = 0; $i < $filesCount; $i++){
			$_FILES['userFile']['name'] = $_FILES['pilihan_jawaban_gambar_d']['name'][$i];
			$_FILES['userFile']['type'] = $_FILES['pilihan_jawaban_gambar_d']['type'][$i];
			$_FILES['userFile']['tmp_name'] = $_FILES['pilihan_jawaban_gambar_d']['tmp_name'][$i];
			$_FILES['userFile']['error'] = $_FILES['pilihan_jawaban_gambar_d']['error'][$i];
			$_FILES['userFile']['size'] = $_FILES['pilihan_jawaban_gambar_d']['size'][$i];

			$uploadPath = './uploads/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = TRUE;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('userFile')){
				$fileData = $this->upload->data();
				array_push($temp, $fileData['file_name']);
			}
		}
		array_push($soal_ujian_detail["pilihan_jawaban_gambar"], $temp);

		$filesCount = count($_FILES['pilihan_jawaban_gambar_e']['name']);
		$temp = array();
		for($i = 0; $i < $filesCount; $i++){
			$_FILES['userFile']['name'] = $_FILES['pilihan_jawaban_gambar_e']['name'][$i];
			$_FILES['userFile']['type'] = $_FILES['pilihan_jawaban_gambar_e']['type'][$i];
			$_FILES['userFile']['tmp_name'] = $_FILES['pilihan_jawaban_gambar_e']['tmp_name'][$i];
			$_FILES['userFile']['error'] = $_FILES['pilihan_jawaban_gambar_e']['error'][$i];
			$_FILES['userFile']['size'] = $_FILES['pilihan_jawaban_gambar_e']['size'][$i];

			$uploadPath = './uploads/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = TRUE;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('userFile')){
				$fileData = $this->upload->data();
				array_push($temp, $fileData['file_name']);
			}
		}
		array_push($soal_ujian_detail["pilihan_jawaban_gambar"], $temp);
		$soal_ujian_detail["pilihan_jawaban_gambar"] = json_encode($soal_ujian_detail["pilihan_jawaban_gambar"]);

		$soal_ujian["kunci_jawaban"] = $this->input->post("kunci_jawaban");
		print_r($soal_ujian);
		$this->db->insert("soal_ujian", $soal_ujian);
		redirect("/home/dataSoalUjian", "location");
	}

	public function lihatDataSoalUjian($id) {
		$soal_ujian = $this->db->query('Select soal_ujian.id, soal_ujian.id_judul_ujian, judul_ujian.nama as nama_judul_ujian, soal_ujian.id_jenis_soal_ujian, jenis_soal_ujian.nama as nama_jenis_soal_ujian, soal_ujian.soal_tulisan, soal_ujian.soal_gambar, soal_ujian.pilihan_jawaban_tulisan, soal_ujian.pilihan_jawaban_gambar, soal_ujian.kunci_jawaban
												from soal_ujian
												join judul_ujian on soal_ujian.id_soal_ujian = judul_ujian.id
												join jenis_soal_ujian on soal_ujian.id_jenis_soal_ujian = jenis_soal_ujian.id
												where soal_ujian.id = ' . $id)->result();
		$data = array(
	    	"sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true),
			"soal_ujian" => $soal_ujian
		);
		$this->load->view('lihat_data_soal_ujian', $data);
	}

	public function updateDataSoalUjianDetail($id) {
		$soal_ujian = $this->db->query('Select soal_ujian.id, soal_ujian.id_judul_ujian, judul_ujian.nama as nama_judul_ujian, soal_ujian.id_jenis_soal_ujian, jenis_soal_ujian.nama as nama_jenis_soal_ujian, soal_ujian.soal_tulisan, soal_ujian.soal_gambar, soal_ujian.pilihan_jawaban_tulisan, soal_ujian.pilihan_jawaban_gambar, soal_ujian.kunci_jawaban
												from soal_ujian
												join judul_ujian on soal_ujian.id_soal_ujian = judul_ujian.id
												join jenis_soal_ujian on soal_ujian.id_jenis_soal_ujian = jenis_soal_ujian.id
												where soal_ujian.id = ' . $id)->result();
		$data = array(
	    	"sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true),
			"soal_ujian" => $soal_ujian
		);
		$this->load->view('update_data_soal_ujian', $data);
	}

	public function updateDataSoalUjianSimpan() {
		$soal_ujian["id"] = $this->input->post("id");
		$soal_ujian["id_judul_ujian"] = $this->input->post("id_judul_ujian");
		$soal_ujian["id_jenis_soal_ujian"] = $this->input->post("id_jenis_soal_ujian");
		$soal_ujian["soal_tulisan"] = $this->input->post("soal_tulisan");
		$soal_ujian["soal_gambar"] = array();
		$filesCount = count($_FILES['soal_gambar']['name']);
		for($i = 0; $i < $filesCount; $i++){
			$_FILES['userFile']['name'] = $_FILES['soal_gambar']['name'][$i];
			$_FILES['userFile']['type'] = $_FILES['soal_gambar']['type'][$i];
			$_FILES['userFile']['tmp_name'] = $_FILES['soal_gambar']['tmp_name'][$i];
			$_FILES['userFile']['error'] = $_FILES['soal_gambar']['error'][$i];
			$_FILES['userFile']['size'] = $_FILES['soal_gambar']['size'][$i];

			$uploadPath = './uploads/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = TRUE;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('userFile')){
				$fileData = $this->upload->data();
				array_push($soal_ujian["soal_gambar"], $fileData['file_name']);
			}
		}
		$soal_ujian["soal_gambar"] = json_encode($soal_ujian["soal_gambar"]);

		$soal_ujian["pilihan_jawaban_tulisan"] = array();
		array_push($soal_ujian["pilihan_jawaban_tulisan"], $this->input->post("pilihan_jawaban_tulisan_a"));
		array_push($soal_ujian["pilihan_jawaban_tulisan"], $this->input->post("pilihan_jawaban_tulisan_b"));
		array_push($soal_ujian["pilihan_jawaban_tulisan"], $this->input->post("pilihan_jawaban_tulisan_c"));
		array_push($soal_ujian["pilihan_jawaban_tulisan"], $this->input->post("pilihan_jawaban_tulisan_d"));
		array_push($soal_ujian["pilihan_jawaban_tulisan"], $this->input->post("pilihan_jawaban_tulisan_e"));
		$soal_ujian["pilihan_jawaban_tulisan"] = json_encode($soal_ujian["pilihan_jawaban_tulisan"]);

		$soal_ujian["pilihan_jawaban_gambar"] = array();
		$filesCount = count($_FILES['pilihan_jawaban_gambar_a']['name']);
		$temp = array();
		for($i = 0; $i < $filesCount; $i++){
			$_FILES['userFile']['name'] = $_FILES['pilihan_jawaban_gambar_a']['name'][$i];
			$_FILES['userFile']['type'] = $_FILES['pilihan_jawaban_gambar_a']['type'][$i];
			$_FILES['userFile']['tmp_name'] = $_FILES['pilihan_jawaban_gambar_a']['tmp_name'][$i];
			$_FILES['userFile']['error'] = $_FILES['pilihan_jawaban_gambar_a']['error'][$i];
			$_FILES['userFile']['size'] = $_FILES['pilihan_jawaban_gambar_a']['size'][$i];

			$uploadPath = './uploads/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = TRUE;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('userFile')){
				$fileData = $this->upload->data();
				array_push($temp, $fileData['file_name']);
			}
		}
		array_push($soal_ujian["pilihan_jawaban_gambar"], $temp);

		$filesCount = count($_FILES['pilihan_jawaban_gambar_b']['name']);
		$temp = array();
		for($i = 0; $i < $filesCount; $i++){
			$_FILES['userFile']['name'] = $_FILES['pilihan_jawaban_gambar_b']['name'][$i];
			$_FILES['userFile']['type'] = $_FILES['pilihan_jawaban_gambar_b']['type'][$i];
			$_FILES['userFile']['tmp_name'] = $_FILES['pilihan_jawaban_gambar_b']['tmp_name'][$i];
			$_FILES['userFile']['error'] = $_FILES['pilihan_jawaban_gambar_b']['error'][$i];
			$_FILES['userFile']['size'] = $_FILES['pilihan_jawaban_gambar_b']['size'][$i];

			$uploadPath = './uploads/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = TRUE;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('userFile')){
				$fileData = $this->upload->data();
				array_push($temp, $fileData['file_name']);
			}
		}
		array_push($soal_ujian["pilihan_jawaban_gambar"], $temp);

		$filesCount = count($_FILES['pilihan_jawaban_gambar_c']['name']);
		$temp = array();
		for($i = 0; $i < $filesCount; $i++){
			$_FILES['userFile']['name'] = $_FILES['pilihan_jawaban_gambar_c']['name'][$i];
			$_FILES['userFile']['type'] = $_FILES['pilihan_jawaban_gambar_c']['type'][$i];
			$_FILES['userFile']['tmp_name'] = $_FILES['pilihan_jawaban_gambar_c']['tmp_name'][$i];
			$_FILES['userFile']['error'] = $_FILES['pilihan_jawaban_gambar_c']['error'][$i];
			$_FILES['userFile']['size'] = $_FILES['pilihan_jawaban_gambar_c']['size'][$i];

			$uploadPath = './uploads/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = TRUE;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('userFile')){
				$fileData = $this->upload->data();
				array_push($temp, $fileData['file_name']);
			}
		}
		array_push($soal_ujian["pilihan_jawaban_gambar"], $temp);

		$filesCount = count($_FILES['pilihan_jawaban_gambar_d']['name']);
		$temp = array();
		for($i = 0; $i < $filesCount; $i++){
			$_FILES['userFile']['name'] = $_FILES['pilihan_jawaban_gambar_d']['name'][$i];
			$_FILES['userFile']['type'] = $_FILES['pilihan_jawaban_gambar_d']['type'][$i];
			$_FILES['userFile']['tmp_name'] = $_FILES['pilihan_jawaban_gambar_d']['tmp_name'][$i];
			$_FILES['userFile']['error'] = $_FILES['pilihan_jawaban_gambar_d']['error'][$i];
			$_FILES['userFile']['size'] = $_FILES['pilihan_jawaban_gambar_d']['size'][$i];

			$uploadPath = './uploads/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = TRUE;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('userFile')){
				$fileData = $this->upload->data();
				array_push($temp, $fileData['file_name']);
			}
		}
		array_push($soal_ujian["pilihan_jawaban_gambar"], $temp);

		$filesCount = count($_FILES['pilihan_jawaban_gambar_e']['name']);
		$temp = array();
		for($i = 0; $i < $filesCount; $i++){
			$_FILES['userFile']['name'] = $_FILES['pilihan_jawaban_gambar_e']['name'][$i];
			$_FILES['userFile']['type'] = $_FILES['pilihan_jawaban_gambar_e']['type'][$i];
			$_FILES['userFile']['tmp_name'] = $_FILES['pilihan_jawaban_gambar_e']['tmp_name'][$i];
			$_FILES['userFile']['error'] = $_FILES['pilihan_jawaban_gambar_e']['error'][$i];
			$_FILES['userFile']['size'] = $_FILES['pilihan_jawaban_gambar_e']['size'][$i];

			$uploadPath = './uploads/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = TRUE;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('userFile')){
				$fileData = $this->upload->data();
				array_push($temp, $fileData['file_name']);
			}
		}
		array_push($soal_ujian["pilihan_jawaban_gambar"], $temp);
		$soal_ujian["pilihan_jawaban_gambar"] = json_encode($soal_ujian["pilihan_jawaban_gambar"]);

		$soal_ujian["kunci_jawaban"] = $this->input->post("kunci_jawaban");
		print_r($soal_ujian);
    	$this->db->where("id", $soal_ujian["id"]);
		$this->db->update('soal_ujian', $soal_ujian);
		redirect("/home/dataSoalUjian", "location");
	}

	public function hapusDataSoalUjian($id) {
		$this->db->where('id', $id);
		$this->db->delete('soal_ujian');
		redirect("/home/dataSoalUjian", 'location');
	}

	public function banyakDataSoalUjian($record_per_page) {
		$result = $this->db->get('soal_ujian')->num_rows();
		$result = ceil((float) $result / $record_per_page);
		echo (int) $result;
	}

	public function loadDataSoalUjian($page, $record_per_page) {
		$output = '';
		$start_from = ($page - 1) * $record_per_page;
		$this->db->select('soal_ujian.id, judul_ujian.nama as nama_judul_ujian, jenis_soal_ujian.nama as nama_jenis_soal_ujian, soal_ujian.soal_tulisan');
		$this->db->from('soal_ujian');
		$this->db->join('judul_ujian', 'soal_ujian.id_judul_ujian = judul_ujian.id');
		$this->db->join('jenis_soal_ujian', 'soal_ujian.id_jenis_soal_ujian = jenis_soal_ujian.id');
		$this->db->limit($record_per_page, $start_from);
		$results = $this->db->get()->result();
		$output .= "
			<table class='table table-bordered'>
				<tr>
					<th>Id</th>
					<th>Judul Ujian</th>
					<th>Jenis Soal Ujian</th>
					<th>Soal</th>
					<th>Action</th>
				</tr>
		";
		foreach($results as $result) {
			$chooseSoalUjian = "chooseSoalUjian('" . $result->id . "','" . $result->nama . "')";
			$output .= "
				<tr>
					<td>$result->id</td>
					<td>$result->nama_judul_ujian</td>
					<td>$result->nama_jenis_soal_ujian</td>
					<td>$result->soal_tulisan</td>
					<td>
						<button class='btn btn-primary' onclick=\"$chooseSoalUjian\">Choose</button>
					</td>
				</tr>
			";
		}
		$output .= "</table>";
		echo $output;
	}
	public function dataPR()
	{
		// $data = array(
	  //   "sidebar" => $this->load->view('sidebar', NULL, true),
		// 	"content" => $this->load->view('data_guru', NULL, true)
		// );
		// load db and model
		$this->load->model('PR');

		// init params
		$params = array();
		$limit_per_page = 10;
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->PR->get_total();

		if ($total_records > 0)
		{
				// get current page records
				$params["results"] = $this->PR->get_current_page_records($limit_per_page, $start_index);

				$config['base_url'] = base_url() . 'index.php/home/dataPR';
				$config['total_rows'] = $total_records;
				$config['per_page'] = $limit_per_page;
				$config["uri_segment"] = 3;

				$config['full_tag_open'] = '<div class="pagination">';
				$config['full_tag_close'] = '</div>';

				$config['first_link'] = 'First Page';
				$config['first_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['first_tag_close'] = '</button>';

				$config['last_link'] = 'Last Page';
				$config['last_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['last_tag_close'] = '</button>';

				$config['next_link'] = 'Next Page';
				$config['next_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['next_tag_close'] = '</button>';

				$config['prev_link'] = 'Prev Page';
				$config['prev_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['prev_tag_close'] = '</button>';

				$config['cur_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['cur_tag_close'] = '</button>';

				$config['num_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['num_tag_close'] = '</button>';

				$this->pagination->initialize($config);

				// build paging links
				$params["links"] = $this->pagination->create_links();
		}

		$params["sidebar"] = $this->load->view('sidebar', NULL, true);
		$params["footer"] = $this->load->view('footer', NULL, true);

		$this->load->view('data_pr', $params);
	}

	public function tambahDataPR() {
		$data = array(
	    	"sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true)
		);
		$this->load->view('tambah_data_pr', $data);
	}

	public function tambahDataPRSimpan() {
		$pr["id_mata_pelajaran"] = $this->input->post("id_mata_pelajaran");
		$pr["id_guru"] = $this->input->post("id_guru");
		$pr["id_kelas"] = $this->input->post("id_kelas");
		$pr["deskripsi"] = $this->input->post("deskripsi");
		$pr["gambar"] = array();
		$filesCount = count($_FILES['gambar']['name']);
		for($i = 0; $i < $filesCount; $i++){
			$_FILES['userFile']['name'] = $_FILES['gambar']['name'][$i];
			$_FILES['userFile']['type'] = $_FILES['gambar']['type'][$i];
			$_FILES['userFile']['tmp_name'] = $_FILES['gambar']['tmp_name'][$i];
			$_FILES['userFile']['error'] = $_FILES['gambar']['error'][$i];
			$_FILES['userFile']['size'] = $_FILES['gambar']['size'][$i];

			$uploadPath = './uploads/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = TRUE;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('userFile')){
				$fileData = $this->upload->data();
				array_push($pr["gambar"], $fileData['file_name']);
			}
		}
		$pr["gambar"] = json_encode($pr["gambar"]);

		$pr["nama"] = $this->input->post("nama");
		print_r($pr);
		$this->db->insert("pr", $pr);
		redirect("/home/dataPR", "location");
	}

	public function lihatDataPR($id) {
		$pr = $this->db->query('Select pr.id, pr.id_mata_pelajaran, mata_pelajaran.nama as nama_mata_pelajaran, pr.id_guru, guru.nama as nama_guru, pr.id_kelas, kelas.nama as nama_kelas, pr.deskripsi, pr.gambar, pr.nama
								from pr
								join mata_pelajaran on pr.id_mata_pelajaran = mata_pelajaran.id
								join guru on pr.id_guru = guru.id
								join kelas on pr.id_kelas = kelas.id
								where pr.id = ' . $id)->result();
		$data = array(
	    	"sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true),
			"pr" => $pr
		);
		$this->load->view('lihat_data_pr', $data);
	}

	public function updateDataPR($id) {
		$pr = $this->db->query('Select pr.id, pr.id_mata_pelajaran, mata_pelajaran.nama as nama_mata_pelajaran, pr.id_guru, guru.nama as nama_guru, pr.id_kelas, kelas.nama as nama_kelas, pr.deskripsi, pr.gambar, pr.nama
								from pr
								join mata_pelajaran on pr.id_mata_pelajaran = mata_pelajaran.id
								join guru on pr.id_guru = guru.id
								join kelas on pr.id_kelas = kelas.id
								where pr.id = ' . $id)->result();
		$data = array(
	    	"sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true),
			"pr" => $pr
		);
		$this->load->view('update_data_pr', $data);
	}

	public function updateDataPRSimpan() {
		$pr["id"] = $this->input->post("id");
		$pr["id_mata_pelajaran"] = $this->input->post("id_mata_pelajaran");
		$pr["id_guru"] = $this->input->post("id_guru");
		$pr["id_kelas"] = $this->input->post("id_kelas");
		$pr["deskripsi"] = $this->input->post("deskripsi");
		$pr["gambar"] = array();
		$filesCount = count($_FILES['gambar']['name']);
		for($i = 0; $i < $filesCount; $i++){
			$_FILES['userFile']['name'] = $_FILES['gambar']['name'][$i];
			$_FILES['userFile']['type'] = $_FILES['gambar']['type'][$i];
			$_FILES['userFile']['tmp_name'] = $_FILES['gambar']['tmp_name'][$i];
			$_FILES['userFile']['error'] = $_FILES['gambar']['error'][$i];
			$_FILES['userFile']['size'] = $_FILES['gambar']['size'][$i];

			$uploadPath = './uploads/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = TRUE;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('userFile')){
				$fileData = $this->upload->data();
				array_push($pr["gambar"], $fileData['file_name']);
			}
		}
		$pr["gambar"] = json_encode($pr["gambar"]);

		$pr["nama"] = $this->input->post("nama");
		print_r($pr);
    	$this->db->where("id", $pr["id"]);
		$this->db->update('pr', $pr);
		redirect("/home/dataPR", "location");
	}

	public function hapusDataPR($id) {
		$this->db->where('id', $id);
		$this->db->delete('pr');
		redirect("/home/dataPR", 'location');
	}

	public function banyakDataPR($record_per_page) {
		$result = $this->db->get('pr')->num_rows();
		$result = ceil((float) $result / $record_per_page);
		echo (int) $result;
	}

	public function loadDataPR($page, $record_per_page) {
		$output = '';
		$start_from = ($page - 1) * $record_per_page;
		$this->db->select('pr.id, pr.id_mata_pelajaran, mata_pelajaran.nama as nama_mata_pelajaran, pr.id_guru, guru.nama as nama_guru, pr.id_kelas, kelas.nama as nama_kelas, pr.deskripsi, pr.gambar, pr.nama');
		$this->db->from('pr');
		$this->db->join('mata_pelajaran', 'pr.id_mata_pelajaran = mata_pelajaran.id');
		$this->db->join('guru', 'pr.id_guru = guru.id');
		$this->db->join('kelas', 'pr.id_kelas = kelas.id');
		$this->db->limit($record_per_page, $start_from);
		$results = $this->db->get()->result();
		$output .= "
			<table class='table table-bordered'>
				<tr>
					<th>Id</th>
					<th>Mata Pelajaran</th>
					<th>Guru</th>
					<th>Kelas</th>
					<th>Deskripsi</th>
					<th>Nama</th>
					<th>Action</th>
				</tr>
		";
		foreach($results as $result) {
			$choosePR = "choosePR('" . $result->id . "','" . $result->nama . "')";
			$output .= "
				<tr>
					<td>$result->id</td>
					<td>$result->nama_mata_pelajaran</td>
					<td>$result->nama_guru</td>
					<td>$result->nama_kelas</td>
					<td>$result->deskripsi</td>
					<td>$result->nama</td>
					<td>
						<button class='btn btn-primary' onclick=\"$choosePR\">Choose</button>
					</td>
				</tr>
			";
		}
		$output .= "</table>";
		echo $output;
	}
	public function dataMateriPelajaran()
	{
		// $data = array(
	  //   "sidebar" => $this->load->view('sidebar', NULL, true),
		// 	"content" => $this->load->view('data_guru', NULL, true)
		// );
		// load db and model
		$this->load->model('MateriPelajaran');

		// init params
		$params = array();
		$limit_per_page = 10;
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->MateriPelajaran->get_total();

		if ($total_records > 0)
		{
				// get current page records
				$params["results"] = $this->MateriPelajaran->get_current_page_records($limit_per_page, $start_index);

				$config['base_url'] = base_url() . 'index.php/home/dataMateriPelajaran';
				$config['total_rows'] = $total_records;
				$config['per_page'] = $limit_per_page;
				$config["uri_segment"] = 3;

				$config['full_tag_open'] = '<div class="pagination">';
				$config['full_tag_close'] = '</div>';

				$config['first_link'] = 'First Page';
				$config['first_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['first_tag_close'] = '</button>';

				$config['last_link'] = 'Last Page';
				$config['last_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['last_tag_close'] = '</button>';

				$config['next_link'] = 'Next Page';
				$config['next_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['next_tag_close'] = '</button>';

				$config['prev_link'] = 'Prev Page';
				$config['prev_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['prev_tag_close'] = '</button>';

				$config['cur_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['cur_tag_close'] = '</button>';

				$config['num_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['num_tag_close'] = '</button>';

				$this->pagination->initialize($config);

				// build paging links
				$params["links"] = $this->pagination->create_links();
		}

		$params["sidebar"] = $this->load->view('sidebar', NULL, true);
		$params["footer"] = $this->load->view('footer', NULL, true);

		$this->load->view('data_materi_pelajaran', $params);
	}

	public function tambahDataMateriPelajaran() {
		$data = array(
	    	"sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true)
		);
		$this->load->view('tambah_data_materi_pelajaran', $data);
	}

	public function tambahDataMateriPelajaranSimpan() {
		$materi_pelajaran["id_mata_pelajaran"] = $this->input->post("id_mata_pelajaran");
		$materi_pelajaran["id_kelas"] = $this->input->post("id_kelas");
		$materi_pelajaran["id_guru"] = $this->input->post("id_guru");
		$materi_pelajaran["deskripsi"] = $this->input->post("deskripsi");
		$materi_pelajaran["gambar"] = array();
		$filesCount = count($_FILES['gambar']['name']);
		for($i = 0; $i < $filesCount; $i++){
			$_FILES['userFile']['name'] = $_FILES['gambar']['name'][$i];
			$_FILES['userFile']['type'] = $_FILES['gambar']['type'][$i];
			$_FILES['userFile']['tmp_name'] = $_FILES['gambar']['tmp_name'][$i];
			$_FILES['userFile']['error'] = $_FILES['gambar']['error'][$i];
			$_FILES['userFile']['size'] = $_FILES['gambar']['size'][$i];

			$uploadPath = './uploads/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = TRUE;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('userFile')){
				$fileData = $this->upload->data();
				array_push($materi_pelajaran["gambar"], $fileData['file_name']);
			}
		}
		$materi_pelajaran["gambar"] = json_encode($materi_pelajaran["gambar"]);

		$materi_pelajaran["nama"] = $this->input->post("nama");
		print_r($materi_pelajaran);
		$this->db->insert("materi_pelajaran", $materi_pelajaran);
		redirect("/home/dataMateriPelajaran", "location");
	}

	public function lihatDataMateriPelajaran($id) {
		$materi_pelajaran = $this->db->query('Select materi_pelajaran.id, materi_pelajaran.id_mata_pelajaran, mata_pelajaran.nama as nama_mata_pelajaran, materi_pelajaran.id_kelas, kelas.nama as nama_kelas, materi_pelajaran.id_guru, guru.nama as nama_guru, materi_pelajaran.deskripsi, materi_pelajaran.gambar, materi_pelajaran.nama
								from materi_pelajaran
								join mata_pelajaran on materi_pelajaran.id_mata_pelajaran = mata_pelajaran.id
								join kelas on materi_pelajaran.id_kelas = kelas.id
								join guru on materi_pelajaran.id_guru = guru.id
								where materi_pelajaran.id = ' . $id)->result();
		$data = array(
	    	"sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true),
			"materi_pelajaran" => $materi_pelajaran
		);
		$this->load->view('lihat_data_materi_pelajaran', $data);
	}

	public function updateDataMateriPelajaran($id) {
		$materi_pelajaran = $this->db->query('Select materi_pelajaran.id, materi_pelajaran.id_mata_pelajaran, mata_pelajaran.nama as nama_mata_pelajaran, materi_pelajaran.id_kelas, kelas.nama as nama_kelas, materi_pelajaran.id_guru, guru.nama as nama_guru, materi_pelajaran.deskripsi, materi_pelajaran.gambar, materi_pelajaran.nama
								from materi_pelajaran
								join mata_pelajaran on materi_pelajaran.id_mata_pelajaran = mata_pelajaran.id
								join kelas on materi_pelajaran.id_kelas = kelas.id
								join guru on materi_pelajaran.id_guru = guru.id
								where materi_pelajaran.id = ' . $id)->result();
		$data = array(
	    	"sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true),
			"materi_pelajaran" => $materi_pelajaran
		);
		$this->load->view('update_data_materi_pelajaran', $data);
	}

	public function updateDataMateriPelajaranSimpan() {
		$materi_pelajaran["id"] = $this->input->post("id");
		$materi_pelajaran["id_mata_pelajaran"] = $this->input->post("id_mata_pelajaran");
		$materi_pelajaran["id_kelas"] = $this->input->post("id_kelas");
		$materi_pelajaran["id_guru"] = $this->input->post("id_guru");
		$materi_pelajaran["deskripsi"] = $this->input->post("deskripsi");
		$materi_pelajaran["gambar"] = array();
		$filesCount = count($_FILES['gambar']['name']);
		for($i = 0; $i < $filesCount; $i++){
			$_FILES['userFile']['name'] = $_FILES['gambar']['name'][$i];
			$_FILES['userFile']['type'] = $_FILES['gambar']['type'][$i];
			$_FILES['userFile']['tmp_name'] = $_FILES['gambar']['tmp_name'][$i];
			$_FILES['userFile']['error'] = $_FILES['gambar']['error'][$i];
			$_FILES['userFile']['size'] = $_FILES['gambar']['size'][$i];

			$uploadPath = './uploads/';
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = TRUE;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('userFile')){
				$fileData = $this->upload->data();
				array_push($materi_pelajaran["gambar"], $fileData['file_name']);
			}
		}
		$materi_pelajaran["gambar"] = json_encode($materi_pelajaran["gambar"]);

		$materi_pelajaran["nama"] = $this->input->post("nama");
		print_r($materi_pelajaran);
    	$this->db->where("id", $materi_pelajaran["id"]);
		$this->db->update('materi_pelajaran', $materi_pelajaran);
		redirect("/home/dataMateriPelajaran", "location");
	}

	public function hapusDataMateriPelajaran($id) {
		$this->db->where('id', $id);
		$this->db->delete('materi_pelajaran');
		redirect("/home/dataMateriPelajaran", 'location');
	}

	public function banyakDataMateriPelajaran($record_per_page) {
		$result = $this->db->get('materi_pelajaran')->num_rows();
		$result = ceil((float) $result / $record_per_page);
		echo (int) $result;
	}

	public function loadDataMateriPelajaran($page, $record_per_page) {
		$output = '';
		$start_from = ($page - 1) * $record_per_page;
		$this->db->select('materi_pelajaran.id, materi_pelajaran.id_mata_pelajaran, mata_pelajaran.nama as nama_mata_pelajaran, materi_pelajaran.id_kelas, kelas.nama as nama_kelas, materi_pelajaran.id_guru, guru.nama as nama_guru, materi_pelajaran.deskripsi, materi_pelajaran.gambar, materi_pelajaran.nama');
		$this->db->from('materi_pelajaran');
		$this->db->join('mata_pelajaran', 'materi_pelajaran.id_mata_pelajaran = mata_pelajaran.id');
		$this->db->join('kelas', 'materi_pelajaran.id_kelas = kelas.id');
		$this->db->join('guru', 'materi_pelajaran.id_guru = guru.id');
		$this->db->limit($record_per_page, $start_from);
		$results = $this->db->get()->result();
		$output .= "
			<table class='table table-bordered'>
				<tr>
					<th>Id</th>
					<th>Mata Pelajaran</th>
					<th>Kelas</th>
					<th>Guru</th>
					<th>Deskripsi</th>
					<th>Nama</th>
					<th>Action</th>
				</tr>
		";
		foreach($results as $result) {
			$chooseMateriPelajaran = "chooseMateriPelajaran('" . $result->id . "','" . $result->nama . "')";
			$output .= "
				<tr>
					<td>$result->id</td>
					<td>$result->nama_mata_pelajaran</td>
					<td>$result->nama_kelas</td>
					<td>$result->nama_guru</td>
					<td>$result->deskripsi</td>
					<td>$result->nama</td>
					<td>
						<button class='btn btn-primary' onclick=\"$chooseMateriPelajaran\">Choose</button>
					</td>
				</tr>
			";
		}
		$output .= "</table>";
		echo $output;
	}
	public function dataJadwalUjian()
	{
		// $data = array(
	  //   "sidebar" => $this->load->view('sidebar', NULL, true),
		// 	"content" => $this->load->view('data_guru', NULL, true)
		// );
		// load db and model
		$this->load->model('JadwalUjian');

		// init params
		$params = array();
		$limit_per_page = 10;
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->JadwalUjian->get_total();

		if ($total_records > 0)
		{
				// get current page records
				$params["results"] = $this->JadwalUjian->get_current_page_records($limit_per_page, $start_index);

				$config['base_url'] = base_url() . 'index.php/home/dataJadwalUjian';
				$config['total_rows'] = $total_records;
				$config['per_page'] = $limit_per_page;
				$config["uri_segment"] = 3;

				$config['full_tag_open'] = '<div class="pagination">';
				$config['full_tag_close'] = '</div>';

				$config['first_link'] = 'First Page';
				$config['first_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['first_tag_close'] = '</button>';

				$config['last_link'] = 'Last Page';
				$config['last_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['last_tag_close'] = '</button>';

				$config['next_link'] = 'Next Page';
				$config['next_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['next_tag_close'] = '</button>';

				$config['prev_link'] = 'Prev Page';
				$config['prev_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['prev_tag_close'] = '</button>';

				$config['cur_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['cur_tag_close'] = '</button>';

				$config['num_tag_open'] = '<button type="button" class="btn btn-default">';
				$config['num_tag_close'] = '</button>';

				$this->pagination->initialize($config);

				// build paging links
				$params["links"] = $this->pagination->create_links();
		}

		$params["sidebar"] = $this->load->view('sidebar', NULL, true);
		$params["footer"] = $this->load->view('footer', NULL, true);

		$this->load->view('data_jadwal_ujian', $params);
	}

	public function tambahDataJadwalUjian() {
		$data = array(
	    	"sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true)
		);
		$this->load->view('tambah_data_jadwal_ujian', $data);
	}

	public function tambahDataJadwalUjianSimpan() {
		$jadwal_ujian["id_judul_ujian"] = $this->input->post("id_judul_ujian");
		$jadwal_ujian["tanggal"] = $this->input->post("tanggal");
		$jadwal_ujian["nama"] = $this->input->post("nama");
		$jadwal_ujian["durasi"] = $this->input->post("durasi");
		print_r($jadwal_ujian);
		$this->db->insert("jadwal_ujian", $jadwal_ujian);
		// redirect("/home/dataJadwalUjian", "location");
	}

	public function lihatDataJadwalUjian($id) {
		$jadwal_ujian = $this->db->query('Select jadwal_ujian.id, jadwal_ujian.id_judul_ujian, judul_ujian.nama as nama_judul_ujian, jadwal_ujian.tanggal, jadwal_ujian.nama, jadwal_ujian.durasi
								from jadwal_ujian
								join judul_ujian on jadwal_ujian.id_judul_ujian = judul_ujian.id
								where jadwal_ujian.id = ' . $id)->result();
		$data = array(
	    	"sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true),
			"jadwal_ujian" => $jadwal_ujian
		);
		$this->load->view('lihat_data_jadwal_ujian', $data);
	}

	public function updateDataJadwalUjian($id) {
		$jadwal_ujian = $this->db->query('Select jadwal_ujian.id, jadwal_ujian.id_judul_ujian, judul_ujian.nama as nama_judul_ujian, jadwal_ujian.tanggal, jadwal_ujian.nama, jadwal_ujian.durasi
								from jadwal_ujian
								join judul_ujian on jadwal_ujian.id_judul_ujian = judul_ujian.id
								where jadwal_ujian.id = ' . $id)->result();
		$data = array(
	    	"sidebar" => $this->load->view('sidebar', NULL, true),
			"footer" => $this->load->view('footer', NULL, true),
			"jadwal_ujian" => $jadwal_ujian
		);
		$this->load->view('update_data_jadwal_ujian', $data);
	}

	public function updateDataJadwalUjianSimpan() {
		$jadwal_ujian["id"] = $this->input->post("id");
		$jadwal_ujian["id_judul_ujian"] = $this->input->post("id_judul_ujian");
		$jadwal_ujian["tanggal"] = $this->input->post("tanggal");
		$jadwal_ujian["nama"] = $this->input->post("nama");
		$jadwal_ujian["durasi"] = $this->input->post("durasi");
		print_r($jadwal_ujian);
    	$this->db->where("id", $jadwal_ujian["id"]);
		$this->db->update('jadwal_ujian', $jadwal_ujian);
		redirect("/home/dataJadwalUjian", "location");
	}

	public function hapusDataJadwalUjian($id) {
		$this->db->where('id', $id);
		$this->db->delete('jadwal_ujian');
		redirect("/home/dataJadwalUjian", 'location');
	}

	public function banyakDataJadwalUjian($record_per_page) {
		$result = $this->db->get('jadwal_ujian')->num_rows();
		$result = ceil((float) $result / $record_per_page);
		echo (int) $result;
	}

	public function loadDataJadwalUjian($page, $record_per_page) {
		$output = '';
		$start_from = ($page - 1) * $record_per_page;
		$this->db->select('jadwal_ujian.id, jadwal_ujian.id_judul_ujian, judul_ujian.nama as nama_judul_ujian, jadwal_ujian.tanggal, jadwal_ujian.nama, jadwal_ujian.durasi');
		$this->db->from('jadwal_ujian');
		$this->db->join('judul_ujian', 'jadwal_ujian.id_judul_ujian = judul_ujian.id');
		$this->db->limit($record_per_page, $start_from);
		$results = $this->db->get()->result();
		$output .= "
			<table class='table table-bordered'>
				<tr>
					<th>Id</th>
					<th>Judul Ujian</th>
					<th>Tanggal</th>
					<th>Nama</th>
					<th>Durasi</th>
					<th>Action</th>
				</tr>
		";
		foreach($results as $result) {
			$chooseJadwalUjian = "chooseJadwalUjian('" . $result->id . "','" . $result->nama . "')";
			$output .= "
				<tr>
					<td>$result->id</td>
					<td>$result->nama_judul_ujian</td>
					<td>$result->tanggal</td>
					<td>$result->nama</td>
					<td>$result->durasi</td>
					<td>
						<button class='btn btn-primary' onclick=\"$chooseJadwalUjian\">Choose</button>
					</td>
				</tr>
			";
		}
		$output .= "</table>";
		echo $output;
	}
}
