# WINE

## Установка и запуск старой версии Google Chrome

### Создай новый win64 префикс
```shell
LANG=ru_RU.UTF-8 WINEPREFIX=~/.wine-chrome92 WINEARCH=win64 winecfg
```

### Запустить установку
```shell
LANG=ru_RU.UTF-8 WINEPREFIX=~/.wine-chrome92 wine google-chrome-92-0-4515-159.exe
```

### Запустить Chrome без поддержки GPU
```shell
LANG=ru_RU.UTF-8 WINEPREFIX=~/.wine-chrome92 wine ~/.wine-chrome92/drive_c/Program\ Files/Google/Chrome/Application/chrome.exe --disable-gpu --disable-software-rasterizer
```
