<?php if ( file_exists("../booktop.php") ) {
  require_once "../booktop.php";
  ob_start();
}?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="" xml:lang="">
<head>
  <meta charset="utf-8" />
  <meta name="generator" content="pandoc" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
  <title>-</title>
  <style>
    code{white-space: pre-wrap;}
    span.smallcaps{font-variant: small-caps;}
    span.underline{text-decoration: underline;}
    div.column{display: inline-block; vertical-align: top; width: 50%;}
    div.hanging-indent{margin-left: 1.5em; text-indent: -1.5em;}
    ul.task-list{list-style: none;}
  </style>
  <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv-printshiv.min.js"></script>
  <![endif]-->
</head>
<body>
<h1 id="programas-en-red">Programas en red</h1>
<p>Aunque muchos de los ejemplos en este libro se han enfocado en leer archivos y buscar datos en ellos, hay muchas fuentes de información diferentes si se tiene en cuenta el Internet.</p>
<p>En este capítulo fingiremos ser un navegador web y recuperaremos páginas web utilizando el Protocolo de Transporte de Hipertexto (HyperText Transfer Protocol - HTTP). Luego revisaremos los datos de esas páginas web y los analizaremos.</p>
<h2 id="protocolo-de-transporte-de-hipertexto---http">Protocolo de Transporte de Hipertexto - HTTP</h2>
<p>El protocolo de red que hace funcionar la web es en realidad bastante simple, y existe un soporte integrado en Python llamado <code>sockets</code>, el cual hace que resulte muy fácil realizar conexiones de red y recuperar datos a través de esas conexiones desde un programa de Python.</p>
<p>Un socket es muy parecido a un archivo, a excepción de que proporciona una conexión de doble sentido entre dos programas. Es posible tanto leer como escribir en un mismo socket. Si se escribe algo en un socket, es enviado a la aplicación que está al otro lado de éste. Si se lee desde el socket, se obtienen los datos que la otra aplicación ha enviado.</p>
<p>Pero si intentas leer un socket cuando el programa que está del otro lado del socket no ha enviado ningún dato, puedes sentarte y esperar. Si los programas en ambos extremos del socket simplemente esperan por datos sin enviar nada, van a esperar por mucho, mucho tiempo, así que una parte importante de los programas que se comunican a través de internet consiste en tener algún tipo de protocolo.</p>
<p>Un protocolo es un conjunto de reglas precisas que determinan quién va primero, qué debe hacer, cuáles son las respuestas siguientes para ese mensaje, quién envía a continuación, etcétera. En cierto sentido las aplicaciones a ambos lados del socket están interpretando un baile y cada una debe estar segura de no pisar los pies de la otra.</p>
<p>Hay muchos documentos que describen estos protocolos de red. El Protocolo de Transporte de Hipertext está descrito en el siguiente documento:</p>
<p><a href="https://www.w3.org/Protocols/rfc2616/rfc2616.txt" class="uri">https://www.w3.org/Protocols/rfc2616/rfc2616.txt</a></p>
<p>Se trata de un documento largo y complejo de 176 páginas, con un montón de detalles. Si lo encuentras interesante, siéntete libre de leerlo completo. Pero si echas un vistazo alrededor de la página 36 del RFC2616, encontrarás la sintaxis para las peticiones GET. Para pedir un documento a un servidor web, hacemos una conexión al servidor <code>www.pr4e.org</code> en el puerto 80, y luego enviamos una línea como esta:</p>
<p><code>GET http://data.pr4e.org/romeo.txt HTTP/1.0</code></p>
<p>en la cual el segundo parámetro es la página web que estamos solicitando, y a continuación enviamos una línea en blanco. El servidor web responderá con una cabecera que contiene información acerca del documento y una línea en blanco, seguido por el contenido del documento.</p>
<h2 id="el-navegador-web-más-sencillo-del-mundo">El navegador web más sencillo del mundo</h2>
<p>Quizá la manera más sencilla de demostrar cómo funciona el protocolo HTTP sea escribir un programa en Python muy sencillo, que realice una conexión a un servidor web y siga las reglas del protocolo HTTP para solicitar un documento y mostrar lo que el servidor envía de regreso.</p>
<pre class="python"><code>import socket

misock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
misock.connect((&#39;data.pr4e.org&#39;, 80))
cmd = &#39;GET http://data.pr4e.org/romeo.txt HTTP/1.0\r\n\r\n&#39;.encode()
misock.send(cmd)

while True:
    datos = misock.recv(512)
    if len(datos) &lt; 1:
        break
    print(datos.decode(),end=&#39;&#39;)

misock.close()

# Código: https://es.py4e.com/code3/socket1.py</code></pre>
<p>En primer lugar, el programa realiza una conexión al puerto 80 del servidor <a href="http://www.py4e.com">www.py4e.com</a>. Puesto que nuestro programa está jugando el rol de “navegador web”, el protocolo HTTP dice que debemos enviar el comando GET seguido de una línea en blanco. <code>\r\n</code> representa un salto de línea (end of line, o EOL en inglés), así que <code>\r\n\r\n</code> significa que no hay nada entre dos secuencias de salto de línea. Ese es el equivalente de una línea en blanco.</p>
<figure>
<img src="../images/socket.svg" alt="" /><figcaption>Conexión de un socket</figcaption>
</figure>
<p>Una vez que enviamos esa línea en blanco, escribimos un bucle que recibe los datos desde el socket en bloques de 512 caracteres y los imprime en pantalla hasta que no quedan más datos por leer (es decir, la llamada a recv() devuelve una cadena vacía).</p>
<p>El programa produce la salida siguiente:</p>
<pre><code>HTTP/1.1 200 OK
Date: Wed, 11 Apr 2018 18:52:55 GMT
Server: Apache/2.4.7 (Ubuntu)
Last-Modified: Sat, 13 May 2017 11:22:22 GMT
ETag: &quot;a7-54f6609245537&quot;
Accept-Ranges: bytes
Content-Length: 167
Cache-Control: max-age=0, no-cache, no-store, must-revalidate
Pragma: no-cache
Expires: Wed, 11 Jan 1984 05:00:00 GMT
Connection: close
Content-Type: text/plain

But soft what light through yonder window breaks
It is the east and Juliet is the sun
Arise fair sun and kill the envious moon
Who is already sick and pale with grief</code></pre>
<p>La salida comienza con la cabecera que el servidor envía para describir el documento. Por ejemplo, la cabecera <code>Content-Type</code> indica que el documento es un documento de texto sin formato (<code>text/plain</code>).</p>
<p>Después de que el servidor nos envía la cabecera, añade una línea en blanco para indicar el final de la cabecera, y después envía los datos reales del archivo <em>romeo.txt</em>.</p>
<p>Este ejemplo muestra cómo hacer una conexión de red de bajo nivel con sockets. Los sockets pueden ser usados para comunicarse con un servidor web, con un servidor de correo, o con muchos otros tipos de servidores. Todo lo que se necesita es encontrar el documento que describe el protocolo correspondiente y escribir el código para enviar y recibir los datos de acuerdo a ese protocolo.</p>
<p>Sin embargo, como el protocolo que se usa con más frecuencia es el protocolo web HTTP, Python tiene una librería especial diseñada especialmente para trabajar con éste para recibir documentos y datos a través de la web.</p>
<p>Uno de los requisitos para utilizar el protocolo HTTP es la necesidad de enviar y recibir datos como objectos binarios, en vez de cadenas. En el ejemplo anterior, los métodos <code>encode()</code> y <code>decode()</code> convierten cadenas en objectos binarios y viceversa.</p>
<p>El siguiente ejemplo utiliza la notación <code>b''</code> para especificar que una variable debe ser almacenada como un objeto binario. <code>encode()</code> y <code>b''</code> son equivalentes.</p>
<pre><code>&gt;&gt;&gt; b&#39;Hola mundo&#39;
b&#39;Hola mundo&#39;
&gt;&gt;&gt; &#39;Hola mundo&#39;.encode()
b&#39;Hola mundo&#39;</code></pre>
<h2 id="recepción-de-una-imagen-mediante-http">Recepción de una imagen mediante HTTP</h2>
<p>  </p>
<p>En el ejemplo anterior, recibimos un archivo de texto sin formato que tenía saltos de línea en su interior, y lo único que hicimos cuando el programa se ejecutó fue copiar los datos a la pantalla. Podemos utilizar un programa similar para recibir una imagen utilizando HTTP. En vez de copiar los datos a la pantalla conforme va funcionando el programa, vamos a guardar los datos en una cadena, remover la cabecera, y después guardar los datos de la imagen en un archivo tal como se muestra a continuación:</p>
<pre class="python"><code>import socket
import time

SERVIDOR = &#39;data.pr4e.org&#39;
PUERTO = 80
misock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
misock.connect((SERVIDOR, PUERTO))
misock.sendall(b&#39;GET http://data.pr4e.org/cover3.jpg HTTP/1.0\r\n\r\n&#39;)
contador = 0
imagen = b&quot;&quot;

while True:
    datos = misock.recv(5120)
    if len(datos) &lt; 1: break
    #time.sleep(0.25)
    contador = contador + len(datos)
    print(len(datos), contador)
    imagen = imagen + datos

misock.close()

# Búsqueda del final de la cabecera (2 CRLF)
pos = imagen.find(b&quot;\r\n\r\n&quot;)
print(&#39;Header length&#39;, pos)
print(imagen[:pos].decode())

# Ignorar la cabera y guardar los datos de la imagen
imagen = imagen[pos+4:]
fhand = open(&quot;cosa.jpg&quot;, &quot;wb&quot;)
fhand.write(imagen)
fhand.close()

# Código: https://es.py4e.com/code3/urljpeg.py</code></pre>
<p>Cuando el programa corre, produce la siguiente salida:</p>
<pre><code>$ python urljpeg.py
5120 5120
5120 10240
4240 14480
5120 19600
...
5120 214000
3200 217200
5120 222320
5120 227440
3167 230607
Header length 394
HTTP/1.1 200 OK
Date: Fri, 21 Feb 2020 01:45:41 GMT
Server: Apache/2.4.18 (Ubuntu)
Last-Modified: Mon, 15 May 2017 12:27:40 GMT
ETag: &quot;38342-54f8f2e5b6277&quot;
Accept-Ranges: bytes
Content-Length: 230210
Vary: Accept-Encoding
Cache-Control: max-age=0, no-cache, no-store, must-revalidate
Pragma: no-cache
Expires: Wed, 11 Jan 1984 05:00:00 GMT
Connection: close
Content-Type: image/jpeg</code></pre>
<p>Puedes observar que para esta url, la cabecera <code>Content-Type</code> indica que el cuerpo del documento es una imagen (<code>image/jpeg</code>). Una vez que el programa termina, puedes ver los datos de la imagen abriendo el archivo <code>cosa.jpg</code> en un visor de imágenes.</p>
<p>Al ejecutar el programa, se puede ver que no se obtienen 5120 caracteres cada vez que llamamos el método <code>recv()</code>. Se obtienen tantos caracteres como hayan sido transferidos por el servidor web hacia nosotros a través de la red en el momento de la llamada a <code>recv()</code>. En este emeplo, se obtienen al menos 3200 caracteres cada vez que solicitamos hasta 5120 caracteres de datos.</p>
<p>Los resultados pueden variar dependiendo de tu velocidad de internet. Además, observa que en la última llamada a <code>recv()</code> obtenemos 3167 bytes, lo cual es el final de la cadena, y en la siguiente llamada a <code>recv()</code> obtenemos una cadena de longitud cero que indica que el servidor ya ha llamado <code>close()</code> en su lado del socket, y por lo tanto no quedan más datos pendientes por recibir.</p>
<p> </p>
<p>Podemos retardar las llamadas sucesivas a <code>recv()</code> al descomentar la llamada a <code>time.sleep()</code>. De esta forma, esperamos un cuarto de segundo después de cada llamada de modo que el servidor puede “adelantarse” a nosotros y enviarnos más datos antes de que llamemos de nuevo a <code>recv()</code>. Con el retraso, esta vez el programa se ejecuta así:</p>
<pre><code>$ python urljpeg.py
5120 5120
5120 10240
5120 15360
...
5120 225280
5120 230400
208 230608
Header length 394
HTTP/1.1 200 OK
Date: Fri, 21 Feb 2020 01:57:31 GMT
Server: Apache/2.4.18 (Ubuntu)
Last-Modified: Mon, 15 May 2017 12:27:40 GMT
ETag: &quot;38342-54f8f2e5b6277&quot;
Accept-Ranges: bytes
Content-Length: 230210
Vary: Accept-Encoding
Cache-Control: max-age=0, no-cache, no-store, must-revalidate
Pragma: no-cache
Expires: Wed, 11 Jan 1984 05:00:00 GMT
Connection: close
Content-Type: image/jpeg</code></pre>
<p>Ahora todas las llamadas a <code>recv()</code>, excepto la primera y la última, nos dan 5120 caracteres cada vez que solicitamos más datos.</p>
<p>Existe un buffer entre el servidor que hace las peticiones <code>send()</code> y nuestra aplicación que hace las peticiones <code>recv()</code>. Cuando ejecutamos el programa con el retraso activado, en algún momento el servidor podría llenar el buffer del socket y verse forzado a detenerse hasta que nuestro programa empiece a vaciar ese buffer. La detención de la aplicación que envía los datos o de la que los recibe se llama “control de flujo”.</p>
<p></p>
<h2 id="recepción-de-páginas-web-con-urllib">Recepción de páginas web con <code>urllib</code></h2>
<p>Aunque podemos enviar y recibir datos manualmente mediante HTTP utilizando la librería socket, existe una forma mucho más simple para realizar esta habitual tarea en Python, utilizando la librería <code>urllib</code>.</p>
<p>Utilizando <code>urllib</code>, es posible tratar una página web de forma parecida a un archivo. Se puede indicar simplemente qué página web se desea recuperar y <code>urllib</code> se encargará de manejar todos los detalles referentes al protocolo HTTP y a la cabecera.</p>
<p>El código equivalente para leer el archivo <em>romeo.txt</em> desde la web usando <code>urllib</code> es el siguiente:</p>
<pre class="python"><code>import urllib.request

man_a = urllib.request.urlopen(&#39;http://data.pr4e.org/romeo.txt&#39;)
for linea in man_a:
    print(linea.decode().strip())

# Código: https://es.py4e.com/code3/urllib1.py</code></pre>
<p>Una vez que la página web ha sido abierta con <code>urllib.urlopen</code>, se puede tratar como un archivo y leer a través de ella utilizando un bucle <code>for</code>.</p>
<p>Cuando el programa se ejecuta, en su salida sólo vemos el contenido del archivo. Las cabeceras siguen enviándose, pero el código de <code>urllib</code> se encarga de manejarlas y solamente nos devuelve los datos.</p>
<pre><code>But soft what light through yonder window breaks
It is the east and Juliet is the sun
Arise fair sun and kill the envious moon
Who is already sick and pale with grief</code></pre>
<p>Como ejemplo, podemos escribir un programa para obtener los datos de <code>romeo.txt</code> y calcular la frecuencia de cada palabra en el archivo de la forma siguiente:</p>
<pre class="python"><code>import urllib.request, urllib.parse, urllib.error

man_a = urllib.request.urlopen(&#39;http://data.pr4e.org/romeo.txt&#39;)

contadores = dict()
for linea in man_a:
    palabras = linea.decode().split()
    for palabra in palabras:
        contadores[palabra] = contadores.get(palabra, 0) + 1

print(contadores)

# Código: https://es.py4e.com/code3/urlwords.py</code></pre>
<p>De nuevo vemos que, una vez abierta la página web, se puede leer como si fuera un archivo local.</p>
<h2 id="leyendo-archivos-binarios-con-urllib">Leyendo archivos binarios con <code>urllib</code></h2>
<p>A veces se desea obtener un archivo que no es de texto (o binario) tal como una imagen o un archivo de video. Los datos en esos archivos generalmente no son útiles para ser impresos en pantalla, pero se puede hacer fácilmente una copia de una URL a un archivo local en el disco duro utilizando <code>urllib</code>.</p>
<p></p>
<p>El método consiste en abrir la dirección URL y utilizar <code>read</code> para descargar todo el contenido del documento en una cadena (<code>img</code>) para después escribir esa información a un archivo local, tal como se muestra a continuación:</p>
<pre class="python"><code>import urllib.request, urllib.parse, urllib.error

img = urllib.request.urlopen(&#39;http://data.pr4e.org/cover3.jpg&#39;).read()
man_a = open(&#39;portada.jpg&#39;, &#39;wb&#39;)
man_a.write(img)
man_a.close()

# Código: https://es.py4e.com/code3/curl1.py</code></pre>
<p>Este programa lee todos los datos que recibe de la red y los almacena en la variable <code>img</code> en la memoria principal de la computadora. Después, abre el archivo <code>portada.jpg</code> y escribe los datos en el disco. El argumento <code>wb</code> en la función <code>open()</code> abre un archivo binario en modo de escritura solamente. Este programa funcionará siempre y cuando el tamaño del archivo sea menor que el tamaño de la memoria de la computadora.</p>
<p>Aún asi, si es un archivo grande de audio o video, este programa podría fallar o al menos ejecutarse sumamente lento cuando la memoria de la computadora se haya agotado. Para evitar que la memoria se termine, almacenamos los datos en bloques (o buffers) y luego escribimos cada bloque en el disco antes de obtener el siguiente bloque. De esta forma, el programa puede leer archivos de cualquier tamaño sin utilizar toda la memoria disponible en la computadora.</p>
<pre class="python"><code>import urllib.request, urllib.parse, urllib.error

img = urllib.request.urlopen(&#39;http://data.pr4e.org/cover3.jpg&#39;)
man_a = open(&#39;portada.jpg&#39;, &#39;wb&#39;)
tamano = 0
while True:
    info = img.read(100000)
    if len(info) &lt; 1: break
    tamano = tamano + len(info)
    man_a.write(info)

print(tamano, &#39;caracteres copiados.&#39;)
man_a.close()

# Código: https://es.py4e.com/code3/curl2.py</code></pre>
<p>En este ejemplo, leemos solamente 100,000 caracteres a la vez, y después los escribimos al archivo <code>portada.jpg</code> antes de obtener los siguientes 100,000 caracteres de datos desde la web.</p>
<p>Este programa se ejecuta como se observa a continuación:</p>
<pre><code>python curl2.py
230210 caracteres copiados.</code></pre>
<h2 id="análisis-the-html-y-rascado-de-la-web">Análisis the HTML y rascado de la web</h2>
<p> </p>
<p>Uno de los usos más comunes de las capacidades de <code>urllib</code> en Python es <em>rascar</em> la web. El rascado de la web es cuando escribimos un programa que pretende ser un navegador web y recupera páginas, examinando luego los datos de esas páginas para encontrar ciertos patrones.</p>
<p>Por ejemplo, un motor de búsqueda como Google buscará el código de una página web, extraerá los enlaces a otras paginas y las recuperará, extrayendo los enlaces que haya en ellas y así sucesivamente. Utilizando esta técnica, las <em>arañas</em> de Google alcanzan a casi todas las páginas de la web.</p>
<p>Google utiliza también la frecuencia con que las páginas que encuentra enlazan hacia una página concreta para calcular la “importancia” de esa página, y la posición en la que debe aparecer dentro de sus resultados de búsqueda.</p>
<h2 id="análisis-de-html-mediante-expresiones-regulares">Análisis de HTML mediante expresiones regulares</h2>
<p>Una forma sencilla de analizar HTML consiste en utilizar expresiones regulares para hacer búsquedas repetitivas que extraigan subcadenas coincidentes con un patrón en particular.</p>
<p>Aquí tenemos una página web simple:</p>
<pre class="html"><code>&lt;h1&gt;La Primera Página&lt;/h1&gt;
&lt;p&gt;
Si quieres, puedes visitar la
&lt;a href=&quot;http://www.dr-chuck.com/page2.htm&quot;&gt;
Segunda Página&lt;/a&gt;.
&lt;/p&gt;</code></pre>
<p>Podemos construir una expresión regular bien formada para buscar y extraer los valores de los enlaces del texto anterior, de esta forma:</p>
<pre><code>href=&quot;http[s]?://.+?&quot;</code></pre>
<p>Nuestra expresión regular busca cadenas que comiencen con “href="http://” o “href="https://”, seguido de uno o más caracteres (<code>.+?</code>), seguidos por otra comilla doble. El signo de interrogación después de <code>[s]?</code> indica que la coincidencia debe ser hecha en modo “no-codicioso”, en vez de en modo “codicioso”. Una búsqueda no-codiciosa intenta encontrar la cadena coincidente <em>más pequeña</em> posible, mientras que una búsqueda codiciosa intentaría localizar la cadena coincidente <em>más grande</em>.</p>
<p> </p>
<p>Añadimos paréntesis a nuestra expresión regular para indicar qué parte de la cadena localizada queremos extraer, y obtenemos el siguiente programa:</p>
<p> </p>
<pre class="python"><code># Búsqueda de valores de enlaces dentro de una URL ingresada
import urllib.request, urllib.parse, urllib.error
import re
import ssl

# Ignorar errores de certificado SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

url = input(&#39;Introduzca - &#39;)
html = urllib.request.urlopen(url).read()
enlaces = re.findall(b&#39;href=&quot;(http[s]?://.*?)&quot;&#39;, html)
for enlace in enlaces:
    print(enlace.decode())

# Código: https://es.py4e.com/code3/urlregex.py</code></pre>
<p>La librería <code>ssl</code> permite a nuestro programa acceder a los sitios web que estrictamente requieren HTTPS. El método <code>read</code> devuelve código fuente en HTML como un objeto binario en vez de devolver un objeto HTTPResponse. El método de expresiones regulares <code>findall</code> nos da una lista de todas las cadenas que coinciden con la expresión regular, devolviendo solamente el texto del enlace entre las comillas dobles.</p>
<p>Cuando corremos el programa e ingresamos una URL, obtenemos lo siguiente:</p>
<pre><code>Introduzca - https://docs.python.org
https://docs.python.org/3/index.html
https://www.python.org/
https://devguide.python.org/docquality/#helping-with-documentation
https://docs.python.org/3.9/
https://docs.python.org/3.8/
https://docs.python.org/3.7/
https://docs.python.org/3.6/
https://docs.python.org/3.5/
https://docs.python.org/2.7/
https://www.python.org/doc/versions/
https://www.python.org/dev/peps/
https://wiki.python.org/moin/BeginnersGuide
https://wiki.python.org/moin/PythonBooks
https://www.python.org/doc/av/
https://devguide.python.org/
https://www.python.org/
https://www.python.org/psf/donations/
https://docs.python.org/3/bugs.html
https://www.sphinx-doc.org/</code></pre>
<p>Las expresiones regulares funcionan muy bien cuando el HTML está bien formateado y es predecible. Pero dado que ahí afuera hay muchas páginas con HTML “defectuoso”, una solución que solo utilice expresiones regulares podría perder algunos enlaces válidos, o bien terminar obteniendo datos erróneos.</p>
<p>Esto se puede resolver utilizando una librería robusta de análisis de HTML.</p>
<h2 id="análisis-de-html-mediante-beautifulsoup">Análisis de HTML mediante BeautifulSoup</h2>
<p></p>
<p>A pesar de que HTML es parecido a XML<a href="#fn1" class="footnote-ref" id="fnref1" role="doc-noteref"><sup>1</sup></a> y que algunas páginas son construidas cuidadosamente para ser XML, la mayoría del HTML generalmente está incompleto, de modo que puede causar que un analizador de XML rechace una página HTML completa por estar formada inadecuadamente.</p>
<p>Hay varias librerías en Python que pueden ayudarte a analizar HTML y extraer datos de las páginas. Cada una tiene sus fortalezas y debilidades, por lo que puedes elegir una basada en tus necesidades.</p>
<p>Por ejemplo, vamos a analizar una entrada HTML cualquiera y a extraer enlaces utilizando la librería <em>BeautifulSoup</em>. BeautifulSoup tolera código HTML bastante defectuoso y aún así te deja extraer los datos que necesitas. Puedes descargar e instalar el código de BeautifulSoup desde:</p>
<p><a href="https://pypi.python.org/pypi/beautifulsoup4" class="uri">https://pypi.python.org/pypi/beautifulsoup4</a></p>
<p>La información acerca de la instalación de BeautifulSoup utilizando la herramienta de Python Package Index (Índice de Paquete de Python) <code>pip</code>, disponible en:</p>
<p><a href="https://packaging.python.org/tutorials/installing-packages/" class="uri">https://packaging.python.org/tutorials/installing-packages/</a></p>
<p>Vamos a utilizar <code>urllib</code> para leer la página y después utilizaremos <code>BeautifulSoup</code> para extraer los atributos <code>href</code> de las etiquetas de anclaje (<code>a</code>).</p>
<p>  </p>
<pre class="python"><code># Para ejecutar este programa descarga BeautifulSoup
# https://pypi.python.org/pypi/beautifulsoup4

# O descarga el archivo
# http://www.py4e.com/code3/bs4.zip
# y descomprimelo en el mismo directorio que este archivo

import urllib.request, urllib.parse, urllib.error
from bs4 import BeautifulSoup
import ssl

# Ignorar errores de certificado SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

url = input(&#39;Introduzca - &#39;)
html = urllib.request.urlopen(url, context=ctx).read()
sopa = BeautifulSoup(html, &#39;html.parser&#39;)

# Recuperar todas las etiquetas de anclaje
etiquetas = sopa(&#39;a&#39;)
for etiqueta in etiquetas:
    print(etiqueta.get(&#39;href&#39;, None))

# Código: https://es.py4e.com/code3/urllinks.py</code></pre>
<p>El programa solicita una dirección web, luego la abre, lee los datos y se los pasa al analizador BeautifulSoup. Luego, recupera todas las etiquetas de anclaje e imprime en pantalla el atributo <code>href</code> de cada una de ellas.</p>
<p>Cuando el programa se ejecuta, produce lo siguiente:</p>
<pre><code>Introduzca - https://docs.python.org
genindex.html
py-modindex.html
https://www.python.org/
#
whatsnew/3.8.html
whatsnew/index.html
tutorial/index.html
library/index.html
reference/index.html
using/index.html
howto/index.html
installing/index.html
distributing/index.html
extending/index.html
c-api/index.html
faq/index.html
py-modindex.html
genindex.html
glossary.html
search.html
contents.html
bugs.html
https://devguide.python.org/docquality/#helping-with-documentation
about.html
license.html
copyright.html
download.html
https://docs.python.org/3.9/
https://docs.python.org/3.8/
https://docs.python.org/3.7/
https://docs.python.org/3.6/
https://docs.python.org/3.5/
https://docs.python.org/2.7/
https://www.python.org/doc/versions/
https://www.python.org/dev/peps/
https://wiki.python.org/moin/BeginnersGuide
https://wiki.python.org/moin/PythonBooks
https://www.python.org/doc/av/
https://devguide.python.org/
genindex.html
py-modindex.html
https://www.python.org/
#
copyright.html
https://www.python.org/psf/donations/
https://docs.python.org/3/bugs.html
https://www.sphinx-doc.org/</code></pre>
<p>Esta lista es mucho más larga porque algunas de las etiquetas de anclaje son rutas relativas (e.g., tutorial/index.html) o referencias dentro de la página (p. ej., ‘#’) que no incluyen “http://” o “https://”, lo cual era un requerimiento en nuestra expresión regular.</p>
<p>También puedes utilizar BeautifulSoup para extraer varias partes de cada etiqueta de este modo:</p>
<pre class="python"><code># Para ejecutar este programa descarga BeautifulSoup
# https://pypi.python.org/pypi/beautifulsoup4

# O descarga el archivo
# http://www.py4e.com/code3/bs4.zip
# y descomprimelo en el mismo directorio que este archivo

from urllib.request import urlopen
from bs4 import BeautifulSoup
import ssl

# Ignorar errores de certificado SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

url = input(&#39;Introduzca - &#39;)
html = urlopen(url, context=ctx).read()
sopa = BeautifulSoup(html, &quot;html.parser&quot;)

# Obtener todas las etiquetas de anclaje
etiquetas = sopa(&#39;a&#39;)
for etiqueta in etiquetas:
    # Look at the parts of a tag
    print(&#39;ETIQUETA:&#39;, etiqueta)
    print(&#39;URL:&#39;, etiqueta.get(&#39;href&#39;, None))
    print(&#39;Contenido:&#39;, etiqueta.contents[0])
    print(&#39;Atributos:&#39;, etiqueta.attrs)

# Código: https://es.py4e.com/code3/urllink2.py</code></pre>
<pre><code>python urllink2.py
Introduzca - http://www.dr-chuck.com/page1.htm
ETIQUETA: &lt;a href=&quot;http://www.dr-chuck.com/page2.htm&quot;&gt;
Second Page&lt;/a&gt;
URL: http://www.dr-chuck.com/page2.htm
Contenido:
Second Page
Atributos: {&#39;href&#39;: &#39;http://www.dr-chuck.com/page2.htm&#39;}</code></pre>
<p><code>html.parser</code> es el analizador de HTML incluido en la librería estándar de Python 3. Para más información acerca de otros analizadores de HTML, lee:</p>
<p><a href="http://www.crummy.com/software/BeautifulSoup/bs4/doc/#installing-a-parser" class="uri">http://www.crummy.com/software/BeautifulSoup/bs4/doc/#installing-a-parser</a></p>
<p>Estos ejemplo tan sólo muestran un poco de la potencia de BeautifulSoup cuando se trata de analizar HTML.</p>
<h2 id="sección-extra-para-usuarios-de-unix-linux">Sección extra para usuarios de Unix / Linux</h2>
<p>Si tienes una computadora Linux, Unix, o Macintosh, probablemente tienes comandos nativos de tu sistema operativo para obtener tanto archivos de texto plano como archivos binarios utilizando los procolos HTTP o de Transferencia de Archivos (File Transfer - FTP). Uno de esos comandos es <code>curl</code>:</p>
<p></p>
<pre class="bash"><code>$ curl -O http://www.py4e.com/cover.jpg</code></pre>
<p>El comando <code>curl</code> es una abreviación de “copiar URL” y por esa razón los dos ejemplos vistos anteriormente para obtener archivos binarios con <code>urllib</code> son astutamente llamados <code>curl1.py</code> y <code>curl2.py</code> en <a href="http://www.py4e.com/code3">www.py4e.com/code3</a> debido a que ellos implementan una funcionalidad similar a la del comando <code>curl</code>. Existe también un programa de ejemplo <code>curl3.py</code> que realiza la misma tarea de forma un poco más eficiente, en caso de que quieras usar de verdad este diseño en algún programa que estés escribiendo.</p>
<p>Un segundo comando que funciona de forma similar es <code>wget</code>:</p>
<p></p>
<pre class="bash"><code>$ wget http://www.py4e.com/cover.jpg</code></pre>
<p>Ambos comandos hacen que obtener páginas web y archivos remotos se vuelva una tarea fácil.</p>
<h2 id="glosario">Glosario</h2>
<dl>
<dt>BeautifulSoup</dt>
<dd>Una librería de Python para analizar documentos HTML y extraer datos de ellos, que compensa la mayoría de las imperfecciones que los navegadores HTML normalmente ignoran. Puedes descargar el código de BeautifulSoup desde <a href="http://www.crummy.com">www.crummy.com</a>.
</dd>
<dt>puerto</dt>
<dd>Un número que generalmente indica qué aplicación estás contactando cuando realizas una conexión con un socket en un servidor. Por ejemplo, el tráfico web normalmente usa el puerto 80, mientras que el tráfico del correo electrónico usa el puerto 25.
</dd>
<dt>rascado</dt>
<dd>Cuando un programa simula ser un navegador web y recupera una página web, para luego realizar una búsqueda en su contenido. A menudo los programas siguen los enlaces en una página para encontrar la siguiente, de modo que pueden atravesar una red de páginas o una red social.
</dd>
<dt>rastrear</dt>
<dd>La acción de un motor de búsqueda web que consiste en recuperar una página y luego todas las páginas enlazadas por ella, continuando así sucesivamente hasta que tienen casi todas las páginas de Internet, que usan a continuación para construir su índice de búsqueda.
</dd>
<dt>socket</dt>
<dd>Una conexión de red entre dos aplicaciones, en la cual dichas aplicaciones pueden enviar y recibir datos en ambas direcciones.
</dd>
</dl>
<h2 id="ejercicios">Ejercicios</h2>
<p><strong>Ejercicio 1: Cambia el programa del socket <code>socket1.py</code> para que le pida al usuario la URL, de modo que pueda leer cualquier página web. Puedes usar <code>split('/')</code> para dividir la URL en las partes que la componen, de modo que puedas extraer el nombre del host para la llamada a <code>connect</code> del socket. Añade comprobación de errores utilizando <code>try</code> y <code>except</code> para contemplar la posibilidad de que el usuario introduzca una URL mal formada o inexistente.</strong></p>
<p><strong>Ejercicio 2: Cambia el programa del socket para que cuente el número de caracteres que ha recibido y se detenga, con un texto en pantalla, después de que se hayan mostrado 3000 caracteres. El programa debe recuperar el documento completo y contar el número total de caracteres, mostrando ese total al final del documento.</strong></p>
<p><strong>Ejercicio 3: Utiliza <code>urllib</code> para rehacer el ejercicio anterior de modo que (1) reciba el documento de una URL, (2) muestre hasta 3000 caracteres, y (3) cuente la cantidad total de caracteres en el documento. No te preocupes de las cabeceras en este ejercicio, simplemente muesta los primeros 3000 caracteres del contenido del documento.</strong></p>
<p><strong>Ejercicio 4: Cambia el programa <code>urllinks.py</code> para extraer y contar las etiquetas de párrafo (p) del documento HTML recuperado y mostrar el total de párrafos como salida del programa. No muestres el texto de los párrafos, sólo cuéntalos. Prueba el programa en varias páginas web pequeñas, y también en otras más grandes.</strong></p>
<p><strong>Ejercicio 5: (Avanzado) Cambia el programa del socket de modo que solamente muestra datos después de que se haya recibido la cabecera y la línea en blanco. Recuerda que <code>recv</code> recibe caracteres (saltos de línea incluidos), no líneas.</strong></p>
<section class="footnotes" role="doc-endnotes">
<hr />
<ol>
<li id="fn1" role="doc-endnote"><p>El formato XML es descrito en el siguiente capítulo.<a href="#fnref1" class="footnote-back" role="doc-backlink">↩︎</a></p></li>
</ol>
</section>
</body>
</html>
<?php if ( file_exists("../bookfoot.php") ) {
  $HTML_FILE = basename(__FILE__);
  $HTML = ob_get_contents();
  ob_end_clean();
  require_once "../bookfoot.php";
}?>
