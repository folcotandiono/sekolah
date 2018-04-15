<?php
// models/Users.php
defined('BASEPATH') OR exit('No direct script access allowed');

class MataPelajaran extends CI_Model
{
    function __construct()
    {
      parent::__construct();
    }

    public function get_current_page_records($limit, $start)
    {
      $this->db->select('mata_pelajaran.id, mata_pelajaran.nama, kelas.nama as kelas, guru.nama as guru');
      $this->db->from('mata_pelajaran');
      $this->db->join('kelas', 'mata_pelajaran.id_kelas = kelas.id');
      $this->db->join('guru', 'mata_pelajaran.id_guru = guru.id');
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
        return $this->db->count_all("mata_pelajaran");
    }
}
