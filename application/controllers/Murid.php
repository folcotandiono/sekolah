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
        $this->db->from('murid');
        $this->db->where('id', $id);
        $this->db->where('password', $password);
        $result = $this->db->get()->result();

        $message = array("list_murid" => $result);

        $this->response($message, 200);
    }
}