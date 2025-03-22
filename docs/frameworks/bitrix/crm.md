# CRM

### Как добавить вкладку в сущность CRM

[Как добавить вкладку в CRM Bitrix24](https://aclips.ru/bitrix24-crm-custom-tab/)
Только там упущен урл обработчика eventArgs.url

```php
<?php if (!empty($arParams['AJAX_LOADER'])) { ?>
	<script>
		BX.addCustomEvent('Grid::beforeRequest', function (gridData, eventArgs) {
			if (eventArgs.gridId != '<?=$arResult['GRID_ID'];?>') {
				return;
			}

			eventArgs.method = 'POST';
			eventArgs.data = <?= \Bitrix\Main\Web\Json::encode($arParams['AJAX_LOADER']['data']) ?>;

			// без этого урла ломается обновление после изменения настроек грида
			eventArgs.url = '<?= $arParams['AJAX_LOADER']['url'] ?>';
		});
	</script>
<?php } ?>

```
