---Перечень таблиц по схеме
SELECT table_name FROM information_schema.tables
WHERE table_schema NOT IN ('information_schema', 'pg_catalog')
  AND table_schema IN('b2c');


-- Получить имя текущей базы
SELECT * FROM information_schema.information_schema_catalog_name;

-- Все стандартные поддерживаемые функции sql
SELECT * FROM information_schema.sql_features;

-- Список ограничений БД
SELECT * FROM information_schema.sql_sizing;

-- list all check constraints
SELECT * FROM information_schema.check_constraints;

-- lists all views in the database
SELECT * FROM information_schema.views;

-- list all enabled roles
SELECT * FROM information_schema.enabled_roles;

-- lists all of the schemas
SELECT * FROM information_schema.schemata;