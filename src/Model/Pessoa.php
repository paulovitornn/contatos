<?php
namespace Model;

use Dao\PessoaDao;
use Dao\ContatoDao;

class Pessoa
{
    public $id, $nome;
    public $contatos = [];

    public function salvarPessoa()
    {
        try {
            $dao = new PessoaDao();

            if (empty($this->id)) {
                $idPessoa = $dao->insert($this);
                return $idPessoa;
            } else {
                $idPessoa = $dao->update($this);
                return $idPessoa;
            }
        } catch (\PDOException $e) {
            throw new \RuntimeException('Erro ao salvar contato: ' . $e->getMessage());
        }
    }

    public function getAllPessoas()
    {
        try {
            $dao = new PessoaDao();
            return $dao->listaPessoasContatos();
        } catch (\PDOException $e) {
            throw new \RuntimeException('Erro ao obter contatos: ' . $e->getMessage());
        }
    }

    public function getPessoaById($id)
    {
        try {
            $dao = new PessoaDao();
            $pessoa =  $dao->pessoaById($id);
            return ($pessoa) ? $pessoa : false;
        } catch (\PDOException $e) {
            throw new \RuntimeException('Erro ao obter pessoa: ' . $e->getMessage());
        }
    }

    public function deletePessoa($id)
    {
        try {
            $pDao = new PessoaDao();
            $cDao = new ContatoDao();
            $cDao->deleteTodosContatosByIdPessoa($id);
            $pDao->deletePessoa($id);
        } catch (\PDOException $e) {
            throw new \RuntimeException('Erro ao excluir pessoa: ' . $e->getMessage());
        }
    }
}
