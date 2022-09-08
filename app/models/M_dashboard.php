<?php 

class M_dashboard {

    private $table = 'Gambar';
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function getGambar()
    {
         
        $this->db->query('SELECT *FROM '.$this->table);
        return $this->db->resultSet();
    }
    public function saveImg($data)
    {
        $query = "INSERT INTO ".$this->table." VALUES (:id,:img)";
        $this->db->query($query);
        $this->db->bind('id',$data['id']);
        $this->db->bind('img',$data['gambar']);
        $this->db->execute();
    }
}