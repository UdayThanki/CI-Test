<?php
class User extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function login($userName = null, $password)
    {
        $this->db->select("*");
        $whereCondition = $array = array('email' => $userName, 'password' => $password);
        $this->db->where($whereCondition);
        $this->db->from('login');
        $query = $this->db->get();
        print_r($query->result());

        return $query->result();
    }

}
