# Архитектура REST

**REST** (Representational state transfer) - архитектура распределенных
систем. REST не связан ни с каким протоколом.

"RESTfull системой" называют систему, соответствующей критериям:
1. Client-Server. Система разделена на клиентов и серверы
2. Stateless. Сервер не хранит информацию о клиентах. Вся необходимая
   информация в запросах
3. Cache. В ответе информация о том, что он является кэшируемым или нет
4. Uniform Interface. Универсальный интерфейс между компонентами
   системы.
5. Layered System. Система может быть многоуровневой. На каждом уровне
   может быть свой API. Но каждый уровень знает только о соседнем.
6. Code-On-Demand. Может загружаться и исполняться код на клиенте.

Чаще всего архитектура REST реализуется с помощью HTTP и URI.

## Ресурсы
1. [Swagger](https://swagger.io/)