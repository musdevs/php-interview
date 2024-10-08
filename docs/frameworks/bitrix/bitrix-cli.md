# @bitrix/cli - консольный инструмент Битрикс-разработчика

## Описание

[Github репозиторий bitrix/cli](https://github.com/bitrix-tools/cli)
[Инструмент @bitrix/cli](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=43&LESSON_ID=12435&LESSON_PATH=3913.3516.4776.3635.12435)

## Структура

```
which bitrix
/home/user/.nvm/versions/node/v20.11.1/bin/bitrix

ls -l /home/user/.nvm/versions/node/v20.11.1/bin/bitrix
lrwxrwxrwx 1 vvs vvs 42 мар 24  2024 /home/user/.nvm/versions/node/v20.11.1/bin/bitrix -> ../lib/node_modules/@bitrix/cli/bin/bitrix
```

## Сборщик Rollup

[rollup.js - The JavaScript module bundler](https://rollupjs.org/)

## Плагин Rollup для копирования файлов без обработки

Если некоторые файлы не нужно включать в бандл, а нужно просто скопировать,
то нужно добавить custom plugin. Например, копировать **src/some/dir/somefile.js**
в **dest/some/dir/somefile.js**:

```javascript
// bundle.config.js

const fs = require('fs');

const copyPlugin = function (options) {
	return {
		name: 'copyPlugin',
		generateBundle(bundle) {
			if (!options.targets) {
				return;
			}
			options.targets.forEach(target => {
				fs.cpSync(target['src'], target['dest']);
			});
		}
	}
}

const dest = 'dest'

module.exports = [
	{
		input: 'src/application.js',
		output: `${dest}/my-ext.bundle.js`,
		namespace: 'My.Ext',
		browserslist: true,
		minification: false,
		plugins: {
			custom: [
				copyPlugin({
					targets: [
						{
							src: 'src/some/dir/somefile.js',
							dest: `${dest}/some/dir/somefile.js`,
						},
					]
				})
			]
		}
	},
];
```

Для копирования есть [rollup-plugin-copy](https://www.npmjs.com/package/rollup-plugin-copy).
Но подключить его не удалось. [Тут](https://github.com/bitrix-tools/cli/issues/21) пишут,
что можно установить плагин глобально. Но не получилось. Хотя пытался.

Установил:
```
 npm install -g rollup-plugin-copy -D
```

Проверил:
```
npm list -g
/home/user/.nvm/versions/node/v20.11.1/lib
├── @babel/cli@7.25.6
├── @babel/core@7.25.2
├── @bitrix/cli@3.3.5
├── corepack@0.23.0
├── npm@10.2.4
└── rollup-plugin-copy@3.5.0
```

Добавил в конфиг:

```javascript
import copy from 'rollup-plugin-copy';

const dest = 'dest'

module.exports = [
	{
		input: 'src/application.js',
		output: `${dest}/my-ext.bundle.js`,
		namespace: 'My.Ext',
		browserslist: true,
		minification: false,
		plugins: {
			resolve: true,
			custom: [
				copy({
					targets: [
						{
                            src: 'src/some/dir/somefile.js',
                            dest: `${dest}/some/dir/somefile.js`,
						},
					]
				}),
			]
		}
	},
];
```

Ошибка:
```
bitrix build
Error: Cannot find module 'rollup-plugin-copy'
```
