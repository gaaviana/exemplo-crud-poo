<?php
require_once "conecta.php";


// listarUmFabricante: usada pela pagina fabricantes/atualizar.php
function listarUmFabricante(PDO $conexao, int $idFabricante):array {
    $sql = "SELECT * FROM fabricantes WHERE id = :id";

    try {
        $consulta = $conexao->prepare($sql);

        $consulta->bindValue(":id", $idFabricante, PDO::PARAM_INT);

        $consulta->execute();

        // usamos o fetch para garantir o retotno de um unico array associativo com o resultado
        return $consulta-> fetch(PDO::FETCH_ASSOC);

    } catch (Exception $erro) {
        die("Erro ao carregar fabricante: ".$erro->getMessage());
    }
}

function atualizarFabricante(PDO $conexao, string $nomeDoFabricante, int $idFabricante):void {
    $sql = "UPDATE fabricantes SET nome = :nome WHERE id = :id";

    try {
        $consulta = $conexao->prepare($sql);

        $consulta->bindValue(":nome", $nomeDoFabricante, PDO::PARAM_STR_CHAR);  
        $consulta->bindValue(":id", $idFabricante, PDO::PARAM_INT);

        $consulta->execute();

    } catch (Exception $erro) {
        die("Erro ao carregar fabricante: ".$erro->getMessage());
    }
}

function excluirFabricante(PDO $conexao, int $idFabricante):void{
    $sql = "DELETE FROM fabricantes WHERE id = :id";
 
    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":id", $idFabricante, PDO::PARAM_INT);
        $consulta->execute();
 
    } catch (Exception $erro) {
        die("Erro ao excluir fabricante: ".$erro->getMessage());
    }
}
 
