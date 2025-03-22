# Ubuntu snap

Пакет с приложением содержит все зависимости. Нет проблем с совместимостью зависимостей пакетов.

## Поиск пакетов

```shell
snap find vlc
Name             Version                 Publisher      Notes  Summary
vlc              3.0.20-1-g2617de71b6    videolan✓      -      The ultimate media player
orion-desktop    3.0.0                   keshavnrj✪     -      Complete torrent client and streamer for Linux Desktop
audio-sharing    0.2.2                   soumyadghosh✪  -      Share your computer audio
```

## Информация о пакете

```shell
snap info vlc
name:      vlc
summary:   The ultimate media player
publisher: VideoLAN✓
store-url: https://snapcraft.io/vlc
contact:   https://www.videolan.org/support/
license:   unset
description: |
  VLC is the VideoLAN project's media player.

  Completely open source and privacy-friendly, it plays every multimedia file and streams.

  It notably plays MKV, MP4, MPEG, MPEG-2, MPEG-4, DivX, MOV, WMV, QuickTime, WebM, FLAC, MP3,
  Ogg/Vorbis files, BluRays, DVDs, VCDs, podcasts, and multimedia streams from various network
  sources. It supports subtitles, closed captions and is translated in numerous languages.
commands:
  - vlc
snap-id:      RT9mcUhVsRYrDLG8qnvGiy26NKvv6Qkd
tracking:     latest/stable
refresh-date: today at 08:58 MSK
channels:
  latest/stable:    3.0.20-1-g2617de71b6        2024-03-26 (3777) 336MB -
  latest/candidate: 3.0.20-1-g2617de71b6        2024-03-26 (3777) 336MB -
  latest/beta:      3.0.21-1-74-g47e6c1b726     2024-09-30 (4252) 336MB -
  latest/edge:      4.0.0-dev-28288-g586bf64e5f 2024-03-28 (4070) 703MB -
installed:          3.0.20-1-g2617de71b6                   (3777) 336MB -
```

## Установка пакетов

```shell
snap install vlc
```

## Откат обновления

```shell
snap revert vlc
```

## Обновление пакетов

```shell
snap refresh
snap refresh vlc
```

## Удаление пакетов

```shell
snap remove gimp
```

## Временно отключить/включить пакет

```shell
snap disable gimp
snap enable gimp
```
