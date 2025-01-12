# GoLang

1
- [Ключевые слова var, const, type](https://github.com/ValikoDorodnov/www_helper/blob/master/grades/golang/knowledge/g1.md#1)
- [Типы данных (int, uint, string, rune, float, complex, bool, iota)](https://github.com/ValikoDorodnov/www_helper/blob/master/grades/golang/knowledge/g1.md#2)
- [Type casting (Type assertion, type switch)](https://github.com/ValikoDorodnov/www_helper/blob/master/grades/golang/knowledge/g1.md#3)
- [Shadow return](https://github.com/ValikoDorodnov/www_helper/blob/master/grades/golang/knowledge/g1.md#4)

2
- [Конструкции](https://github.com/ValikoDorodnov/www_helper/blob/master/grades/golang/knowledge/g2.md#1)
  - make
  - init()
  - :=
  - new()
- [Типы данных (array, slice, map)](https://github.com/ValikoDorodnov/www_helper/blob/master/grades/golang/knowledge/g2.md#2)
- [Циклы (forr, fori, break, continue)](https://github.com/ValikoDorodnov/www_helper/blob/master/grades/golang/knowledge/g2.md#3)
- [Labels (break, continue, goto)](https://github.com/ValikoDorodnov/www_helper/blob/master/grades/golang/knowledge/g2.md#3)
- [switch case (fallthrough)](https://github.com/ValikoDorodnov/www_helper/blob/master/grades/golang/knowledge/g2.md#4)

3
- [Типы данных (struct, nil, interface{}, error, generic)](https://github.com/ValikoDorodnov/www_helper/blob/master/grades/golang/knowledge/g3.md#1)
- [Тип как func](https://github.com/ValikoDorodnov/www_helper/blob/master/grades/golang/knowledge/g3.md#2)
- [Пакеты и модули (package, import, go mod, go sum)](https://github.com/ValikoDorodnov/www_helper/blob/master/grades/golang/knowledge/g3.md#3)
- [Функции лямбда и closure](https://github.com/ValikoDorodnov/www_helper/blob/master/grades/golang/knowledge/g3.md#4)
- [Обработка ошибок, errors.Is, errors.As, errors.Wrap](https://github.com/ValikoDorodnov/www_helper/blob/master/grades/golang/knowledge/g3.md#5)

4
- Конструкции &, * (как golang работает с ссылками и указателями)
- defer
- panic (recover)
- strings.Builder (оптимизация работы со строками)
- Heap, stack

5
- Протокол http (1.0/1.1, 2.0, 3.0)
- Основные изменения в версиях golang (1.15 -- 1.22)
- Описание и возможности библиотеки http.net
- Реализация маршрутизации запросов (роутинг)
- средства промежуточной обработки запросов Middleware
- Как в golang можно реализовать наследование, инкапсуляцию, полиморфизм

6
- Структура проекта (pkg, internal, cmd, api, ...)
- go test (Mocks, Integration Tests)
- golangci-lint
- Сборка golang приложения в Docker контейнер (тип OS, переменные окружения, multi-stage builds)
- Graceful shutdown
- GOMAXPROCS

7
- Утечки памяти
- Garbage collector
- Как именно устроена map? (hash table, buckets, эвакуация, коллизии)
- Подробный разбор slice (len, cap, append, *array)
  - slice[x:]
  - slice[:x]
  - slice[x:x]
- Пакет context

8
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

9
- Реализация gRPC, protobuf, WebSocket
- Кодогенерация
- Десериализация JSON (marshal, unmarshal)
- Использование тегов структур

10
- Observability & Monitoring
- Postmortem
- Использование CI/CD инструментов
- Метрики приложения (на что обращать внимание)
- Benchmarking
- Устройство логирования (std_err, std_out...)