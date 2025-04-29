<?php
require_once "conecta.php";

/* Lógica/Funções para o CRUD de Fabricantes */

// listarFabricantes: usada pela página fabricantes/visualizar.php
function listarFabricantes(PDO $conexao):array {
    $sql = "SELECT * FROM fabricantes ORDER BY nome";

    try {

        /* Preparando o comando SQL ANTES de executar no servidor
        e guardando em memória (variável consulta ou query) */
        $consulta = $conexao->prepare($sql);
        
        /* Executando o comando no banco de dados */
        $consulta->execute();
        
        /* Busca/Retorna todos os dados provenientes da execução da consulta
        e os transforma em um array associativo */
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
      
    } catch (Exception $erro) {
        //  getMessage: puxa a mensagem que aparecer
        die ("ERRO: ".$erro->getMessage());
    }
}

// inserirFabricantes: usada pela pagina fabricantes/inserir.php
// void indica que não tem retorno
function inserirFabricante(PDO $conexao, string $nomeDoFabricante):void {
    // named parameter (paramentro nomeado)
    // usamos este recurso do PDO para 'reservar' um espaço seguro em memoria para colocação de dado. nunca passe de forma direta valores para comandos SQL.
    $sql = "INSERT INTO fabricantes(nome) VALUES (:nome)";

    try {
        $consulta = $conexao->prepare($sql);

        // bindValue() - permite vincular o valor do parametro a consulta que sera execultadad. É necessario indicar qual é o parametro (:nome), de onde vem o valor ($nome DoFabricante) e de que tipo ele é - PDO::PARAM_STR - tratar como string
        $consulta->bindValue(":nome", $nomeDoFabricante, PDO::PARAM_STR);

        $consulta->execute();


    } catch (Exception $erro){
        die("Erro ao inserir: ".$erro->getMessage());
    }
}

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
 
