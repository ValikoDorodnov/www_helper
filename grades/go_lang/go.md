### GoLang
[Official web page](https://golang.org/)  
[GoLang developer roadmap](https://github.com/Alikhll/golang-developer-roadmap)  
[Web go skeleton](https://github.com/windstep/go-web-skeleton)  
[Go-lang book](http://golang-book.ru/)  
[Введение в язык Go](https://metanit.com/go/tutorial/1.1.php)  


### Общая информация
[Собеседование Golang разработчика (теоретические вопросы), Часть I](https://habr.com/ru/post/654569/)  
[Собеседование Golang разработчика (теоретические вопросы), Часть II](https://habr.com/ru/post/670974/)  
[50 оттенков Go: ловушки, подводные камни и распространённые ошибки новичков](https://habr.com/ru/company/vk/blog/314804/)  
[Планирование в Go: Часть I — Планировщик ОС](https://habr.com/ru/post/478168/)  
[Планирование в Go: Часть II — Планировщик Go](https://habr.com/ru/post/489862/)  
[Performance without the event loop – The acme of foolishness](https://dave.cheney.net/2015/08/08/performance-without-the-event-loop)  
[Channel Use Cases - Go 101: an online Go programming book + knowledge base](https://go101.org/article/channel-use-cases.html)  
[GitHub - AlexanderGrom/go-patterns: Design patterns in Golang](https://github.com/AlexanderGrom/go-patterns)  
[Алгоритмы в Golang](https://vavilen84.com/ru/golang/2021/03/algorithms_in_go/)  
[Шаблоны проектирования микросервисов на примере Авито YouTube](https://www.youtube.com/watch?v=5_9x7czHJOM)  
[Паттерны микросервисной разработки: самый полный список](https://mcs.mail.ru/blog/26-osnovnyh-patternov-mikroservisnoj-razrabotki)  
[Go. Прорабатываем 25 основных вопросов собеседования](https://nuancesprog.ru/p/12333/)  
[Собеседование на позицию Golang разработчика](https://parshinpn.ru/ru/blog/golang-interview)  


### Особенности языка
[SliceTricks · golang/go Wiki · GitHub](https://github.com/golang/go/wiki/SliceTricks)  
[Home · go101/go101 Wiki · GitHub](https://github.com/go101/go101/wiki)  
[Горутины: всё, что вы хотели знать, но боялись спросить / Хабр](https://habr.com/ru/post/141853/)  
[Как устроены каналы в Go / Хабр](https://habr.com/ru/post/308070/)  
[Хэш таблицы в Go. Детали реализации](https://habr.com/ru/post/457728/)  
[Шпаргалка по структурам данных в Go](https://habr.com/ru/post/456194/)  
[Разбираемся с новым sync.Map в Go 1.9](https://habr.com/ru/post/338718/)  
[GC в Go: приоритет на скорость и простоту](https://habr.com/ru/post/265833/)



# GoLang

# Разделы
1. [Грейды](#Грейды)
    * [Основы языка](#Основы-языка)
      * [Переменные](#Переменные)
      * [Константы](#Константы)


## Грейды

### Основы языка
**[⬆ вернуться к началу](#Разделы)**

#### Переменные
Переменные в Go объявляются с помощью ключевого слова var, за которым следует имя переменной и ее тип. Например:
```go
var x int // объявление переменной типа int
x = 5     // присваивание значения переменной
```

В Go также есть сокращенный способ объявления и инициализации переменной:
```go
y := 10 // объявление и инициализация переменной типа int
```

Переменные на уровне пакета в языке Go - это переменные, которые определены вне тела функции, но внутри пакета.  
Они могут быть использованы в любом месте внутри этого пакета, в том числе внутри функций, определенных в этом пакете.
```go
package mypackage

import (
   "fmt"
)
var myIntVar int // будет дефолтное значение для типа - 0
var myVar = "string" // будет присвоено значение и тип

func test() {
   fmt.Printf("my int var is %d", myIntVar)
   fmt.Printf("my str var is %s", myVar)
}
```

#### Константы
В Go константы - это именованные значения, которые нельзя изменять во время выполнения программы. Они объявляются с  
помощью ключевого слова const, за которым следует имя константы и ее значение.  
```go
const pi = 3.14159
const appName = "My App"
```

Константы в Go могут иметь следующие типы данных: boolean, числа (integer, floating-point и complex), строки и руны.  

в Go есть специальные неопределенные константы **iota**, которые используются для создания последовательности целочисленных  
констант. Они начинаются с 0 и автоматически инкрементируются на 1 при каждом использовании.  
```go
const (
    C0 = iota
    C1
    C2
)
fmt.Println(C0, C1, C2) // "0 1 2"

const (
    C1 = iota + 1
    C2
    C3
)
fmt.Println(C1, C2, C3) // "1 2 3"


const (
    C1 = iota + 1
    _
    C3
    C4
)
fmt.Println(C1, C3, C4) // "1 3 4"
```