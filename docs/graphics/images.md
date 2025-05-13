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

## Уменьшить размер файла PDF

```shell
decr.sh orig.pdf out.pdf 120
```

```shell
#!/bin/sh

# http://www.alfredklomp.com/programming/shrinkpdf
# Licensed under the 3-clause BSD license:
#
# Copyright (c) 2014-2019, Alfred Klomp
# All rights reserved.
#
# Redistribution and use in source and binary forms, with or without
# modification, are permitted provided that the following conditions are met:
# 1. Redistributions of source code must retain the above copyright notice,
#    this list of conditions and the following disclaimer.
# 2. Redistributions in binary form must reproduce the above copyright notice,
#    this list of conditions and the following disclaimer in the documentation
#    and/or other materials provided with the distribution.
# 3. Neither the name of the copyright holder nor the names of its contributors
#    may be used to endorse or promote products derived from this software
#    without specific prior written permission.
#
# THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
# AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
# IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
# ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
# LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
# CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
# SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
# INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
# CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
# ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
# POSSIBILITY OF SUCH DAMAGE.

#
# Modified by Vivek Gite to suit my needs
#
shrink ()
{
	gs					\
	  -q -dNOPAUSE -dBATCH -dSAFER		\
	  -sDEVICE=pdfwrite			\
	  -dCompatibilityLevel=1.3		\
	  -dPDFSETTINGS=/screen			\
	  -dEmbedAllFonts=true			\
	  -dSubsetFonts=true			\
	  -dAutoRotatePages=/None		\
	  -dColorImageDownsampleType=/Bicubic	\
	  -dColorImageResolution=$3		\
	  -dGrayImageDownsampleType=/Bicubic	\
	  -dGrayImageResolution=$3		\
	  -dMonoImageDownsampleType=/Subsample	\
	  -dMonoImageResolution=$3		\
	  -sOutputFile="$2"			\
	  "$1"
}

check_smaller ()
{
	# If $1 and $2 are regular files, we can compare file sizes to
	# see if we succeeded in shrinking. If not, we copy $1 over $2:
	if [ ! -f "$1" -o ! -f "$2" ]; then
		return 0;
	fi
	ISIZE="$(echo $(wc -c "$1") | cut -f1 -d\ )"
	OSIZE="$(echo $(wc -c "$2") | cut -f1 -d\ )"
	if [ "$ISIZE" -lt "$OSIZE" ]; then
		echo "Input smaller than output, doing straight copy" >&2
		cp "$1" "$2"
	fi
}

usage ()
{
	echo "Reduces PDF filesize by lossy recompressing with Ghostscript."
	echo "Not guaranteed to succeed, but usually works."
	echo "  Usage: $1 infile [outfile] [resolution_in_dpi]"
}

IFILE="$1"

# Need an input file:
if [ -z "$IFILE" ]; then
	usage "$0"
	exit 1
fi

# Output filename defaults to "-" (stdout) unless given:
if [ ! -z "$2" ]; then
	OFILE="$2"
else
	OFILE="-"
fi

# Output resolution defaults to 72 unless given:
if [ ! -z "$3" ]; then
	res="$3"
else
	res="90"
fi

shrink "$IFILE" "$OFILE" "$res" || exit $?

check_smaller "$IFILE" "$OFILE"
```
