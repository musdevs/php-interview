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
sudo rabbitmq-plugins enable rabbitmq_localhostmanagement
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

## Пример работы

Запустить контейнер

```
docker run -d --hostname dev-rabbit --name dev-rabbit -p 15672:15672 -p 5672:5672 rabbitmq:3-management
```

Отправить сообщение в очередь

```php
function publish($queue, $data)
{
    $config = [
        'protocol' => 'http',
        'host' => 'localhost',
        'port' => '15672',
        'login' => 'guest',
        'password' => 'guest',
    ];

    $curl = curl_init(sprintf(
        '%s://%s:%s/api/exchanges/%%2f/amq.default/publish',
        $config['protocol'],
        $config['host'],
        $config['port']
    ));

    $post = json_encode([
        'properties' => [
            'delivery_mode' => 2
        ],
        'routing_key' => $queue,
        'payload' => json_encode($data, JSON_UNESCAPED_UNICODE),
        'payload_encoding' => 'string'
    ], JSON_UNESCAPED_UNICODE);

    curl_setopt_array($curl, [
        CURLOPT_USERPWD => "{$config['login']}:{$config['password']}",
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $post,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json'
        ]
    ]);

    $result = curl_exec($curl);

    $json = json_decode($result, true);

    curl_close($curl);

    if ($error = json_last_error()) {
        throw new \Exception("Error ({$error}) parsing response JSON: " . json_last_error_msg());
    }

    return $json;
}

var_dump(publish('myqueue', ['message' => "Увидимся!"]));
```

Получить сообщение
 - 'ackmode' => 'ack_requeue_true' - не удаляя его из очереди 
 - 'ackmode' => 'ack_requeue_false' - удаляя его из очереди 

```php
function get($queue)
{
    $config = [
        'protocol' => 'http',
        'host' => 'localhost',
        'port' => '15672',
        'login' => 'guest',
        'password' => 'guest',
    ];

    $curl = curl_init(sprintf(
        '%s://%s:%s/api/queues/%%2f/%s/get',
        $config['protocol'],
        $config['host'],
        $config['port'],
        $queue
    ));

    $post = json_encode([
        'count' => 1,
        'ackmode' => 'ack_requeue_true',
        'encoding' => 'auto',
        'truncate' => 50000
    ], JSON_UNESCAPED_UNICODE);

    curl_setopt_array($curl, [
        CURLOPT_USERPWD => "{$config['login']}:{$config['password']}",
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $post,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json'
        ]
    ]);

    $result = curl_exec($curl);

    $json = json_decode($result, true);

    curl_close($curl);

    if ($error = json_last_error()) {
        throw new \Exception("Error ({$error}) parsing response JSON: " . json_last_error_msg());
    }

    $json = json_decode($json[0]['payload'], true);

    if ($error = json_last_error()) {
        throw new \Exception("Error ({$error}) parsing response JSON: " . json_last_error_msg());
    }

    return $json;
}

var_dump(get('myqueue'));
```

## Ресурсы

1. [Использование RabbitMQ в связке с PHP](https://ruseller.com/lessons.php?rub=37&id=2171)
2. [PHP и RabbitMQ: продвинутые примеры](https://ruseller.com/lessons.php?rub=37&id=2172)
3. [Установка и настройка RabbitMQ-кластера в AWS](https://eax.me/rabbitmq/)
4. [Интерфейс управления RabbitMQ](https://thewebland.net/development/devops/chast-3-interfejs-upravleniya-rabbitmq/)
5. [Troubleshooting Network Connectivity](https://www.rabbitmq.com/troubleshooting-networking.html)
6. [RabbitMQ Tutorials](https://www.rabbitmq.com/getstarted.html)
7. [Gavin M. Roy. RabbitMQ in Depth](http://www.allitebooks.com/rabbitmq-in-depth/)
8. [Гайвин Рой. RabbitMQ для профессионалов](http://onreader.mdl.ru/RabbitMQInDepth/content/index.html)
9. [Federation Plugin commands](https://www.rabbitmq.com/federation.html)
10. [Management Command Line Tool](https://www.rabbitmq.com/management-cli.html)
11. [RabbitMQ Management HTTP API](https://cdn.rawgit.com/rabbitmq/rabbitmq-management/v3.7.9/priv/www/api/index.html)
