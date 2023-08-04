# Slim Framework 3 Skeleton Application

Use this skeleton application to quickly setup and start working on a new Slim Framework 3 application. This application uses the latest Slim 3 with the PHP-View template renderer. It also uses the Monolog logger.

This skeleton application was built for Composer. This makes setting up a new Slim Framework application quick and easy.

## Install the Application

Run this command from the directory in which you want to install your new Slim Framework application.

    php composer.phar create-project slim/slim-skeleton [my-app-name]

Replace `[my-app-name]` with the desired directory name for your new application. You'll want to:

* Point your virtual host document root to your new application's `public/` directory.
* Ensure `logs/` is web writeable.

To run the application in development, you can run these commands 

	cd [contatos]
	php composer.phar start
	
Or you can use `docker-compose` to run the app with `docker`, so you can run these commands:

         cd [contatos]
	 docker-compose up -d
After that, open `http://0.0.0.0:8080` in your browser.

Run this command in the application directory to run the test suite

	php composer.phar test

That's it! Now go build something cool.

----------------------------------------------
# Projeto para teste técnico utilizando PHP e MySql

Esta aplicação funciona como uma agenda, onde pode-se armazenar "N" pessoas e para cada uma dessas pessoas "N" contatos.

Banco de dados hospedado pelo serviço em nuvem da plataforma heroku.

<p align="center">
  <img src="bd_contato_modelo_relacional.png" alt="doc" width="200"/>
</p>

Os scripts para criação das tabelas e uma primeira alimentação das mesmas está dentro da pasta "bancodedados" na raiz do projeto.

Foi utilizado o framework slim 3.1 para implementação das rotas entre as paginas e também entre as funcionalidades.

Projeto foi implementado usando PHP 5.6

Para instalação e execução do projeto, é necessário ter a mesma versão do PHP instalada e também o composer instalado.

Com ambos instalados, segue o passo a passo para deixar o projeto rodando:

```bash
# clone o repository
$ git clone https://github.com/paulovitornn/contatos.git

# com o composer já instalado na sua maquina vá para a pasta raiz do projeto e execute (pelo prompt)
$ composer install

# apos finalizar a instalação dos pacotes no projeto rode o seguinte comando (pelo prompt)
$ composer start

# na tela do prompt mostrará o endereço local para acessar o projeto.
```


