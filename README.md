# laravel_passport

Este é um projeto de API desenvolvido em Laravel, utilizando o Laravel Passport para autenticação de usuários. A API oferece funcionalidades para registro, login, perfil e logout de usuários.

## Funcionalidades

- **Registro de Usuário:** Permite criar um novo usuário com validação de nome, e-mail e senha.
- **Login:** Permite que um usuário se autentique e obtenha um token de acesso.
- **Perfil:** Fornece informações do perfil do usuário autenticado.
- **Logout:** Permite que um usuário deslogue e invalide seu token de acesso.

## Instalação

Siga os passos abaixo para configurar o projeto localmente.

# Clone o repositório
git clone https://github.com/erickhenrique3/laravel_passport.git

# Navegue até o diretório do projeto
cd repositorio

# Instale as dependências
composer install

# Execute as migrações do banco de dados
php artisan migrate

# Gere a chave de aplicativo
php artisan key:generate

