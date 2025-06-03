# Clínica Amor Saúde – Backend (Laravel 5.4)

Este projeto é a API backend da aplicação **Clínica Amor**, construída com Laravel 5.4 e PHP 7.0. A API é responsável por gerenciar entidades como clínicas, especialidades médicas e regionais.

---

## ✅ Requisitos

-   PHP 7.0
-   Composer
-   Docker e Docker Compose
-   MySQL
-   Extensões do PHP: `mbstring`, `pdo`, `openssl`, `tokenizer`, `xml`, `curl`

---

## 🚀 Instalação

### 1. Clonar o repositório

```bash
git clone https://seu-repo.git backend-clinica
cd backend-clinica
```

### 2. Instalar dependências via Composer

```bash
composer install
```

### 3. Copiar e configurar o `.env`

```bash
cp .env.example .env
```

Configure as seguintes variáveis no `.env` conforme necessário:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=clinica-amor
DB_USERNAME=laravel-clinica
DB_PASSWORD=q1w2e3r4t5

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=

```

### 4. Gerar a chave da aplicação

```bash
php artisan key:generate
```

---

## 🐳 Rodar Banco de Dados com Docker

Você pode subir a instância do banco de dados com Docker Compose usando o seguinte comando:

```bash
docker-compose up -d
```

O arquivo `docker-compose.yml` (incluso no projeto) vai subir um container com:

-   MariaDB na porta `3306`
-   Usuário: `laravel-clinica`
-   Senha: `q1w2e3r4t5`

## 🛠 Executar Migrações

```bash
php artisan migrate
```

---

## 📦 Populando o Banco de Dado

Para popular o banco de dados com dados iniciais, você pode usar os seeders. Primeiro certifique-se de que o banco de dados está vazio ou que você deseja sobrescrever os dados existentes.
Em seguida, execute o comando:

```bash
composer dump-autoload
```

E então rode o seeder:

```bash
php artisan db:seed
```

## 🔥 Rodar o servidor local

```bash
php artisan serve
```

A API estará acessível via: [http://localhost:8000](http://localhost:8000)

---

## 🧪 Endpoints principais

-   `GET /api/clinicas`
-   `POST /api/clinicas`
-   `PUT /api/clinicas/{id}`
-   `DELETE /api/clinicas/{id}`
-   `GET /api/especialidades`
-   `GET /api/regionais`
-   `POST /api/login`

---

## 📦 Organização de Código

-   `routes/api.php`: definição das rotas da API
-   `app/Http/Controllers`: controladores das entidades
-   `app/Models`: modelos Eloquent

---
