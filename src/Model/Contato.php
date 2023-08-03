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
        } catch (\Exception $e) {
            throw new \Exception('Erro ao salvar contato: ' . $e->getMessage());
        }
    }

    public function getContatosByIdPessoa($id_pessoa)
    {
        try {
            $dao = new ContatoDao();
            $contatos = $dao->getContatosByIdPessoa($id_pessoa);
            return $contatos;
        } catch (\Exception $e) {
            throw new \Exception('Erro ao obter contatos: ' . $e->getMessage());
        }
    }

    public function deleteContato($id)
    {
        try {
            $dao = new ContatoDao();
            $dao->deleteContato($id);
        } catch (\Exception $e) {
            throw new \Exception('Erro ao excluir contato: ' . $e->getMessage());
        }
    }

    public function deleteTodosContatosByIdPessoa(int $id_pessoa)
    {
        try {
            $dao = new ContatoDao();
            $dao->deleteTodosContatosByIdPessoa($id_pessoa);
        } catch (\Exception $e) {
            throw new \Exception('Erro ao excluir contatos: ' . $e->getMessage());
        }
    }
}
