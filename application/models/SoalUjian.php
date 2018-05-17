<?php
// models/Users.php
defined('BASEPATH') OR exit('No direct script access allowed');

class SoalUjian extends CI_Model
{
    function __construct()
    {
      parent::__construct();
    }

    public function get_current_page_records($limit, $start)
    {
        $this->db->select('soal_ujian.id, judul_ujian.nama as nama_judul_ujian, jenis_soal_ujian.nama as nama_jenis_soal_ujian, soal_ujian.soal_tulisan');
        $this->db->from('soal_ujian');
        $this->db->join('judul_ujian', 'soal_ujian.id_judul_ujian = judul_ujian.id');
        $this->db->join('jenis_soal_ujian', 'soal_ujian.id_jenis_soal_ujian = jenis_soal_ujian.id');
        $this->db->limit($limit, $start);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function get_total()
    {
        return $this->db->count_all("soal_ujian");
    }
}
