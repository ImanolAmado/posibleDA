
<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos de la solicitud POST
    $input = json_decode(file_get_contents('php://input'), false);

    
    var_dump($input);   
    
}
    
    
?>
