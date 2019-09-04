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
