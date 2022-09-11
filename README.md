# Teste Cuco API

O Teste Cuco é uma API que da suporte para aplicação front -end em Vue JS com o mesmo nome. 
Ele fornece endpoints para criação e manutenção dos usuários do sistema com base nas definições do banco de dados.

A documentação foi gerada a partir do postman no link:
https://www.postman.com/collections/ebf5a54994762b32414c

## Install

    Clone the repository

        git clone -b master git clone https://github.com/151597/teste_cuco_api.git

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


