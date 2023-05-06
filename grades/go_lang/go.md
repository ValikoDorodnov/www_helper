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
    * [Типы](#Типы)
      * [Целочисленные типы](#Целочисленные-типы)
      * [Типы чисел с плавающей точкой](#Типы-чисел-с-плавающей-точкой)
      * [Комплексные типы](#Комплексные-типы)
      * [Строки](#Строки)

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

### Типы
**[⬆ вернуться к началу](#Разделы)**

#### Целочисленные типы

- int8
- int16
- int32 - rune (default int on 32 systems)
- int64        (default int on 64 systems)
- uint8 - byte
- uint16
- uint32
- uint64

Если нет необходимости в явном указании размерности или знака целочисленных значений из соображений производительности  
или обеспечения интеграции, используйте тип int. Пока не доказано иное, использование любого другого типа следует  
считать преждевременной оптимизацией.  

```go
myVar := 5 //int
myVar /= 0 //division by zero panic!!
```

#### Типы чисел с плавающей точкой

- float32
- float64

Выбрать подходящий тип достаточно просто: за исключением тех случаев, когда нужно обеспечить совместимость с имеющимся  
форматом, используется тип float64. Литералы чисел с плавающей запятой по умолчанию относятся к типу float64,  
поэтому самым простым решением будет всегда использовать тип float64.  

```go
var myVar float64
myVar /= 0 //NaN (no error)

myVar = 6.44
myVar /= 0 //+Inf (no error)

myVar = -6.44
myVar /= 0 //-Inf (no error)
```

#### Комплексные типы

- complex64 (float32)
- complex128 (float64)

```go
x := complex(2.5, 3.1)
y := complex(10.2, 2)
fmt.Println(x + y)
```

#### Строки

- string (rune for char)

```go
test := "test"
var test = "test"
var test string = "test"

```

В строковых литералах могут находиться специальные экранированные символы наподобие \n. Во избежание замены \n новой  
строкой можно поместить текст в обратные кавычки `` вместо обычных "". Обратные кавычки выводят строку в необработанном виде.  

```go
fmt.Println("peace be upon you\nupon you be peace")
fmt.Println(`strings can span multiple lines with the \n escape sequence`)

//peace be upon you
//upon you be peace
//strings can span multiple lines with the \n escape sequence
```

Для представления Юникода в Go используется тип rune, который иначе называется int32.  
```
var grade rune = 'A'

fmt.Printf("grade is %d", grade) // 65
fmt.Printf("grade is %c", grade) // A
```

```go
t := "а" //строка с кириллицей
r := []rune(t) //представление строки в виде рун

for i := 0; i < len(t); i++ { //итерирование по байтам
	println(string(t[i]))
}
//Ð
//°

for _, char := range r { //итерирование по рунам
	println(string(char))
}
//а
```

Строки в go неизменяемы

```go
shalom := "shalom"
shalom = "salām"

c := shalom[5]
fmt.Printf("%c\n", c) // Выводит: m

shalom[5] = "d" // !!! Нельзя присвоить shalom[5]
```