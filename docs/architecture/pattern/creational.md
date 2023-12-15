# Порождающие шаблоны проектирования

## Abstract Factory (Абстрактная фабрика)

Применяется для создания семейств продуктов. Объявляется общий интерфейс, в котором объявляются
фабричные методы, возвращяющие экземпляры классов. Например, объявляем интерфейс абстрактной
фабрики движков рендеринга: 

```php
interface TemplateFactory
{
    public function createTitleTemplate(): TitleTemplate;
    public function createPageTemplate(): PageTemplate;
}
```

Фабрика шаблонов Twig:
```php
class TwigTemplateFactory implements TemplateFactory
{
    public function createTitleTemplate(): TitleTemplate
    {
        return new TwigTitleTemplate();
    }

    public function createPageTemplate(): PageTemplate
    {
        return new TwigPageTemplate();
    }}
```

```php
function templateRenderer(TemplateFactory $factory)
{
    $titleTemplate = $factory->createTitleTemplate();
    $pageTemplate = $factory->createPageTemplate();

    print($pageTemplate->render($titleTemplate));
}
```

```php
templateRenderer(new TwigTemplateFactory());
```

## Фабричный метод (Factory Method)


## Одиночка (Singleton)


## Прототип (Prototype)

Применяется для быстрого создания объектов путем копирования по прототипу.
Код паттерна должен работать с внешними объектами, ничего не зная об их структуре.
Для этого объявляется интерфейс клонирования (например, метод clone(),
создающий и возвращаяющий копию объекта): 

```php
interface Clonable {
    abstract function clone(): Prototype;
}
```

Но в PHP есть магический метод __clone, поэтому этот шаблон выглядит по-другому.
Необходимо в классе прототипа объявить метод __clone абстрактным, чтобы заставить
всех потомков реализовывать этот метод:

```php
abstract class CarPrototype
{
    abstract public function __clone();
}
```
## Строитель (Builder)
