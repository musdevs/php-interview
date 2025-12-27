# Приложения для загрузки

## Загрузка видео

### [yt-dlp is a feature-rich command-line audio/video downloader](https://github.com/yt-dlp/yt-dlp)

```shell
./yt-dlp --proxy 127.0.0.1:8881 https://www.youtube.com/watch?v=t4NbbyXsgP8
```

#### Загрузить все ccылки на видео из плейлиста

```shell
~/my/bin/yt-dlp/yt-dlp --proxy http://127.0.0.1:8881 --print "%(title)s | %(webpage_url)s" --skip-download "https://youtube.com/playlist?list=PL-FhWbGlJPfYeYWf111pb3Y4SYhuDBevD&si=bYEAuH6ZjY7ExOcK" > playlist.txt
```

```shell
head -1 playlist.txt
Верстка на Tailwind CSS #1 - Шапка | https://www.youtube.com/watch?v=6P0VjISPUu4
```


#### Показать список доступных форматов для ролика 0p1Yja1Gu_0

```shell
~/my/bin/yt-dlp/yt-dlp --proxy http://127.0.0.1:8881 --list-formats https://www.youtube.com/watch?v=6P0VjISPUu4
...
ID  EXT   RESOLUTION FPS │   FILESIZE   TBR PROTO │ VCODEC          VBR ACODEC     MORE INFO
───────────────────────────────────────────────────────────────────────────────────────────────────────────────
sb3 mhtml 48x27        0 │                  mhtml │ images                         storyboard
sb2 mhtml 80x45        0 │                  mhtml │ images                         storyboard
sb1 mhtml 160x90       0 │                  mhtml │ images                         storyboard
sb0 mhtml 320x180      0 │                  mhtml │ images                         storyboard
233 mp4   audio only     │                  m3u8  │ audio only          unknown    [ru] Untested, Default, low
234 mp4   audio only     │                  m3u8  │ audio only          unknown    [ru] Untested, Default, high
602 mp4   256x144     15 │ ~  4.43MiB   82k m3u8  │ vp09.00.10.08   82k video only Untested
269 mp4   256x144     30 │ ~  7.07MiB  130k m3u8  │ avc1.4D400C    130k video only Untested
603 mp4   256x144     30 │ ~  5.23MiB   96k m3u8  │ vp09.00.11.08   96k video only Untested
229 mp4   426x240     30 │ ~ 10.91MiB  201k m3u8  │ avc1.4D4015    201k video only Untested
604 mp4   426x240     30 │ ~  7.40MiB  136k m3u8  │ vp09.00.20.08  136k video only Untested
230 mp4   640x360     30 │ ~ 21.12MiB  389k m3u8  │ avc1.4D401E    389k video only Untested
605 mp4   640x360     30 │ ~ 15.20MiB  280k m3u8  │ vp09.00.21.08  280k video only Untested
231 mp4   854x480     30 │ ~ 29.32MiB  541k m3u8  │ avc1.4D401F    541k video only Untested
606 mp4   854x480     30 │ ~ 20.62MiB  380k m3u8  │ vp09.00.30.08  380k video only Untested
311 mp4   1280x720    60 │ ~ 46.76MiB  862k m3u8  │ avc1.640020    862k video only Untested
612 mp4   1280x720    60 │ ~ 35.94MiB  663k m3u8  │ vp09.00.40.08  663k video only Untested
312 mp4   1920x1080   60 │ ~ 78.31MiB 1444k m3u8  │ avc1.64002A   1444k video only Untested
617 mp4   1920x1080   60 │ ~ 46.96MiB  866k m3u8  │ vp09.00.41.08  866k video only Untested
623 mp4   2560x1440   60 │ ~ 83.87MiB 1546k m3u8  │ vp09.00.50.08 1546k video only Untested
628 mp4   3840x2160   60 │ ~164.27MiB 3029k m3u8  │ vp09.00.51.08 3029k video only Untested
```

#### Загрузить видео с наилучшим разрешением до 720p и наихудшим аудио

```shell
~/my/bin/yt-dlp/yt-dlp --proxy http://127.0.0.1:8881 --format "bv[height<=480]+wa" https://www.youtube.com/watch?v=6P0VjISPUu4
```

Будет загружен файл:

```shell
ls -lh
-rw-rw-r-- 1 user user 6,4M дек 30  2024 'Верстка на Tailwind CSS #1 - Шапка [6P0VjISPUu4].mp4'
```

### [Downlodr](https://downlodr.com/)

### [Media Downloader](http://github.com/mhogomchungu/media-downloader)

Удобный GUI для управления различными задачами скачивания. Достаточно скопировать и вставить ссылку на видео в инпут поле,
выбрать нужный инструмент для загрузки
и в один клик скачать видео на локальное устройство.
