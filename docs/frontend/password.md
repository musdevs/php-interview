# Пароли на веб-страницах

## Узнать пароли

### Вкладка браузера с javascript-URL

```
javascript:(function (){var $inputs=document.getElementsByTagName('input'), iMax=$inputs.length; for(var i=iMax;i--;) if($inputs[i].type=='password') $inputs[i].type='text';})()
```

### Вывести пароль в консоли

Выделить input-элемент в DOM-дереве и в консоли набрать

```javascript
$0.value
```

### Вручную изменить тип input

У input-элемента вручную изменить type=”password” на type=”text”.
