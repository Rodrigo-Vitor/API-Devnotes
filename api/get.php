<?php 
require('../config.php');

$id = filter_input(INPUT_GET, 'id');
$method = strtolower($_SERVER["REQUEST_METHOD"]);

if($id) {
    if ($method === "get") {
        $sql = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sql->bindValue("id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            $data = $sql->fetch( PDO::FETCH_ASSOC );
            $array["result"][] = [
                "id" => $data["id"],
                "title" => $data["title"]
            ];
        } else {
            $array["error"] = "Usuario nao encontrado";
        }
    } else {
        $array["error"] = "Somente metodo GET e suportado";
    }
}


require("../result.php");
?>