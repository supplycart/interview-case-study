# Full-Stack SupplyCart Case Study E-commerce Application (Laravel & Vue.js)

This project is a full-stack e-commerce application built with a Laravel 12 (PHP) backend and a Vue.js 3 (JavaScript) frontend, containerized with Docker. It includes features like user authentication, product browsing, cart management, order placement, and bonus features like user activity logging and differential pricing.

## Table of Contents

1.  [Features](#features)
2.  [Technology Stack](#technology-stack)
3.  [Prerequisites](#prerequisites)
4.  [Project Structure](#project-structure)
5.  [Setup and Installation (Local Docker Environment)](#setup-and-installation-local-docker-environment)
    *   [Clone the Repository](#1-clone-the-repository)
    *   [Backend Setup (Laravel)](#2-backend-setup-laravel)
    *   [Frontend Setup (Vue.js)](#3-frontend-setup-vuejs)
    *   [Docker Setup](#4-docker-setup)
    *   [Running the Application](#5-running-the-application)
    *   [Initial Application Setup (Migrations, Seeding etc.)](#6-initial-application-setup-migrations-seeding-etc)
6.  [Accessing the Application](#accessing-the-application)
7.  [Running Tests](#running-tests)
8.  [API Endpoints (Brief Overview)](#api-endpoints-brief-overview)
9.  [Key Assumptions and Considerations](#key-assumptions-and-considerations)
10. [Deployment (Conceptual Overview)](#deployment-conceptual-overview)
11. [Troubleshooting](#troubleshooting)
12. [Best Practices Applied](#troubleshooting)

## Database Design Schema
![image_alt](https://github.com/nasrulirfan/interview-case-study/blob/nasrul/dev/ERD%20Diagram%20-%20Supplycart%20Interview.png?raw=true)
Please refer to the [database_schema.md](https://github.com/nasrulirfan/interview-case-study/blob/nasrul/dev/database_schema.md) for detailed explaination.

## Features (All Bonus Tasks Applied)
*   **User Management:**
    *   User Registration with Email Verification (Bonus)
    *   User Login & Logout
    *   Authenticated User Information
*   **Product Management:**
    *   Product Listing with Search & Filtering (Bonus: Category, Brand, Price Range)
    *   Product Detail View (Conceptual)
    *   Product Attributes (Bonus: e.g., Color, Size)
    *   Differential Pricing per User (Bonus)
*   **Shopping Cart:**
    *   Add items to cart (Client-side management)
    *   Update item quantities
    *   Remove items from cart
    *   Cart persistence using `localStorage`
*   **Order Management:**
    *   Place Order (from cart)
    *   View Order History (Paginated)
    *   View Order Details (Conceptual)
    *   Stock quantity decrement on order placement
*   **User Activity Logging (Bonus):**
    *   Track user actions like login, logout, order placement.
    *   View user's own activity logs.
*   **API:**
    *   RESTful API for all backend operations.
    *   Sanctum for API authentication.

## Technology Stack
*   **Backend:**
    *   PHP 8.2+
    *   Laravel 12.x
    *   PostgreSQL 15+
    *   Redis 7+ (for caching, sessions, queues)
    *   Supervisord (for managing queue workers)
*   **Frontend:**
    *   Vue.js 3 (Options API)
    *   Vite
    *   Pinia (State Management)
    *   Vue Router
    *   Axios (HTTP Client)
    *   TailwindCSS (Styling)
    *   `vue-toastification` (Notifications)
*   **Development & Deployment:**
    *   Docker & Docker Compose
    *   Nginx (Web Server / Reverse Proxy)

## Prerequisites

Before you begin, ensure you have the following installed on your system:

*   **Docker Desktop** (or Docker Engine + Docker Compose CLI V2)
    *   Verify with `docker --version` and `docker compose version`
*   **Git** (for cloning the repository)
*   **Node.js** (v18.x or later) and **npm** (or yarn) for frontend development and building assets.

## Project Structure

```
your-ecommerce-app/
├── backend/                # Laravel application
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   │   ├── migrations/
│   │   └── seeders/
│   ├── docker/             # Docker-specific files for backend (php.ini, supervisord.conf)
│   ├── public/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   ├── tests/
│   ├── .env.example
│   ├── composer.json
│   └── Dockerfile          # Backend Dockerfile
├── frontend/               # Vue.js application
│   ├── public/
│   ├── src/
│   │   ├── assets/
│   │   ├── components/
│   │   ├── router/
│   │   ├── services/
│   │   ├── stores/
│   │   └── views/
│   ├── .env.development
│   ├── index.html
│   ├── package.json
│   └── vite.config.js
├── nginx/                  # Nginx configuration (default.conf, options-ssl-nginx.conf)
│   └── default.conf
├── .env                    # Docker Compose environment variables (loaded by docker-compose)
├── .gitignore
├── docker-compose.yml      # Docker Compose configuration
└── README.md
```

## Setup and Installation (Local Docker Environment)

### 1. Clone the Repository

```bash
git clone <your-repository-url> your-ecommerce-app
cd your-ecommerce-app
```

### 2. Backend Setup (Laravel)

*   Navigate to the backend directory:
    ```bash
    cd backend
    ```
*   Copy the example environment file:
    ```bash
    cp .env.example .env
    ```
*   **Inside `backend/.env`:**
    *   Ensure `APP_KEY` is `base64:dummy_app_key_to_be_replaced_real_one_in_docker_env` or similar. This will be set by the main `.env` for Docker.
    *   `DB_CONNECTION=pgsql`
    *   `DB_HOST=db` (This is the service name of the PostgreSQL container in `docker-compose.yml`)
    *   `DB_PORT=5432`
    *   `DB_DATABASE=ecommerce_db` (Matches `POSTGRES_DB` in the root `.env`)
    *   `DB_USERNAME=sail` (Or your chosen user, matches `POSTGRES_USER` in root `.env`)
    *   `DB_PASSWORD=password` (Or your chosen password, matches `POSTGRES_PASSWORD` in root `.env`)
    *   `REDIS_HOST=redis` (Service name of the Redis container)
    *   `REDIS_PASSWORD=null` (Or your Redis password if set)
    *   `REDIS_PORT=6379`
    *   `APP_URL=http://localhost:8080` (Or your local Nginx port if different)
    *   `APP_FE_URL=http://localhost:5173` (Depends on the front-end port)
    *   Mail settings (for development, MailHog is configured in `docker-compose.yml`):
        ```
        MAIL_MAILER=smtp
        MAIL_HOST=mailhog
        MAIL_PORT=1025
        MAIL_USERNAME=null
        MAIL_PASSWORD=null
        MAIL_ENCRYPTION=null
        MAIL_FROM_ADDRESS="hello@example.com"
        MAIL_FROM_NAME="${APP_NAME}"
        ```
    ```bash
    cd .. # Return to project root
    ```

### 3. Frontend Setup (Vue.js)

*   Navigate to the frontend directory:
    ```bash
    cd frontend
    ```
*   Copy the example environment file (if one exists, otherwise create it):
    ```bash
    cp .env.development.example .env.development # Or manually create .env.development
    ```
*   **Inside `frontend/.env.development`:**
    ```env
    VITE_API_BASE_URL=http://localhost:80/api
    VITE_APP_URL=http://localhost:5173
    ```
*   Install frontend dependencies:
    ```bash
    npm install
    ```
    ```bash
    cd .. # Return to project root
    ```

### 4. Docker Setup

*   Copy the root example environment file for Docker Compose:
    ```bash
    cp .env.example .env
    ```
*   **Review and update the root `.env` file:** This file provides environment variables to your Docker containers.
    ```env
    # --- GENERAL ---
    COMPOSE_PROJECT_NAME=ecommerce_app # Sets a prefix for container names
    APP_USER_ID=1000 # Set to your host user ID (`id -u`) to own files in volumes
    APP_GROUP_ID=1000 # Set to your host group ID (`id -g`)

    # --- LARAVEL (backend 'app' service) ---
    APP_NAME="E-commerce App"
    APP_ENV=local
    APP_DEBUG=true
    APP_KEY= # Will be generated after containers are up if left blank, or set a dummy one here
    APP_URL=http://localhost:8080 # How Laravel sees itself via Nginx

    # Frontend URL for CORS and verification emails
    FRONTEND_URL=http://localhost:5173

    # CORS and Sanctum configuration
    SANCTUM_STATEFUL_DOMAINS=localhost:8080,localhost:5173,127.0.0.1:5173,app # 'app' is vite dev proxy target
    CORS_ALLOWED_ORIGINS=http://localhost:5173,http://127.0.0.1:5173

    # Laravel Mailer (for MailHog)
    MAIL_MAILER=smtp
    MAIL_HOST=mailhog
    MAIL_PORT=1025
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS="noreply@ecommerce.test"
    MAIL_FROM_NAME="${APP_NAME}"

    # --- POSTGRESQL ('db' service) ---
    # These are used by both the 'db' container to initialize and 'app' container to connect
    POSTGRES_DB=ecommerce_db
    POSTGRES_USER=sail # Or your preferred username
    POSTGRES_PASSWORD=password # Choose a secure password
    # Note: DB_HOST for Laravel will be 'db' (service name)
    # Note: DB_USERNAME for Laravel will be POSTGRES_USER
    # Note: DB_PASSWORD for Laravel will be POSTGRES_PASSWORD

    # --- REDIS ('redis' service) ---
    # REDIS_PASSWORD= # Optional: Set a password for Redis if needed
    # Note: REDIS_HOST for Laravel will be 'redis' (service name)
    # Note: REDIS_PASSWORD for Laravel will be this value

    # --- NGINX ('nginx' service) ---
    NGINX_HOST_HTTP_PORT=8080 # Port on your host machine for Nginx HTTP
    NGINX_HOST_HTTPS_PORT=8443 # Port on your host machine for Nginx HTTPS (if using self-signed certs)

    # --- Frontend Dev Server (Vite, if run from container) ---
    # FRONTEND_HOST_PORT=5173 # Vite's default port
    ```
    **Important:** The user ID (`APP_USER_ID`) and group ID (`APP_GROUP_ID`) are used in the `backend/Dockerfile` to ensure file permissions are correct when volumes are mounted from your host machine. Run `id -u` and `id -g` in your terminal to get your current user's IDs and update these values.

### 5. Running the Application

*   From the project root directory (`your-ecommerce-app/`):
    ```bash
    docker compose up -d --build
    ```
    *   `-d`: Detached mode (runs in the background).
    *   `--build`: Forces Docker to rebuild images if Dockerfiles or context have changed.
*   **The first time you run this, it will:**
    1.  Build the Docker image for the Laravel backend (`app` service).
    2.  Pull images for Nginx, PostgreSQL, Redis, and MailHog.
    3.  Create and start all containers.
    4.  Create Docker volumes for persistent PostgreSQL and Redis data.
    5.  The `backend/Dockerfile` will run `composer install`.

*   **After the containers are up, if `APP_KEY` was not set in the root `.env`:**
    Generate a Laravel application key:
    ```bash
    docker compose exec app php artisan key:generate
    ```
    This will update the `APP_KEY` in `backend/.env`. For consistency, also copy this generated key to your root `.env` file (the one Docker Compose uses). Then, you might want to restart the app container:
    ```bash
    docker compose restart app
    ```

### 6. Initial Application Setup (Migrations, Seeding etc.)

Once the containers are running and `APP_KEY` is set:

*   **Run Database Migrations:**
    ```bash
    docker compose exec app php artisan migrate
    ```
*   **Seed the Database:**
    If you have seeders:
    ```bash
    docker compose exec app php artisan db:seed
    ```
*   **Link Storage:**
    If not already done in the `backend/Dockerfile`:
    ```bash
    docker compose exec app php artisan storage:link
    ```
*   **Cache Configuration and Routes:**
    While not strictly necessary for local development with `APP_DEBUG=true`, useful to test production behavior.
    ```bash
    docker compose exec app php artisan config:cache
    docker compose exec app php artisan route:cache
    ```
    To clear: `docker compose exec app php artisan config:clear` and `php artisan route:clear`.

*   **Frontend Development Server (Vite):**
    The `docker-compose.yml` includes a `frontend_dev` service that runs `npm run dev` for the Vue.js application. This provides hot-reloading.
    *   If you built `frontend/dist` already, the Nginx container will serve it.
    *   If you want to use Vite's HMR dev server:
        *   Ensure Nginx `default.conf` (or a separate dev Nginx conf) proxies requests to `http://frontend_dev:5173` (or whatever your Vite dev server port is configured to inside its container).
        *   The provided `docker-compose.yml` might set this up already.

    Alternatively, you can run the frontend Vite dev server directly on your host machine if you prefer (not using the `frontend_dev` Docker service):
    ```bash
    cd frontend
    npm run dev
    ```
    Ensure your API calls from Vue are correctly pointing to `http://localhost:80/api` (or whatever port Nginx is mapped to on your host).

## Accessing the Application

*   **Frontend (Vite Dev Server - if running frontend locally or via `frontend_dev` service):**
    *   URL: `http://localhost:5173` (or the port Vite is running on)
*   **Backend API (via Nginx):**
    *   URL: `http://localhost:80/api/` (or the Nginx host port you configured)
    *   Example: `http://localhost:80/api/products`
*   **MailHog (Email Catching):**
    *   URL: `http://localhost:8025`
*   **PostgreSQL (e.g., with a GUI like DBeaver or pgAdmin):**
    *   Host: `localhost` (or `127.0.0.1`)
    *   Port: `54320` (as mapped in `docker-compose.yml`)
    *   Database: `ecommerce_db` (from root `.env`)
    *   User: `sail` (from root `.env`)
    *   Password: `password` (from root `.env`)
*   **Redis (e.g., with RedisInsight):**
    *   Host: `localhost` (or `127.0.0.1`)
    *   Port: `63790` (as mapped in `docker-compose.yml`)

## Running Tests

*   **Backend (Laravel PHPUnit):**
    ```bash
    docker compose exec app php artisan test
    # Or for a specific test file:
    # docker compose exec app php artisan test tests/Feature/YourTest.php
    ```

## API Endpoints (Brief Overview)

*   **Auth:**
    *   `POST /api/register`
    *   `POST /api/login`
    *   `POST /api/logout` (Auth required)
    *   `GET /api/user` (Auth required)
    *   `GET /api/email/verify/{id}/{hash}` (Signed URL for email verification)
    *   `POST /api/email/verification-notification` (Auth required, to resend verification)
*   **Products:**
    *   `GET /api/products` (Supports filtering query params)
    *   `GET /api/products/{product:slug}`
*   **Orders:**
    *   `POST /api/orders` (Auth required)
    *   `GET /api/orders` (Auth required)
    *   `GET /api/orders/{order}` (Auth required)
*   **User Activity:**
    *   `GET /api/user/activity-logs` (Auth required)

Refer to `backend/routes/api.php` for the complete list and details.

## Key Assumptions and Considerations

*   **Docker Environment:** This setup assumes you are comfortable working with Docker and Docker Compose.
*   **`.env` Files:** Environment configuration is crucial. Sensitive data should **NEVER** be committed to Git. Use `.env.example` files as templates. The root `.env` file takes precedence for Docker Compose environment variables.
*   **File Permissions:** The `APP_USER_ID` and `APP_GROUP_ID` in the root `.env` are important for ensuring correct file permissions for mounted volumes, especially `backend/storage`.
*   **Email Verification:** Uses MailHog for local development.
*   **Queues:** The `supervisord.conf` in `backend/docker/` is configured to run Laravel queue workers. Ensure `QUEUE_CONNECTION=redis` (or `database`) is set in `backend/.env`.
*   **CORS & Sanctum:** Configuration for Cross-Origin Resource Sharing (CORS) and Laravel Sanctum (for SPA authentication) is set up for the local development URLs.
*   **Frontend Serving:** For local development, Vite's dev server (`frontend_dev` service or run locally) provides HMR. For production, the frontend is built into static assets and served by Nginx.
*   **Database/Redis Persistence:** Docker volumes (`ecommerce_db_data`, `ecommerce_redis_data`) are used to persist data across container restarts.

## Deployment (Conceptual Overview)

Deploying this application typically involves:

1.  Setting up a Virtual Private Server (VPS).
2.  Installing Docker and Docker Compose on the VPS.
3.  Transferring the project code to the VPS.
4.  Building production Docker images on the VPS (or push pre-built images to a registry).
5.  Configuring production environment variables (especially for `APP_KEY`, database credentials, URLs, and mail services).
6.  Setting up Nginx for production (including SSL/TLS with Let's Encrypt).
7.  Running the application using `docker compose -f docker-compose.yml -f docker-compose.prod.yml up -d` (if using a separate production compose file).
8.  Setting up automated backups for the database and persistent volumes.

## Troubleshooting
*   **Containers not starting:** Check logs with `docker compose logs <service_name>`. For example, `docker compose logs app`.
*   **Permission denied errors (especially in `backend/storage`):**
    *   Ensure `APP_USER_ID` and `APP_GROUP_ID` in the root `.env` match your host user/group IDs.
    *   You might need to manually `chown` the `backend/storage` and `backend/bootstrap/cache` directories on your host to match these IDs before the first `docker compose up`.
    *   Alternatively, from within the `app` container: `docker compose exec app chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache`.
*   **Nginx 502 Bad Gateway:** Usually means the `app` (PHP-FPM) container is not running or Nginx cannot connect to it. Check `app` container logs.
*   **CORS errors in the browser console:** Double-check your `CORS_ALLOWED_ORIGINS` and `SANCTUM_STATEFUL_DOMAINS` in `backend/.env` (and the root `.env` that Docker uses). Ensure the frontend URL is correctly listed.
*   **Database connection issues:** Verify host (`db`), port, database name, user, and password in `backend/.env` match the PostgreSQL container's configuration in the root `.env`.
*   **"No application encryption key has been specified."**: Run `docker compose exec app php artisan key:generate`.

---

## Best Practices Applied
Okay, let's list the best practices aimed for and ideally implemented *within the code* itself (Laravel backend and Vue.js frontend), in addition to the setup/infrastructure practices previously mentioned.

**I. Laravel Backend Best Practices:**

1.  **MVC Architecture:**
    *   **Models:** Represent data and business logic (e.g., `User`, `Product`, `Order`). Use Eloquent ORM effectively with relationships, accessors, mutators, and model events.
    *   **Views:** (Primarily API resources in this case) `JsonResource` and `ResourceCollection` are used for transforming models into consistent JSON responses, separating presentation from data.
    *   **Controllers:** Handle HTTP requests, delegate business logic to services or models, and return responses. Kept lean.

2.  **Service Layer (Service-Repository Pattern - Conceptual):**
    *   **Services** (e.g., `AuthService`, `ProductService`, `OrderService`, `CartService`): Encapsulate complex business logic, keeping controllers thin and models focused on data representation. This promotes reusability and testability.
    *   (Repositories are an optional further step for abstracting data access, not explicitly detailed but services can interact directly with Eloquent for this project size).

3.  **Dependency Injection (DI) & Inversion of Control (IoC):**
    *   Laravel's service container is used implicitly and explicitly for resolving dependencies (e.g., injecting services into controllers, mailables, jobs). This promotes loose coupling and testability.

4.  **API Design & Versioning (Implicit):**
    *   **RESTful Principles:** Adhered to for API endpoints (e.g., using appropriate HTTP verbs, resource-based URLs).
    *   **Consistent JSON Responses:** Using API Resources (`OrderResource`, `ProductResource`, `UserResource`) ensures a standardized structure for API outputs, including data wrapping, pagination, and links.
    *   (Explicit API versioning like `/api/v1/...` is a good practice for larger projects, not explicitly implemented here but can be added).

5.  **Routing:**
    *   Clear and organized routes in `routes/api.php`.
    *   Use of route model binding (`{product:slug}`, `{order}`) for convenience and cleaner controller actions.
    *   Named routes for easier URL generation (e.g., in Mailables).
    *   Route groups for middleware application (`auth:sanctum`).

6.  **Authentication & Authorization:**
    *   **Sanctum:** Used for SPA authentication, providing a secure and straightforward way to authenticate Vue.js frontend with the Laravel backend.
    *   **Email Verification (`MustVerifyEmail`):** Ensures users have valid email addresses.
    *   (Role-based/Permission-based authorization using Gates/Policies would be a best practice for more complex scenarios, not explicitly detailed but can be built upon `auth:sanctum`).

7.  **Error & Exception Handling:**
    *   Laravel's built-in exception handler is used. Custom exceptions can be created for specific error scenarios.
    *   Consistent error responses from the API (e.g., 4xx for client errors, 5xx for server errors, with meaningful messages).
    *   Logging of errors for debugging and monitoring.

8.  **Validation:**
    *   **Form Requests:** (Or manual `Validator::make()`) Used extensively in controllers/services to validate incoming data against defined rules, ensuring data integrity.
    *   Custom validation rules where necessary.

9.  **Database Migrations & Seeding:**
    *   **Migrations:** Define database schema in code, allowing for version control and easy schema evolution.
    *   **Seeders & Factories:** Populate the database with initial/test data, useful for development and testing.

10. **Events & Listeners / Jobs:**
    *   **Events** (e.g., `UserRegistered`, `OrderPlaced`, `UserLoggedIn`): Decouple different parts of the application. For example, sending a verification email or logging activity after an event occurs.
    *   **Queued Jobs** (e.g., `SendVerificationEmailJob`): Offload time-consuming tasks (like sending emails) to background workers, improving API response times.
    *   **Mailables (`ShouldQueue`):** Specific mailables are designed to be queueable.

11. **Configuration Management:**
    *   Use of `.env` files for environment-specific configuration.
    *   Configuration files (`config/*.php`) provide defaults and access to `.env` variables.

12. **Security:**
    *   **CSRF Protection:** Handled by Sanctum for SPA authentication.
    *   **Input Sanitization/Validation:** Prevents common vulnerabilities like XSS (via Blade if used, or careful handling of user input) and SQL injection (via Eloquent's prepared statements).
    *   **Password Hashing:** Laravel uses secure hashing (Bcrypt/Argon2) by default.
    *   **Rate Limiting:** Applied to sensitive routes (e.g., login, email verification requests).
    *   **HTTPS:** (Assumed for production deployment) Essential for secure communication.

13. **Code Style & Readability:**
    *   Adherence to PSR standards (Laravel follows these by default).
    *   Clear naming conventions for variables, methods, classes.
    *   Code comments for complex logic.

14. **Eloquent ORM Best Practices:**
    *   **Eager Loading (`with()`):** To prevent N+1 query problems when accessing relationships.
    *   **Query Scopes:** For reusable query constraints.
    *   **Accessors & Mutators:** For formatting attributes or modifying them before saving.
    *   **Model Observers/Events:** For hooking into model lifecycle events.

15. **Testing (Conceptual, as per Bonus):**
    *   Unit tests for services, models, and critical business logic.
    *   Feature/Integration tests for API endpoints.

**II. Vue.js Frontend Best Practices:**

1.  **Component-Based Architecture:**
    *   Breaking down the UI into reusable and manageable components (e.g., `ProductCard`, `LoginForm`, `AppButton`).
    *   Single Responsibility Principle for components.

2.  **State Management (Pinia):**
    *   Centralized state management for shared application data (e.g., user authentication, cart, product list).
    *   Clear separation of state, getters, and actions.
    *   Modular store design (e.g., `authStore`, `cartStore`, `productStore`).
    *   Persistence of critical state (auth token, cart) to `localStorage`.

3.  **Routing (Vue Router):**
    *   Clear route definitions for different pages/views.
    *   Navigation guards for protecting routes (e.g., requiring authentication, redirecting if verified/unverified).
    *   Lazy loading routes for better initial load performance (not explicitly detailed but a common practice).

4.  **API Communication (Axios):**
    *   Centralized Axios instance (`src/services/api.js`) with base URL.
    *   Interceptors for request (e.g., attaching auth token) and response (e.g., handling 401 errors for logout).
    *   Fetching CSRF cookie from Sanctum before making state-changing requests.

5.  **Props Down, Events Up:**
    *   Data flows from parent to child components via props.
    *   Child components communicate changes or actions to parents by emitting events.

6.  **Reusable UI Components:**
    *   Creating generic UI elements (e.g., `AppButton`, `AppInput`, `AlertMessage`, `LoadingSpinner`) for consistency and DRY principles.

7.  **Form Handling & Validation:**
    *   Client-side validation for immediate user feedback, complementing backend validation.
    *   Clear error messages displayed near form fields.
    *   Managing loading states for form submissions.

8.  **Error Handling:**
    *   Gracefully handling API errors (e.g., displaying toast notifications or alert messages).
    *   Providing user-friendly feedback when things go wrong.

9.  **Loading States & User Feedback:**
    *   Displaying loading indicators (spinners, disabled buttons) during asynchronous operations (e.g., API calls, form submissions).

10. **Code Structure & Organization:**
    *   Logical folder structure (e.g., `components`, `views`, `stores`, `services`, `router`).
    *   Naming conventions for files and components (e.g., PascalCase for Vue components).

11. **Environment Variables (Vite):**
    *   Using `.env.[mode]` files (e.g., `.env.development`) for environment-specific frontend configuration (like API base URL).

12. **CSS Styling (TailwindCSS):**
    *   Utility-first CSS framework for rapid UI development and consistent styling.

13. **Performance (Conceptual):**
    *   Code splitting/lazy loading (via Vue Router).
    *   Optimizing images.
    *   Minimizing re-renders using computed properties and careful state management.
    *   Debouncing/throttling for frequent events (e.g., cart quantity updates).

14. **Security (Client-Side):**
    *   While most security is backend-focused, frontend avoids rendering raw HTML from user input (Vue handles this well by default).
    *   Securely handling auth tokens (stored in Pinia, persisted to `localStorage`, sent via Authorization header).

### Code Structure
*   **Containerization for Backend & Services:** Docker isolates backend dependencies (PHP version, extensions, PostgreSQL, Redis), ensuring consistency across developer machines and easier onboarding.
*   **Separation of Concerns:**
    *   Backend logic is distinct from frontend.
    *   Databases, caches, and mail servers are separate, replaceable services.
*   **Modular Code** Request are implemented in Request Class, Controller are to handle requests and Services to handle Business Logic.
*   **Infrastructure as Code:** `docker-compose.yml` and `Dockerfile` define the backend environment, making it reproducible.
*   **Development Parity (Backend):** The Dockerized backend environment aims to mimic production more closely than a native PHP installation might, especially regarding services like Redis and distinct PHP-FPM processes.
*   **Environment Variables:** Configuration is externalized from code using `.env` files, adhering to 12-factor app principles.
*   **Live Reloading / HMR:** Essential for developer productivity, provided by Vite (frontend on host) and opcache settings (backend in Docker).
*   **Named Volumes for Data Persistence:** Database data (PostgreSQL) and Redis data are persisted across `docker compose down/up` cycles using named volumes.
*   **Non-Root Users in Containers (Backend):** The Laravel `app` container runs PHP-FPM and artisan commands as a non-root user (though Supervisor starts as root to manage them), improving security.
*   **Clear Port Mapping:** Ports for services exposed to the host are explicitly defined, with options for customization to avoid conflicts.
*   **Committed Configuration for Reproducibility:** Key Docker configuration files (`docker-compose.yml`, `Dockerfile`) are version-controlled.
*   **Service Discovery within Docker Network:** Backend services (e.g., `app`, `db`, `redis`) communicate using their Docker Compose service names over the internal Docker network.
*   **CORS and Sanctum Configuration:** Addresses the need for secure cross-origin communication between the host-run frontend and the Dockerized backend API.
*   **Optimized Docker Images (Backend):** The backend `Dockerfile` uses multi-stage builds (conceptually, by having a `composer install` step) and aims to install only necessary dependencies, cleaning up build tools to keep image size reasonable.
*   **Detailed Logging:** Supervisor directs PHP-FPM and worker logs to stdout/stderr, which are then accessible via `docker compose logs`. Nginx also logs to stdout/stderr.
