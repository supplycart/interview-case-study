# Supplycart use case task by qayyum


### 1. Clone this repository to your local folder

```bash
git clone https://github.com/koyomdev21/interview-case-study.git
```

```bash
cd interview-case-study
```

### 2. Create .env

```bash
cp .env.example .env
```

### 3. Setup .env variables

#### 3.1 Set up base url for your application

```dotenv
APP_URL=
```

#### 3.2 Set up your database credentials, im using postgres. change as you like

```dotenv
DB_CONNECTION=pgsql
#DB_HOST=localhost
#DB_PORT=5432
#DB_DATABASE=postgres
#DB_USERNAME=postgres
#DB_PASSWORD=postgres
```

#### 3.3 Set up your cache & session driver, filesystem disk & queue connection

```dotenv
CACHE_DRIVER=database
FILESYSTEM_DISK=public
QUEUE_CONNECTION=database
SESSION_DRIVER=database
```

#### 3.4 Set up mail SMTP options(must have working smtp setup if want working email verification)

```dotenv
MAIL_MAILER=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
```

### 4. Install all composer & npm dependencies

```bash
composer install
```

```bash
npm install
```

### 5. Run artisan commands

```bash
php artisan key:generate
```

```bash
php artisan storage:link
```

```bash
php artisan migrate:fresh --seed
```

```bash
php artisan optimize:clear
```

```bash
php artisan serve
```

### 7. Run dev server

```bash
npm run dev
```

### 8. Access through localhost in your browser

```markdown
Open your browser and navigate to [http://localhost:8000](http://localhost:8000) to access the application.
```
