# Графика в Linux

## Информация о PDF-файле

```shell
pdfinfo file.pdf
CreationDate:   Thu Feb  9 11:39:47 2017
Tagged:         no
UserProperties: no
Suspects:       no
Form:           none
JavaScript:     no
Pages:          396
Encrypted:      no
Page size:      841.68 x 595.2 pts
Page rot:       270
File size:      257623345 bytes
Optimized:      no
PDF version:    1.4
```

## Информация о JPEG-файле
```shell
file file.jpg
z-000.jpg: JPEG image data, JFIF standard 1.02, resolution (DPI), density 300x300, segment length 16, baseline, precision 8, 3507x2480, frames 3
```
## Повернуть JPEG на 270 градусов и уменьшить размер до 30% от исходного

```shell
convert file.jpg -rotate 270 -resize 30% newfile.jpg
```

## Извлечь изображения из PDF

Извлечь изображения из диапазона (c 1-й по 1-ю) страниц PDF-документа и сохранить под именем image-NNN.EXT, где EXT - расширение исходного формата изображение (ключ -all)

```shell
pdfimages -f 1 -l 1 -all file.pdf image
```

Еще [полезные команды](https://www.howtogeek.com/109369/how-to-quickly-resize-convert-modify-images-from-the-linux-terminal/).
