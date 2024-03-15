# Налоги

## Страховые взносы

[Калькулятор расчета страховых взносов ФНС](https://www.nalog.gov.ru/rn77/service/ops/)

За себя предприниматели должны платить также два вида взносов:
- фиксированные страховые взносы;
- дополнительные — 1% от дохода свыше 300 000 ₽.

Фиксированные взносы

| Взнос | 2022   | 2023 |
|-------|--------|--------|
| ОПС   | 34445  ||
| ОМС   | 8766   ||

## 2022
[](https://dmitry-robionek.ru/nulevaya-deklaratsiya-po-usn-za-2023-god-dlya-ip-bez-sotrudnikov)
[УСН 6 % для ИП без работников](https://www.moedelo.org/club/nalogovyj-uchet/usn-6-dlya-ip-bez-rabotnikov)
[Форма декларации по УСН за 2022 год](https://www.moedelo.org/club/nalogovyj-uchet/deklaratsiya-usn-za-god)
[Бланк декларации 2022](https://www.regberry.ru/sites/default/files/content/files/blank-novoy-deklaracii-usn.pdf)
[Как заполнить декларацию УСН ДОХОДЫ с помощью налогоплательщика ЮЛ](https://www.youtube.com/watch?v=FiwDlSul9IQ&t=12s)

## Приложения

### Налогоплательщик ЮЛ

Скачать тут: [Налогоплательщик ЮЛ](https://www.nalog.gov.ru/rn77/program/5961229/)

Установить по инструкции: [Запуск «Налогоплательщик ЮЛ» на Linux](https://vk.com/@noostyche_llc-zapusk-nalogoplatelschik-ul-na-linux)

```
WINEARCH=win32 WINEPREFIX=/home/$USER/.wine32nalogul wineboot -u
WINEPREFIX=/home/$USER/.wine32nalogul winetricks -q jet40 msxml3 msxml4 msxml6 gdiplus
WINEPREFIX=/home/$USER/.wine32nalogul winetricks corefonts
```

Запуск
```
env LC_ALL=ru_RU.UTF-8 WINEPREFIX=/home/$USER/.wine32nalogul wine start /unix 'C:/Налогоплательщик ЮЛ/INPUTDOC/inputdoc.exe'
```

### Сдача налоговой декларации

[Сдача отчетности через сервис налоговой. Настройка отправки. Первая отправка декларации через ИФНС](https://www.youtube.com/watch?v=TWyrLOJ0L6E&t=0s)
[Сервис сдачи налоговой, бухгалтерской отчетности](https://service.nalog.ru/nbo/)

### КриптоПро

[Установка КриптоПро ЭЦП Browser plug-in в *nix](https://docs.cryptopro.ru/cades/plugin/plugin-installation-unix)
sudo apt install ./cprocsp-pki-cades-64_2.0.14892-1_amd64.deb

[CryptoPro Extension for CAdES Browser Plug-in](https://chrome.google.com/webstore/detail/cryptopro-extension-for-c/iifchhfnnmpdbibifmljnfjhpififfog)
