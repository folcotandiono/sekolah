<?php
// models/Users.php
defined('BASEPATH') OR exit('No direct script access allowed');

class JudulUjian extends CI_Model
{
    function __construct()
    {
      parent::__construct();
    }

    public function get_current_page_records($limit, $start)
    {
        $this->db->select('judul_ujian.id, mata_pelajaran.nama as mata_pelajaran, guru.nama as nama_guru, kelas.nama as nama_kelas, judul_ujian.nama');
        $this->db->from('judul_ujian');
        $this->db->join('mata_pelajaran', 'judul_ujian.id_mata_pelajaran = mata_pelajaran.id');
        $this->db->join('guru', 'judul_ujian.id_guru = guru.id');
        $this->db->join('kelas', 'judul_ujian.id_kelas = kelas.id');
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
        return $this->db->count_all("judul_ujian");
    }
}
