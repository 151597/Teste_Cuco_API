# Teste Cuco API

O Teste Cuco é uma API que da suporte para aplicação front -end em Vue JS com o mesmo nome. 
Ele fornece endpoints para criação e manutenção dos usuários do sistema com base nas definições do banco de dados.

A documentação foi gerada a partir do postman no link:
https://www.postman.com/collections/eed16cab09ec170c2c23

## API Teste
    Para testar os Enpoints para importar o link no aplicativo e ter acesso a Collection.

## Install

    Clone the repository

        git clone -b master https://github.com/151597/teste_cuco_api.git

    Switch to the repo folder

        cd teste_cuco_api
        
    Install all the dependencies using composer

        composer install

    Copy the example env file and make the required configuration changes in the .env file

        cp .env.example .env

    Generate a new application key

        php artisan key:generate

    Generate a new JWT authentication secret key

        php artisan jwt:generate

## Run the app

    php artisan serve

## migrations

    php artisan migrate
## You can now access the server at http://localhost:8000


