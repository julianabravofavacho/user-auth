# Sistema de Autenticação com Laravel 10

Este projeto foi desenvolvido como parte de um teste prático. Ele implementa uma aplicação de autenticação de usuários utilizando Laravel 10, PHP 8.2, Bootstrap 5, Docker e PHPUnit, com foco em boas práticas de código, validação, responsividade e testes automatizados.

---

## 🛠️ Tecnologias Utilizadas

-   **PHP 8.2** (via Docker)
-   **Laravel 10**
-   **Laravel Breeze** (starter kit de autenticação)
-   **MySQL 8** (via Docker)
-   **Bootstrap 5**
-   **JavaScript nativo** (para validações em tempo real)
-   **PHPUnit** (testes de autenticação e perfil)
-   **Docker + Docker Compose**

---

## ✅ Funcionalidades Implementadas

-   Cadastro com nome, e-mail, senha e confirmação de senha
-   Login e logout com redirecionamento
-   Edição de perfil com upload de imagem, atualização de nome, e-mail e senha (opcional)
-   Validação visual em tempo real para senha, nome e e-mail
-   Upload de imagem com preview e fallback para avatar padrão
-   Testes automatizados (login, cadastro e atualização de perfil)

---

## 🚀 Como Rodar o Projeto

### Pré-requisitos

-   Docker + Docker Compose
-   Node.js (v18+) e NPM (caso queira rodar o Vite fora do container)

### Passo a passo

## 🐳 Rodando via Docker

### 1. Build e subida dos containers:

```bash
docker compose build --no-cache
docker compose up -d
```

### 2. Acesse o container para executar comandos artisan:

```bash
docker exec -it laravel_app bash
php artisan migrate
php artisan test
```

### 3. URL do sistema:

```
http://localhost:8000
```

## 💻 Rodando Localmente (sem Docker)

### 1. Instale as dependências:

```bash
composer install
npm install
```

### 2. Copie e edite o arquivo `.env`:

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Crie e atualize o banco:

```bash
php artisan migrate
```

### 4. Rode o servidor local:

```bash
php artisan serve
npm run dev
```

## 🖼️ Instalação da Extensão GD (para testes com imagens)

### No Docker (já incluso no Dockerfile)

No Dockerfile:

```Dockerfile
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd
```

### Localmente (Linux)

```bash
sudo apt update
sudo apt install php-gd
```

### Localmente (Windows via Scoop)

```powershell
scoop install php-gd
```

> Confirme com `php -m | findstr gd`

## 🧪 Como Rodar os Testes

```bash
php artisan test
```

Os testes estão localizados em:

-   `tests/Feature/Auth/`
-   `tests/Feature/Profile/`

---

## 🗂️ Estrutura de Pastas Importantes

| Pasta                      | Finalidade                      |
| -------------------------- | ------------------------------- |
| `resources/views/auth/`    | Telas de login, cadastro, senha |
| `resources/views/profile/` | Tela de edição de perfil        |
| `app/Http/Controllers/`    | Lógica de autenticação e perfil |
| `app/Http/Requests/`       | Validações customizadas         |
| `tests/Feature/`           | Testes de funcionalidades       |
| `docker/`                  | Configurações do Apache         |

---

## 📄 .env de Exemplo

```env
APP_NAME=Sistema
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=user_auth
DB_USERNAME=root
DB_PASSWORD="sua-senha"

VITE_DEV_SERVER_URL=http://localhost:5173
```

---

## 👨‍💻 Autor

Desenvolvido por Juliana
[LinkedIn](https://www.linkedin.com/in/juliana-bravo-favacho) · [GitHub](https://github.com/julianabravofavacho)
