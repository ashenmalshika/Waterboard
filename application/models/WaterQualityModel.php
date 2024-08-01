<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WaterQualityModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insertWaterquality($data) {
        return $this->db->insert('waterqualitydata', $data);
    }
}
