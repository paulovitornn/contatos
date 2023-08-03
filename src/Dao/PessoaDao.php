<?php
namespace Dao;

use PDO;
use Model\Pessoa;

class PessoaDao
{
    private $con;

    public function __construct()
    {
        try {
            
            //acesso local
            /* $dsn = "mysql:host=localhost:3306;dbname=db_contatos";
            $this->con = new PDO($dsn, 'root', '2023mysql'); */

            //acesso heroku
            /* user: bb860a0b20798f
            password: fd26b3e8
            host: us-cdbr-east-06.cleardb.net
            banco de dados: heroku_d3d35dbad5afa2a */
            $dsn = "mysql:host=us-cdbr-east-06.cleardb.net:3306;dbname=heroku_d3d35dbad5afa2a";
            $this->con = new PDO($dsn, 'bb860a0b20798f', 'fd26b3e8');
        } catch (\PDOException $e) {
            throw new \PDOException('Erro ao conectar ao banco: ' . $e->getMessage());
        }
    }

    public function insert(Pessoa $pessoa)
    {
        try {
            $sql = "INSERT INTO pessoa (nome) VALUES (:nome) ";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':nome', $pessoa->nome);
    
            if ($stmt->execute()) {
                return (int) $this->con->lastInsertId();
            }

        } catch (\PDOException $e) {
            $stmt->errorInfo();
            throw new \PDOException('Erro ao alterar pessoa: ' . $e->getMessage());
        }
    }

    public function update(Pessoa $pessoa)
    {
        try {
            $sql = "UPDATE pessoa SET nome = :nome WHERE id = :id";
    
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':nome', $pessoa->nome, PDO::PARAM_INT);
            $stmt->bindValue(':id', $pessoa->id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->execute()) {
                return (int) $pessoa->id;
            }

        } catch (\PDOException $e) {
            $stmt->errorInfo();
            throw new \PDOException('Erro ao alterar pessoa: ' . $e->getMessage());
        }
    }

    public function listaPessoasContatos()
    {
        try {
            $sql = "SELECT * FROM pessoa";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_CLASS);
        } catch (\PDOException $e) {
            $stmt->errorInfo();
            throw new \PDOException('Erro ao buscar pessoas: ' . $e->getMessage());
        }
    }

    public function pessoaById($id)
    {
        try {
            $sql = "SELECT * FROM pessoa where id = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchObject(Pessoa::class);
        } catch (\PDOException $e) {
            $stmt->errorInfo();
            throw new \PDOException('Erro ao buscar pessoa: ' . $e->getMessage());
        }
    }

    public function deletePessoa($id)
    {
        try {
            $sql = "DELETE FROM pessoa WHERE id = :id";

            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return;
            }
        } catch (\PDOException $e) {
            $stmt->errorInfo();
            throw new \PDOException('Erro ao deletar pessoa: ' . $e->getMessage());
        }
    }
}
