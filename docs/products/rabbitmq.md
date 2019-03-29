# RabbitMQ

## Введение

### Advanced Message Queuing Protocol

Основные понятия:

| Сущность | Описание|
|----------|---------|
| Broker   | Сервер AMQP.|
| Message  | Сообщение. Единица передаваемых данных. Не интерпретируется
|          | сервером |
|          | Можно присоединить структуированные заголовки |
| Exchange | Точка обмена. Сообщения не хранит, а только распределяет их в |
|          | одну или несколько очередей |
|          | * fanout - во все присоединенные очереди |
|          | * direct - в очередь с совпадающим routing key |
|          | * topic - во все очереди, у которых совпадает маска routing key (app.#) |
| Queue    | Очередь. Хранит сообщения, которые удяляются как только будут прочитаны клиентом. Типы:
|          | * общая -  |
|          | * эксклюзивная -  |

## Установка и настройка

Установка веб-интерфейса управления (http://localhost:15672)
```bash
sudo rabbitmq-plugins enable rabbitmq_management
```

Подключение плагинов федерации
```bash
sudo rabbitmq-plugins enable rabbitmq_federation \
rabbitmq_federation_management
```

Добавить Upstream федерации
```bash
rabbitmqctl set_parameter federation-upstream bo_rabbitmq '{"uri":"amqp://user:password@host"}'
```

Добавить Policy федерации
```bash
rabbitmqctl set_policy --apply-to exchanges "My federation" "^my_federation\." '{"federation-upstream-set":"all"}'
```

Добавить Exchange
```bash
rabbitmqadmin --username=user --password=secret declare exchange name="my_federation.exchange" type="topic" durable=true
```

Добавить Queue
```bash
rabbitmqadmin  --username=user --password=secret declare queue name=my_queue durable=true
```

Привязать Queue к Exchange
```bash
rabbitmqadmin  --username=user --password=secret declare binding source="broadcast" destination_type="queue" destination="my_queue" routing_key="my_queue"
```

## Ресурсы

1. [Установка и настройка RabbitMQ-кластера в AWS](https://eax.me/rabbitmq/)
2. [Интерфейс управления RabbitMQ](https://thewebland.net/development/devops/chast-3-interfejs-upravleniya-rabbitmq/)
3. [Troubleshooting Network Connectivity](https://www.rabbitmq.com/troubleshooting-networking.html)
4. [RabbitMQ Tutorials](https://www.rabbitmq.com/getstarted.html)
5. [Gavin M. Roy. RabbitMQ in Depth](http://www.allitebooks.com/rabbitmq-in-depth/)
6. [Гайвин Рой. RabbitMQ для профессионалов](http://onreader.mdl.ru/RabbitMQInDepth/content/index.html)
7. [Federation Plugin commands](https://www.rabbitmq.com/federation.html)
8. [Management Command Line Tool](https://www.rabbitmq.com/management-cli.html)
