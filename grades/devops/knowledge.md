# Devops knowledge

## Мониторинг (Observability)

### Метрики (Metrics)

это цифры, показывающие информацию о текущих процессах или активностях

Типы метрик:
- System-level Performance (CPU, Memory, IO utilization)
- Application-level Performance (кол-во запросов, утилизация памяти, кеш)
- Server Availability and Uptime (доступность серверов healthcheck)
- Business-level (например кол-во заказов в час и т.д.)

Подходы сбора метрик:
- USE: (мониторинг инфраструктуры)
    - Utilization (кол-во использованных ресурсов)
    - Saturation (насколько ресурс перегружен overhead)
    - Errors (кол-во ошибок)
- RED:
    - Rate (кол-во запросов в единицу времени)
    - Error (кол-во запросов с ошибками)
    - Duration (время выполнения запроса)
- GSG (Golden Signals of Google)
    - Latency (время требующееся для обработки запросов)
    - Traffic (кол-во запросов на сервис)
    - Errors (кол-во неудавшихся запросов)
    - Saturation (насколько перегружены сервисы)