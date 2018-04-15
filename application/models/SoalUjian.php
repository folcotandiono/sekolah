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
        $this->db->select('soal_ujian.id, mata_pelajaran.nama as mata_pelajaran, soal_ujian.nama');
        $this->db->from('soal_ujian');
        $this->db->join('mata_pelajaran', 'soal_ujian.id_mata_pelajaran = mata_pelajaran.id');
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
