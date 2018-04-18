<?php
// models/Users.php
defined('BASEPATH') OR exit('No direct script access allowed');

class PR extends CI_Model
{
    function __construct()
    {
      parent::__construct();
    }

    public function get_current_page_records($limit, $start)
    {
        $this->db->select('pr.id, pr.id_mata_pelajaran, mata_pelajaran.nama as nama_mata_pelajaran, pr.deskripsi, pr.gambar, pr.nama');
        $this->db->from('pr');
        $this->db->join('mata_pelajaran', 'pr.id_mata_pelajaran = mata_pelajaran.id');
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
        return $this->db->count_all("pr");
    }
}
