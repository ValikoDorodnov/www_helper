# Yii ActiveRecord tips and tricks

## Когда нужно получить одну запись из таблицы

```php
<?php
/**
* Используйте конструкцию с явным  указанием limit
*/
Model::find()->where($condition)->limit(1)->one();

/**
* ::findOne() и ::one() не добавляют limit(1) в запрос!!!
*/
Model::findOne($condition);
```


## Получение данных через множественные связи

```php
<?php
class Product extends ActiveRecord
{
     public function getProductMetalType(): ActiveQuery
     {
        return $this->hasOne(ProductMetalType::class, ['id' => 'product_id']);
     }
}

class ProductMetalType extends ActiveRecord
{
     public function getMetalSample(): ActiveQuery
     {
         return $this->hasOne(MetalSample::class, ['id' => 'sample_id']);
     }
}

class MetalSample extends ActiveRecord
{
     /**
     * 1 => Высшая проба 
     * 2 => Средняя проба 
     * 3 => Низкая проба 
     */
     public $sample_id;
}


//Нужно найти данные по продукту, где металл является высшей пробой
Product::find()
      ->joinWith(['productMetalType.metalSample']) // указываем связи через точку
      ->andWhere(['sample_id' => 1]) // получаем доступ до поля в таблице Member
      ->select(['article', 'price', 'count'])
      ->all();
```

## Доработка связи в запросе

```php
// Группировка по типу металла с добавлением связи пробы метала
// В анонимной функции мы явно указываем дополнительные условия, для связи
return Product::find()
    ->with(['productMetalType' => function (ActiveQuery $query) {
        $query->select([
            'metalType',
        ])
            ->with([
                'metalSample',
            ]);
    },])
    ->select(['metalType'])
    ->groupBy('metalType')
    ->all();
```

## Выгрузить SQL запрос
```php

Product::find()
   ->joinWith(['productMetalType.metalSample']) // указываем связи через точку
   ->andWhere(['sample_id' => 1]) // получаем доступ до поля в таблице Member
   ->select(['article', 'price', 'count'])
   ->createCommand()->rawSql;
```

## Передача выражения во время запроса
```php
Product::find()
->select([
       new Expression(
           "first_value(products.id) over (PARTITION BY $catalogTable.complect_guid) as id,
               count(products.id) over (PARTITION BY $catalogTable.complect_guid) as count"
       ) // Лучше указывать через new Expression для чистоты запроса
   ])
   ->join('left join', $catalogTable, "$catalogTable.product_id = products.id")
   ->andWhere(['is not', "$catalogTable.complect_guid", null])
   ->distinct();
```

## Кеширование запроса и проверка на кеш в автоматическом режиме
```php
$store = Store::find()
    ->cache(
        Yii::$app->params['store_delivery_settings'], // Время жизни
        new TagDependency(['tags' => 'store_delivery_settings']) // Метка
    )
    ->exists();
```

## Метод ::column() Список в соответствии с select (только одно значение)
```php
$memberIds = OmniMember::find()
            ->select(['user_id'])
            ->andWhere(['promotion_id' => $promotion_id])
            ->column();

//Output int[] ['23123', '123123'] //Массив user id
```