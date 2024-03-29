## Грейд 13

### Theory

#### Микросервисная архитектура

Термин «Microservice Architecture» получил распространение в последние несколько лет как описание способа дизайна  
приложений в виде набора независимо развертываемых сервисов. В то время как нет точного описания этого архитектурного  
стиля, существует некий общий набор характеристик: организация сервисов вокруг бизнес-потребностей, автоматическое  
развертывание, перенос логики от шины сообщений к приемникам (endpoints) и децентрализованный контроль над языками  
и данными.  

Если коротко, то архитектурный стиль микросервисов — это подход, при котором единое приложение строится как набор  
небольших сервисов, каждый из которых работает в собственном процессе и коммуницирует с остальными используя  
легковесные механизмы, как правило HTTP. Эти сервисы построены вокруг бизнес-потребностей и развертываются независимо  
с использованием полностью автоматизированной среды.  

Если вы разрабатываете приложение, состоящее из нескольких библиотек, работающих в одном процессе, любое изменение  
в этих библиотеках приводит к переразвертыванию всего приложения. Но если ваше приложение разбито на несколько  
сервисов, то изменения, затрагивающие какой-либо из них, потребуют переразвертывания только изменившегося сервиса  

Наиболее популярным сейчас считается мнение о том, что сервис должен быть настолько большим, чтобы он мог  
полностью «уместиться в голове разработчика», независимо от количества строк кода.

Проектирование под отказ (Design for failure)  
Следствием использования сервисов как компонентов является необходимость проектирования приложений так, чтобы они  
могли работать при отказе отдельных сервисов. Любое обращение к сервису может не сработать из-за его недоступности.  
Клиент должен реагировать на это настолько терпимо, насколько возможно.  

Плюсы:
- при грамотном разделении проекта на сервисы можно получить "независимые" компоненты, которые можно разрабатывать и поддерживать независимо от других компонентов системы
- более прозрачная архитектура проекта
- возможность применять разные стеки технологий для сервисов
- при отказе одного сервиса не должна отказать все приложение

Минусы:
- при неправильном разделении (слишком мелком дроблении) может усложниться понимание архитектуры и интеграции
- сервисы получились не независимыми (один сервис требует другой для работы и так далее)
- чем больше сервисов, тем дольше может идти общение по http 
- для сбора информации нужно обойти слишком много сервисов
- требуются более опытные разработчики для развертывания систем CI CD и мониторинга

#### JSON API

JSON API - open source спецификация для работы по протоколу HTTP.  

Cпецификация JSON API решает ряд проблем — общее соглашение для всех. Раз есть общее соглашение, то мы не спорим  
внутри команды — велосипедный сарай задокументирован. У нас есть соглашение, из каких материалов делать велосипедный  
сарай и как его красить.  

Как REST так и JSON api - это контракт, договор между клиентом и сервером о том как взаимодействовать друг с другом.
Контракт REST строится вокруг стандартных методов HTTP (GET, POST, PUT, DELETE) и схемы url.  
Клиент получает и отправляет данные на сервер с через формирование запросов по URL адресам.  
JSON api - контракт о том что данные с сервера будут приходить в JSON формате. Данные могут приходить как ответы к  
REST запросам. А так же JSON api может быть реализован поверх других транспортов (websocket, webrtc).  

REST не исключает, но и не ограничивается JSON api.  


Различия можно явно увидеть если сравнить пути решения одной и той же задачи разными способами - используя REST и JSON api  

задача:
- получить статью и детальную информация о авторе статьи

```
//REST
// GET /article/1 - получает статью
{
  id: 1,
  text: "some text",
  created: 'date'
   // etc
  authorId: 3
}

// GET /authors/3 - получает автора
{
  id: 3,
  name: "Petya",
  dateOfBirth: '1989-09-12'
   // etc
}

//JSON api
// GET /article/1?include=author
{
  id: 1,
  text: "some text",
  created: 'date'
   // etc
  author: {
     id: 3,
     name: "Petya",
     dateOfBirth: '1989-09-12'
     // etc
  }
}
```

#### GraphQL

В двух словах, GraphQL это синтаксис, который описывает как запрашивать данные, и, в основном, используется клиентом  
для загрузки данных с сервера. GraphQL имеет три основные характеристики:
- Позволяет клиенту точно указать, какие данные ему нужны.
- Облегчает агрегацию данных из нескольких источников.
- Использует систему типов для описания данных.

Facebook придумал концептуально простое решение: вместо того, чтобы иметь множество "глупых" endpoint, лучше иметь  
один "умный" endpoint, который будет способен работать со сложными запросами и придавать данным такую форму,  
какую запрашивает клиент.  

Фактически, слой GraphQL находится между клиентом и одним или несколькими источниками данных; он принимает запросы  
клиентов и возвращает необходимые данные в соответствии с переданными инструкциями.  

На практике GraphQL API построен на трёх основных строительных блоках: 
- на схеме (schema)
- запросах (queries)
- распознавателях (resolvers)


##### queries
```
query {
  stuff {
    eggs
    shirt
    pizza
  }
}
```

##### resolvers
```
Query: {
    post(root, args) {
        return Posts.find({ id: args.id });
    }
}
```

##### schema
```
import gql from 'graphql-tag'
import mongodb from '/path/to/mongodb’ // Это - лишь пример. Предполагается, что `mongodb` даёт нам подключение к MongoDB.


const schema = {
  typeDefs: gql`
    type Nutrition {
      flavorId: ID
      calories: Int
      fat: Int
      sodium: Int
    }

    type Flavor {
      id: ID
      name: String
      description: String
      nutrition: Nutrition
    }

    type Query {
      flavors(id: ID): [Flavor]
    }

    type Mutation {
      updateFlavor(id: ID!, name: String, description: String): Flavor
    }
  `,
  resolvers: {
    Query: {
      flavors: (parent, args) => {
        // Предполагается, что args равно объекту, наподобие { id: '1' }
        return mongodb.collection('flavors').find(args).toArray()
      },
    },
    Mutation: {
      updateFlavor: (parent, args) => {
        // Предполагается, что args равно объекту наподобие { id: '1', name: 'Movie Theater Clone', description: 'Bring the movie theater taste home!' }

        // Выполняем обновление.

        mongodb.collection('flavors').update(args)

        // Возвращаем flavor после обновления.

        return mongodb.collection('flavors').findOne(args.id)
      },
    },
    Flavor: {
      nutrition: (parent) => {
        return mongodb.collection('nutrition').findOne({
          flavorId: parent.id,
        })
      }
    },
  },
}

export default schema
```

#### Принципы разработки: SOLID

Аббревиатура SOLID была предложена Робертом Мартином, автором нескольких книг, широко известных в сообществе  
разработчиков. Эти принципы позволяют строить на базе ООП масштабируемые и сопровождаемые программные продукты с  
понятной бизнес-логикой.  

- Single responsibility — принцип единственной ответственности
- Open-closed — принцип открытости / закрытости
- Liskov substitution — принцип подстановки Барбары Лисков
- Interface segregation — принцип разделения интерфейса
- Dependency inversion — принцип инверсии зависимостей


#### Проблемы и решения SOLID

- Нельзя чтобы при изменении одной бизнес фичи перестала работать другая → Ограничиваем код одной бизнес фичей → SRP
- Добавление нового не должно требовать переделывания старого → проектируем легко расширяемый код → OCP
- Код не должен разваливаться при замене одного компонента на другой → Классы и компоненты с одинаковыми внешними интерфейсами должны быть взаимозаменяемы → LSP
- Изменение интерфейса не должно ломать посторонний код → меняя часть интерфейса, мы не должны затронуть код который её не использует → все методы интерфейса должны использоваться → проектируем интерфейсы так, чтобы неиспользуемых частей не было → ISP
- Система не должна сломаться от мелких изменений → высокоуровневая абстракция не должна зависеть от деталей → разворачиваем зависимости в обратную сторону (инвертируем зависимости), чтобы детали зависели от абстракций → DIP

##### Single responsibility — принцип единственной ответственности

Принцип декларирует, что каждый объект должен иметь одну обязанность и эта обязанность должна  
быть полностью инкапсулирована в класс, а все его сервисы должны быть направлены исключительно на  
обеспечение этой обязанности.  

Следование принципу заключается обычно в декомпозиции сложных классов, которые делают сразу много вещей,  
на простые, отвественность которых очень специализирована. Но также и объединении в отдельный класс однотипной  
функциональности, которая может оказаться распределённой по многим классам, может рассматриваться как следование  
этому принципу.  

Следование SRP весьма полезная практика с точки зрения повторного использования кода. Сложные объекты с комплексными  
зависимостями обычно очень сложно использовать повторно, особенно если нужна только часть реализованного в них  
функционала. А небольшие классы с чётко очерченным функционалом, напротив, проще использовать повторно,  
так как они не избыточные и редко тянут за собой существенный объём зависимостей.  

Например, часто используемый во фреймворках паттерн ActiveRecord нарушает принцип единственной ответственности.  
ActiveRecord реально объединяет в себе очень много функциональных возможностей и часто смешивает бизнес-логику и работу  
со слоем хранения. При этом использование ActiveRecord часто является удобным и целесообразным. На этом примере  
становится ясно, что SRP — это не догма, а нарушение этого принципа вполне может быть логичным и целесообразным.  


##### Open-closed — принцип открытости / закрытости

Принцип декларирует, что программные сущности (классы, модули, функции и т. п.) должны быть открыты для расширения,  
но закрыты для изменения. Это означает, что эти сущности могут менять свое поведение без изменения их исходного кода.  

Другими словами, нужно избегать случаев, когда появление новых требований к функциональности влечет за собой  
модификацию существующей логики, стараясь реализовать возможность ее расширения.  

Нашей целью является разработка системы, которая будет достаточно просто и безболезненно меняться. Другими словами,  
система должна быть гибкой. Например, внесение изменений в библиотеку общую для 4х проектов не должно быть долгим  
(«долгим» является разным промежутком времени для конкретной ситуации) и уж точно не должно вести к изменениям  
в этих 4х проектах.  

```
//Конкретная реализация
public class Logger
{
    public void Log(string logText)
    {
        // сохранить лог в файле
    }
}
  
public class SmtpMailer
{
    private readonly Logger logger;
  
    public SmtpMailer()
    {
        logger = new Logger();
    }
  
    public void SendMessage(string message)
    {
        // отсылка сообщения
  
        logger.Log(string.Format("Отправлено '{0}'", message));
    }
}

//Конкретная реализация для сохранения логов в базу
public class DatabaseLogger
{
    public void Log(string logText)
    {
        // сохранить лог в базе данных
    }
}


//А теперь самое интересное. Мы должны изменить класс SmptMailer из-за изменившегося бизнес-требования.
//! но следуя принципу open/close мы не должны менять код, а только дополнять
```

##### Решение
```
public interface Logger
{
    void Log(string logText);
}
  
public class FileLogger : Logger
{
    public void Log(string logText)
    {
        // сохранить лог в файле
    }
}
  
public class DatabaseLogger : Logger
{
    public void Log(string logText)
    {
        // сохранить лог в базе данных
    }
}


//Теперь мы не зависим от реализации Logger и можем менять класс, добавляя новые зависимости (новые реализации Logger)
public class SmtpMailer
{
    private readonly Logger logger;
  
    public SmtpMailer(Logger logger)
    {
        this.logger = logger;
    }
  
    public void SendMessage(string message)
    {
        // отсылка сообщения
  
        logger.Log(string.Format("Отправлено '{0}'", message));
    }
}
```

##### Liskov substitution — принцип подстановки Барбары Лисков

Следование принципу LSP заключается в том, что при построении иерархий наследования создаваемые наследники должны  
корректно реализовывать поведение базового типа. То есть если базовый тип реализует определённое поведение, то это  
поведение должно быть корректно реализовано и для всех его наследников.  

Интерфейсы, реализумые наследниками, должны соответствовать контракту интерфейсов базового класса.  

Наследник класса дополняет, но не заменяет поведение базового класса. То есть в любом месте программы замена  
базового класса на класс-наследник не должна вызывать проблем.  


##### Interface segregation — принцип разделения интерфейса

Принцип в формулировке Роберта Мартина декларирует, что клиенты не должны зависеть от методов, которые они не используют.  
То есть если какой-то метод интерфейса не используется клиентом, то изменения этого метода не должны приводить к  
необходимости внесения изменений в клиентский код.  

В чём-то принцип разделения интерфейса перекликается с принципом единственной ответственности — интерфейсы не должны  
быть избыточно «толстыми», если вдруг в приложении формируется слишком объёмный интерфейс, то есть высокая вероятность,  
что так происходит из-за того, что в этом интерфейсе слишком много разных ответственностей, а значит  
логичнее всего провести декомпозицию сложного интерфейса на несколько простых.  


##### Dependency inversion — принцип инверсии зависимостей

Принцип декларирует, что модули верхних уровней не должны зависеть от модулей нижних уровней, а оба типа модулей  
должны зависеть от абстракций; сами абстракции не должны зависеть от деталей, а вот детали должны зависеть от абстракций.  

Суть принципа инверсии зависимостей проста: заменить композицию агрегацией. То есть вместо создания зависимостей  
напрямую, класс должен требовать их у более высокого уровня через аргументы метода или конструктора. При этом  
зависимость должна передаваться не в виде экземпляров конкретных классов, а в виде интерфейсов или абстрактных классов.  

##### Сильная связанность, пример плохого кода
```
class Order
{
    public function __construct(IDB $db, IDiscount $discount)
    {
        $this->db = $db;
        $this->discount = $discount;
    }

    public function calculate()
    {
        // ...
        $product = new Product();
        // ...
        $promo = new Promo();
        // ...
        $warehouse = new Warehouse();
        // ...
        $email = new Notification();
        // ...
    }
}
```

##### Слабая связанность, пример хорошего кода
```
class OrderInfo
{
    private IOrders $orders;

    public function __construct(IOrder $orders)
    {
        $this->orders = $orders;
    }

    public function get()
    {
        $productDescription = $this->orders->getInformation();
        // здесь идёт некоторый код и вызов view
    }
}
```

### Language

#### Паттерны проектирования: "наблюдатель"

Наблюдатель — это поведенческий паттерн проектирования, который создаёт механизм подписки, позволяющий одним  
объектам следить и реагировать на события, происходящие в других объектах  
При этом наблюдатели могут свободно подписываться и отписываться от этих оповещений.  

Решает проблему оповещения пользователей о выходе новой статьи в блоге.  

```php
/**
 * Издатель владеет некоторым важным состоянием и оповещает наблюдателей о его
 * изменениях.
 */
class Subject implements \SplSubject
{
    /**
     * @var int Для удобства в этой переменной хранится состояние Издателя,
     * необходимое всем подписчикам.
     */
    public $state;

    /**
     * @var \SplObjectStorage Список подписчиков. В реальной жизни список
     * подписчиков может храниться в более подробном виде (классифицируется по
     * типу события и т.д.)
     */
    private $observers;

    public function __construct()
    {
        $this->observers = new \SplObjectStorage();
    }

    /**
     * Методы управления подпиской.
     */
    public function attach(\SplObserver $observer): void
    {
        echo "Subject: Attached an observer.\n";
        $this->observers->attach($observer);
    }

    public function detach(\SplObserver $observer): void
    {
        $this->observers->detach($observer);
        echo "Subject: Detached an observer.\n";
    }

    /**
     * Запуск обновления в каждом подписчике.
     */
    public function notify(): void
    {
        echo "Subject: Notifying observers...\n";
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    /**
     * Обычно логика подписки – только часть того, что делает Издатель. Издатели
     * часто содержат некоторую важную бизнес-логику, которая запускает метод
     * уведомления всякий раз, когда должно произойти что-то важное (или после
     * этого).
     */
    public function someBusinessLogic(): void
    {
        echo "\nSubject: I'm doing something important.\n";
        $this->state = rand(0, 10);

        echo "Subject: My state has just changed to: {$this->state}\n";
        $this->notify();
    }
}

/**
 * Конкретные Наблюдатели реагируют на обновления, выпущенные Издателем, к
 * которому они прикреплены.
 */
class ConcreteObserverA implements \SplObserver
{
    public function update(\SplSubject $subject): void
    {
        if ($subject->state < 3) {
            echo "ConcreteObserverA: Reacted to the event.\n";
        }
    }
}

class ConcreteObserverB implements \SplObserver
{
    public function update(\SplSubject $subject): void
    {
        if ($subject->state == 0 || $subject->state >= 2) {
            echo "ConcreteObserverB: Reacted to the event.\n";
        }
    }
}

/**
 * Клиентский код.
 */

$subject = new Subject();

$o1 = new ConcreteObserverA();
$subject->attach($o1);

$o2 = new ConcreteObserverB();
$subject->attach($o2);

$subject->someBusinessLogic();
$subject->someBusinessLogic();

$subject->detach($o2);

$subject->someBusinessLogic();
```

#### Паттерны проектирования: "стратегия"

Стратегия — это поведенческий паттерн проектирования, который определяет семейство схожих алгоритмов и помещает  
каждый из них в собственный класс, после чего алгоритмы можно взаимозаменять прямо во время исполнения программы.
Программа может подменить этот объект другим, если требуется иной способ решения задачи. 

```php
/**
 * Контекст определяет интерфейс, представляющий интерес для клиентов.
 */
class Context
{
    /**
     * @var Strategy Контекст хранит ссылку на один из объектов Стратегии.
     * Контекст не знает конкретного класса стратегии. Он должен работать со
     * всеми стратегиями через интерфейс Стратегии.
     */
    private $strategy;

    /**
     * Обычно Контекст принимает стратегию через конструктор, а также
     * предоставляет сеттер для её изменения во время выполнения.
     */
    public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * Обычно Контекст позволяет заменить объект Стратегии во время выполнения.
     */
    public function setStrategy(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * Вместо того, чтобы самостоятельно реализовывать множественные версии
     * алгоритма, Контекст делегирует некоторую работу объекту Стратегии.
     */
    public function doSomeBusinessLogic(): void
    {
        // ...

        echo "Context: Sorting data using the strategy (not sure how it'll do it)\n";
        $result = $this->strategy->doAlgorithm(["a", "b", "c", "d", "e"]);
        echo implode(",", $result) . "\n";

        // ...
    }
}

/**
 * Интерфейс Стратегии объявляет операции, общие для всех поддерживаемых версий
 * некоторого алгоритма.
 *
 * Контекст использует этот интерфейс для вызова алгоритма, определённого
 * Конкретными Стратегиями.
 */
interface Strategy
{
    public function doAlgorithm(array $data): array;
}

/**
 * Конкретные Стратегии реализуют алгоритм, следуя базовому интерфейсу
 * Стратегии. Этот интерфейс делает их взаимозаменяемыми в Контексте.
 */
class ConcreteStrategyA implements Strategy
{
    public function doAlgorithm(array $data): array
    {
        sort($data);

        return $data;
    }
}

class ConcreteStrategyB implements Strategy
{
    public function doAlgorithm(array $data): array
    {
        rsort($data);

        return $data;
    }
}

/**
 * Клиентский код выбирает конкретную стратегию и передаёт её в контекст. Клиент
 * должен знать о различиях между стратегиями, чтобы сделать правильный выбор.
 */
$context = new Context(new ConcreteStrategyA());
echo "Client: Strategy is set to normal sorting.\n";
$context->doSomeBusinessLogic();

echo "\n";

echo "Client: Strategy is set to reverse sorting.\n";
$context->setStrategy(new ConcreteStrategyB());
$context->doSomeBusinessLogic();
```


### Framework
#### Yii2 Примеры реализации паттернов проектирования


Abstract Factory, Factory Method, Builder, Adapter, Composite, Decorator, Facade, Proxy, Flyweight  
Chain of responsibility, Command, Iterator, Observer, State, Strategy, Template method  
Dependency Injection, Repository, mixin etc.  


##### Builder

```php
\yii\db\ActiveQueryInterface;
```


##### Factory Method
```php
\yii\base\Controller::createAction()
```


### Storage

#### Механизм транзакций

Транзакции — это фундаментальное понятие во всех СУБД. Суть транзакции в том, что она объединяет последовательность  
действий в одну операцию «всё или ничего». Промежуточные состояния внутри последовательности не видны  
другим транзакциям, и если что-то помешает успешно завершить транзакцию, ни один из результатов этих действий  
не сохранится в базе данных.  

Нам также нужна гарантия, что после завершения и подтверждения транзакции системой баз данных, её результаты в самом  
деле сохраняются и не будут потеряны, даже если вскоре произойдёт авария. Например, если мы списали сумму и  
выдали её Бобу, мы должны исключить возможность того, что сумма на его счёте восстановится, как только он  
выйдет за двери банка. Транзакционная база данных гарантирует, что все изменения записываются в  
постоянное хранилище (например, на диск) до того, как транзакция будет считаться завершённой.  

#### ACID
- Логическая неделимость (атомарность, Atomicity): означает, что выполняются либо все операции (команды), входящие в транзакцию, либо ни одной. Система гарантирует невозможность запоминания части изменений, произведённых транзакцией. До тех пор, пока транзакция не завершена, её можно "откатить", т.е. отменить все сделанные командами транзакции изменения. Успешное выполнение транзакции (фиксация) означает, что все команды транзакции проанализированы, интерпретированы как правильные и безошибочно исполнены.

- Согласованность (Consistency): транзакция начинается на согласованном множестве данных и после её завершения множество данных согласовано. Состояние БД является согласованным, если данные удовлетворяют всем установленным ограничениям целостности и относятся к одному моменту в состоянии предметной области.

- Изолированность (Isolation): отсутствие влияния транзакций друг на друга.

- Устойчивость (Durability): если транзакция завершена успешно, то те изменения в данных, которые были ею произведены, не могут быть потеряны ни при каких обстоятельствах (даже в случае последующих ошибок).

#### Уровни изоляции транзакций
Выбирая уровень транзакции, мы пытаемся прийти к консенсусу в выборе между **высокой согласованностью** данных между  
транзакциями и **скоростью выполнения** этих самых транзакций.  

Стоит отметить, что самую высокую скорость выполнения и самую низкую согласованность имеет уровень read uncommitted.  
Самую низкую скорость выполнения и самую высокую согласованность — serializable.  

Да и как оказалось, разные СУБД по-разному воспринимают уровни изолированности.  
Могут иметь разнообразные нюансы в обеспечении изоляции, иметь дополнительные уровни или не иметь общеизвестных.  

Read uncommitted - Уровень, имеющий самую плохую согласованность данных, но самую высокую скорость выполнения  
транзакций. Название уровня говорит само за себя — каждая транзакция видит незафиксированные изменения  
другой транзакции (феномен грязного чтения). 

Read committed - Для этого уровня параллельно исполняющиеся транзакции видят только зафиксированные изменения из  
других транзакций. Таким образом, данный уровень обеспечивает защиту от грязного чтения.  

Repeatable read - Уровень, позволяющий предотвратить феномен неповторяющегося чтения. Т.е. мы не видим в исполняющейся  
транзакции измененные и удаленные записи другой транзакцией. Но все еще видим вставленные записи из другой транзакции.  

Serializable - Уровень, при котором транзакции ведут себя как будто ничего более не существует  
никакого влияния друг на друга нет.  

В большинстве приложений уровень изолированности редко меняется и используется значение по умолчанию  
(например, в MySQL это repeatable read, в PostgreSQL — read committed).  


### DB
#### PostgreSQL Оконные функции

Оконная функция выполняет вычисления для набора строк, некоторым образом связанных с текущей строкой. Можно сравнить  
её с агрегатной функцией, но, в отличие от обычной агрегатной функции, при использовании оконной функции несколько  
строк не группируются в одну, а продолжают существовать отдельно. Внутри же, оконная функция, как и агрегатная,  
может обращаться не только к текущей строке результата запроса.  

```sql
SELECT depname, empno, salary, avg(salary) OVER (PARTITION BY depname)
  FROM empsalary;

```

```sql
  depname  | empno | salary |          avg          
-----------+-------+--------+-----------------------
 develop   |    11 |   5200 | 5020.0000000000000000
 develop   |     7 |   4200 | 5020.0000000000000000
 develop   |     9 |   4500 | 5020.0000000000000000
 develop   |     8 |   6000 | 5020.0000000000000000
 develop   |    10 |   5200 | 5020.0000000000000000
 personnel |     5 |   3500 | 3700.0000000000000000
 personnel |     2 |   3900 | 3700.0000000000000000
 sales     |     3 |   4800 | 4866.6666666666666667
 sales     |     1 |   5000 | 4866.6666666666666667
 sales     |     4 |   4800 | 4866.6666666666666667
(10 rows)
```

Первые три столбца извлекаются непосредственно из таблицы empsalary, при этом для каждой строки таблицы есть строка  
результата. В четвёртом столбце оказалось среднее значение, вычисленное по всем строкам, имеющим то же значение  
depname, что и текущая строка.  

Вызов оконной функции всегда содержит предложение OVER, следующее за названием и аргументами оконной функции.  

Предложение PARTITION BY, дополняющее OVER, указывает, что строки нужно разделить по группам или разделам, объединяя  
одинаковые значения выражений PARTITION BY.  

Для каждой строки существует набор строк в её разделе, называемый рамкой окна. По умолчанию, с указанием ORDER BY  
рамка состоит из всех строк от начала раздела до текущей строки и строк, равных текущей по значению выражения ORDER BY.  
Без ORDER BY рамка по умолчанию состоит из всех строк раздела  


```sql
SELECT salary, sum(salary) OVER () FROM empsalary;
```

```sql
salary |  sum  
--------+-------
5200 | 47100
5000 | 47100
3500 | 47100
4800 | 47100
3900 | 47100
4200 | 47100
4500 | 47100
4800 | 47100
6000 | 47100
5200 | 47100
(10 rows)
```

```sql
SELECT salary, sum(salary) OVER (ORDER BY salary) FROM empsalary;
```

```sql
 salary |  sum  
--------+-------
   3500 |  3500
   3900 |  7400
   4200 | 11600
   4500 | 16100
   4800 | 25700
   4800 | 25700
   5000 | 30700
   5200 | 41100
   5200 | 41100
   6000 | 47100
(10 rows)
```

Здесь в сумме накапливаются зарплаты от первой (самой низкой) до текущей, включая повторяющиеся текущие значения  
(обратите внимание на результат в строках с одинаковой зарплатой).  


Для оконных функций с одинаковыми окнами лучше определение окна выделить в предложение WINDOW, а затем ссылаться на  
него в OVER  

```sql
SELECT sum(salary) OVER w, avg(salary) OVER w
FROM empsalary
WINDOW w AS (PARTITION BY depname ORDER BY salary DESC);
```


### Frontend
#### JS Асинхронность

Существует специальный синтаксис для работы с промисами, который называется «async/await».  

У слова async один простой смысл: эта функция всегда возвращает промис. Значения других типов оборачиваются в  
завершившийся успешно промис автоматически.  

Ключевое слово await заставит интерпретатор JavaScript ждать до тех пор, пока промис справа от await не  
выполнится. После чего оно вернёт его результат, и выполнение кода продолжится.  

await нельзя использовать в обычных функциях.  

```js
//В этом примере промис успешно выполнится через 1 секунду:
async function f() {

  let promise = new Promise((resolve, reject) => {
    setTimeout(() => resolve("готово!"), 1000)
  });

  let result = await promise; // будет ждать, пока промис не выполнится (*)

  alert(result); // "готово!"
}
```

[пример](https://github.com/ValikoDorodnov/www_helper/blob/master/practice/yii/front/fetch/index.js)  