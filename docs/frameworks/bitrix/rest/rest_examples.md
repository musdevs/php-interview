

## Запрос к ресту в коробке

```javascript
	<script>
		BX.ready(async function (){
			console.log('start');
			const response = await BX.ajax.runAction('crm.category.list', {
				data: {
					entityTypeId: 1074
				}
			})
			console.log(response.data);
		})
	</script>
```
