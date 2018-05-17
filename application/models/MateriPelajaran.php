<?php
// models/Users.php
defined('BASEPATH') OR exit('No direct script access allowed');

class MateriPelajaran extends CI_Model
{
    function __construct()
    {
      parent::__construct();
    }

    public function get_current_page_records($limit, $start)
    {
        $this->db->select('materi_pelajaran.id, materi_pelajaran.id_mata_pelajaran, mata_pelajaran.nama as nama_mata_pelajaran, materi_pelajaran.id_kelas, kelas.nama as nama_kelas, materi_pelajaran.id_guru, guru.nama as nama_guru, materi_pelajaran.deskripsi, materi_pelajaran.gambar, materi_pelajaran.nama');
        $this->db->from('materi_pelajaran');
        $this->db->join('mata_pelajaran', 'materi_pelajaran.id_mata_pelajaran = mata_pelajaran.id');
        $this->db->join('kelas', 'materi_pelajaran.id_kelas = kelas.id');
        $this->db->join('guru', 'materi_pelajaran.id_guru = guru.id');
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
        return $this->db->count_all("materi_pelajaran");
    }
}
