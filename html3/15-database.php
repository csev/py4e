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
<h1 id="bases-de-datos-y-sql">Bases de datos y SQL</h1>
<h2 id="qué-es-una-base-de-datos">¿Qué es una base de datos?</h2>
<p></p>
<p>Una <em>base de datos</em> es un archivo que está organizado para almacenar datos. La mayoría de las bases de datos están organizadas como diccionarios, en el sentido de que realizan asociaciones entre claves y valores. La diferencia más importante es que la base de datos se encuentra en el disco (u otro almacenamiento permanente), de modo que su contenido se conserva después de que el programa finaliza. Gracias a que la base de datos se guarda en almacenamiento permanente, puede almacenar muchos más datos que un diccionario, que está limitado al tamaño de memoria que tenga la computadora.</p>
<p></p>
<p>Como un diccionario, el software de una base de datos está diseñado para conseguir que la inserción y acceso a los datos sean muy rápidos, incluso para grandes cantidades de datos. Este software mantiene su rendimiento mediante la construcción de índices, como datos añadidos a la base de datos que permiten al equipo saltar rápidamente hasta una entrada concreta.</p>
<p>Existen muchos sistemas de bases de datos diferentes, que se utilizan para una amplia variedad de propósitos. Algunos de ellos son: Oracle, MySQL, Microsoft SQL Server, PostgreSQL, y SQLite. En este libro nos enfocaremos en SQLite, ya que se trata de una base de datos muy común y ya viene integrada dentro de Python. SQLite está diseñada para ser <em>incrustada</em> dentro de otras aplicaciones, de modo que proporcione soporte para bases de datos dentro de la aplicación. Por ejemplo, el navegador Firefox es uno de los que utilizan la base de datos SQLite internamente, al igual que muchos otros productos.</p>
<p><a href="http://sqlite.org/" class="uri">http://sqlite.org/</a></p>
<p>SQLite es muy adecuado para ciertos problemas de manipulación de datos que nos encontramos en informática, como en la aplicación de rastreo de Twitter que hemos descrito en el capítulo anterior.</p>
<h2 id="conceptos-sobre-bases-de-datos">Conceptos sobre bases de datos</h2>
<p>Cuando se ve por primera vez una base de datos, se parece a una hoja de cálculo con múltiples hojas. Las estructuras de datos primarias en una base de datos son: <em>tablas</em>, <em>files</em>, and <em>columnas</em>.</p>
<figure>
<img src="../images/relational.svg" alt="" /><figcaption>Bases de datos relacionales</figcaption>
</figure>
<p>En las descripciones técnicas de las bases de datos relacionales, los conceptos de tabla, fila y columna reciben los nombres más formales de <em>relación</em>, <em>tupla</em>, y <em>atributo</em>, respectivamente. Nosotros utilizaremos los términos menos formales en este capítulo.</p>
<h2 id="navegador-de-bases-de-datos-para-sqlite">Navegador de bases de datos para SQLite</h2>
<p>A pesar de que en este capítulo nos enfocaremos en utilizar Python para trabajar con datos en archivos de bases de datos SQLite, muchas operaciones pueden ser hechas de forma más eficaz usando un programa de software llamado <em>Database Browser for SQLite</em>, que se puede descargar gratis desde:</p>
<p><a href="http://sqlitebrowser.org/" class="uri">http://sqlitebrowser.org/</a></p>
<p>Utilizando el navegador se pueden crear tablas, insertar datos, editar datos, o ejecutar consultas SQL sencillas sobre la base de datos.</p>
<p>En cierto modo, el navegador de base de datos es parecido a un editor de texto que trabaja con archivos de texto. Cuando quieres realizar uno o dos cambios en un archivo de texto, lo más sencillo es abrirlo en un editor de texto y realizar los cambios que quieres. Cuando debes realizar muchas modificaciones en el archivo, a menudo habrá que escribir un programa en Python sencillo. El mismo enfoque se puede aplicar al trabajo con bases de datos. Se realizarán las operaciones más sencillas en el gestor de bases de datos, y para otras más complejas será más conveniente usar Python.</p>
<h2 id="creación-de-una-tabla-en-una-base-de-datos">Creación de una tabla en una base de datos</h2>
<p>Las bases de datos necesitan una estructura más definida que las listas o diccionarios de Python<a href="#fn1" class="footnote-ref" id="fnref1" role="doc-noteref"><sup>1</sup></a>.</p>
<p>Cuando creamos una <em>tabla</em>, debemos indicar de antemano a la base de datos los nombres de cada una de las <em>columnas</em> de esa tabla y el tipo de dato que se va a almacenar en cada una de ellas. Cuando el software de la base de datos conoce el tipo de dato de cada columna, puede elegir el modo más eficiente de almacenar y buscar en ellas, basándose en el tipo de dato que contendrán.</p>
<p>Puedes revisar los distintos tipos de datos soportados por SQLite en la siguiente dirección:</p>
<p><a href="http://www.sqlite.org/datatypes.html" class="uri">http://www.sqlite.org/datatypes.html</a></p>
<p>El tener que definir de antemano una estructura para los datos puede parecer incómodo al principio, pero la recompensa consiste en obtener un acceso rápido a los datos, incluso cuando la base de datos contiene una gran cantidad de ellos.</p>
<p>El código para crear un archivo de base de datos y una tabla llamada <code>Canciones</code> con dos columnas en la base de datos es el siguiente:</p>
<p> </p>
<pre class="python"><code>import sqlite3

conn = sqlite3.connect(&#39;musica.sqlite&#39;)
cur = conn.cursor()

cur.execute(&#39;DROP TABLE IF EXISTS Canciones&#39;)
cur.execute(&#39;CREATE TABLE Canciones (titulo TEXT, reproducciones INTEGER)&#39;)

conn.close()

# Code: http://www.py4e.com/code3/db1.py</code></pre>
<p>   </p>
<p>La operación <code>connect</code> realiza una conexión con la base de datos almacenada en el archivo <code>musica.sqlite</code> en el directorio actual. Si el archivo no existe, se creará uno nuevo. La razón de que se le llame una “conexión” es que a veces la base de datos se almacena en un “servidor de bases de datos”, distinto del servidor en el cual está funcionando nuestra aplicación. En nuestros ejemplos, dado que son sencillos, la base de datos será simplemente un archivo local en el mismo directorio en el que está funcionando el código de Python.</p>
<p>Un <em>cursor</em> es como un manejador de archivos, y se puede usar para realizar operaciones en los datos almacenados en la base de datos. La llamada a <code>cursor()</code> es muy similar conceptualmente a la llamada <code>open()</code> cuando se está tratando con archivos de texto.</p>
<figure>
<img src="../images/cursor.svg" alt="" /><figcaption>Un cursor de bases de datos</figcaption>
</figure>
<p>Una vez que tenemos el cursor, podemos comenzar a ejecutar comandos sobre el contenido de la base de datos, usando el método <code>execute()</code>.</p>
<p>Los comandos de las bases de datos se expresan en un lenguaje especial que ha sido estandarizado entre varios proveedores de bases de datos diferentes para permitirnos aprender un único lenguaje para todas ellas. Este lenguaje recibe el nombre de <em>Lenguaje de Consultas Estructurado</em> (Structured Query Language), o <em>SQL</em>.</p>
<p><a href="https://es.wikipedia.org/wiki/SQL" class="uri">https://es.wikipedia.org/wiki/SQL</a></p>
<p>En nuestro ejemplo, estamos ejecutando dos comandos SQL sobre la base de datos. Por convención, mostraremos las palabras claves de SQL en mayúscula y las partes de los comandos que añadamos nosotros (como los nombres de las tablas y las columnas) irán en minúsculas.</p>
<p>El primer comando SQL elimina la tabla <code>Canciones</code> si ya existe. Este planteamiento se utiliza simplemente para permitirnos ejecutar el mismo programa para crear la tabla <code>Canciones</code> una y otra vez sin provocar un error. Observa que el comando <code>DROP TABLE</code> elimina la tabla y todo su contenido de la base de datos (es decir, aquí no existe la opción “deshacer”).</p>
<pre class="python"><code>cur.execute(&#39;DROP TABLE IF EXISTS Canciones &#39;)</code></pre>
<p>El segundo comando crea una tabla llamada <code>Canciones</code> con una columna de texto llamada <code>titulo</code> y una columna de enteros llamada <code>reproducciones</code>.</p>
<pre class="python"><code>cur.execute(&#39;CREATE TABLE Canciones (titulo TEXT, reproducciones INTEGER)&#39;)</code></pre>
<p>Ahora que ya hemos creado la tabla llamada <code>Canciones</code>, podemos guardar algunos datos en ella usando la operación de SQL <code>INSERT</code>. Empezaremos realizando otra vez una conexión con la base de datos y obteniendo el <code>cursor</code>. Luego podemos ejecutar comandos SQL usando ese cursor.</p>
<p>El comando <code>INSERT</code> de SQL indica qué tabla se está utilizando y luego define una fila nueva, enumerando los campos que se desean incluir <code>(titulo, reproducciones)</code> seguidos por los valores (<code>VALUES</code>) que queremos colocar en esa fila. Nosotros vamos a especificar los valores como signos de interrogación <code>(?, ?)</code> para indicarle que los valores reales serán pasados como una tupla <code>( 'My Way', 15 )</code> en el segundo parámetro de la llamada a <code>execute()</code>.</p>
<pre class="python"><code>import sqlite3

conn = sqlite3.connect(&#39;music.sqlite&#39;)
cur = conn.cursor()

cur.execute(&#39;INSERT INTO Canciones (titulo, reproducciones) VALUES (?, ?)&#39;,
    (&#39;Thunderstruck&#39;, 20))
cur.execute(&#39;INSERT INTO Canciones (titulo, reproducciones) VALUES (?, ?)&#39;,
    (&#39;My Way&#39;, 15))
conn.commit()

print(&#39;Canciones:&#39;)
cur.execute(&#39;SELECT titulo, reproducciones FROM Canciones&#39;)
for fila in cur:
     print(fila)

cur.execute(&#39;DELETE FROM Canciones WHERE reproducciones &lt; 100&#39;)
conn.commit()

cur.close()

# Code: http://www.py4e.com/code3/db2.py</code></pre>
<p>Primero insertamos (<code>INSERT</code>) dos filas en la tabla y usamos <code>commit()</code> para forzar a que los datos sean escritos en el archivo de la base de datos.</p>
<figure>
<img src="../images/tracks.svg" alt="" /><figcaption>Columnas en una tabla</figcaption>
</figure>
<p>Después usamos el comando <code>SELECT</code> para recuperar las filas que acabamos de insertar en la tabla. En el comando <code>SELECT</code>, indicamos qué columnas nos gustaría obtener <code>(titulo, reproducciones)</code>, y también desde qué tabla queremos recuperar los datos. Después de ejecutar la sentencia <code>SELECT</code>, el cursor se convierte en algo con lo que podemos iterar mediante una sentencia <code>for</code>. Por eficiencia, el cursor no lee todos los datos de la base de datos cuando se ejecuta la sentencia <code>SELECT</code>. En lugar de ello, los datos van siendo leídos a medida que se van pidiendo las filas desde el bucle creado con la sentencia <code>for</code>.</p>
<p>La salida del programa es la siguiente:</p>
<pre><code>Canciones:
(&#39;Thunderstruck&#39;, 20)
(&#39;My Way&#39;, 15)</code></pre>
<p></p>
<p>Nuestro bucle <code>for</code> encuentra dos filas, y cada fila es una tupla de Python cuyo primer valor es el <code>titulo</code> y el segundo es el número de <code>reproducciones</code>.</p>
<p><em>Nota: Puede que veas cadenas comenzando con <code>u'</code> en otros libros o en Internet. Esto es una indicación en Python 2 que dice que las cadenas son cadenas </em>Unicode<em> que son capaces de almacenar caracteres no-latinos. En Python 3, todas las cadenas son del tipo <code>Unicode</code> por defecto.</em></p>
<p>Al final del programa, ejecutamos un comando SQL para borrar (<code>DELETE</code>) las files que acabamos de crear, de modo que podamos ejecutar el programa una y otra vez. El comando <code>DELETE</code> nos muestra el uso de la cláusula <code>WHERE</code>, la cual nos permite expresar un criterio de selección, de modo que podemos pedir a la base de datos que aplique el comando solamente a las filas que cumplan ese criterio. En este ejemplo, el criterio es cumplido por todas las filas, así que vaciamos la tabla para que podamos ejecutar el programa de nuevo repetidamente. Después de que se ha realizado el <code>DELETE</code>, llamamos de nuevo a <code>commit()</code> para forzar a los datos a ser eliminados de la base de datos.</p>
<h2 id="resumen-de-lenguaje-de-consultas-estructurado">Resumen de Lenguaje de Consultas Estructurado</h2>
<p>Hasta ahora, hemos estado usando el Lenguaje de Consultas Estructurado (SQL) en nuestros ejemplos de Python y hemos utilizado muchos de los comandos básicos de SQL. En esta sección, nos centraremos en el lenguaje SQL en particular y echaremos un vistazo a su sintaxis.</p>
<p>Debido a que hay muchos proveedores de bases de datos, el Lenguaje de Consultas Estructurado (SQL) está estandarizado, para que podamos comunicarnos de una forma similar con sistemas de bases de datos de múltiples vendedores.</p>
<p>Una base de datos relacional está compuesta por tablas, filas, y columnas. Las columnas tienen generalmente un tipo de datos que puede ser texto, números, o datos de fechas. Cuando se crea una tabla, se indican los nombres y tipos de cada columna:</p>
<pre class="sql"><code>CREATE TABLE Canciones (titulo TEXT, reproducciones INTEGER)</code></pre>
<p>Para insertar una fila en una tabla, usamos el comando de SQL <code>INSERT</code>:</p>
<pre class="sql"><code>INSERT INTO Canciones (titulo, reproducciones) VALUES (&#39;My Way&#39;, 15)</code></pre>
<p>La sentencia <code>INSERT</code> especifíca el nombre de la tabla, seguido por una lista de los campos/columnas que se quieren establecer en la fila nueva, a continuación la palabra clave <code>VALUES</code>, y una lista de los valores correspondientes para cada uno de los campos.</p>
<p>El comando de SQL <code>SELECT</code>se utiliza para recuperar filas y columnas desde una base de datos. La sentencia <code>SELECT</code> permite especificar qué columnas se quieren recibir, junto con una clausula <code>WHERE</code> para indicar qué filas se desean obtener. También permite una clausula opcional, <code>ORDER BY</code> para controlar el orden de las files devueltas.</p>
<pre class="sql"><code>SELECT * FROM Canciones WHERE titulo = &#39;My Way&#39;</code></pre>
<p>El uso de <code>*</code> indica que se desea que la base de datos devuelva todas las columnas para cada línea que cumpla la condición de la clausula <code>WHERE</code>.</p>
<p>Hay que notar que, a diferencia de lo que ocurre en Python, en SQL la clausula <code>WHERE</code> utiliza un único signo igual para indicar una comprobación de igualdad, en lugar de utilizar un signo doble igual. Otras operaciones lógicas que se permiten en una clausula <code>WHERE</code> son <code>&lt;</code>, <code>&gt;</code>, <code>&lt;=</code>, <code>&gt;=</code>, <code>!=</code>, así como también <code>AND</code> y <code>OR</code>, y paréntesis para construir expresiones lógicas.</p>
<p>Se puede solicitar que las columnas devueltas vengan ordenadas por uno de los campos, de este modo:</p>
<pre class="sql"><code>SELECT titulo,reproducciones FROM Canciones ORDER BY titulo</code></pre>
<p>Para eliminar una fila, es necesario usar una clausula <code>WHERE</code> en una sentencia <code>DELETE</code> de SQL. La clausula <code>WHERE</code> determina qué filas serán eliminadas:</p>
<pre class="sql"><code>DELETE FROM Canciones WHERE titulo = &#39;My Way&#39;</code></pre>
<p>Es posible actualizar (<code>UPDATE</code>) una columna o varias de una o más filas en una tabla usando la secuencia de SQL <code>UPDATE</code>, como se muestra a continuación:</p>
<pre class="sql"><code>UPDATE Canciones SET reproducciones = 16 WHERE titulo = &#39;My Way&#39;</code></pre>
<p>La sentencia <code>UPDATE</code> especifíca una tabla, a continuación una lista de campos y valores a cambiar detrás de la palabra clave <code>SET</code>, y finalmente una clausula opcional <code>WHERE</code> para elegir las filas que van a ser actualizadas. Una única sentencia <code>UPDATE</code> cambiará todas las filas que coincidan con la clausula <code>WHERE</code>. Si no se ha especificado ninguna clausula <code>WHERE</code>, se realizará la actualización (<code>UPDATE</code>) de todas las filas de la tabla.</p>
<p>Existen cuatro comandos básicos de SQL (INSERT, SELECT, UPDATE, y DELETE), que nos permiten realizar las cuatro operaciones básicas necesarias para crear y mantener datos.</p>
<h2 id="rastreo-en-twitter-usando-una-base-de-datos">Rastreo en Twitter usando una base de datos</h2>
<p>En esta sección, crearemos un programa araña sencillo que se moverá a través de cuentas de Twitter y construirá una base de datos de ellas. <em>Nota: Ten mucho cuidado cuando al ejecutar este programa. Si extraes demasiados datos o ejecutas el programa durante demasiado tiempo pueden terminar cortándote el acceso a Twitter.</em></p>
<p>Uno de los problemas de cualquier tipo de programa araña es que se necesita poderlo deener y volver a poner en marcha muchas veces, y no se quieren perder los datos que se hayan recuperado hasta ese momento. No querrás tener que empezar siempre la recuperación de datos desde el principio, de modo que necesitaremos almacenar los datos según los vamos recuperando para que nuestro programa pueda usar esa copia de seguridad y reanudar la recolección de datos desde donde lo dejó la última vez.</p>
<p>Vamos a comenzar por recuperar los amigos de Twitter de una persona y sus estados, moviéndonos a través de la lista de amigos y añadiendo cada uno de ellos a la base de datos para poder recuperarlos en el futuro. Después de haber procesado todos los amigos de esa persona, consultaremos la base de datos y recuperaremos los amigos de uno de esos amigos. Continuaremos haciendo esto una y otra vez, recogiendo cualquier persona “no visitada”, recuperando su lista de amigos y añadiendo aquellos que no tengamos ya en nuestra lista para una próxima visita.</p>
<p>También vamos a contar cuántas veces hemos visto un amigo concreto en la base de datos, para tener una idea de su “popularidad”.</p>
<p>Estamos almacenando nuestra lista de cuentas de conocidos, si hemos recuperado la cuenta o no, y la popularidad de cada cuenta. Al tener todo ello guardado en una base de datos en nuestro PC, podremos detener y reanudar el programa tantas veces como queramos.</p>
<p>Este programa es un poco complejo. Está basado en el código de un ejercicio anterior del libro que usa la API de Twitter.</p>
<p>Aquí está el código fuente para nuestra aplicación araña de Twitter:</p>
<pre class="python"><code>from urllib.request import urlopen
import urllib.error
import twurl
import json
import sqlite3
import ssl

TWITTER_URL = &#39;https://api.twitter.com/1.1/friends/list.json&#39;

conn = sqlite3.connect(&#39;arana.sqlite&#39;)
cur = conn.cursor()

cur.execute(&#39;&#39;&#39;
            CREATE TABLE IF NOT EXISTS Twitter
            (nombre TEXT, recuperado INTEGER, amigos INTEGER)&#39;&#39;&#39;)

# Ignorar errores de certificado SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

while True:
    cuenta = input(&#39;Ingresa una cuenta de Twitter, o salir: &#39;)
    if (cuenta == &#39;salir&#39;): break
    if (len(cuenta) &lt; 1):
        cur.execute(&#39;SELECT nombre FROM Twitter WHERE recuperado = 0 LIMIT 1&#39;)
        try:
            cuenta = cur.fetchone()[0]
        except:
            print(&#39;No se han encontrado cuentas de Twitter por recuperar&#39;)
            continue

    url = twurl.aumentar(TWITTER_URL, {&#39;screen_name&#39;: cuenta, &#39;count&#39;: &#39;5&#39;})
    print(&#39;Recuperando&#39;, url)
    conexion = urlopen(url, context=ctx)
    datos = conexion.read().decode()
    cabeceras = dict(conexion.getheaders())

    print(&#39;Restante&#39;, cabeceras[&#39;x-rate-limit-remaining&#39;])
    js = json.loads(datos)
    # Depuración
    # print json.dumps(js, indent=4)

    cur.execute(&#39;UPDATE Twitter SET recuperado=1 WHERE nombre = ?&#39;, (cuenta, ))

    contnuevas = 0
    contantiguas = 0
    for u in js[&#39;users&#39;]:
        amigo = u[&#39;screen_name&#39;]
        print(amigo)
        cur.execute(&#39;SELECT amigos FROM Twitter WHERE nombre = ? LIMIT 1&#39;,
                    (amigo, ))
        try:
            contador = cur.fetchone()[0]
            cur.execute(&#39;UPDATE Twitter SET amigos = ? WHERE nombre = ?&#39;,
                        (contador+1, amigo))
            contantiguas = contantiguas + 1
        except:
            cur.execute(&#39;&#39;&#39;INSERT INTO Twitter (nombre, recuperado, amigos)
                        VALUES (?, 0, 1)&#39;&#39;&#39;, (amigo, ))
            contnuevas = contnuevas + 1
    print(&#39;Cuentas nuevas=&#39;, contnuevas, &#39; ya visitadas=&#39;, contantiguas)
    conn.commit()

cur.close()

# Code: http://www.py4e.com/code3/twspider.py</code></pre>
<p>Nuestra base de datos está almacenada en el archivo <code>arana.sqlite</code> y tiene una tabla llamada <code>Twitter</code>. Cada fila en la tabla <code>Twitter</code> contiene una columna para el nombre de la cuenta, otra para indicar si hemos recuperado los amigos de esa cuenta, y otra para guardar cuántas veces se ha visto esa cuenta añadida en la lista de amigos de las demás.</p>
<p>En el bucle principal del programa, pedimos al usuario el nombre de una cuenta de Twitter o “salir” para finalizar el programa. Si el usuario introduce una cuenta de Twitter, recuperamos la lista de amigos de ese usuario y sus estados, y añadimos cada amigo a la base de datos, si no estaba ya en ella. Si el amigo ya estaba en la lista, aumentamos en 1 el campo <code>amigos</code> en la fila correspondiente de la base de datos.</p>
<p>Si el usuario presiona intro, buscamos en la base de datos la siguiente cuenta de Twitter que no haya sido aún recuperada, recuperamos los amigos de esa cuenta y sus estados, y luego los añadimos a la base de datos o los actualizamos, e incrementamos su contador de <code>amigos</code>.</p>
<p>Una vez hemos recuperado la lista de amigos y sus estados, nos movemos a través de los elementos <code>user</code> del JSON devuelto y recuperamos el <code>screen_name</code> (nombre a mostrar) de cada usuario. Luego usamos la sentencia <code>SELECT</code> para comprobar si ya tenemos almacenado ese nombre concreto en la base de datos y si es así recuperamos su contador de amigos (<code>amigos</code>).</p>
<pre class="python"><code>contnuevas = 0
contantiguas = 0
for u in js[&#39;users&#39;]:
    amigo = u[&#39;screen_name&#39;]
    print(amigo)
    cur.execute(&#39;SELECT amigos FROM Twitter WHERE nombre = ? LIMIT 1&#39;,
                (amigo, ))
    try:
        contador = cur.fetchone()[0]
        cur.execute(&#39;UPDATE Twitter SET amigos = ? WHERE nombre = ?&#39;,
                    (contador+1, amigo))
        contantiguas = contantiguas + 1
    except:
        cur.execute(&#39;&#39;&#39;INSERT INTO Twitter (nombre, recuperado, amigos)
                    VALUES (?, 0, 1)&#39;&#39;&#39;, (amigo, ))
        contnuevas = contnuevas + 1
print(&#39;Cuentas nuevas=&#39;, contnuevas, &#39; ya visitadas=&#39;, contantiguas)
conn.commit()</code></pre>
<p>Una vez que el cursor ejecuta la sentencia <code>SELECT</code>, tenemos que recuperar las filas. Podríamos hacerlo con una sentencia <code>for</code>, pero dado que sólo estamos recuperando una única fila (<code>LIMIT 1</code>), podemos también usar el método <code>fetchone()</code> para extraer la primera (y única) fila que da como resultado la operación <code>SELECT</code>. Dado que <code>fetchone()</code> devuelve la fila como una <em>tupla</em> (incluso si sólo contiene un campo), tomamos el primer valor de la tupla mediante [0], para almacenar así dentro de la variable <code>contador</code> el valor del contador de amigos actual.</p>
<p>Si esta operación tiene éxito, usamos la sentencia <code>UPDATE</code> de SQL con una clausula <code>WHERE</code> para añadir 1 a la columa <code>amigos</code> de aquella fila que coincida con la cuenta del amigo. Fíjate que hay dos marcadores de posición (es decir, signos de interrogación) en el SQL, y que el segundo parámetro de <code>execute()</code> es una tupla de dos elementos que contiene los valores que serán sustituidos por esas interrogaciones dentro de la sentencia SQL.</p>
<p>Si el código en el bloque <code>try</code> falla, se deberá probablemente a que ningún registro coincide con lo especificado en la clausula <code>WHERE nombre = ?</code> de la setencia SELECT. Así que en el bloque <code>except</code>, usamos la sentencia de SQL <code>INSERT</code> para añadir el nombre a mostrar (<code>screen_name</code>) del amigo a la tabla, junto con una indicación de que no lo hemos recuperado aún, y fijamos su contador de amigos a cero.</p>
<p>La primera vez que el programa funciona e introducimos una cuenta de Twitter, mostrará algo similar a esto:</p>
<pre><code>Ingresa una cuenta de Twitter, o salir: drchuck
Recuperando http://api.twitter.com/1.1/friends ...
Cuentas nuevas= 20  ya visitadas= 0
Ingresa una cuenta de Twitter, o salir: salir</code></pre>
<p>Dado que es la primera vez que ejecutamos el programa, la base de datos está vacía, así que creamos el archivo <code>arana.sqlite</code> y añadimos una tabla llamada <code>Twitter</code> a la base de datos. A continuación recuperamos algunos amigos y los añadimos a la base de datos, ya que ésta está vacía.</p>
<p>En este punto, tal vez sea conveniente escribir un programa de volcado de datos sencillo, para echar un vistazo a lo que hay dentro del archivo <code>spider.sqlite</code>:</p>
<pre class="python"><code>import sqlite3

conn = sqlite3.connect(&#39;arana.sqlite&#39;)
cur = conn.cursor()
cur.execute(&#39;SELECT * FROM Twitter&#39;)
contador = 0
for fila in cur:
    print(fila)
    contador = contador + 1
print(contador, &#39;filas.&#39;)
cur.close()

# Code: http://www.py4e.com/code3/twdump.py</code></pre>
<p>Este programa simplemente abre la base de datos y selecciona todas las columnas de todas las filas de la tabla <code>Twitter</code>, luego se mueve a través de las filas e imprime en pantalla su contenido.</p>
<p>Si ejecutamos este programa después de la primera ejecución de nuestra araña de Twitter, la salida que mostrará será similar a esta:</p>
<pre><code>(&#39;opencontent&#39;, 0, 1)
(&#39;lhawthorn&#39;, 0, 1)
(&#39;steve_coppin&#39;, 0, 1)
(&#39;davidkocher&#39;, 0, 1)
(&#39;hrheingold&#39;, 0, 1)
...
20 filas.</code></pre>
<p>Vemos una fila para cada nombre, que aún no hemos recuperado los datos de ninguno de esos nombres, y que todo el mundo en la base de datos tiene un amigo.</p>
<p>En este momento la base de datos muestra la recuperación de los amigos de nuestra primera cuenta de Twitter (<em>drchuck</em>). Podemos ejecutar de nuevo el programa y pedirle que recupere los amigos de la siguiente cuenta “sin procesar”, simplemente pulsando intro en vez de escribir el nombre de una cuenta:</p>
<pre><code>Ingresa una cuenta de Twitter, o salir:
Recuperando http://api.twitter.com/1.1/friends ...
Cuentas nuevas= 18  ya visitadas= 2
Ingresa una cuenta de Twitter, o salir:
Recuperando http://api.twitter.com/1.1/friends ...
Cuentas nuevas= 17  ya visitadas= 3
Ingresa una cuenta de Twitter, o salir: salir</code></pre>
<p>Como hemos pulsado intro (es decir, no hemos especificado otra cuenta de Twitter), se ha ejecutado el código siguiente:</p>
<pre class="python"><code>if ( len(cuenta) &lt; 1 ) :
    cur.execute(&#39;SELECT nombre FROM Twitter WHERE recuperado = 0 LIMIT 1&#39;)
    try:
        cuenta = cur.fetchone()[0]
    except:
        print(&#39;No se han encontrado cuentas de Twitter por recuperar&#39;)
        continue</code></pre>
<p>Usamos la sentencia de SQL <code>SELECT</code> para obtener el nombre del primer usuario (<code>LIMIT 1</code>) que aún tiene su valor de “hemos recuperado ya este usuario” a cero. También usamos el patrón <code>fetchone()[0]</code> en un bloque try/except para extraer el “nombre a mostrar” (<code>screen_name</code>) de los datos recuperados, o bien mostrar un mensaje de error y volver al principio.</p>
<p>Si hemos obtenido con éxito el nombre de una cuenta que aún no había sido procesada, recuperamos sus datos de este modo:</p>
<pre class="python"><code>url=twurl.augment(TWITTER_URL,{&#39;screen_name&#39;: cuenta,&#39;count&#39;: &#39;20&#39;})
print(&#39;Recuperando&#39;, url)
conexion = urllib.urlopen(url)
datos = conexion.read()
js = json.loads(datos)

cur.execute(&#39;UPDATE Twitter SET recuperado=1 WHERE nombre = ?&#39;,(cuenta, ))</code></pre>
<p>Una vez recuperados correctamente los datos, usamos la sentencia <code>UPDATE</code> para poner la columna <code>recuperado</code> a 1, lo que indica que hemos terminado la extracción de amigos de esa cuenta. Esto impide que recuperemos los mismos datos una y otra vez, y nos permite ir avanzando a través de la red de amigos de Twitter.</p>
<p>Si ejecutamos el programa de amigos y pulsamos intro dos veces para recuperar los amigos del siguiente amigo no visitado, y luego ejecutamos de nuevo el programa de volcado de datos, nos mostrará la salida siguiente:</p>
<pre><code>(&#39;opencontent&#39;, 1, 1)
(&#39;lhawthorn&#39;, 1, 1)
(&#39;steve_coppin&#39;, 0, 1)
(&#39;davidkocher&#39;, 0, 1)
(&#39;hrheingold&#39;, 0, 1)
...
(&#39;cnxorg&#39;, 0, 2)
(&#39;knoop&#39;, 0, 1)
(&#39;kthanos&#39;, 0, 2)
(&#39;LectureTools&#39;, 0, 1)
...
55 filas.</code></pre>
<p>Podemos ver que se han guardado correctamente las visitas que hemos realizado a <code>lhawthorn</code> y <code>opencontent</code>. Además, las cuentas <code>cnxorg</code> y <code>kthanos</code> ya tienen dos seguidores. Puesto que hemos recuperado los amigos de tres personas (<code>drchuck</code>, <code>opencontent</code>, y <code>lhawthorn</code>), la tabla contiene 55 filas de amigos por recuperar.</p>
<p>Cada vez que ejecutamos el programa y pulsamos intro, se elegirá la siguiente cuenta no visitada (es decir, ahora la siguiente cuenta sería <code>steve_coppin</code>), recuperará sus amigos, los marcará como recuperados y, para cada uno de los amigos de <code>steve_coppin</code>, o bien lo añadirá al final de la base de datos, o bien actualizará su contador de amigos si ya estaba en la base de datos.</p>
<p>Como todos los datos del programa están almacenados en el disco en una base de datos, la actividad de rastreo puede ser suspendida y reanudada tantas veces como se desee, sin que se produzca ninguna pérdida de datos.</p>
<h2 id="modelado-de-datos-básico">Modelado de datos básico</h2>
<p>La potencia real de las bases de datos relacionales se manifiesta cuando se construyen múltiples tablas y se crean enlaces entre ellas. La acción de decidir cómo separar los datos de tu aplicación en múltiples tablas y establecer las relaciones entre esas tablas recibe el nombre de <em>modelado de datos</em>. El documento de diseño que muestra las tablas y sus relaciones se llama <em>modelo de datos</em>.</p>
<p>El modelado de datos es una habilidad relativamente sofisticada, y en esta sección sólo introduciremos los conceptos más básicos acerca del tema. Para obtener más detalles sobre modelado de datos puedes comenzar con:</p>
<p><a href="http://es.wikipedia.org/wiki/Modelo_relacional" class="uri">http://es.wikipedia.org/wiki/Modelo_relacional</a></p>
<p>Supongamos que para nuestra aplicación de rastreo de Twitter, en vez de contar los amigos de una persona sin más, queremos mantener una lista de todas las relaciones entre ellos, de modo que podamos encontrar una lista de gente que esté siguiendo la cuenta de una persona concreta.</p>
<p>Dado que todo el mundo puede tener potencialmente muchas cuentas siguiéndole, no podemos añadir simplemente una única columna a nuestra tabla de <code>Twitter</code>. De modo que creamos una tabla nueva que realice un seguimiento de parejas de amigos. A continuación se muestra un modo sencillo de hacer una tabla de este tipo:</p>
<pre class="sql"><code>CREATE TABLE Colegas (desde_amigo TEXT, hacia_amigo TEXT)</code></pre>
<p>Cada vez que encontremos una persona de las que está siguiendo <code>drchuck</code>, insertaremos una fila de esta forma:</p>
<pre class="sql"><code>INSERT INTO Colegas (desde_amigo,hacia_amigo) VALUES (&#39;drchuck&#39;, &#39;lhawthorn&#39;)</code></pre>
<p>Conforma vayamos procesando los 20 amigos de <code>drchuck</code> que nos envía Twitter, insertaremos 20 registros con “drchuck” como primer parámetro, de modo que terminaremos duplicando la cadena un montón de veces en la base de datos.</p>
<p>Esta duplicación de cadenas de datos viola una de las mejores prácticas para la <em>normalización de bases de datos</em>, que básicamente consiste en que nunca se debe guardar la misma cadena más de una vez en la base de datos. Si se necesitan los datos varias veces, se debe crear una <em>clave</em> numérica para ellos y hacer referencia a los datos reales a través de esa clave.</p>
<p>En términos prácticos, una cadena ocupa un montón de espacio más que un entero, tanto en el disco como en la memoria del equipo, y además necesita más tiempo de procesador para ser comparada y ordenada. Si sólo se tienen unos pocos cientos de entradas, el espacio y el tiempo de procesador no importan demasiado. Pero si se tienen un millón de personas en la base de datos y la posibilidad de 100 millones de enlaces de amigos, es importante ser capaz de revisar los datos tan rápido como sea posible.</p>
<p>Vamos a almacenar nuestras cuentas de Twitter en una tabla llamada <code>Personas</code> en vez de hacerlo en la tabla <code>Twitter</code> que usamos en el ejemplo anterior. La tabla <code>Personas</code> tiene una columna adicional para almacenar la clave numérica asociada con la fila de cada usuario de Twitter. SQLite tiene una característica que permite añadir automáticamente el valor de la clave para cualquier fila que insertemos en la tabla, usando un tipo especial de datos en la columna (<code>INTEGER PRIMARY KEY</code>).</p>
<p>Podemos crear la tabla <code>Personas</code> con esa columna adicional, <code>id</code>, como se muestra a continuación:</p>
<pre class="sql"><code>CREATE TABLE Personas
    (id INTEGER PRIMARY KEY, nombre TEXT UNIQUE, recuperado INTEGER)</code></pre>
<p>Hay que notar que ya no necesitamos mantener un contador de amigos en cada columna de la tabla <code>Personas</code>. Cuando elegimos <code>INTEGER PRIMARY KEY</code> como el tipo de la columa <code>id</code>, estamos indicando que queremos que SQLite controle esta columa y asigne automáticamente una clave numérica única para cada fila que insertemos. También añadimos la palabra clave <code>UNIQUE</code>, para indicar que no vamos a permitir a SQLite insertar dos filas con el mismo valor de <code>nombre</code>.</p>
<p>Ahora, en vez de crear la tabla <code>Colegas</code> como hicimos antes, crearemos una tabla llamada <code>Seguimientos</code> con dos columnas de tipo entero, <code>desde_id</code> y <code>hacia_id</code>, y una restricción en la tabla que consistirá en que la <em>combinación</em> de <code>desde_id</code> y <code>hacia_id</code> deberá ser única (es decir, no se podrán insertar filas en la tabla con estos valores duplicados) en nuestra base de datos.</p>
<pre class="sql"><code>CREATE TABLE Seguimientos
    (desde_id INTEGER, hacia_id INTEGER, UNIQUE(desde_id, hacia_id) )</code></pre>
<p>Cuando añadimos la clausula <code>UNIQUE</code> a nuestras tablas, estamos comunicando un conjunto de reglas que vamos a exigir a la base de datos que se cumplan cuando se intenten insertar registros. Estamos creando esas reglas porque le convienen a nuestro programa, como veremos dentro de un momento. Ambas reglas impiden que se cometan errores y hacen más sencillo escribir parte de nuestro código.</p>
<p>En esencia, al crear esta tabla <code>Seguimientos</code> estamos modelando una “relación”, en la cual una persona “sigue” a otra y se representa con un par de números que indican que (a) ambas personas están conectadas y (b) la dirección de la relación.</p>
<figure>
<img src="figs2/twitter.svg" alt="" /><figcaption>Relaciones Entre Tablas</figcaption>
</figure>
<h2 id="programación-con-múltiples-tablas">Programación con múltiples tablas</h2>
<p>Ahora vamos a rehacer de nuevo el programa araña de Twitter usando dos tablas, las claves primarias, y las claves de referencia, como hemos descrito antes. He aquí el código de la nueva versión del programa:</p>
<pre class="python"><code>import urllib.request, urllib.parse, urllib.error
import twurl
import json
import sqlite3
import ssl

TWITTER_URL = &#39;https://api.twitter.com/1.1/friends/list.json&#39;

conn = sqlite3.connect(&#39;amigos.sqlite&#39;)
cur = conn.cursor()

cur.execute(&#39;&#39;&#39;CREATE TABLE IF NOT EXISTS Personas
            (id INTEGER PRIMARY KEY, nombre TEXT UNIQUE, recuperado INTEGER)&#39;&#39;&#39;)
cur.execute(&#39;&#39;&#39;CREATE TABLE IF NOT EXISTS Seguimientos
            (desde_id INTEGER, hacia_id INTEGER, UNIQUE(desde_id, hacia_id))&#39;&#39;&#39;)

# Ignore SSL certificate errors
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

while True:
    cuenta = input(&#39;Ingresa una cuenta de Twitter, o salir: &#39;)
    if (cuenta == &#39;salir&#39;): break
    if (len(cuenta) &lt; 1):
        cur.execute(&#39;SELECT id, nombre FROM Personas WHERE recuperado=0 LIMIT 1&#39;)
        try:
            (id, cuenta) = cur.fetchone()
        except:
            print(&#39;No se han encontrado cuentas de Twitter sin recuperar&#39;)
            continue
    else:
        cur.execute(&#39;SELECT id FROM Personas WHERE nombre = ? LIMIT 1&#39;,
                    (cuenta, ))
        try:
            id = cur.fetchone()[0]
        except:
            cur.execute(&#39;&#39;&#39;INSERT OR IGNORE INTO Personas
                        (nombre, recuperado) VALUES (?, 0)&#39;&#39;&#39;, (cuenta, ))
            conn.commit()
            if cur.rowcount != 1:
                print(&#39;Error insertando cuenta:&#39;, cuenta)
                continue
            id = cur.lastrowid

    url = twurl.aumentar(TWITTER_URL, {&#39;screen_name&#39;: cuenta, &#39;count&#39;: &#39;100&#39;})
    print(&#39;Recuperando cuenta&#39;, cuenta)
    try:
        conexion = urllib.request.urlopen(url, context=ctx)
    except Exception as err:
        print(&#39;Fallo al recuperar&#39;, err)
        break

    datos = conexion.read().decode()
    cabeceras = dict(conexion.getheaders())

    print(&#39;Restantes&#39;, cabeceras[&#39;x-rate-limit-remaining&#39;])

    try:
        js = json.loads(datos)
    except:
        print(&#39;Fallo al analizar json&#39;)
        print(datos)
        break

    # Depuración
    # print(json.dumps(js, indent=4))

    if &#39;users&#39; not in js:
        print(&#39;JSON incorrecto recibido&#39;)
        print(json.dumps(js, indent=4))
        continue

    cur.execute(&#39;UPDATE Personas SET recuperado=1 WHERE nombre = ?&#39;, (cuenta, ))

    contnuevas = 0
    contantiguas = 0
    for u in js[&#39;users&#39;]:
        amigo = u[&#39;screen_name&#39;]
        print(amigo)
        cur.execute(&#39;SELECT id FROM Personas WHERE nombre = ? LIMIT 1&#39;,
                    (amigo, ))
        try:
            amigo_id = cur.fetchone()[0]
            contantiguas = contantiguas + 1
        except:
            cur.execute(&#39;&#39;&#39;INSERT OR IGNORE INTO Personas (nombre, recuperado)
                        VALUES (?, 0)&#39;&#39;&#39;, (amigo, ))
            conn.commit()
            if cur.rowcount != 1:
                print(&#39;Error inserting account:&#39;, amigo)
                continue
            amigo_id = cur.lastrowid
            contnuevas = contnuevas + 1
        cur.execute(&#39;&#39;&#39;INSERT OR IGNORE INTO Seguimientos (desde_id, hacia_id)
                    VALUES (?, ?)&#39;&#39;&#39;, (id, amigo_id))
    print(&#39;Cuentas nuevas=&#39;, contnuevas, &#39; ya visitadas=&#39;, contantiguas)
    print(&#39;Restantes&#39;, cabeceras[&#39;x-rate-limit-remaining&#39;])
    conn.commit()
cur.close()

# Code: http://www.py4e.com/code3/twfriends.py</code></pre>
<p>Este programa empieza a resultar un poco complicado, pero ilustra los patrones de diseño que debemos usar cuando utilizamos claves de enteros para enlazar tablas. Esos patrones básicos son:</p>
<ol type="1">
<li><p>Crear tablas con claves primarias y restricciones.</p></li>
<li><p>Cuando tenemos una clave lógica para una persona (es decir, un nombre de cuenta) y necesitamos el valor del <code>id</code> de esa persona, dependiento de si esa persona ya está en la tabla <code>Personas</code> o no, tendremos que: (1) buscar la persona en la tabla <code>Personas</code> y recuperar el valor de <code>id</code> para esa persona, o (2) añadir la persona a la tabla <code>Personas</code> y obtener el valor del <code>id</code> para la fila recién añadida.</p></li>
<li><p>Insertar la fila que indica la relación de “seguimiento”.</p></li>
</ol>
<p>Vamos a explicar todos los puntos de uno en uno.</p>
<h3 id="restricciones-en-tablas-de-bases-de-datos">Restricciones en tablas de bases de datos</h3>
<p>Conforme diseñamos la estructura de la tabla, podemos indicar al sistema de la base de datos que queremos aplicar algunas reglas. Estas reglas nos ayudarán a evitar errores y a introducir correctamente los datos en las tablas. Cuando creamos nuestras tablas:</p>
<pre class="python"><code>cur.execute(&#39;&#39;&#39;CREATE TABLE IF NOT EXISTS Personas
    (id INTEGER PRIMARY KEY, nombre TEXT UNIQUE, recuperado INTEGER)&#39;&#39;&#39;)
cur.execute(&#39;&#39;&#39;CREATE TABLE IF NOT EXISTS Seguimientos
    (desde_id INTEGER, hacia_id INTEGER, UNIQUE(desde_id, hacia_id))&#39;&#39;&#39;)</code></pre>
<p>Estamos indicando que la columna <code>nombre</code> de la tabla <code>Personas</code> debe ser <code>UNIQUE</code> (única). Además indicamos que la combinación de los dos números de cada fila de la tabla <code>Seguimientos</code> debe ser también única. Estas restricciones evitan que cometamos errores como añadir la misma relación entre las mismas personas más de una vez.</p>
<p>Después, podemos aprovechar estas restricciones en el código siguiente:</p>
<pre class="python"><code>cur.execute(&#39;&#39;&#39;INSERT OR IGNORE INTO Personas (nombre, recuperado)
    VALUES ( ?, 0)&#39;&#39;&#39;, ( amigo, ) )</code></pre>
<p>Aquí añadimos la clausula <code>OR IGNORE</code> en la sentencia <code>INSERT</code> para indicar que si este <code>INSERT</code> en particular causara una violación de la regla “el <code>nombre</code> debe ser único”, el sistema de la base de datos está autorizado a ignorar el <code>INSERT</code>. De esta forma, estamos usando las restricciones de la base de datos como una red de seguridad para asegurarnos de que no hacemos algo incorrecto sin darnos cuenta.</p>
<p>De manera similar, el código siguiente se asegura de que no añadamos exactamente la misma relación de <code>Seguimiento</code> dos veces.</p>
<pre class="python"><code>cur.execute(&#39;&#39;&#39;INSERT OR IGNORE INTO Seguimientos
    (desde_id, hacia_id) VALUES (?, ?)&#39;&#39;&#39;, (id, amigo_id) )</code></pre>
<p>De nuevo, simplemente estamos indicándole a la base de datos que ignore cualquier intento de <code>INSERT</code> si éste viola la restricción de unicidad que hemos especificado para cada fila de <code>Seguimientos</code>.</p>
<h3 id="recuperar-yo-insertar-un-registro">Recuperar y/o insertar un registro</h3>
<p>Cuando pedimos al usuario una cuenta de Twitter, si la cuenta ya existe debemos averiguar el valor de su <code>id</code>. Si la cuenta no existe aún en la tabla <code>Personas</code>, debemos insertar el registro y obtener el valor del <code>id</code> de la fila recién insertada.</p>
<p>Éste es un diseño muy habitual y se utiliza dos veces en el programa anterior. Este código muestra cómo se busca el <code>id</code> de la cuenta de un amigo, una vez extraído su <code>screen_name</code> desde un nodo de <code>usuario</code> del JSON recuperado desde Twitter.</p>
<p>Dado que con el tiempo será cada vez más probable que la cuenta ya figure en la base de datos, primero comprobaremos si el registro existe en <code>Personas</code>, usando una sentencia <code>SELECT</code>.</p>
<p>Si todo sale bien<a href="#fn2" class="footnote-ref" id="fnref2" role="doc-noteref"><sup>2</sup></a> dentro de la sección <code>try</code> recuperaremos el registro mediante <code>fetchone()</code> y luego extraeremos el primer (y único) elemento de la tupla devuelta, que almacenaremos en <code>amigo_id</code>.</p>
<p>Si el <code>SELECT</code> falla, el código <code>fetchone()[0]</code> también fallará, y el control será transferido a la sección <code>except</code>.</p>
<pre class="python"><code>    amigo = u[&#39;screen_name&#39;]
    cur.execute(&#39;SELECT id FROM Personas WHERE nombre = ? LIMIT 1&#39;,
        (amigo, ) )
    try:
        amigo_id = cur.fetchone()[0]
        contantiguas = contantiguas + 1
    except:
        cur.execute(&#39;&#39;&#39;INSERT OR IGNORE INTO Personas (nombre, recuperado)
            VALUES ( ?, 0)&#39;&#39;&#39;, ( amigo, ) )
        conn.commit()
        if cur.rowcount != 1 :
            print(&#39;Error al insertar cuenta:&#39;,amigo)
            continue
        amigo_id = cur.lastrowid
        contnuevas = contnuevas + 1</code></pre>
<p>Si terminamos en el código del <code>except</code>, eso sólo significa que la fila no se ha encontrado en la table, de modo que debemos insertarla. Usamos <code>INSERT OR IGNORE</code> para evitar posibles errores, y luego llamamos a <code>commit()</code> para forzar a la base de datos a que se actualice de verdad. Después de que se ha realizado la escritura, podemos comprobar el valor de <code>cur.rowcount</code>, para saber cuántas filas se han visto afectadas. Como estamos intentando insertar una única fila, si el número de filas afectadas es distinto de 1, se habría producido un error.</p>
<p>Si el <code>INSERT</code> tiene éxito, podemos usar <code>cur.lastrowid</code> para averiguar el valor que la base de datos ha asignado a la columna <code>id</code> en nuestra fila recién creada.</p>
<h3 id="almacenar-las-relaciones-entre-amigos">Almacenar las relaciones entre amigos</h3>
<p>Una vez que sabemos el valor de la clave tanto para el usuario de Twitter como para el amigo que hemos extraído del JSON, resulta sencillo insertar ambos números en la tabla de <code>Seguimientos</code> con el código siguiente:</p>
<pre class="python"><code>cur.execute(&#39;INSERT OR IGNORE INTO Seguimientos (desde_id, hacia_id) VALUES (?, ?)&#39;,
    (id, amigo_id) )</code></pre>
<p>Nota que dejamos que sea la base de datos quien se ocupe de evitar la “inserción duplicada” de una relación, mediante la creación de una tabla con una restricción de unicidad, de modo que luego en nuestra sentencia <code>INSERT</code> tan sólo añadimos <code>o ignoramos</code>.</p>
<p>Aquí está un ejemplo de la ejecución de este programa:</p>
<pre><code>Ingresa una cuenta de Twitter, o salir:
No se han encontrado cuentas de Twitter sin recuperar
Ingresa una cuenta de Twitter, o salir: drchuck
Recuperando http://api.twitter.com/1.1/friends ...
Cuentas nuevas= 20  ya visitadas= 0
Ingresa una cuenta de Twitter, o salir:
Recuperando http://api.twitter.com/1.1/friends ...
Cuentas nuevas= 17  ya visitadas= 3
Ingresa una cuenta de Twitter, o salir:
Recuperando http://api.twitter.com/1.1/friends ...
Cuentas nuevas= 17  ya visitadas= 3
Ingresa una cuenta de Twitter, o salir: salir</code></pre>
<p>Comenzamos con la cuenta de <code>drchuck</code> y luego dejamos que el programa escoja de forma automática las siguientes dos cuentas para recuperar y añadir a nuestra base de datos.</p>
<p>Las siguientes son las primeras filas de las tablas <code>Personas</code> y <code>Seguimientos</code> después de terminar la ejecución anterior:</p>
<pre><code>Personas:
(1, &#39;drchuck&#39;, 1)
(2, &#39;opencontent&#39;, 1)
(3, &#39;lhawthorn&#39;, 1)
(4, &#39;steve_coppin&#39;, 0)
(5, &#39;davidkocher&#39;, 0)
55 filas.
Seguimientos:
(1, 2)
(1, 3)
(1, 4)
(1, 5)
(1, 6)
60 filas.</code></pre>
<p>Puedes ver los campos <code>id</code>, <code>nombre</code>, <code>visitado</code> de la tabla <code>Personas</code>, y también los números de ambos extremos de la relación en la tabla <code>Seguimientos</code>. En la tabla <code>Personas</code>, vemos que las primeras tres personas ya han sido visitadas y que sus datos han sido recuperados. Los datos de la tabla <code>Seguidores</code> indican que <code>drchuck</code> (usuario 1) es amigo de todas las personas que se muestran en las primeras cinco filas. Esto tiene sentido, ya que los primeros datos que recuperamos y almacenamos fueron los amigos de Twitter de <code>drchuck</code>. Si imprimieras más filas de la tabla <code>Seguimientos</code> verías también los amigos de los usuarios 2 y 3.</p>
<h2 id="tres-tipos-de-claves">Tres tipos de claves</h2>
<p>Ahora que hemos empezado a construir un modelo de datos, colocando nuestros datos en múltiples tablas enlazadas, y hemos enlazado las filas de esas tablas usando <em>claves</em>, debemos fijarnos en cierta terminología acerca de esas claves. Generalmente, en un modelo de base de datos hay tres tipos de claves que se pueden usar.</p>
<ul>
<li><p>Una <em>clave lógica</em> es una clave que se podría usar en el “mundo real” para localizar una fila. En nuestro ejemplo de modelado de datos, el campo <code>nombre</code> es una clave lógica. Es el nombre que se muestra en pantalla para el usuario y, en efecto, usamos el campo <code>nombre</code> varias veces en el programa para localizar la fila correspondiente a un usuario. Comprobarás que a menudo tiene sentido añadir una restricción <code>UNIQUE (única)</code> a una clave lógica. Como las claves lógicas son las que usamos para buscar una fila desde el mundo exterior, tendría poco sentido permitir que hubiera múltiples filas con el mismo valor en la tabla.</p></li>
<li><p>Una <em>clave primaria</em> es normalmente un número que es asignado automáticamente por la base de datos. En general no tiene ningún significado fuera del programa y sólo se utiliza para enlazar entre sí filas de tablas diferentes. Cuando queremos buscar una fila en una tabla, realizar la búsqueda usando la clave primaria es, normalmente, el modo más rápido de localizarla. Como las claves primarias son números enteros, necesitan muy poco espacio de almacenamiento y pueden ser comparadas y ordenadas muy rápido. En nuestro modelo de datos, el campo <code>id</code> es un ejemplo de una clave primaria.</p></li>
<li><p>Una <em>clave foránea</em> (foreign key) es normalmente un número que apunta a la clave primaria de una fila asociada en una tabla diferente. Un ejemplo de una clave foránea en nuestro modelo de datos es la columna <code>desde_id</code>.</p></li>
</ul>
<p>Estamos usando como convención para los nombres el darle siempre al campo de clave primaria el nombre <code>id</code> y añadir el sufijo <code>_id</code> a cualquier nombre de campo que sea una clave foránea.</p>
<h2 id="uso-de-join-para-recuperar-datos">Uso de JOIN para recuperar datos</h2>
<p>Ahora que hemos cumplido con las reglas de la normalización de bases de datos y hemos separado los datos en dos tablas, enlazándolas entre sí usando claves primarias y foráneas, necesitaremos ser capaces de construir un <code>SELECT</code> que vuelva a juntar los datos esparcidos por las tablas.</p>
<p>SQL usa la clausula <code>JOIN</code> para volver a conectar esas tablas. En la clausula <code>JOIN</code> se especifican los campos que se utilizan para reconectar las filas entre las distintas tablas.</p>
<p>A continuación se muestra un ejemplo de un <code>SELECT</code> con una clausula <code>JOIN</code>:</p>
<pre class="sql"><code>SELECT * FROM Seguimientos JOIN Personas
    ON Seguimientos.desde_id = Personas.id WHERE Personas.id = 1</code></pre>
<p>La clausula <code>JOIN</code> indica que los campos que estamos seleccionando mezclan las tablas <code>Seguimientos</code> y <code>Personas</code>. La clausula <code>ON</code> indica cómo deben ser unidas las dos tablas: Toma cada fila de <code>Seguimientos</code> y añade una fila de <code>Personas</code> en la cual el campo <code>desde_id</code> en <code>Seguimientos</code> coincide con el valor <code>id</code> en la tabla <code>Personas</code>.</p>
<figure>
<img src="figs2/join.svg" alt="" /><figcaption>Conexión de Tablas Usando JOIN</figcaption>
</figure>
<p>El resultado del JOIN consiste en la creación de una “meta-fila” extra larga, que contendrá tanto los campos de <code>Personas</code> como los campos de la fila de <code>Seguimientos</code> que cumplan la condición. Cuando hay más de una coincidencia entre el campo <code>id</code> de <code>Personas</code> y el <code>desde_id</code> de <code>Seguimientos</code>, JOIN creará una meta-fila para <em>cada una</em> de las parejas de filas que coincidan, duplicando los datos si es necesario.</p>
<p>El código siguiente muestra los datos que tendremos en la base de datos después de que el programa multi-tabla araña de Twitter anterior haya sido ejecutado varias veces.</p>
<pre class="python"><code>import sqlite3

conn = sqlite3.connect(&#39;amigos.sqlite&#39;)
cur = conn.cursor()

cur.execute(&#39;SELECT * FROM Personas&#39;)
contador = 0
print(&#39;Personas:&#39;)
for fila in cur:
    if contador &lt; 5: print(fila)
    contador = contador + 1
print(contador, &#39;filas.&#39;)

cur.execute(&#39;SELECT * FROM Seguimientos&#39;)
contador = 0
print(&#39;Seguimientos:&#39;)
for fila in cur:
    if contador &lt; 5: print(fila)
    contador = contador + 1
print(contador, &#39;filas.&#39;)

cur.execute(&#39;&#39;&#39;SELECT * FROM Seguimientos JOIN Personas
            ON Seguimientos.hacia_id = Personas.id
            WHERE Seguimientos.desde_id = 2&#39;&#39;&#39;)
contador = 0
print(&#39;Conexiones para id=2:&#39;)
for fila in cur:
    if contador &lt; 5: print(fila)
    contador = contador + 1
print(contador, &#39;filas.&#39;)

cur.close()

# Code: http://www.py4e.com/code3/twjoin.py</code></pre>
<p>En este programa, en primer lugar volcamos el contenido de las tablas <code>Personas</code> y <code>Seguimientos</code> y a continuación mostramos un subconjunto de datos de las tablas unidas entre sí.</p>
<p>Aquí tenemos la salida del programa:</p>
<pre><code>python twjoin.py
Personas:
(1, &#39;drchuck&#39;, 1)
(2, &#39;opencontent&#39;, 1)
(3, &#39;lhawthorn&#39;, 1)
(4, &#39;steve_coppin&#39;, 0)
(5, &#39;davidkocher&#39;, 0)
55 filas.
Seguimientos:
(1, 2)
(1, 3)
(1, 4)
(1, 5)
(1, 6)
60 filas.
Conexiones para id=2:
(2, 1, 1, &#39;drchuck&#39;, 1)
(2, 28, 28, &#39;cnxorg&#39;, 0)
(2, 30, 30, &#39;kthanos&#39;, 0)
(2, 102, 102, &#39;SomethingGirl&#39;, 0)
(2, 103, 103, &#39;ja_Pac&#39;, 0)
20 filas.</code></pre>
<p>Se pueden ver las columnas de las tablas <code>Personas</code> y <code>Seguimientos</code>, seguidos del último conjunto de filas, que es el resultado del <code>SELECT</code> con la clausula <code>JOIN</code>.</p>
<p>En el último select, buscamos las cuentas que sean amigas de “opencontent” (es decir, de <code>Personas.id=2</code>).</p>
<p>En cada una de las “meta-filas” del último select, las primeras dos columnas pertenecen a la tabla <code>Seguimientos</code>, mientras que las columnas tres a cinco pertenecen a la tabla <code>Personas</code>. Se puede observar también cómo la segunda columna (<code>Seguimientos.hacia_id</code>) coincide con la tercera (<code>Personas.id</code>) en cada una de las “meta-filas” unidas.</p>
<h2 id="resumen">Resumen</h2>
<p>En este capítulo se han tratado un montón de temas para darte una visión de de lo necesario para utilizar una base de datos en Python. Es más complicado escribir el código para usar una base de datos que almacene los datos que utilizar diccionarios de Python o archivos planos, de modo que existen pocas razones para usar una base de datos, a menos que tu aplicación necesite de verdad las capacidades que proporciona. Las situaciones en las cuales una base de datos pueden resultar bastante útil son: (1) cuanto tu aplicación necesita realizar muchos cambios pequeños de forma aleatoria en un conjunto de datos grandes, (2) cuando tienes tantos datos que no caben en un diccionario y necesitas localizar información con frecuencia, o (3) cuando tienes un proceso que va a funcionar durante mucho tiempo, y necesitas poder detenerlo y volverlo a poner en marcha, conservando los datos entre ejecuciones.</p>
<p>Una base de datos con una simple tabla puede resultar suficiente para cubrir las necesidades de muchas aplicaciones, pero la mayoría de los problemas necesitarán varias tablas y enlaces/relaciones entre filas de tablas diferentes. Cuando empieces a crear enlaces entre tablas, es importante realizar un diseño meditado y seguir las reglas de normalización de bases de datos, para conseguir el mejor uso de sus capacidades. Como la motivación principal para usar una base de datos suele ser el tener grandes cantidades de datos con las que tratar, resulta importante modelar los datos de forma eficiente, para que tu programa funcione tan rápidamente como sea posible.</p>
<h2 id="depuración">Depuración</h2>
<p>Un planteamiento habitual, cuando se está desarrollando un programa en Python que conecta con una base de datos SQLite, será ejecutar primero el programa y revisar luego los resultados usando el navegador de bases de datos de SQLite (Database Browser for SQLite). El navegador te permite revisar cuidadosamente los datos, para comprobar si tu programa está funcionando correctamente.</p>
<p>Debes tener cuidado, ya que SQLite se encarga de evitar que dos programas puedan cambiar los mismos datos a la vez. Por ejemplo, si abres una base de datos en el navegador y realizas un cambio en la base de datos, pero no has pulsado aún el botón “guardar” del navegador, éste “bloqueará” el archivo de la base de datos y evitará que cualquier otro programa acceda a dicho fichero. Concretamente, en ese caso tu programa de Python no será capaz de acceder al archivo, ya que éste se encontrará bloqueado.</p>
<p>De modo que la solución pasa por asegurarse de cerrar la ventana del navegador de la base de datos, o bien usar el menú <em>Archivo</em> para cerrar la base de datos abierta en el navegador antes de intentar acceder a ella desde Python, para evitar encontrarse con el problema de que el código de Python falle debido a que la base de datos está bloqueada.</p>
<h2 id="glosario">Glosario</h2>
<dl>
<dt>atributo</dt>
<dd>Uno de los valores dentro de una tupla. Más comúnmente llamada “columa” o “campo”.
</dd>
<dt>cursor</dt>
<dd>Un cursor permite ejecutar comandos SQL en una base de datos y recuperar los datos de ella. Un cursor es similar a un socket en conexiones de red o a un manejar de archivos.
</dd>
<dt>clave foránea</dt>
<dd>Una clave numérica que apunta a la clave primaria de una fila en otra tabla. Las claves foráneas establecen relaciones entre filas almacenadas en tablas diferentes.
</dd>
<dt>clave lógica</dt>
<dd>Una clave que el “mundo exterior” utiliza para localizar una fila concreta. Por ejemplo, en una tabla de cuentas de usuario, la dirección de e-mail de una persona sería un buen candidato a utilizar como clave lógica para los datos de ese usuario.
</dd>
<dt>clave primaria</dt>
<dd>Una clave numérica asignada a cada fila, que es utilizada para referirnos a esa fila concreta de esa tabla desde otra tabla distinta. A menudo la base de datos se configura para asignar las claves primarias de forma automática, según se van insertando filas.
</dd>
<dt>índice</dt>
<dd>Datos adicionales que el software de la base de datos mantiene como filas e inserta en una tabla para conseguir que las búsquedas sean muy rápidas.
</dd>
<dt>navegador de base de datos</dt>
<dd>Un programa que permite conectar directamente con una base de datos y manipularla, sin tener que escribir código para ello.
</dd>
<dt>normalización</dt>
<dd>Diseño de un modelado de datos de forma que no haya datos duplicados. Se almacena cada elemento de los datos en un lugar concreto de la base de datos y se referencia desde otros sitios usando una clave foránea.
</dd>
<dt>relación</dt>
<dd>Un área dentro de una base de datos que contiene tuplas y atributos. Se le conoce más habitualmente como “tabla”.
</dd>
<dt>restricción</dt>
<dd>Cuando le pedimos a una base de datos que imponga una regla a un campo de una fila en una tabla. Una restricción habitual consiste en especificar que no pueda haber valores repetidos en un campo concreto (es decir, que todos los valores deban ser únicos).
</dd>
<dt>tupla</dt>
<dd>Una entrada única en una base de datos, que es un conjunto de atributos. Se le conoce más habitualmente como “fila”.
</dd>
</dl>
<section class="footnotes" role="doc-endnotes">
<hr />
<ol>
<li id="fn1" role="doc-endnote"><p>SQLite en realidad permite cierta flexibilidad respecto al tipo de dato que se almacena en cada columna, pero en este capítulo nosotros vamos a mantener los tipos de datos estrictos, para que los conceptos que aprendamos puedan ser igualmente aplicados a otras bases de datos como MySQL.<a href="#fnref1" class="footnote-back" role="doc-backlink">↩︎</a></p></li>
<li id="fn2" role="doc-endnote"><p>En general, cuando una frase empieza por “si todo va bien”, es porque el código del que se habla necesita utilizar try/except.<a href="#fnref2" class="footnote-back" role="doc-backlink">↩︎</a></p></li>
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
