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
      $this->db->select('mata_pelajaran.id, mata_pelajaran.nama, tahun_ajaran.tahun');
      $this->db->from('mata_pelajaran');
      $this->db->join('tahun_ajaran', 'mata_pelajaran.id_tahun_ajaran = tahun_ajaran.id');
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
