## Sobre

Implementação de um mecanismo de busca com filtros combinados utilizando **Laravel** e **Livewire**.

O ambiente deve é baseado em **Docker**, então é necessário que o mesmo esteja previamente instalado.

O projeto faz uso de _migrations_, _factories_ e _seeders_ para a carga inicial de dados.

A versão do **Laravel** utilizada é a 11.9

A versão do **Livewire** utilizada é a 3.5.

## Pré-requisitos

- **Docker**

## Preparando o ambiente

- Após fazer o clone do projeto, execute os seguintes comandos:

    - Entre na pasta do projeto:

    ```
    cd busca-app
    ```
    - Copie o arquivo **.env.example** criando o novo arquivo **.env**

    ```
    cp .env.example .env
    ```

    - Crie os containers:

    ```
    docker compose up -d
    ```

    - Execute o composer install dentro do container PHP:

    ```
    docker exec -it busca-app-php composer install
    ```

    - Crie e inicialize as tabelas do banco de dados:

    ```
    docker exec -it busca-app-php php artisan migrate:fresh --seed
    ```

    - Instalando as dependências do projeto:
    ```
    docker exec -it busca-app-php npm install
    ```

    - Execute o 'build' para as dependências

    ```
    docker exec -it busca-app-php npm run build
    ```

    - Veja o projeto acessando:

    ```
    http://localhost:8080
    ```
  
    - Testes: execute os testes através do comando:

    ```
    docker exec -it busca-app-php php artisan test --filter BuscaComponentTest
    ```
