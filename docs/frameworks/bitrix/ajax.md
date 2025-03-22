# AJAX

## Как выполнить AJAX-запрос со страницы

```php
<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
global $APPLICATION;
$APPLICATION->SetTitle("Выполнение ajax-запроса");

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
if ($request->isAjaxRequest()) {
	$startPosition = (int)$request->getPost('start_position');

	$response = new Bitrix\Main\Engine\Response\Json(['start_position' => $startPosition + 5]);

	$response = Bitrix\Main\Context::getCurrent()->getResponse()->copyHeadersTo($response);

	Bitrix\Main\Application::getInstance()->end(0, $response);
}

?>
	<form method="post" name="ajax_form" action="<?= CUtil::JSEscape(POST_FORM_ACTION_URI) ?>">
		<input name="start_position">
		<input type="button" id="ajax_start" value="Выполнить ajax-запрос" onclick="start();">
	</form>

	<script>
		function start() {
			let form = document.forms.ajax_form;

			BX.showWait(BX('ajax_start'));

			BX.ajax({
				url: window.location.href,
				method: 'POST',
				dataType: 'json',
				data: new FormData(form),
				// processData: false,     //
				preparePost: false,     // чтобы передать FormData как есть
				onsuccess: function (response) {
					BX.closeWait(BX('ajax_start'));
					form.elements.start_position.value = response.start_position;
				},
			});
		}
	</script>

<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>
```
