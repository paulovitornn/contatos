<?php
namespace Dao;
use \PDO;

class ContatoDao
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
            throw new \RuntimeException('Erro ao conectar ao banco: ' . $e->getMessage());
        }
    }

    public function insert(Contato $contato)
    {
        try {

            $sql = "INSERT INTO contatos (tipo, descricao, id_pessoa) VALUES (?,?,?) ";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(1, $contato->tipoContato);
            $stmt->bindValue(2, $contato->descricao);
            $stmt->bindValue(3, $contato->id_pessoa);

            if ($stmt->execute()) {
                return;
            }
        } catch (\PDOException $e) {
            print_r($stmt->errorInfo());
            throw new \RuntimeException('Erro ao tentar inserir contato: ' . $e->getMessage());
        }
    }

    public function getContatosByIdPessoa($idPessoa)
    {
        try {
            $sql = "SELECT * FROM contatos where id_pessoa = ?";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(1, $idPessoa);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (\PDOException $e) {
            print_r($stmt->errorInfo());
            throw new \RuntimeException('Erro ao tentar buscar dados: ' . $e->getMessage());
        }
    }

    public function deleteContato($id)
    {
        try {
            $sql = "DELETE FROM contatos WHERE id = ?";

            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(1, $id);

            if ($stmt->execute()) {
                return;
            }
        } catch (\PDOException $e) {
            $stmt->errorInfo();
            throw new \RuntimeException('Erro ao deletar contato: ' . $e->getMessage());
        }
    }

    public function deleteTodosContatosByIdPessoa($id_pessoa)
    {
        try {
            $sql = "DELETE FROM contatos WHERE id_pessoa = :id_pessoa";

            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':id_pessoa', $id_pessoa, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return;
            }
        } catch (\PDOException $e) {
            $stmt->errorInfo();
            throw new \RuntimeException('Erro ao deletar contato: ' . $e->getMessage());
        }
    }
}
