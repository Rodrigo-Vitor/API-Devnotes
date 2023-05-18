<?php 
require('../config.php');

$method = strtolower($_SERVER["REQUEST_METHOD"]);

if ($method === 'delete') {
    parse_str(file_get_contents('php://input'), $input);
    $id = filter_var($input['id']);

    if($id) {
        $sql = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $sql = $pdo->prepare("DELETE FROM notes WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
            $array['result'] = [
                "message" => "Usuario deletado com sucesso"
            ];
        } else {
            $array['error'] = "Usuario nao identificado";
        }
    }
} else {
    $array['error'] = "Metodo nao permitido (APENAS DELETE)";
}


require('../result.php');

?>