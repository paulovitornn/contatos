<?php
namespace Model;

use Dao\ContatoDao;

class Contato
{
    public $id, $tipoContato, $descricao, $id_pessoa;

    public function salvarContato()
    {
        try {
            $dao = new ContatoDao();
            if (!empty($this->tipoContato) && !empty($this->descricao) && !empty($this->id_pessoa)) {
                $dao->insert($this);
            }
        } catch (\PDOException $e) {
            throw new \RuntimeException('Erro ao salvar contato: ' . $e->getMessage());
        }
    }

    public function getContatosByIdPessoa($id_pessoa)
    {
        try {
            $dao = new ContatoDao();
            $contatos = $dao->getContatosByIdPessoa($id_pessoa);
            return $contatos;
        } catch (\PDOException $e) {
            throw new \RuntimeException('Erro ao obter contatos: ' . $e->getMessage());
        }
    }

    public function deleteContato($id)
    {
        try {
            $dao = new ContatoDao();
            $dao->deleteContato($id);
        } catch (\PDOException $e) {
            throw new \RuntimeException('Erro ao excluir contato: ' . $e->getMessage());
        }
    }

    public function deleteTodosContatosByIdPessoa(int $id_pessoa)
    {
        try {
            $dao = new ContatoDao();
            $dao->deleteTodosContatosByIdPessoa($id_pessoa);
        } catch (\PDOException $e) {
            throw new \RuntimeException('Erro ao excluir contatos: ' . $e->getMessage());
        }
    }
}
