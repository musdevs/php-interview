# Запрет смены стадии пользователю в CRM

```php

use Bitrix\Main\Error;
use Bitrix\Main\Result;
use Bitrix\Crm\Item;
use Bitrix\Crm\Service;
use Bitrix\Crm\Service\Operation;
use Bitrix\Main\DI;
if (\Bitrix\Main\Loader::includeModule('crm'))
{
    // ID смарт процесса
    define('ENTITY_TYPE_ID', 142);
    //переопределим контейнер, что бы была возможность переопределить любой метод контейнера
    $container = new class extends Service\Container {
    //переопределим фабрику, установив проверку работы нашего кода, только для необходимого бизнес процесса
    public function getFactory(int $entityTypeId): ?Service\Factory
    {
        if (defined('ENTITY_TYPE_ID') && $entityTypeId === ENTITY_TYPE_ID)
        {
            //получим orm-объект смарт-процесса по его $entityTypeId
            $type = $this->getTypeByEntityTypeId($entityTypeId);
            //подменим фабрику
            $factory = new class($type) extends Service\Factory\Dynamic {
                //переопределим метод
                public function getUpdateOperation(Item $item, Context $context = null): Operation\Update
                {
                    //получим операции сущности
                    $operation = parent::getUpdateOperation($item, $context);
                    //добавим дополнительное действие, перед сохранением элемента
                    return $operation->addAction(
                        Operation::ACTION_BEFORE_SAVE,
                        new class extends Operation\Action {
                            public function process(Item $item): Result
                            {
                                $result = new Result();
                                $userId = Service\Container::getInstance()->getContext()->getUserId();
                                //добавим условие, по которому получим ошибку в случае перехода из одной стадии в другую
                                if (
                                    $userId === 1
                                    && $item->isChangedStageId()
                                    && $item->getStageId() === 'DT142_2:CLIENT'
                                    && $item->remindActual(Item::FIELD_NAME_STAGE_ID) === 'DT142_2:PREPARATION'
                                ) {
                                    $result->addError(new Error('Изменение стадии запрещено'));
                                }
                                return $result;
                            }
                        }
                    );
                }
            };
            return $factory;
        }
        return parent::getFactory($entityTypeId);
    }
};

//подменяем преопределенный контейнер
DI\ServiceLocator::getInstance()->addInstance('crm.service.container', $container);
}
```

[Как запретить менять стадию определенному пользователю в смарт-процессах Битрикс24](https://www.pavelkvashin.ru/blog/kak-zapretit-menyat-stadiyu-opredelennomu-polzovatelyu-v-smart-protsessakh-bitriks24/)
