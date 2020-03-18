Python para Todos
-----------------

Para generar el PDF del libro, necesitas instalar LaTeX en tu
computadora. Para sistemas Linux basados en Debian (Ubuntu, Mint, etc.):

    sudo apt-get install texlive-full
    sudo apt-get install pandoc

Para Macintosh,

    https://www.tug.org/mactex/
    https://www.tug.org/mactex/mactextras.html

Para generar el libro, ejecuta:

    bash book.sh

La salida de `bash book.sh` se encuentra en los archivos `x.pdf` y `x.epub`.

*Nótese que los scripts requiren Python 2 para compilar el libro*

## Servidor de compilación

Hay un servidor de compilación continua que tengo en Digital Ocean que compila
las versiones PDF y epub del libro aproximadamente cada hora.

    http://do1.dr-chuck.com/pythonlearn/ES_es/pythonlearn.pdf
    http://do1.dr-chuck.com/pythonlearn/ES_es/pythonlearn.epub

Solamente necesitas enviar los cambios y los archivos se actualizarán.

Este servidor también recompila cualquier traducción aproximadamente cada hora.

## Scripts de compilaciones alternas

Además del script oficial `book.sh`, también hay otros scripts de compilación que hacen
versiones alternas del libro.   Si haces cambios al contenido, deberías
ejecutar todos esos scripts y enviar todo a github de modo que todo termine en línea.

* `phpbook.sh` hará una versión html/php del libro, la cual es una extensión
de este sitio en `../html3` - después esto es agregado a github.

* `htmlbook.sh` hará una versión html del libro, con ejemplos interactivos
embebidos en trinkets. Esos archivos están en `books/html` en caso de que quieras descargarlos
o verlos.

* `zipbook.sh` hará dos versiones html del libro con la marca de Trinket,
uno con ejemplos interactivos (que requieren una conexión de internet para funcionar) y otra con
bloques de código resaltados para verlos completamente fuera de línea. Hay un archivo zip
que contiene todo esto en `/book/zips/pfe.zip` en caso de que quieras descargarlo.

* `trinketbook.sh` hará la plantilla de nunjucks que usamos para almacenar el libro
en [books.trinket.io](https://books.trinket.io).  Esto no será necesario que lo utilices
a menos que busques un ejemplo de cómo obtener el contenido fuente del libro en tu propio
lenguaje de plantillas.   Si quisieras ver la salida de este script, la puedes encontrar en
`books/trinket/pfe`.   También actualiza `../trinket3`.

Si quisieras hacer tu propio script de compilación, puedes utilizar estos como ejemplo. Si
tu script de compilación podría ser utilizado por otras personas, considera hacer una contribución
mediante un pull request. Ten en cuenta que cada script de compilación funciona bien con los otros
scripts y ejecutan en paralelo. Por favor no modifiques ninguna porción de código en los scripts de
python que son utilizados por otro script en caso de que quieras contribuir con un nuevo script.

## KindleGen

El script `book.sh` genera el archivo `x.mobi` (KindleGen) en la siguiente ruta:

    https://www.amazon.com/gp/feature.html?docId=1000765211

Para Linux:

    curl -O http://kindlegen.s3.amazonaws.com/kindlegen_linux_2.6_i386_v2_9.tar.gz
    tar xfv kindlegen_linux_2.6_i386_v2_9.tar.gz 
    cp kindlegen /usr/local/bin

## Createspace

Unicamente toma los archivos `x.pdf` y `x.mobi` y copialos dentro de la carpeta `createspace`,
agregando una fecha en el nombre de archivo como versión y después subiéndolos a
Kindle Direct Publishing.

Versión en Chino
----------------

Si estás compilando el archivo en Chino, crea el archivo

    touch .chinese

De modo que LaTeX se ejecuta en una manera que produzca documentos en Chino.

Instala la fuente (Font) 'Noto Serif CJK SC'.  Descarga de aquí y descomprime:

    https://noto-website.storage.googleapis.com/pkgs/NotoSerifCJK.ttc.zip

Deberías obtener un archivo llamado `NotoSerifCJK.ttc`.

En Mac, copia el archivo en `~/Library/Fonts` y recompila la cache de fuentes:

    sudo atsutil databases -remove

En Linux coloca el archivo en `/usr/share/fonts`:

    [ -d /usr/share/fonts/opentype ] || sudo mkdir /usr/share/fonts/opentype
    [ -d /usr/share/fonts/opentype/noto ] || sudo mkdir /usr/share/fonts/opentype/noto
    sudo mv NotoSerifCJK.ttc /usr/share/fonts/opentype/noto
    sudo fc-cache -f -v

Nota extraña:  Si estás corriendo un un sistema Linux con poca memoria, podrías
encontrar el error "I can't write on file `test.pdf`" - significa
que `xelatex` no tiene suficiente memoria RAM para correr - esto lo arreglará.

    dd if=/dev/zero of=/var/512mb.swap bs=1M count=512
    mkswap /var/512mb.swap
    swapon /var/512mb.swap

Ref: https://tex.stackexchange.com/questions/16801/xelatex-i-cant-write-on-file-test-pdf

## Contribuir

Si quieres contribuir, siéntete libre de hacer fork al repositorio
de py4e y enviarme pull requests.

https://github.com/csev-es/py4e

Podemos utilizar el "issue tracker" para coordinarnos si eso ayuda.

/Chuck

