
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function getUser($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', $password); // Assume passwords are stored as MD5 hashes
        $query = $this->db->get('users'); // 'users' is the table name

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }
    public function getUsersData() {
        $this->db->where('role', 'user');
        $query = $this->db->get('users'); // Assuming your table name is 'users'
        return $query->result();
    }
}
