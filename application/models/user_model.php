<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function add_user($data)
    {
        return $this->db->insert('tbl_users', $data);
    }

    public function check_email($email)
    {
        $this->db->from('tbl_users');
        $this->db->where('email', $email);
        $query = $this->db->get();

//        print_r($query->result());

        if(count($query->result()) > 0) {
            return true;
        }

        return false;
    }

    public function check_user_by_hash($hash)
    {
        $this->db->from('tbl_users');
        $this->db->where('hash', $hash);
        $query = $this->db->get();

//        print_r($query->result());

        if(count($query->result()) > 0) {
            return true;
        }

        return false;
    }

    public function update_user_by_hash($data, $hash)
    {
        $this->db->where('hash', $hash);
        return $this->db->update('tbl_users', $data);
    }
}