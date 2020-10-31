<?php
class Film{
 
    // database connection and table name
    private $conn;
    private $table_name = "film";
 
    // object properties
    public $f_id;
    public $f_nom;
    public $t_nom;
    public $n_nom;
    public $img;
    public $vid;
    public $description;
    public $nb_vue;
    public $date_sortie;
    public $num_type;
    public $num_notation;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    //used by select drop-down list
    public function voir_tous(){
        //select all data
        $query = "SELECT f_id,f_nom,img,vid,description,nb_vue,date_sortie,num_type,t_nom,num_notation,n_nom
            FROM film
             JOIN notation ON film.num_notation = notation.n_id
             JOIN type ON film.num_type = type.t_id";
 
        $stmt = $this->conn->prepare( $query );

        $stmt->execute();
 
        return $stmt;
    }
    
	//function to see data of a film by his id which we ll need when we wanna see more details of the film like his trailer for example
	function voir_un_seul_id(){
 
		// query to read single record
		$query = "SELECT f_id,f_nom,img,vid,description,nb_vue,date_sortie,num_type,t_nom,num_notation,n_nom
            FROM film
             JOIN notation ON film.num_notation = notation.n_id
             JOIN type ON film.num_type = type.t_id WHERE f_id = ?";
 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
 
		// bind id of film to be updated
		$stmt->bindParam(1, $this->f_id);
        
		// execute query
		$stmt->execute();
		
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
 
		// set values to object properties
		$this->f_id = $row['f_id'];
		$this->f_nom = $row['f_nom'];
		$this->img = $row['img'];
		$this->vid = $row['vid'];
		$this->description = $row['description'];
		$this->nb_vue = $row['nb_vue'];
		$this->date_sortie = $row['date_sortie'];
		$this->num_type = $row['num_type'];
		$this->t_nom = $row['t_nom'];
		$this->num_notation = $row['num_notation'];
		$this->n_nom = $row['n_nom'];
	}
	////function to see data of a film by his name which we ll need when we use the search on html
	function voir_un_seul(){
 
		// query to read single record
		$query = "SELECT f_id,f_nom,img,vid,description,nb_vue,date_sortie,num_type,t_nom,num_notation,n_nom
            FROM film
             JOIN notation ON film.num_notation = notation.n_id
             JOIN type ON film.num_type = type.t_id WHERE f_nom = ?";
 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
 
		// bind name of film to be updated
		$stmt->bindParam(1, $this->f_nom);

        
		// execute query
		$stmt->execute();
		
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
 
		// set values to object properties
		$this->f_id = $row['f_id'];
		$this->f_nom = $row['f_nom'];
		$this->img = $row['img'];
		$this->vid = $row['vid'];
		$this->description = $row['description'];
		$this->nb_vue = $row['nb_vue'];
		$this->date_sortie = $row['date_sortie'];
		$this->num_type = $row['num_type'];
		$this->t_nom = $row['t_nom'];
		$this->num_notation = $row['num_notation'];
		$this->n_nom = $row['n_nom'];
	}
	function voir_tous_type(){
         //select all data
        $query = "SELECT f_id,f_nom,img,vid,description,nb_vue,date_sortie,num_type,t_nom,num_notation,n_nom
            FROM film
             JOIN notation ON film.num_notation = notation.n_id
             JOIN type ON film.num_type = type.t_id WHERE t_nom = ?";
 
        $stmt = $this->conn->prepare( $query );
	    // bind name of type to be updated
		$stmt->bindParam(1, $this->t_nom);

        $stmt->execute();
 
        return $stmt;
	}
}
?>