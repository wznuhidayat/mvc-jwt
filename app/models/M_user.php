<?php 

class M_user {

    private $table = 'Users';
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function getUser()
    {
         
        $this->db->query('SELECT *FROM '.$this->table);
        return $this->db->resultSet();
    }
}