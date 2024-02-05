# GoLang

1. Грейды
   * Грейды 1-5
      * [Грейд 1](#Grade-1)
      * [Грейд 2](#Grade-2)
      * [Грейд 3](#Grade-3)
      * [Грейд 4](#Grade-4)
      * [Грейд 5](#Grade-5)
   * Грейды 6-10
      * [Грейд 6](#Grade-6)
      * [Грейд 7](#Grade-7)
      * [Грейд 8](#Grade-8)
      * [Грейд 9](#Grade-9)
      * [Грейд 10](#Grade-10)


## Grade 1

### Theory
- Императивное и декларативное программирование
- Компилируемые и интерпретируемые языки программирования
- Области применения различных языков программирования

### Language
- Ключевые слова var, const, type
- Типы данных (int, uint, string, rune, float, complex, bool, iota)
- Type casting (Type assertion, type switch)
- Shadow return

### Practice
- Решение 3х easy задач на leetcode

## Grade 2
**[⬆ вернуться к началу](#GoLang)**

### Theory
- Разрядность операционной системы
- Виды операционных систем
- Переменные окружения

### Language
- Конструкции
  - make
  - init()
  - :=
  - new()
- Типы данных (array, slice, map)
- Циклы (forr, fori, break, continue)
- Labels (break, continue, goto)
- switch case (fallthrough)

### Practice
- Решение 3 easy и 1 medium задачи на leetcode


## Grade 3
**[⬆ вернуться к началу](#GoLang)**

### Theory
- Система управления пакетами
- Функции и методы
- Понятие об алгоритмах, сложность (O большое)
- IDE, инструментарий разработчика

### Language
- Типы данных (struct, nil, interface{}, error, generic)
- Тип как func
- Пакеты и модули (package, import, go mod, go sum)
- Функции (main, named func, лямбда)
- Обработка ошибок, errors.Is, errors.As, errors.Wrap

### Practice
- Решение 2 medium задачи на leetcode


## Grade 4
**[⬆ вернуться к началу](#GoLang)**

### Theory
- Ссылки, указатели (разыменование указателя)
- Heap, stack
- Жизненный цикл процесса linux

### Language
- Конструкции &, * (как golang работает с указателями)
- defer
- panic (recover)
- strings.Builder (оптимизация работы со строками)

### Practice
- Решение 3 medium задач на leetcode


## Grade 5
**[⬆ вернуться к началу](#GoLang)**

### Theory
- Зачем нужна структуризация проекта
- Понятие о тестировании ПО
- Линтеры
- Понятие о "чистом коде"

### Language
- Структура проекта (pkg, internal, cmd, api, ...)
- go test
- golangci-lint
- Подробный разбор slice (len, cap, append, *array)

### Practice
- Создание простого проекта на golang по ТЗ
- Написание unit тестов
- Добавить linter в проект


## Grade 6
**[⬆ вернуться к началу](#GoLang)**

### Theory
- Версионирование
- Протокол http (1.0/1.1, 2.0, 3.0)
- Наследование, инкапсуляция, полиморфизм
- Понятие о cli утилитах

### Language
- Основные изменения в версиях golang (1.15 -- 1.22)
- Описание и возможности библиотеки http.net
- Реализация маршрутизации запросов (роутинг)
- Как в golang можно реализовать наследование, инкапсуляцию, полиморфизм

### Practice
- Создание простого http сервера на golang по ТЗ
- Применить основные подходы ООП
- Написать cli утилиту по ТЗ (запуск миграций)


## Grade 7
**[⬆ вернуться к началу](#GoLang)**

### Theory
- REST, SOAP, gRPC и GraphQL
- Что такое обобщенное програмирование
- OpenApi спецификация

### Language
- Реализация gRPC, protobuf
- Кодогенерация
- Десериализация JSON (marshal, unmarshal)
- Использование тегов структур

### Practice
- Создание простого gRPC сервера на golang по ТЗ
- Применить кодогенерацию
- Добавить OpenApi спецификацию в проект


## Grade 8
**[⬆ вернуться к началу](#GoLang)**

### Theory
- Threads операционной системы
- Параллелизм, многопоточность, асинхронность
- Блокирующие и неблокирующие вызовы

### Language
- Конструкция go (горутины)
- Как именно устроены каналы (buffered/unbuffered, блокировки чтения/записи, доступ к стеку)
- Примитивы синхронизации (deadlock, race condition, go test -race)
  - sync.WaitGroup
  - sync.Mutex
  - sync.RWMutex
  - sync.Map
  - sync/atomic
  - sync/errgroup
- for select, time.NewTicker, semaphore

### Practice
- Решение задачи на concurrency


## Grade 9
**[⬆ вернуться к началу](#GoLang)**

### Theory
- Сборщик мусора
- Go scheduler
- Контейнеризация

### Language
- Утечки памяти
- Как именно устроена map? (hash table, buckets, эвакуация, коллизии)
- Сборка golang приложения в Docker контейнер (тип OS, переменные окружения, multi-stage builds)
- GOMAXPROCS
- Пакет context

### Practice
- Собрать приложение в dockerfile (docker compose)
- Использовать внешние вызовы (database, apis) с пакетом context
- Найти и исправить утечки памяти по ТЗ


## Grade 10
**[⬆ вернуться к началу](#GoLang)**

### Theory
- Observability & Monitoring
- Инструменты мониторинга системы Linux
- Postmortem

### Language
- Graceful shutdown
- Метрики приложения (на что обращать внимание)
- Устройство логирования (std_err, std_out...)

### Practice
- Добавить graceful shutdown в проект
- Огранизовать сбор и анализ метрик
- Организовать систему логирования