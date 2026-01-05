# CLI CRUD з PostgreSQL та Docker

## Опис
Проект демонструє просту CRUD-систему для сутності `products` з використанням PHP CLI та PostgreSQL у Docker. 

## Структура проекту
- `crud/` — клас `ProductCrud.php` з методами CRUD.
- `db.php` — підключення до PostgreSQL через PDO.
- `console.php` — точка входу для CLI-меню.
- `menu.php` — інтерактивне меню для роботи з продуктами.
- `Dockerfile` — збірка PHP CLI з PDO PgSQL.
- `docker-compose.yml` — підняття середовища PHP + PostgreSQL.
- `.env.example` — приклад файлу оточення.

## Запуск
1. Скопіювати `.env.example` у `.env` і при необхідності змінити параметри:

```bash
cp .env.example .env
```
2. Підняти Docker-контейнери:

```bash
docker compose up -d --build
```

3. Підключіться до PHP CLI для роботи з меню:
```bash
docker compose exec php php /app/console.php
```
4. Для перегляду логів:
```bash
docker logs postgres_db
```
5. Для повного очищення бази перед повторним запуском:
```bash
docker compose down -v
docker compose up -d --build
```

## Варіанти роботи з проєктом
1. Через PHP CLI
```bash
docker compose exec php php /lab4/bin/console.php
```
- Меню дозволяє виконувати List, Create, Update, Delete
- Таблиця products створюється автоматично при першому запуску

Приклад використання:
```sql
1 - Products
0 - Exit
> 1
1 - List
2 - Create
3 - Update
4 - Delete
> 2
Name: Apple
Price: 12.5
Added
```

2. Через PostgreSQL
Пряме підключення до бази для виконання SQL-запитів:
```bash
docker exec -it postgres_db psql -U postgres -d cli_crud
```
Приклади SQL:
```sql
SELECT * FROM products;
INSERT INTO products(name, price) VALUES('Orange', 10.50);
UPDATE products SET price = 11.00 WHERE id = 1;
DELETE FROM products WHERE id = 1;
```

