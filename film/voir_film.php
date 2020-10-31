<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/film.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$film = new Film($db);
 
// query film
$stmt = $film->voir_tous();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // film array
    $films_arr=array();
    $films_arr=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $film_item=array(
            "f_id" => $f_id,
            "f_nom" => $f_nom,
            "t_nom" => $t_nom,
            "n_nom" => $n_nom,
            "img" => $img,
            "vid" => $vid,
            "description" => $description,
            "nb_vue" => $nb_vue,
            "date_sortie" => $date_sortie,
            "num_type" => $num_type,
            "num_notation" => $num_notation
        );
 
       	if($f_id!=null){
			array_push($films_arr, $film_item);
		}
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($films_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No film found.")
    );
}