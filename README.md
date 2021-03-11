![alt text](https://avatars.githubusercontent.com/u/66464086?s=200&v=4)

# APi Hope

O micro-serviço `api-hope` tem a responsabilidade de facilitar a criação e a implementação de um projeto inicial.

### DOCUMENTAÇÃO

- [Para iniciar](#para-iniciar-o-serviço)
- [Comandos básicos](#comandos-básicos)
- [Variáveis de ambiente](#variáveis-de-ambiente)
- [Servidores/Portas](#servidores-e-portas)
- [Sobre testes](#sobre-os-testes)
- [Chamadas da API](#chamadas-da-api)
- [Erros](#erros)


## Para iniciar o serviço 

*container(docker)* 
Copie o arquivo de env
 bash
 $ cp ./src/.env.example ./src/.env
 

Para subir o serviço
bash
$ docker-compose up -d

Após subir o serviço execute a instação das depencias via composer
  bash
  $ docker exec -it php-fpm composer install
  
 

Após subir o serviço entre no container.
bash
$ docker exec -it php-fpm sh

Após entrar no container, será necessário realizar as migrações e os seeds.

bash
# Rode as migrations
$ php artisan migrate

# Carregue as seeds
$ php artisan db:seed


> Aviso: O Container por padrão executa a fila de jobs. `php artisan queue:work`

## Comandos básicos 

bash
# Para zerar o banco de dados
$ php artisan migrate:fresh

# Para gerar todas as seeds básicas para teste em DEV 
$ php artisan db:seed


## Variáveis de ambiente 

Todas as **envs** que precisam existir para o serviço funcionar corretamente.


## Servidores e Portas 
| Serviço | Porta  |
|--|--|
| nginx | 80 |
| pgsql | 5432 |
| redis | 6379 |
| pgadmin | 5050 |
| php-fpm | 5050 |


## Sobre os testes 
Para rodar os testes unitários/integração, rode o seguinte comando:
bash
# Rodar testes no container
$ docker exec -it php-fpm ./vendor/bin/phpunit
ou
$ php artisan test



>Recomendamos o uso de qualquer ferramenta `client-rest` para testes nas chamadas da API.
 
- *INSOMNIA*
[https://insomnia.rest/download/](https://insomnia.rest/download/)

- *POSTMAN*
[https://www.getpostman.com/downloads/](https://www.getpostman.com/downloads/)

## Chamadas da API	
Documentação online: 

## Erros

> Se você detectar algum problema que não consiga solucionar, por favor nos informe e se possivel abra uma `issue` sobre..
