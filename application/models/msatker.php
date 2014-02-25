<?php

class MSatker extends Model {

    function MSatker() {
        parent::Model();
    }

    function getAllSatkerPagination($perPage, $uri) {
        $data = array();
        $this->db->select('*');
        $this->db->from('tbl_ref_bagian');
        $this->db->order_by('bagian');
        $getData = $this->db->get('', $perPage, $uri);
        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
    }

    function SearchResult($perPage, $uri, $isi) {
        $this->db->select('*');
        $this->db->from('tbl_ref_bagian');
        if (!empty($isi)) {
            $this->db->like('bagian', $isi);
        }
        $this->db->order_by('kode_bagian', 'asc');
        $getData = $this->db->get('', $perPage, $uri);

        if ($getData->num_rows() > 0)
            return $getData->result_array();
        else
            return null;
    }

}
?>