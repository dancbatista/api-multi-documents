### DOCUMENTAÇÃO

-   [Para iniciar](#para-iniciar-o-serviço)
-   [Plataforma para execução do projeto](#plataforma-para-execução-do-projeto)
-   [Servidores/Portas](#servidores-e-portas)
-   [Design de software](#design-de-software)
-   [Framework](#framework)
-   [Base de dados para execução das notificações](#base-de-dados-para-execução-das-notificações)
-   [Pré-requisitos](#pré-requisitos)
-   [Comandos básicos](#comandos-básicos)
-   [Banco de dados](#banco-de-dados)
-   [Execução das queue](#execução-das-queue)
-   [Teste-Unintário](#teste-Unintário)
-   [Sobre os testes](#Sobre-os-testes)
-   [Chamadas da API](#chamadas-da-API)
-   [Link da collections](#link-da-collections)
-   [Erros](#erros)

## Para iniciar o serviço

Essas instruções farão com que você tenha uma cópia do projeto em execução na sua máquina local para fins de desenvolvimento e teste. Veja a implantação de notas sobre como implantar o projeto em um sistema ativo.

## Plataforma para execução do projeto

```php
Docker
```

Para mais informações clique [aqui](https://docs.docker.com/) para visitar a documentação oficial do docker

## Servidores e Portas

| Serviço | Porta |
| ------- | ----- |
| nginx   | 80    |
| pgsql   | 5432  |
| redis   | 6379  |
| pgadmin | 5050  |
| php-fpm | 5050  |

## Design de software

```php
S O L I D
```

## Framework

```php
Laravel
```

## Base de dados para execução das notificações

```php
Redis
```

## Pré-requisitos

```php
Criar um diretório na are trabalho chamado apiMultiDocumentos
Clonar o projecto dentro desse diretório
```

A seguir, execute o seguinte:

Todos esses comandos que citarei a seguir, devem ser executados na linha de comando da sua máquina. Portanto, navegue até a pasta do projeto para poder executar os comandos abaixo especificados.
logo após clona-ló, na pasta raíz do projeto execute os seguintes comandos.

Criar uma network docker

```php
docker network create -d bridge backend
```

Executar o docker compuser

```php
docker-compose up
```

## Comandos básicos

```php
#para entrar no container
docker exec -it php-fpm sh

#para entrar no diretório do projecto
cd <Diretório do projecto>

#para copiar as variáveis de ambiente
cp .env.docker.example .env

#para instalar as dependência do projecto
composer install
```

## Banco de dados

Configura o seu banco de dados

Acesse o container pgadmin via browser

```php
localhost:5050

EMAIL=user@domain.com
PASSWORD=SuperSecret
```

Criar novo server no pgadmin

```php
DB_CONNECTION=pgsql
DB_HOST=postgresql
DB_PORT=5432
DB_DATABASE=dev
DB_USERNAME=postgres
DB_PASSWORD=root
```

Acessar o container onde esta à aplicacão e dentro do diretório do projecto executar os seguinte comando

```php
php artisan config:clear
```

```php
composer dump-autoload
```

```php
php artisan migrate
```

## Execução das queue

Acessar o container onde esta à aplicacão e dentro do diretório do projecto executar os seguinte comando

Execute o seguinte comando

```php
php artisan queue:work
```

## Teste Unintário

Acessar o container onde esta à aplicacão e dentro do diretório do projecto execute o seguinte comando para executar os testes

```php
vendor/bin/phpunit
ou
php artisan test
```

## Sobre os testes

> Recomendamos o uso de qualquer ferramenta `client-rest` para testes nas chamadas da API.

-   _INSOMNIA_
    [https://insomnia.rest/download/](https://insomnia.rest/download/)

-   _POSTMAN_
    [https://www.getpostman.com/downloads/](https://www.getpostman.com/downloads/)

## Chamadas da API

Documentação:

## Link da collections

Collections:
[https://www.getpostman.com/collections/af5a4e3cdcc25ebbe427/](https://www.getpostman.com/collections/af5a4e3cdcc25ebbe427/)

## Erros

> Se você detectar algum problema que não consiga solucionar, por favor nos informe e se possivel abra uma `issue` sobre..
