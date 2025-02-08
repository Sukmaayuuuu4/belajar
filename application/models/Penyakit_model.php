<?php
class Penyakit_model extends CI_Model {
    public function get_by_id($id) {
        return $this->db->get_where('penyakit', ['id_penyakit' => $id])->row();
    }
}


?>