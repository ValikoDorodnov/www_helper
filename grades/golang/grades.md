# GoLang

- [Ключевые слова var, const, type](https://github.com/ValikoDorodnov/www_helper/blob/master/grades/golang/knowledge/g1.md#grade-1)
- [Типы данных (int, uint, string, rune, float, complex, bool, iota)](https://github.com/ValikoDorodnov/www_helper/blob/master/grades/golang/knowledge/g1.md#grade-2)
- [Type casting (Type assertion, type switch)](https://github.com/ValikoDorodnov/www_helper/blob/master/grades/golang/knowledge/g1.md#grade-3)
- [Shadow return](https://github.com/ValikoDorodnov/www_helper/blob/master/grades/golang/knowledge/g1.md#grade-4)


- Конструкции
  - make
  - init()
  - :=
  - new()
- Типы данных (array, slice, map)
- Циклы (forr, fori, break, continue)
- Labels (break, continue, goto)
- switch case (fallthrough)


- Типы данных (struct, nil, interface{}, error, generic)
- Тип как func
- Пакеты и модули (package, import, go mod, go sum)
- Функции (main, named func, лямбда)
- Обработка ошибок, errors.Is, errors.As, errors.Wrap


- Конструкции &, * (как golang работает с ссылками и указателями)
- defer
- panic (recover)
- strings.Builder (оптимизация работы со строками)
- Heap, stack


- Протокол http (1.0/1.1, 2.0, 3.0)
- Основные изменения в версиях golang (1.15 -- 1.22)
- Описание и возможности библиотеки http.net
- Реализация маршрутизации запросов (роутинг)
- средства промежуточной обработки запросов Middleware
- Как в golang можно реализовать наследование, инкапсуляцию, полиморфизм

- Структура проекта (pkg, internal, cmd, api, ...)
- go test (Mocks, Integration Tests)
- golangci-lint
- Сборка golang приложения в Docker контейнер (тип OS, переменные окружения, multi-stage builds)
- Graceful shutdown
- GOMAXPROCS


- Утечки памяти
- Garbage collector
- Как именно устроена map? (hash table, buckets, эвакуация, коллизии)
- Подробный разбор slice (len, cap, append, *array)
  - slice[x:]
  - slice[:x]
  - slice[x:x]
- Пакет context


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
- Worker pool


- Реализация gRPC, protobuf, WebSocket
- Кодогенерация
- Десериализация JSON (marshal, unmarshal)
- Использование тегов структур


- Observability & Monitoring
- Postmortem
- Использование CI/CD инструментов
- Метрики приложения (на что обращать внимание)
- Benchmarking
- Устройство логирования (std_err, std_out...)