<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/film.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare film object
$film = new Film($db);
 
// set Name property of record to read
$film->f_nom = isset($_GET['f_nom']) ? $_GET['f_nom'] : die();

// read the details of film to be edited
$film->voir_un_seul();
 
if($film->f_nom!=null){
    // create array
    $film_arr = array(
        "f_id" =>  $film->f_id,
        "f_nom" => $film->f_nom,
        "img" => $film->img,
        "vid" => $film->vid,
        "description" => $film->description,
        "nb_vue" => $film->nb_vue,
        "date_sortie" => $film->date_sortie,
        "num_type" => $film->num_type,
        "t_nom" => $film->t_nom,
        "num_notation" => $film->num_notation,
        "n_nom" => $film->n_nom
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($film_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user film does not exist
    echo json_encode(array("message" => "the film does not exist."));
}
?>