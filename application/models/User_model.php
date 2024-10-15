
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
    // Function to delete a row by ID
    public function deleteRowById($id) {
        $this->db->where('id', $id); // Replace 'id' with your primary key column
        return $this->db->delete('waterqualitydata');
    }
    public function getUsersData() {
        $this->db->where('role', 'user');
        $query = $this->db->get('users'); // Assuming your table name is 'users'
        return $query->result();
    }
    // New function to get branch details
    public function getBranchDetails($username) {
        $this->db->select('branchID, branchName');
        $this->db->where('username', $username);
        $query = $this->db->get('users'); // Assuming the table name is 'branches'

        return $query->row();
    }
    public function getWaterQuality() {
        $this->db->select('branchID, branchName, date, time, id, formNo, dataInsertedDate');
        $this->db->from('waterqualitydata');
        $this->db->order_by('date', 'DESC'); // Order by date in descending order
        $this->db->limit(1000);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->result(); // Return all rows
        } else {
            return false; // Return false if no rows are found
        }
    }
    public function getFormData($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('waterqualitydata');
        return $query->row();
    }
}
