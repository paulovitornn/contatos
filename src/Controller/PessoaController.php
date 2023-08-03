<?php

namespace Controller;

use Model\Contato;
use Model\Pessoa;
use Slim\App;

class PessoaController
{

    public function listarContatos()
    {
        try { 
            $listaPessoas = new Pessoa();
            return $listaPessoas->getAllPessoas();
        } catch (\Exception $e) {
            throw new \Exception('Erro ao gerar lista de pessoas: ' . $e->getMessage());
        }
    }

    public function retornaPessoa($id)
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

    public function salvarPessoa(\stdClass $params)
    {
        try {
            $pessoa = new Pessoa();
            
            if(property_exists($params, 'id')){
                $pessoa->id =  $params->id;
            }
            $pessoa->nome = $params->nome;

            return $pessoa->salvarPessoa($pessoa);
            
        } catch (\Exception $e) {
            throw new \Exception('Erro ao tentar cadastrar pessoa: ' . $e->getMessage());
        }
    }

    public function excluirPessoa($id)
    {
        try {
            $pessoa = new Pessoa();
            $pessoa->deletePessoa($id);
        } catch (\Exception $e) {
            throw new \Exception('Erro ao tentar excluir pessoa: ' . $e->getMessage());
        }
    }

    public function salvarContato(\stdClass $params)
    {
        try {
            $contato = new Contato();
            $contato->tipoContato = $params->tipoContato;
            $contato->descricao = $params->descrContato;
            $contato->id_pessoa = $params->id_pessoa;
            $contato->salvarContato();
            return $contato->id_pessoa;
        } catch (\Exception $e) {
            throw new \Exception('Erro ao tentar salvar contato: ' . $e->getMessage());
        }
    }

    public function excluirContato($id)
    {
        try {
            $contato = new Contato();
            $contato->deleteContato($id);
        } catch (\Exception $e) {
            throw new \Exception('Erro ao tentar excluir contato: ' . $e->getMessage());
        }
    }
}
