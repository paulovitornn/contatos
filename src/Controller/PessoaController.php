<?php

namespace Controller;

use Model\Contato;
use Model\Pessoa;
use Slim\App;

class PessoaController
{

    public function listarContatos()
    {
        try { //View/Contatos/ListaContato.php
            $listaPessoas = new Pessoa();
            return $listaPessoas->getAllPessoas();
        } catch (\Exception $e) {
            throw new \Exception('Erro ao gerar lista de pessoas: ' . $e->getMessage());
        }
    }

    public static function retornaPessoa($id)
    {
        try {
            if(!$id){
                return false;
            }
            $pessoa = new Pessoa();
            $contato = new Contato();
            $pessoa = $pessoa->getPessoaById($id);
            if(!$pessoa){
                return false;
            };
            $pessoa->contatos = $contato->getContatosByIdPessoa($id);
            return $pessoa;
        } catch (\Exception $e) {
            throw new \Exception('Erro ao tentar cadastrar pessoa: ' . $e->getMessage());
        }
    }

    public static function savePessoa()
    {
        try {
            $pessoa = new Pessoa();

            $pessoa->id =  $_POST['id'];
            $pessoa->nome = $_POST['nome'];

            $idPessoa =  $pessoa->salvarPessoa();

            header("Location: /cadastrarPessoa?id=" . $idPessoa);
        } catch (\PDOException $e) {
            throw new \RuntimeException('Erro ao tentar cadastrar pessoa: ' . $e->getMessage());
        }
    }

    public static function deletePessoa()
    {
        try {
            $pessoa = new Pessoa();
            $pessoa->deletePessoa((int) $_GET['id']);

            header("Location: /listarContatos");
        } catch (\PDOException $e) {
            throw new \RuntimeException('Erro ao tentar excluir pessoa: ' . $e->getMessage());
        }
    }

    public static function salvarContato()
    {
        try {
            $contato = new Contato();
            $contato->tipoContato = $_POST['tipoContato'];
            $contato->descricao = $_POST['descrContato'];
            $contato->id_pessoa = $_POST['id_pessoa'];
            $contato->salvarContato();
            header("Location: /cadastrarPessoa?id=" . $contato->id_pessoa);
        } catch (\PDOException $e) {
            throw new \RuntimeException('Erro ao tentar salvar contato: ' . $e->getMessage());
        }
    }

    public static function deleteContato()
    {
        try {
            $contato = new Contato();
            $contato->deleteContato((int) $_GET['id']);

            header("Location: /cadastrarPessoa?id=" . $_GET['id_pessoa']);
        } catch (\PDOException $e) {
            throw new \RuntimeException('Erro ao tentar excluir contato: ' . $e->getMessage());
        }
    }
}
