# Шаблоны проектирования

## 1. Порождающие

* **Abstract Factory (Абстрактная фабрика)**
* **Factory Method (Фабричный метод)**
* **Singleton (Одиночка)**
* **Prototype (Прототип)**
* **Builder (Строитель)**

## 2. Структурные

* **Adapter (Адаптер)**
* **Bridge (Мост)**
* **Composite (Компоновщик)**
* **Decorator (Декоратор)**
* **Facade (Фасад)**
* **Flyweight (Приспособленец)**
* **Proxy (Прокси)**

## 3. Поведения

* **Chain of Responsibility (Цепочка обязанностей)**
* **Command (Команда)**
* **Interpreter (Интерперетатор)**
* **Iterator (Итератор)**
* **Mediator (Посредник)**
* **Memento (Хранитель)**
* **Observer (Наблюдатель)**
* **State (Состояние)**
* **Strategy (Стратегия)**
* **Template Method (Шаблонный метод)**
* **Visitor (Посетитель)**

## Порождающие

### Abstract Factory (Абстрактная фабрика)

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

## Ресурсы
* (DesignPatternsPHP)[https://github.com/domnikl/DesignPatternsPHP]
