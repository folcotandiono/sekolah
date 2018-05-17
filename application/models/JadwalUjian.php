<?php
// models/Users.php
defined('BASEPATH') OR exit('No direct script access allowed');

class JadwalUjian extends CI_Model
{
    function __construct()
    {
      parent::__construct();
    }

    public function get_current_page_records($limit, $start)
    {
        $this->db->select('jadwal_ujian.id, jadwal_ujian.id_judul_ujian, judul_ujian.nama as nama_judul_ujian, jadwal_ujian.tanggal, jadwal_ujian.nama, jadwal_ujian.durasi');
        $this->db->from('jadwal_ujian');
        $this->db->join('judul_ujian', 'jadwal_ujian.id_judul_ujian = judul_ujian.id');
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
        return $this->db->count_all("jadwal_ujian");
    }
}
