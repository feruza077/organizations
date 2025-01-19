Этот проект представляет собой Laravel-приложение, развернутое с помощью Docker. Используются PostgreSQL для работы с базой данных, PgAdmin для управления базой данных, а также Laravel Sail для работы с контейнерами.
Установка

# Копирование файла .env

cp .env.example .env

# Установка зависимостей Composer

docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs

# Запуск контейнеров:

make up

# Миграции и заполнение базы тестовыми данными:

make migrate-seed

# Генерация Swagger-документации:

make swagger-generate

# Доступ к приложению

Приложение:
    http://localhost:9999

PgAdmin (панель управления PostgreSQL):
    http://localhost:9090
    Логин: admin@admin.com
    Пароль: admin

# Технологии

    Laravel 8+
    Docker
    PostgreSQL
    PgAdmin 4
    Swagger