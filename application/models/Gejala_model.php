<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gejala_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function get_all() {
        return $this->db->get('gejala')->result();
    }


}

?>