# Página de Contato ~ Fabio Cabral
[![php 7.3](https://img.shields.io/badge/PHP-7.3-blueviolet.svg)](https://shields.io/)
[![Laravel 8.0](https://img.shields.io/badge/Laravel-8.0-red.svg)](https://shields.io/)
[![Vue 2.0](https://img.shields.io/badge/Vue.js-2.0-green.svg)](https://shields.io/)
![](https://github.com/spatie/laravel-permission/workflows/Run%20Tests/badge.svg?branch=master)
[![Build with PHPStorm](https://img.shields.io/badge/Build_in-PHPStorm-blue.svg)](https://shields.io/)

> Teste técnico para programador PHP na [netShow.me](https://netshow.me/)

<p align="center"><a href="https://netshow.me/" target="_blank"><img src="./public/images/logo.svg" width="400" alt="netShow.me"></a></p> 

## Requisitos

* Git
* Composer
* Node.js
* NPM
* PHP >= 7.3
* MySQL Serve >= 5.6 (recomendo 8.0)
* Extensão Fileinfo PHP
* Extensão JSON PHP
* Extensão PHP Mbstring
* Extensão PDO PHP

## Instalação

### 1. Banco de Dados

Com MySQL instalado, crie um esquema de banco de dados para ser usado pela aplicação. Crie também um usuário com permissões de acesso a esta base de dados.

### 2. Deploy do Projeto

Execute os comandos a seguir no terminal (caso esteja na plataforma Windows, recomendo utilizar o pacote [Cmder](https://cmder.net/)).

> Vou considerar que partimos da pasta ```/var/www``` de um servidor Linux com PHP e MySQL instalados somente. Embora eu prefira um Apache2/Nginx :sweat_smile:).

Clone este projeto.

```bash 
git clone https://github.com/fc9/tests-netshowme.git teste-fabio
```

Certifique de ter as permissões de pasta adequadas.

```bash
sudo chmod -R 775 /var/www/teste-fabio
sudo chmod -R 777 /var/www/teste-fabio/public
sudo chmod -R 777 /var/www/teste-fabio/storage
```

Acesse a pasta raiz do projeto.

```bash
cd teste-fabio
```

Faça uma cópia do arquivo de configurações de ambiente.

```bash 
sudo cp .env.example .env
```

Usando um editor (vi, vim, nano...) da sua preferência, configure o arquivo .env para:

* Inserir os dados de acesso à base de dados que [criou](#1-banco-de-dados);
* inserir as configurações de email;
* e ainda, configurar o uso banco de dados para enfileiramento, ou seja, ```QUEUE_CONNECTION=database```. 

> Para testes, recomendo criar uma conta gratuíta no [Mailtrap.io](http://mailtrap.io/) e cópiar os dados de autenticação do email para uso.

```bash
sudo vim .env
```

Configure também o email para onde as mensagens de contato serão enviadas.

> Há outras configurações opcionais, edite somente se souber o que esta fazendo.

```bash
sudo vim config/contact.php
```

Instale as dependências.

```bash
composer install

npm install
```

Execute as migrações do banco de dados...

```bash
php artisan migrate --seed
```

Processe o Sass, o CSS e o Javascript.

```bash
npm run prod
```

Gere uma nova chave para a aplicação.

```bash
php artisan key:generate
```

Caso não tenha um servidor pré-instalado, execute: 
```
php artisan serve
```

> Observação: caso tenha um servidor HTTP, será necessário mudar o diretório raiz da servidor para a pasta "**public/**" do projeto.

### 3. Pronto!

## Extras

### Filas de email

Os e-mails são enviados para uma fila de trabalhos para tornar a usabilidade mais agradável. Todavia, para que os emails sejam enviados será necessário executar o worker:

```bash
php artisan queue:work
``` 
> Observação: Esta escolha foi circunstancial, poderíamos usar outros drivers para trabalhar com as filas no Laravel, mas tomaria muito tempo abordando a configuração de cada um aqui.

### Testes

Para rodar os testes.

``` bash
# laravel
php artisan test

# Vue.js
npm test
```

## Autor

<table>
  <tr>
    <td align="center">
      <a href="https://github.com/fc9">
        <img src="https://avatars1.githubusercontent.com/u/312719?s=460&u=4dadbe34a7d0b0c527253918e83d28c32a5165e2&v=4" width="120px;" alt="Fabio Cabral"/>
        <br />
        <sub><b>Fabio Cabral</b></sub>
      </a>
    </td>
  </tr>
</table>

Para obter uma explicação detalhada sobre como as coisas funcionam mande um "oi" paragit  **fabiocabralx@gmail.com**.

[![Open Source? Yes!](https://badgen.net/badge/Open%20Source%20%3F/Yes%21/blue?icon=github)](https://github.com/Naereen/badges/)
