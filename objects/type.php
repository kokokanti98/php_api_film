<?php
class Type{
 
    // database connection and table name
    private $conn;
    private $table_name = "type";
 
    // object properties
    public $t_id;
    public $t_nom;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    public function voir_tous(){
        //select all data
        $query = "SELECT t_id, t_nom FROM type";
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }
}
?>