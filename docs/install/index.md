# Instalação do Projeto

## 1) Clone o repositório

```bash
git clone git@github.com:iOnilec/upd8-test-php.git
cd upd8-test-php
```

## 2) Crie o banco de dados e configure o usuário no MySQL

```bash
CREATE DATABASE upd8_test_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE USER 'upd8_test_admin'@'localhost' IDENTIFIED BY 'mysqlpass';

GRANT ALL PRIVILEGES ON upd8_test_db.* TO 'upd8_test_admin'@'localhost';

FLUSH PRIVILEGES;
EXIT;
```

## 3) Configure o projeto Laravel

```bash
cp .env.example .env
composer install
php artisan key:generate
```

## 4) Execute as migrações e seeders

```bash
php artisan migrate
php artisan db:seed
``` 

## 5) Rode o server

```bash
php artisan serve
```