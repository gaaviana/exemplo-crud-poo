<?php

namespace ExemploCrud\Services;

use Exception;
use ExemploCrud\Database\ConexaoBD;
use ExemploCrud\Models\Produto;
use PDO;
use Throwable;

final class ProdutoServico
{
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = ConexaoBD::getConexao();
    }

    public function listarTodos(): array
    {
        $sql = "SELECT
            produtos.id AS id,
            produtos.nome AS produto,
            produtos.preco AS preco,
            produtos.quantidade AS quantidade,
            fabricantes.nome AS fabricante
        FROM produtos INNER JOIN fabricantes
        ON produtos.fabricante_id = fabricantes.id
        ORDER BY produto";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $erro) {
            throw new Exception("Error: " . $erro->getMessage());
        }
    }

    public function inserir(Produto $produto): void
    {
        $sql = 'INSERT INTO produtos(nome, preco, quantidade, fabricante_id, descricao) VALUES (:nome, :preco, :quantidade, :fabricante_id,:descricao)';

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $produto->getNome());
            $consulta->bindValue(":preco", $produto->getPreco());
            $consulta->bindValue(":quantidade", $produto->getQuantidade());
            $consulta->bindValue(":fabricante_id", $produto->getFabricanteId());
            $consulta->bindValue(":descricao", $produto->getDescricao());
            $consulta->execute();
        } catch (Throwable $erro) {
            throw new Exception("Erro: " . $erro->getMessage());
        }
    }

    public function buscarPorId(int $id): ?array
    {
        $sql = "SELECT * FROM produtos WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);

            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();

            return $consulta->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (Throwable $erro) {
            throw new Exception("Erro ao carregar fabricante: " . $erro->getMessage());
        }
    }

    public function atualizar(Produto $produto): void
    {
        $sql = "UPDATE fabricantes SET nome = :nome WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);

            $consulta->bindValue(":nome", $produto->getNome());
            $consulta->bindValue(":preco", $produto->getPreco());
            $consulta->bindValue(":quantidade", $produto->getQuantidade());
            $consulta->bindValue(":fabricante_id", $produto->getFabricanteId());
            $consulta->bindValue(":descricao", $produto->getDescricao());

            $consulta->execute();
        } catch (Throwable $erro) {
            throw new Exception("Error Processing Request", 1);
            ("Erro ao carregar fabricante: " . $erro->getMessage());
        }
    }
}
