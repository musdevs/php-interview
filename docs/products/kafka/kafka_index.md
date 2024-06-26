# Kafka

Обмен сообщениями по типу «публикация/подписка» (publish/subscribe (pub/sub) messaging) — паттерн проектирования, отличающийся тем, что отправитель (издатель) элемента данных (сообщения) не направляет его конкретному потребителю. Вместо этого он каким-то образом классифицирут сообщения, а потребитель (подписчик) подписывается на определенные их классы. В системы типа «публикация/подписка» для упрощения этих действийчасто включают брокер — центральный пункт публикации сообщений.

Данные в Kafka хранятся долго, упорядоченно, и их можно читать когда угодно. Кроме того, они могут распределяться по
системе в качестве меры дополнительной защиты от сбоев.

Используемая в Kafka единица данных называется сообщением (message). Если
ранее вы работали с базами данных, то можете рассматривать сообщение как
аналог строки (row) или записи (record). С точки зрения Kafka сообщение
представляет собой просто массив байтов, так что для нее содержащиеся в нем
данные не имеют формата или какого-либо смысла

В сообщении может быть
дополнительный фрагмент метаданных, называемый ключом (key). Он тоже
представляет собой массив байтов и, как и сообщение, не несет для Kafka ника-
кого смысла. Ключи используются при необходимости лучше управлять записью
сообщений в разделы.

Для большей эффективности сообщения в Kafka записываются пакетами.
Пакет (batch) представляет собой просто набор сообщений, относящихся
к одному топику и разделу. Передача каждого сообщения туда и обратно по
сети привела бы к существенному перерасходу ресурсов, а объединение со-
общений в пакет эту проблему уменьшает.

Чем больше пакеты, тем больше сообщений можно обрабатывать за единицу времени, но
тем дольше распространяется отдельное сообщение.

Хотя сообщения для Kafka — всего лишь непрозрачные массивы байтов, ре-
комендуется накладывать на содержимое сообщений дополнительную струк-
туру — схему (JSON, XML, Avro)

Сообщения в Kafka распределяются по топикам (topics). Ближайшая анало-
гия — таблица базы данных или каталог файловой системы. Топики, в свою
очередь, разбиваются на разделы (partitions).

топик обычно состоит из нескольких
разделов, не гарантируется упорядоченность сообщений в пределах всего топи-
ка — лишь в пределах отдельного раздела

Благодаря разделам Kafka обеспечивает также избыточность и масштабируемость. Любой из разделов можно разместить на отдельном сервере. Разделы могут быть реплицированы, так что на разных серверах будет храниться копия одного и того же раздела.

Пользователи Kafka делятся на два основных типа: производители и потребители.
Производители (producers) генерируют новые сообщения. По умолчанию производитель будет равномерно
поставлять сообщения во все разделы топика.

Для направления сообщения в конкретный раздел служат ключ сообщения и объект Partitioner, генерирующий хеш ключа и устанавливающий его соответствие с конкретным разделом. Это гарантирует запись всех сообщений с одинаковым ключом в один и тот же раздел.

Потребители (consumers) читают сообщения. Потребитель подписывается на один топик или более
и читает сообщения в порядке их создания в каждом разделе. Он отслеживает,
какие сообщения он уже прочитал, запоминая смещение сообщений.

Смещение (offset) — непрерывно возрастающее целочисленное значение — еще один элемент метаданных, который Kafka добавляет в каждое сообщение при его создании. Смещения сообщений в конкретном разделе не повторяются, а следующее
сообщение имеет большее смещение (хотя и не обязательно монотонно большее).

Благодаря сохранению следующего возможного смещения для каждого раздела
обычно в хранилище самой Kafka потребитель может приостанавливать и воз-
обновлять свою работу, не забывая, в каком месте он читал.

Потребители работают в составе групп потребителей (consumer groups) — одного
или нескольких потребителей, объединившихся для обработки топика. Орга-
низация в группы гарантирует чтение каждого раздела только одним членом
группы.

Соответствие потребителя разделу иногда называют владением (ownership) раздела потребителем.

Отдельный сервер Kafka называется брокером (broker). Он получает сообщения
от производителей, присваивает им смещения и записывает сообщения в дис-
ковое хранилище. Он также обслуживает потребители и отвечает на запросы
выборки из разделов, возвращая опубликованные сообщения.

Брокеры Kafka предназначены для работы в составе кластера (cluster). Один из
брокеров кластера функционирует в качестве контроллера (cluster controller).

Контроллер кластера выбирается автоматически из числа работающих членов
кластера. Он отвечает за административные операции, включая распределе-
ние разделов по брокерам и мониторинг отказов последних. Каждый раздел
принадлежит одному из брокеров кластера, который называется ведущим
(leader).

Ключевая возможность Apache Kafka — сохранение информации (retention) в течение длительного времени.

В настройки брокеров Kafka включается дли-
тельность хранения топиков по умолчанию — или в течение определенного
промежутка времени (например, семь дней), или до достижения разделом
определенного размера в байтах (например, 1 Гбайт). Превысившие эти пределы
сообщения становятся недействительными и удаляются.

Можно задавать настройки сохранения и для отдельных
топиков, чтобы сообщения хранились только до тех пор, пока они нужны.

Можно также настроить для топиков вариант хранения сжатых журналов
(log compacted). При этом Kafka будет хранить лишь последнее сообщение
с конкретным ключом. Это может пригодиться для таких данных, как журналы
изменений, в случае, когда нас интересует только последнее изменение.

По мере роста развертываемых систем Kafka может оказаться удобным наличие
нескольких кластеров. Вот несколько причин этого.
Разделение типов данных.
Изоляция по требованиям безопасности.
Несколько центров обработки данных (ЦОД) (восстановление в случае
катаклизмов).

Проект Kafka включает утилиту MirrorMaker для репликации данных на дру-
гие кластеры.


Сценарии использования
Отслеживание действий пользователей
Обмен сообщениями
Показатели и журналирование
Журнал фиксации
Потоковая обработка

Kafka была выпущена LinkedIn в виде проекта с открытым исходным кодом на GitHub в конце 2010 года.

Осенью 2014 года разработчики покинули LinkedIn, чтобы основать компанию Confluent, которая занимается разработкой, корпоративной поддержкой и обучением для Apache Kafka.

«Мне показалось, что, раз уж Kafka — система, оптимизирован-
ная для записи, имеет смысл воспользоваться именем писателя. В колледже
я посещал очень много литературных курсов, и мне нравился Франц Кафка.
Кроме того, такое название для проекта с открытым исходным кодом звучит
очень круто»

## Ресурсы

[RdKafka PHP-extension manual](https://arnaud.le-blanc.net/php-rdkafka-doc/phpdoc/index.html)
