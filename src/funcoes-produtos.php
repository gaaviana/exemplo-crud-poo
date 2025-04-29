<?php
require_once "conecta.php";

function listarProdutos(PDO $conexao):array {
   // $sql = "SELECT * FROM produtos";
  $sql = "SELECT
            produtos.id AS id,
            produtos.nome AS Produto,
            produtos.preco AS 'Preço',
            produtos.quantidade AS Quantidade,
            fabricantes.nome AS Fabricante
        FROM produtos INNER JOIN fabricantes
        ON produtos.fabricante_id = fabricantes.id
        ORDER BY produto";

    try {
        $consulta = $conexao->prepare($sql);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC); 
       } catch (Exception $erro) {
        die("Erro ao excluir fabricante: ".$erro->getMessage());
    }
};

function inserirProduto(
    PDO $conexao,string $nome,float $preco,int $quantidade,int $idFabricante,string $descricao):void {
        
    $sql = 'INSERT INTO produtos(nome, preco, quantidade, fabricante_id, descricao) VALUES (:nome, :preco, :quantidade, :fabricante_id,:descricao)';
    
    try {
        $consulta = $conexao->prepare($sql);

        $consulta->bindValue(":nome", $nome, PDO::PARAM_STR_CHAR);
        $consulta->bindValue(":preco", $preco, PDO::PARAM_STR);
        $consulta->bindValue(":quantidade", $quantidade, PDO::PARAM_INT);
        $consulta->bindValue(":fabricante_id", $idFabricante, PDO::PARAM_INT);
        $consulta->bindValue(":descricao", $descricao, PDO::PARAM_STR_CHAR);

        $consulta->execute();
        
    } catch (Exception $erro){
        die("Erro ao inserir: ".$erro->getMessage());
    }
}

function listarUmProduto(PDO $conexao, int $idProduto):array {
    $sql = "SELECT * FROM produtos WHERE id = :id";

    try {
        $consulta = $conexao->prepare($sql);

        $consulta->bindValue(":id", $idProduto, PDO::PARAM_INT);

        $consulta->execute();

        // usamos o fetch para garantir o retotno de um unico array associativo com o resultado
        return $consulta-> fetch(PDO::FETCH_ASSOC);

    } catch (Exception $erro) {
        die("Erro ao carregar fabricante: ".$erro->getMessage());
    }
}

// function listarUmProduto(PDO $conexao, int $idProduto): array {
//    $sql = "SELECT produtos.*, 
//            fabricantes.nome AS Fabricante 
//           FROM produtos INNER JOIN fabricantes 
//            ON produtos.fabricante_id = fabricantes.id 
//            WHERE produtos.id = :id";
//
//    try {
//        $consulta = $conexao->prepare($sql);
//
           // Associa o parâmetro :id com o valor de $idProduto
//       $consulta->bindValue(":id", $idProduto, PDO::PARAM_INT);

            // Executa a consulta
//       $consulta->execute();

        // Retorna o resultado da consulta como um array associativo
//        return $consulta->fetch(PDO::FETCH_ASSOC);

//    } catch (Exception $erro) {
        // Em caso de erro, exibe a mensagem de erro
//        die("Erro ao carregar produto e fabricante: ".$erro->getMessage());
//    }
//}

function atualizarProduto (PDO $conexao,string $nome,float $preco,int $quantidade,int $idFabricante,string $descricao, int $idProduto):void {
    $sql = "UPDATE produtos SET nome = :nome, preco = :preco, quantidade = :quantidade, fabricante_id = :fabricante_id, descricao = :descricao WHERE id = :id";

    try {
        $consulta = $conexao->prepare($sql);

        $consulta->bindValue(":nome", $nome, PDO::PARAM_STR_CHAR);
        $consulta->bindValue(":preco", $preco, PDO::PARAM_STR);
        $consulta->bindValue(":quantidade", $quantidade, PDO::PARAM_INT);
        $consulta->bindValue(":fabricante_id", $idFabricante, PDO::PARAM_INT);
        $consulta->bindValue(":descricao", $descricao, PDO::PARAM_STR_CHAR);
        $consulta->bindValue(":id", $idProduto, PDO::PARAM_INT);

        $consulta->execute();

    } catch (Exception $erro) {
        die("Erro ao carregar fabricante: ".$erro->getMessage());
    }
}


function excluirProduto(PDO $conexao, int $idProduto):void {
    $sql = "DELETE FROM produtos WHERE id = :id";

    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":id", $idProduto, PDO::PARAM_INT);
        $consulta->execute();
 
    } catch (Exception $erro) {
        die("Erro ao excluir fabricante: ".$erro->getMessage());
    }
}

