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
<h1 id="expresiones-regulares">Expresiones regulares</h1>
<p>Hasta ahora hemos leído archivos, buscando patrones y extrayendo varias secciones de líneas que hemos encontrado interesantes. Hemos usado métodos de cadenas como <code>split</code> y <code>find</code>, así como rebanado de listas y cadenas para extraer trozos de las líneas.</p>
<p>  </p>
<p>Esta tarea de buscar y extraer es tan común que Python tiene una librería muy poderosa llamada <em>expresiones regulares</em> que maneja varias de estas tareas de manera bastante elegante. La razón por la que no presentamos las expresiones regulares antes se debe a que, aunque son muy poderosas, son un poco más complicadas y toma algo de tiempo acostumbrarse a su sintaxis.</p>
<p>Las expresiones regulares casi son su propio lenguaje de programación en miniatura para buscar y analizar cadenas. De hecho, se han escrito libros enteros sobre las expresiones regulares. En este capítulo, solo cubriremos los aspectos básicos de las expresiones regulares. Para más información al respecto, recomendamos ver:</p>
<p><a href="https://es.wikipedia.org/wiki/Expresi%C3%B3n_regular" class="uri">https://es.wikipedia.org/wiki/Expresi%C3%B3n_regular</a></p>
<p><a href="https://docs.python.org/library/re.html" class="uri">https://docs.python.org/library/re.html</a></p>
<p>Se debe importar la librería de expresiones regulares <code>re</code> a tu programa antes de que puedas usarlas. La forma más simple de usar la librería de expresiones regulares es la función <code>search()</code> (N. del T.: “search” significa búsqueda). El siguiente programa demuestra una forma muy sencilla de usar esta función.</p>
<p></p>
<pre class="python"><code># Búsqueda de líneas que contengan &#39;From&#39;
import re
man = open(&#39;mbox-short.txt&#39;)
for linea in man:
    linea = linea.rstrip()
    if re.search(&#39;From:&#39;, linea):
        print(linea)

# Code: http://www.py4e.com/code3/re01.py</code></pre>
<p>Abrimos el archivo, revisamos cada línea, y usamos la expresión regular <code>search()</code> para imprimir solo las líneas que contengan la cadena “From”. Este programa no toma ventaja del auténtico poder de las expresiones regulares, ya que podríamos simplemente haber usado <code>line.find()</code> para lograr el mismo resultado.</p>
<p></p>
<p>El poder de las expresiones regulares se manifiesta cuando agregamos caracteres especiales a la cadena de búsqueda que nos permite controlar de manera más precisa qué líneas calzan con la cadena. Agregar estos caracteres especiales a nuestra expresión regular nos permitirá buscar coincidencias y extraer datos usando unas pocas líneas de código.</p>
<p>Por ejemplo, el signo de intercalación (N. del T.: “caret” en inglés, corresponde al signo ^) se utiliza en expresiones regulares para encontrar “el comienzo” de una lína. Podríamos cambiar nuestro programa para que solo retorne líneas en que tengan “From:” al comienzo, de la siguiente manera:</p>
<pre class="python"><code># Búsqueda de líneas que contengan &#39;From&#39;
import re
man = open(&#39;mbox-short.txt&#39;)
for linea in man:
    linea = linea.rstrip()
    if re.search(&#39;^From:&#39;, linea):
        print(linea)

# Code: http://www.py4e.com/code3/re02.py</code></pre>
<p>Ahora solo retornará líneas que <em>comiencen con</em> la cadena “From:”. Este sigue siendo un ejemplo muy sencillo que podríamos haber implementado usando el método <code>startswith()</code> de la librería de cadenas. Pero sirve para presentar la idea de que las expresiones regulares contienen caracteres especiales que nos dan mayor control sobre qué coincidencias retornará la expresión regular.</p>
<p></p>
<h2 id="coincidencia-de-caracteres-en-expresiones-regulares">Coincidencia de caracteres en expresiones regulares</h2>
<p>Existen varios caracteres especiales que nos permiten construir expresiones regulares incluso más poderosas. El más común es el punto, que coincide con cualquier carácter.</p>
<p> </p>
<p>En el siguiente ejemplo, la expresión regular <code>F..m:</code> coincidiría con las cadenas “From:”, “Fxxm:”, “F12m:”, o “F!<span class="citation" data-cites="m">@m</span>:”, ya que los caracteres de punto en la expresión regular coinciden con cualquier carácter.</p>
<pre class="python"><code># # Búsqueda de líneas que comiencen con &#39;F&#39;, seguidas de
# 2 caracteres, seguidos de &#39;m:&#39;
import re
man = open(&#39;mbox-short.txt&#39;)
for linea in man:
    linea = linea.rstrip()
    if re.search(&#39;^F..m:&#39;, linea):
        print(linea)

# Code: http://www.py4e.com/code3/re03.py</code></pre>
<p>Esto resulta particularmente poderoso cuando se le combina con la habilidad de indicar que un carácter puede repetirse cualquier cantidad de veces usando los caracteres <code>*</code> o <code>+</code> en tu expresión regular. Estos caracteres especiales indican que en lugar de coincidir con un solo carácter en la cadena de búsqueda, coinciden con cero o más caracteres (en el caso del asterisco) o con uno o más caracteres (en el caso del signo de suma).</p>
<p>Podemos reducir más las líneas que coincidan usando un carácter <em>comodín</em> en el siguiente ejemplo:</p>
<pre class="python"><code># Búsqueda de líneas que comienzan con From y tienen una arroba
import re
man = open(&#39;mbox-short.txt&#39;)
for linea in man:
    linea = linea.rstrip()
    if re.search(&#39;^From:.+@&#39;, linea):
        print(linea)

# Code: http://www.py4e.com/code3/re04.py</code></pre>
<p>La cadena <code>^From:.+@</code> retornará coincidencias con líneas que empiecen con “From:”, seguidas de uno o más caracteres (<code>.+</code>), seguidas de un carácter @. Por lo tanto, la siguiente línea coincidirá:</p>
<pre><code>From: stephen.marquard@uct.ac.za</code></pre>
<p>Puede considerarse que el comodín <code>.+</code> se expande para abarcar todos los caracteres entre los signos : y @.</p>
<pre><code>From:.+@</code></pre>
<p>Conviene considerar que los signos de suma y los asteriscos “empujan”. Por ejemplo, la siguiente cadena marcaría una coincidencia con el último signo @, ya que el <code>.+</code> “empujan” hacia afuera, como se muestra a continuación:</p>
<pre><code>From: stephen.marquard@uct.ac.za, csev@umich.edu, and cwen @iupui.edu</code></pre>
<p>Es posible indicar a un asterisco o signo de suma que no debe ser tan “ambicioso” agregando otro carácter. Revisa la documentación para obtener información sobre cómo desactivar este comportamiento ambicioso.</p>
<p></p>
<h2 id="extrayendo-datos-usando-expresiones-regulares">Extrayendo datos usando expresiones regulares</h2>
<p>Si queremos extraer datos de una cadena en Python podemos usar el método <code>findall()</code> para extraer todas las subcadenas que coincidan con una expresión regular. Usemos el ejemplo de querer extraer cualquier secuencia que parezca una dirección email en cualquier línea, sin importar su formato. Por ejemplo, queremos extraer la dirección email de cada una de las siguientes líneas:</p>
<pre><code>From stephen.marquard@uct.ac.za Sat Jan  5 09:14:16 2008
Return-Path: &lt;postmaster@collab.sakaiproject.org&gt;
          for &lt;source@collab.sakaiproject.org&gt;;
Received: (from apache@localhost)
Author: stephen.marquard@uct.ac.za</code></pre>
<p>No queremos escribir código para cada tipo de líneas, dividiendo y rebanando de manera distinta en cada una. El siguiente programa usa <code>findall()</code> para encontrar las líneas que contienen direcciones de email y extraer una o más direcciones de cada línea.</p>
<p> </p>
<pre class="python"><code>import re
s = &#39;Un mensaje de csev@umich.edu para cwen@iupui.edu acerca de una junta @2PM&#39;
lst = re.findall(r&#39;\S+@\S+&#39;, s)
print(lst)

# Code: http://www.py4e.com/code3/re05.py</code></pre>
<p>El método <code>findall()</code> busca en la cadena en el segundo argumento y retorna una lista de todas las cadenas que parecen ser direcciones de email. Estamos usando una secuencia de dos caracteres que coincide con un carácter distinto a un espacio en blanco (<code>\S</code>).</p>
<p>El resultado de la ejecución del programa debiera ser:</p>
<pre><code>[&#39;csev@umich.edu&#39;, &#39;cwen@iupui.edu&#39;]</code></pre>
<p>Traduciendo la expresión regular al castellano, estamos buscando subcadenas que tengan al menos un carácter que no sea un espacio, seguido de una @, seguido de al menos un carácter que no sea un espacio. La expresión <code>\S+</code> coincidirá con cuantos caracteres distintos de un espacio sea posible.</p>
<p>La expresión regular retornaría dos coincidencias (csev@umich.edu y cwen@iupui.edu), pero no coincidiría con la cadena “<span class="citation" data-cites="2PM">@2PM</span>” porque no hay caracteres que no sean espacios en blanco <em>antes</em> del signo @. Podemos usar esta expresión regular en un programa para leer todas las líneas en un archivo e imprimir cualquier subcadena que pudiera ser una dirección de email de la siguiente manera:</p>
<pre class="python"><code># Búsqueda de líneas que tengan una arroba entre caracteres
import re
man = open(&#39;mbox-short.txt&#39;)
for linea in man:
    linea = linea.rstrip()
    x = re.findall(r&#39;\S+@\S+&#39;, linea)
    if len(x) &gt; 0:
        print(x)

# Code: http://www.py4e.com/code3/re06.py</code></pre>
<p>Con esto, leemos cada línea y luego extraemos las subcadenas que coincidan con nuestra expresión regular. Dado que <code>findall()</code> retorna una lista, simplemente revisamos si el número de elementos en ésta es mayor a cero e imprimir solo líneas donde encontramos al menos una subcadena que pudiera ser una dirección de email.</p>
<p>Si ejecutamos el programa en <em>mbox.txt</em> obtendremos el siguiente resultado:</p>
<pre><code>[&#39;wagnermr@iupui.edu&#39;]
[&#39;cwen@iupui.edu&#39;]
[&#39;&lt;postmaster@collab.sakaiproject.org&gt;&#39;]
[&#39;&lt;200801032122.m03LMFo4005148@nakamura.uits.iupui.edu&gt;&#39;]
[&#39;&lt;source@collab.sakaiproject.org&gt;;&#39;]
[&#39;&lt;source@collab.sakaiproject.org&gt;;&#39;]
[&#39;&lt;source@collab.sakaiproject.org&gt;;&#39;]
[&#39;apache@localhost)&#39;]
[&#39;source@collab.sakaiproject.org;&#39;]</code></pre>
<p>Algunas de las direcciones tienen caracteres incorrectos como “&lt;” o “;” al comienzo o al final. Declaremos que solo estamos interesados en la parte de la cadena que comience y termine con una letra o un número.</p>
<p>Para lograr esto, usamos otra característica de las expresiones regulares. Los corchetes se usan para indicar un conjunto de caracteres que queremos aceptar como coincidencias. La secuencia <code>\S</code> retornará el conjunto de “caracteres que no sean un espacio en blanco”. Ahora seremos un poco más explícitos en cuanto a los caracteres respecto de los cuales buscamos coincidencias.</p>
<p>Esta será nuestra nueva expresión regular:</p>
<pre><code>[a-zA-Z0-9]\S*@\S*[a-zA-Z]</code></pre>
<p>Esto se está complicando un poco; puedes ver por qué decimos que las expresiones regulares son un lenguaje en sí mismas. Traduciendo esta expresión regular, estamos buscando subcadenas que comiencen con <em>una</em> letra minúscula, letra mayúscula, o número “[a-zA-Z0-9]”, seguida de cero o más caracteres que no sean un espacio (<code>\S*</code>), seguidos de un signo @, seguido de cero o más caracteres que no sean espacios en blanco (<code>\S*</code>), seguidos por una letra mayúscula o minúscula. Nótese que hemos cambiado de <code>+</code> a <code>*</code> para indicar cero o más caracteres que no sean espacios, ya que <code>[a-zA-Z0-9]</code> implica un carácter distinto de un espacio. Recuerda que el <code>*</code> o <code>+</code> se aplica al carácter inmediatamente a la izquierda del signo de suma o del asterisco.</p>
<p></p>
<p>Si usamos esta expresión en nuestro programas, nuestros datos quedarán mucho más depurados:</p>
<pre class="python"><code># Búsqueda de líneas que tengan una arroba entre caracteres
# Los caracteres deben ser una letra o un número
import re
man = open(&#39;mbox-short.txt&#39;)
for linea in man:
    linea = linea.rstrip()
    x = re.findall(r&#39;[a-zA-Z0-9]\S+@\S+[a-zA-Z]&#39;, linea)
    if len(x) &gt; 0:
        print(x)

# Code: http://www.py4e.com/code3/re07.py</code></pre>
<pre><code>...
[&#39;wagnermr@iupui.edu&#39;]
[&#39;cwen@iupui.edu&#39;]
[&#39;postmaster@collab.sakaiproject.org&#39;]
[&#39;200801032122.m03LMFo4005148@nakamura.uits.iupui.edu&#39;]
[&#39;source@collab.sakaiproject.org&#39;]
[&#39;source@collab.sakaiproject.org&#39;]
[&#39;source@collab.sakaiproject.org&#39;]
[&#39;apache@localhost&#39;]</code></pre>
<p>Nótese que en las líneas donde aparece <code>source@collab.sakaiproject.org</code>, nuestra expresión regular eliminó dos caracteres al final de la cadena (“&gt;;”). Esto se debe a que, cuando agregamos <code>[a-zA-Z]</code> al final de nuestra expresión regular, estamos determinando que cualquier cadena que la expresión regular encuentre al analizar el texto debe terminar con una letra. Por lo tanto, cuando vea el “&gt;” al final de “sakaiproject.org&gt;;”, simplemente se detiene en el último carácter que haya encontrado que coincida con ese criterio (en este caso, la “g” fue la última coincidencia).</p>
<p>Nótese también que el resultado de la ejecución del programa es una lista de Python que tiene una cadena como su único elemento.</p>
<h2 id="combinando-búsqueda-y-extracción">Combinando búsqueda y extracción</h2>
<p>Si quisiéramos encontrar los números en las líneas que empiecen con la cadena “X-”, como por ejemplo:</p>
<pre><code>X-DSPAM-Confidence: 0.8475
X-DSPAM-Probability: 0.0000</code></pre>
<p>no queremos cualquier número de coma flotante contenidos en cualquier línea. Solo queremos extraer los números de las líneas que tienen la sintaxis ya mencionada.</p>
<p>Podemos construir la siguiente expresión regular para seleccionar las líneas:</p>
<pre><code>^X-.*: [0-9.]+</code></pre>
<p>Traduciendo esto, estamos diciendo que queremos líneas que empiecen con <code>X-</code>, seguido por cero o más caracteres (<code>.*</code>), seguido por un carácter de dos puntos (<code>:</code>) y luego un espacio. Después del espacio, buscamos uno o más caracteres que sean, o bien un dígito (0-9), o bien un punto <code>[0-9.]+</code>. Nótese que al interior de los corchetes el punto efectivamente corresponde a un punto (es decir, no funciona como comodín entre corchetes).</p>
<p>La siguiente es una expresión bastante comprimida que solo retornará las líneas que nos interesan:</p>
<pre class="python"><code># Búsqueda de líneas que comiencen con &#39;X&#39; seguida de cualquier caracter que
# no sea espacio y &#39;:&#39; seguido de un espacio y cualquier número.
# El número incluye decimales.
import re
man = open(&#39;mbox-short.txt&#39;)
for linea in man:
    linea = linea.rstrip()
    if re.search(r&#39;^X\S*: [0-9.]+&#39;, linea):
        print(linea)

# Code: http://www.py4e.com/code3/re10.py</code></pre>
<p>Cuando ejecutamos el programa, vemos que los datos han sido procesados, mostrando solo las líneas que buscamos.</p>
<pre><code>X-DSPAM-Confidence: 0.8475
X-DSPAM-Probability: 0.0000
X-DSPAM-Confidence: 0.6178
X-DSPAM-Probability: 0.0000</code></pre>
<p>Ahora, debemos resolver el problema de extraer los númueros. Aunque sería bastante sencillo usar <code>split</code>, podemos echar mano a otra función de las expresiones regulares para buscar y analizar la línea a la vez.</p>
<p></p>
<p>Los paréntesis son otros caracteres especiales en las expresiones regulares. Al agregar paréntesis a una expresión regular, son ignorados a la hora de hacer coincidir la cadena. Pero cuando se usa <code>findall()</code>, los paréntesis indican que, aunque se quiere que toda la expresión coincida, solo interesa extraer una parte de la subcadena que coincida con la expresión regular.</p>
<p> </p>
<p>Entonces, hacemos los siguientes cambios a nuestro programa:</p>
<pre class="python"><code># Búsqueda de líneas que comiencen con &#39;X&#39; seguida de cualquier caracter que
# no sea espacio en blanco y &#39;:&#39; seguido de un espacio y un número.
# El número puede incluir decimales.
# Después imprimir el número si es mayor a cero.
import re
man = open(&#39;mbox-short.txt&#39;)
for linea in man:
    linea = linea.rstrip()
    x = re.findall(r&#39;^X\S*: ([0-9.]+)&#39;, linea)
    if len(x) &gt; 0:
        print(x)

# Code: http://www.py4e.com/code3/re11.py</code></pre>
<p>En lugar de usar <code>search()</code>, agregamos paréntesis alrededos de la parte de la expresión regular que representa al número de coma flotante para indicar que solo queremos que <code>findall()</code> retorne la parte correspondiente a números de coma flotante de la cadena retornada.</p>
<p>El resultado de este programa es el siguiente:</p>
<pre><code>[&#39;0.8475&#39;]
[&#39;0.0000&#39;]
[&#39;0.6178&#39;]
[&#39;0.0000&#39;]
[&#39;0.6961&#39;]
[&#39;0.0000&#39;]
..</code></pre>
<p>Los números siguen estando en una lista y deben ser convertidos de cadenas a números de coma flotante, pero hemos usado las expresiones regulares para buscar y extraer la información que consideramos interesante.</p>
<p>Otro ejemplo de esta técnica: si revisan este archivo, verán una serie de líneas en el formulario:</p>
<pre><code>Detalles: http://source.sakaiproject.org/viewsvn/?view=rev&amp;rev=39772</code></pre>
<p>Si quisiéramos extraer todos los números de revisión (el número entero al final de esas líneas) usando la misma técnica del ejemplo anterior, podríamos escribir el siguiente programa:</p>
<pre class="python"><code># Búsqueda de líneas que comiencen con &#39;Details: rev=&#39;
# seguido de números y &#39;.&#39;
# Después imprimir el número si es mayor a cero
import re
man = open(&#39;mbox-short.txt&#39;)
for linea in man:
    linea = linea.rstrip()
    x = re.findall(&#39;^Details:.*rev=([0-9.]+)&#39;, linea)
    if len(x) &gt; 0:
        print(x)

# Code: http://www.py4e.com/code3/re12.py</code></pre>
<p>Traducción de la expresión regular: estamos buscando líneas que empiecen con <code>Details:</code>, seguida de cualquier número de caracteres (<code>.*</code>), seguida de <code>rev=</code>, y después de uno o más dígitos. Queremos encontrar líneas que coincidan con toda la expresión pero solo queremos extraer el número entero al final de la línea, por lo que ponemos <code>[0-9]+</code> entre paréntesis.</p>
<p>Al ejecutar el programa, obtenemos el siguiente resultado:</p>
<pre><code>[&#39;39772&#39;]
[&#39;39771&#39;]
[&#39;39770&#39;]
[&#39;39769&#39;]
...</code></pre>
<p>Recuerda que la expresión <code>[0-9]+</code> es “ambiciosa” e intentará formar una cadena de dígitos lo más larga posible antes de extraerlos. Este comportamiento “ambicioso” es la razón por la que obtenemos los cinco dígitos de cada número. La expresiones regular se expande en ambas direcciones hasta que encuentra, o bien un carácter que no sea un dígito, o bien el comienzo o final de una línea.</p>
<p>Ahora podemos usar expresiones regulares para volver a resolver un ejercicio que hicimos antes, en el que nos interesaba la hora de cada email. En su momento, buscamos las líneas:</p>
<pre><code>From stephen.marquard@uct.ac.za Sat Jan  5 09:14:16 2008</code></pre>
<p>con la intención de extraer la hora del día en cada línea. Antes logramos esto haciendo dos llamadas a <code>split</code>. Primero se dividía la línea en palabras y luego tomábamos la quinta palabra y la dividíamos de nuevo en el carácter “:” para obtener los dos caracteres que nos interesaban.</p>
<p>Aunque esta solución funciona, es el resultado de código bastante frágil, que depende de asumir que las líneas tienen el formato adecuado. Si bien puedes agregar chequeos (o un gran bloque de try/except) para asegurarte que el programa no falle al encontrar líneas mal formateadas, esto hará que el programa aumente a 10 o 15 líneas de código, que además serán difíciles de leer.</p>
<p>Podemos lograr el resultado de forma mucho más simple utilizando la siguiente expresión regular:</p>
<pre><code>^From .* [0-9][0-9]:</code></pre>
<p>La traducción de esta expresión regular sería que estamos buscando líneas que empiecen con <code>From</code> (nótese el espacio), seguido de cualquier número de caracteres (<code>.*</code>), seguidos de un espacio en blanco, seguido de dos dígitos <code>[0-9][0-9]</code>, seguidos de un carácter “:”. Esa es la definición de la clase de líneas que buscamos.</p>
<p>Para extraer solo la hora usando <code>findall()</code>, agregamos paréntesis alrededor de los dos dígitos, de la siguiente manera:</p>
<pre><code>^From .* ([0-9][0-9]):</code></pre>
<p>Esto resultará en el siguiente programa:</p>
<pre class="python"><code># Búsqueda de líneas que comienzan con From y un caracter seguido
# de un número de dos dígitos entre 00 y 99 seguido de &#39;:&#39;
# Después imprimir el número si este es mayor a cero
import re
man = open(&#39;mbox-short.txt&#39;)
for linea in man:
    linea = linea.rstrip()
    x = re.findall(&#39;^From .* ([0-9][0-9]):&#39;, linea)
    if len(x) &gt; 0: print(x)

# Code: http://www.py4e.com/code3/re13.py</code></pre>
<p>Al ejecutar el programa, obtendremos el siguiente resultado:</p>
<pre><code>[&#39;09&#39;]
[&#39;18&#39;]
[&#39;16&#39;]
[&#39;15&#39;]
...</code></pre>
<h2 id="escapado-de-caracteres">Escapado de Caracteres</h2>
<p>Dado que en expresiones regulares usamos caracteres especiales para encontrar el comienzo o final de una línea o especificar comodines, necesitamos una forma de indicar que esos caracteres son “normales” y queremos encontrar la coincidencia con el carácter específico, como un “$” o “^”.</p>
<p>Podemos indicar que queremos encontrar la coincidencia con un carácter anteponiéndole una barra invertida. Por ejemplo, podemos encontrar cantidades de dinero utilizando la siguiente expresión regular:</p>
<pre class="python"><code>import re
x = &#39;We just received $10.00 for cookies.&#39;
y = re.findall(&#39;\$[0-9.]+&#39;,x)</code></pre>
<p>Dado que antepusimos la barra invertida al signo “$”, encuentra una coincidencia con el signo en la cadena en lugar de con el final de la línea, y el resto de la expresión regular coincide con uno o más dígitos del carácter “.” <em>Nota:</em> dentro de los corchetes, los caracteres no se consideran “especiales”. Por tanto, al escribir <code>[0-9.]</code>, efectivamente significa dígitos o un punto. Cuando no está entre corchetes, el punto es el carácter “comodín” que coincide con cualquier carácter. Cuando está dentro de corchetes, un punto es un punto.</p>
<h2 id="resumen">Resumen</h2>
<p>Aunque solo hemos escarbado la superficie de las expresiones regulares, hemos aprendido un poco sobre su lenguaje. Son cadenas de búsqueda con caracteres especiales en su interior, los que comunican tus deseos al sistema de expresiones regulares respecto de qué se considera una coincidencia y qué información es extraída de las cadenas coincidentes. A continuación tenemos algunos de estos caracteres y secuencias especiales:</p>
<p><code>^</code> Coincide con el comienzo de la línea.</p>
<p><code>$</code> Coincide con el final de la línea</p>
<p><code>.</code> Coincide con cualquier carácter (un comodín).</p>
<p><code>\s</code> Coincide con un espacio en blanco.</p>
<p><code>\S</code> Coincide con un carácter que no sea un espacio en blanco (el opuesto a \s).</p>
<p><code>*</code> Se aplica al carácter o caracteres inmediatamente anteriores, indicando que pueden coincidir cero o más veces.</p>
<p><code>*?</code> Se aplica al carácter o caracteres inmediatamente anteriores, indicando que coinciden cero o más veces en modo “no ambicioso”.</p>
<p><code>+</code> Se aplica al carácter o caracteres inmediatamente anteriores, indicando que pueden coincidir una o más veces.</p>
<p><code>+?</code> Se aplica al carácter o caracteres inmediatamente anteriores, indicando que pueden coincidir una o más veces en modo “no ambicioso”.</p>
<p><code>?</code> Se aplica al carácter o caracteres inmediatamente anteriores, indicando que puede coincidir cero o una vez.</p>
<p><code>??</code> Se aplica al carácter o caracteres inmediatamente anteriores, indicando que puede coincidir cero o una vez en modo “no ambicioso”.</p>
<p><code>[aeiou]</code> Coincide con un solo carácter, siempre que éste se encuentre dentro del conjunto especificado. En este caso, coincidiría con “a”, “e”, “i”, “o”, o “u”, pero no con otros caracteres.</p>
<p><code>[a-z0-9]</code> Se pueden especificar rangos de caracteres utilizando el signo menos. En este caso, sería un solo carácter que debe ser una letra minúscula o un dígito.</p>
<p><code>[^A-Za-z]</code> Cuando el primer carácter en la notación del conjunto es “^”, invierte la lógica. En este ejemplo, habría coincidencia con un solo carácter que <em>no sea</em> una letra mayúscula o una letra minúscula.</p>
<p><code>( )</code> Cuando se agregan paréntesis a una expresión regular, son ignorados para propósitos de encontrar coincidencias, pero permiten extraer un subconjunto determinado de la cadena en que se encuentra la coincidencia, en lugar de toda la cadena como cuando se utiliza <code>findall()</code>.</p>
<p><code>\b</code> Coincide con una cadena vacía, pero solo al comienzo o al final de una palabra.</p>
<p><code>\B</code> Concide con una cadena vacía, pero no al comienzo o al final de una palabra.</p>
<p><code>\d</code> Coincide con cualquier dígito decimal; equivalente al conjunto [0-9].</p>
<p><code>\D</code> Coincide con cualquier carácter que no sea un dígito; equivalente al conjunto [^0-9].</p>
<h2 id="sección-adicional-para-usuarios-de-unix-linux">Sección adicional para usuarios de Unix / Linux</h2>
<p>El soporte para buscar archivos usando expresiones regulares viene incluido en el sistema operativo Unix desde la década de 1960, y está disponible en prácticamente todos los lenguajes de programación de una u otra forma.</p>
<p></p>
<p>De hecho, hay un programa de línea de comandos incluido en Unix llamado <em>grep</em> (Generalized Regular Expression Parser// Analizador Generalizado de Expresiones Regulares) que hace prácticamente lo mismo que los ejemplos que hemos dado en este capítulo que utilizan <code>search()</code>. Por tanto, si usas un sistema Macintosh o Linux, puedes probar los siguientes comandos en tu ventana de línea de comandos.</p>
<pre class="bash"><code>$ grep &#39;^From:&#39; mbox-short.txt
From: stephen.marquard@uct.ac.za
From: louis@media.berkeley.edu
From: zqian@umich.edu
From: rjlowe@iupui.edu</code></pre>
<p>Esto ordena a <code>grep</code> mostrar las líneas que comienzan con la cadena “From:” en el archivo <em>mbox-short.txt</em>. Si experimentas un poco con el comando <code>grep</code> y lees su documentación, encontrarás algunas sutiles diferencias entre el soporte de expresiones regulares en Python y en <code>grep</code>. Por ejemplo, <code>grep</code> no reconoce el carácter de no espacio en blanco <code>\S</code>, por lo que deberás usar la notación de conjuntos <code>[^ ]</code>, que es un poco más compleja, y que significa que encontrará una coincidencia con cualquier carácter que no sea un espacio en blanco.</p>
<h2 id="depuración">Depuración</h2>
<p>Python incluye una documentación simple y rudimentaria que puede ser de gran ayuda si necesitas revisar para encontrar el nombre exacto de algún método. Esta documentación puede revisarse en el intérprete de Python en modo interactivo.</p>
<p>Para mostrar el sistema de ayuda interactivo, se utiliza el comando <code>help()</code>.</p>
<pre class="python"><code>&gt;&gt;&gt; help()

help&gt; modules</code></pre>
<p>Si sabes qué método quieres usar, puedes utilizar el comando <code>dir()</code> para encontrar los métodos que contiene el módulo, de la siguiente manera:</p>
<pre class="python trinket"><code>&gt;&gt;&gt; import re
&gt;&gt;&gt; dir(re)
[.. &#39;compile&#39;, &#39;copy_reg&#39;, &#39;error&#39;, &#39;escape&#39;, &#39;findall&#39;,
&#39;finditer&#39;, &#39;match&#39;, &#39;purge&#39;, &#39;search&#39;, &#39;split&#39;, &#39;sre_compile&#39;,
&#39;sre_parse&#39;, &#39;sub&#39;, &#39;subn&#39;, &#39;sys&#39;, &#39;template&#39;]</code></pre>
<p>También puedes obtener una pequeña porción de la documentación de un método en particular usando el comando dir.</p>
<pre class="python trinket"><code>&gt;&gt;&gt; help (re.search)
Help on function search in module re:

search(pattern, string, flags=0)
    Scan through string looking for a match to the pattern, returning
    a match object, or None if no match was found.
&gt;&gt;&gt;</code></pre>
<p>La documentación incluida no es muy exhaustiva, pero puede ser útil si estás con prisa o no tienes acceso a un navegador o motor de búsqueda.</p>
<h2 id="glosario">Glosario</h2>
<dl>
<dt>código frágil</dt>
<dd>Código que funciona cuando los datos se encuentran en un formato específico pero tiene a romperse si éste no se cumple. Lo llamamos “código frágil” porque se rompe con facilidad.
</dd>
<dt>coincidencia ambiciosa</dt>
<dd>La idea de que los caracteres <code>+</code> y <code>*</code> en una expresión regular se expanden hacia afuera para coincidir con la mayor cadena posible.
</dd>
<dt>grep</dt>
<dd>Un comando disponible en la mayoría de los sistemas Unix que busca en archivos de texto, buscando líneas que coincidan con expresiones regulares. El nombre del comando significa “Generalized Regular Expression Parser, o bien”Analizador Generalizado de Expresiones Regulares".
</dd>
<dt>expresión regular</dt>
<dd>Un lenguaje para encontrar cadenas más complejas en una búsqueda. Una expresión regular puede contener caracteres especiales que indiquen que una búsqueda solo coincida al comienzo o al final de una línea, junto con muchas otras capacidades similares.
</dd>
<dt>comodín</dt>
<dd>Un carácter especial que coincide con cualquier carácter. En expresiones regulares, el carácter comodín es el punto.
</dd>
</dl>
<p></p>
<h2 id="ejercicios">Ejercicios</h2>
<p><strong>Ejercicio uno: escribe un programa simple que simule la operación del comando <code>grep</code> en Unix. Debe pedir al usuario que ingrese una expresión regular y cuente el número de líneas que coincidan con ésta:</strong></p>
<pre><code>$ python grep.py
Ingresa una expresión regular: ^Author
mbox.txt tiene 1798 líneas que coinciden con ^Author

$ python grep.py
Ingresa una expresión regular: ^X-
mbox.txt tiene 14368 líneas que coinciden con ^X-

$ python grep.py
Ingresa una expresión regular: java$
mbox.txt tiene 4175 líneas que coinciden con java$</code></pre>
<p><strong>Ejercicio 2: escribe un programa que busque líneas en la forma:</strong></p>
<pre><code>New Revision: 39772</code></pre>
<p><strong>Extrae el número de cada línea usando una expresión regular y el método <code>findall()</code>. Registra el promedio de esos números e imprímelo.</strong></p>
<pre><code>Ingresa nombre de archivo: mbox.txt
38444.0323119

Ingresa nombre de archivo: mbox-short.txt
39756.9259259</code></pre>
</body>
</html>
<?php if ( file_exists("../bookfoot.php") ) {
  $HTML_FILE = basename(__FILE__);
  $HTML = ob_get_contents();
  ob_end_clean();
  require_once "../bookfoot.php";
}?>
