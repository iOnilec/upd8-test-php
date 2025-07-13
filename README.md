# Sistema de Cadastro de Cidades, Clientes e Representantes (upd8)

Este projeto é uma aplicação simples feita com **Laravel**, **MySQL** e frontend em **HTML/JavaScript/CSS** para cadastro e gerenciamento de Cidades, Clientes e Representantes, consumindo dados via **API REST**.

---

## Tecnologias utilizadas

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

---

## Funcionalidades

- Cadastro, edição, exclusão e listagem de:
  - Cidades
  - Clientes (associados a cidades)
  - Representantes (associados a cidades)
- Consulta de representantes que atendem determinado cliente (pela cidade)
- API REST completa para manipulação dos dados
- Frontend simples para interação com a API

---

## Estrutura do banco de dados

- `cities`: cidades com campos `city_id`, `city_name`, `city_uf`
- `clients`: clientes com dados pessoais e chave estrangeira `city_id`
- `representatives`: representantes com dados de contato e chave estrangeira `city_id`
- `scripts.sql`: os scripts obrigatórios
- `upd8_ddl.sql`: ddl do banco de dados

---

### [Instalação do projeto](./docs/install/index.md)
