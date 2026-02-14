# Sistema SLU – Controle de Entradas PEV

Sistema web para registro e controle de entradas de resíduos nos Pontos de Entrega Voluntária (PEVs), com autenticação JWT, controle de permissões por perfil e interface administrativa em React.

---

## Tecnologias Utilizadas

### Backend

* Laravel 11
* PHP 8.2
* JWT Authentication (php-open-source-saver/jwt-auth)
* PostgreSQL
* Upload de imagens (Storage)

### Frontend

* React + Vite
* Axios
* React Router
* Layout administrativo estilo corporativo

### Infraestrutura

* Docker
* Nginx
* PostgreSQL
* PgAdmin (opcional)

---

## Funcionalidades

* Autenticação via JWT
* Controle de acesso por Perfil e Permissões
* Menu dinâmico por usuário
* Registro de entradas de resíduos
* Upload de fotos (câmera ou arquivo)
* Preview da imagem antes do envio
* Listagem das últimas entradas
* Layout administrativo responsivo

---

## Estrutura do Projeto

```
slu-controle/
│
├── backend-laravel-api/
│   ├── app/
│   ├── routes/
│   ├── storage/
│   └── Dockerfile
│
├── frontend-react/
│   ├── src/
│   │   ├── components/
│   │   ├── pages/
│   │   ├── services/
│   │   └── layouts/
│
├── docker-compose.yml
└── README.md
```

---

## Requisitos

* Docker
* Docker Compose
* Git

---

## Instalação

### 1. Clonar o repositório

```bash
git clone https://github.com/seu-usuario/slu-controle.git
cd slu-controle
```

---

### 2. Subir os containers

```bash
docker-compose up -d --build
```

Serviços disponíveis:

| Serviço     | URL                       |
| ----------- | ------------------------- |
| Frontend    | http://localhost:5173     |
| Backend API | http://localhost:8010/api |
| PgAdmin     | http://localhost:8080     |

---

## Configuração do Backend

Acesse o container:

```bash
docker exec -it slu_backend sh
```

### Gerar chave da aplicação

```bash
php artisan key:generate
```

### Gerar chave JWT

```bash
php artisan jwt:secret
```

### Link do storage (para fotos)

```bash
php artisan storage:link
```

As imagens serão salvas em:

```
storage/app/public/entradas
```

Acesso via navegador:

```
http://localhost:8010/storage/entradas/arquivo.jpg
```

---

## Configuração do Banco

Edite o arquivo `.env` do backend:

```
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=controle_slu
DB_USERNAME=postgres
DB_PASSWORD=secret1234
```

Se necessário, execute migrations:

```bash
php artisan migrate
```

---

## API – Principais Endpoints

### Autenticação

POST `/api/login`

Body:

```json
{
  "email": "usuario@email.com",
  "password": "123456"
}
```

Resposta:

* Token JWT
* Dados do usuário
* Menus conforme permissões

---

### Usuário autenticado

GET `/api/me`

Header:

```
Authorization: Bearer {token}
```

---

### Dados da tela de Entradas

GET `/api/entradas/dados`

Retorna:

* Tipos de resíduo
* Regiões administrativas
* Irregularidades
* Últimas entradas do usuário

---

### Registrar Entrada

POST `/api/entradas`

Form-data:

* placa
* id_ra
* residuos[]
* irregularidade
* id_irregularidade
* foto (arquivo)

---

## Upload de Fotos

* Dispositivo móvel: abre câmera ou galeria
* Desktop: abre seletor de arquivos
* Preview antes do envio
* Armazenamento em `storage/app/public`

---

## Frontend

Para desenvolvimento manual:

```bash
cd frontend-react
npm install
npm run dev
```

---

## Controle de Acesso

O sistema utiliza:

Perfil → Permissões → Menus

O menu lateral é carregado dinamicamente após o login.

---

## Usuários de Teste

Criar manualmente no banco ou via seed.

---

## Próximas Melhorias

* Dashboard com indicadores
* Relatórios em PDF
* Exportação Excel
* Auditoria de ações
* Notificações
* Deploy em produção

---

## Autor

Sistema desenvolvido para o SLU – Controle de PEVs.
