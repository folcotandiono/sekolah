<?php
// models/Users.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Murid extends CI_Model
{
    function __construct()
    {
      parent::__construct();
    }

    public function get_current_page_records($limit, $start)
    {
        $this->db->select('murid.id as id, murid.nama, murid.password, kelas.nama as nama_kelas, murid.nama_ayah, murid.nama_ibu, murid.no_telepon, murid.no_induk');
        $this->db->from('murid');
        $this->db->join('kelas', 'murid.id_kelas = kelas.id');
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
        return $this->db->count_all("murid");
    }
}
