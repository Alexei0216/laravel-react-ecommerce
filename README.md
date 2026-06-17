# 🛒 Laravel Shop — E-commerce API Platform

Full-stack e-commerce platform built with :contentReference[oaicite:0]{index=0} (API backend), :contentReference[oaicite:1]{index=1} (SPA frontend) and containerized with :contentReference[oaicite:2]{index=2}.

The project follows an **API-first architecture**, separating backend business logic from frontend presentation layer.

---

# 🧠 System Architecture

            ┌──────────────────────┐
            │   React SPA         │
            │   (Frontend)        │
            └─────────┬────────────┘
                      │ HTTP (JSON API)
                      ▼
            ┌──────────────────────┐
            │   Laravel API        │
            │   (Business Logic)   │
            └─────────┬────────────┘
                      │
      ┌───────────────┼────────────────┐
      ▼               ▼                ▼

MySQL DB Redis Cache Queue Jobs

---

# ⚙️ Tech Stack

## Backend

- Laravel 11+
- REST API architecture
- Laravel Sanctum (authentication)
- MySQL 8.4
- Redis (cache, sessions, queues)

## Frontend

- React SPA
- React Router
- Axios HTTP client

## Infrastructure

- Docker Compose
- Nginx
- PHP 8.4-FPM

---

# 📦 Domain Model (Database Design)

## Core entities

### products

- id
- name
- slug
- description
- price
- stock
- category_id
- created_at

### categories

- id
- name
- slug
- parent_id (nested categories support)

### product_images

- id
- product_id
- url
- is_main

### users

- id
- name
- email
- password

### orders

- id
- user_id
- total
- status
- created_at

### order_items

- id
- order_id
- product_id
- quantity
- price

---

# 🔁 API Flow (Frontend → Backend)

## Product listing flow

React Page
↓
GET /api/products
↓
Laravel Controller
↓
Service Layer (business logic)
↓
Database query (MySQL)
↓
JSON response
↓
React renders UI

---

# 📡 API Endpoints

## Products

GET /api/products
GET /api/products/{id}
POST /api/products
PUT /api/products/{id}
DELETE /api/products/{id}

## Categories

GET /api/categories

## Auth (Sanctum)

POST /api/login
POST /api/register
POST /api/logout
GET /api/user

---

# 🐳 Docker Architecture

Services:

- `app` → Laravel (PHP-FPM)
- `nginx` → reverse proxy
- `mysql` → database
- `redis` → cache & queues

docker-compose up -d

---

# 📁 Project Structure

laravel-shop/
│
├── backend/ # Laravel API
│ ├── app/
│ ├── routes/
│ ├── database/
│
├── frontend/ # React SPA
│ ├── src/
│ ├── components/
│
├── docker/
│ ├── nginx/
│ ├── php/
│
└── docker-compose.yml

---

# 🧠 Architecture Principles

- API-first design
- Stateless backend
- Separation of concerns
- Service-oriented backend structure (planned)
- Database normalized for scalability

---

# 🔐 Authentication Strategy

- Laravel Sanctum used for SPA authentication
- Token-based session handling
- Secure HTTP-only cookie mode (planned production setup)

---

# 🚀 Development Workflow

```bash
# start environment
docker compose up -d --build

# enter backend container
docker compose exec app bash

# install dependencies
composer install

# run migrations
php artisan migrate

# start dev server (API)
php artisan serve


📌 Roadmap
 - Product module (CRUD + filters)
 - Category hierarchy system
 - Cart system (Redis-based)
 - Order processing
 - Admin dashboard (React)
 - Payment integration (Stripe)
 - Search (full-text / ElasticSearch later)

🧪 Design Philosophy

This project is built as a real-world scalable e-commerce backend, focusing on:

 - maintainable architecture
 - API scalability
 - separation of frontend/backend
 - containerized development environment
 - production-ready patterns

👨‍💻 Purpose

This repository is a learning + portfolio project, designed to simulate real production e-commerce systems.

📌 Author

Developer: Oleksii Aivazian
```
