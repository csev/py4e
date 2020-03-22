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
<h1 id="funciones">Funciones</h1>
<h2 id="functionchap">Llamadas a funciones</h2>
<p></p>
<p>En el contexto de la programación, una <em>función</em> es una secuencia de sentencias que realizan una operación y que reciben un nombre. Cuando se define una función, se especifica el nombre y la secuencia de sentencias. Más adelante, se puede “llamar” a la función por ese nombre. Ya hemos visto un ejemplo de una <em>llamada a una función</em>:</p>
<pre class="python"><code>&gt;&gt;&gt; type(32)
&lt;class &#39;int&#39;&gt;</code></pre>
<p>El nombre de la función es <code>type</code>. La expresión entre paréntesis recibe el nombre de <em>argumento</em> de la función. El argumento es un valor o variable que se pasa a la función como parámetro de entrada. El resultado de la función <code>type</code> es el tipo del argumento.</p>
<p></p>
<p>Es habitual decir que una función “toma” (o recibe) un argumento y “retorna” (o devuelve) un resultado. El resultado se llama <em>valor de retorno</em>.</p>
<p> </p>
<h2 id="funciones-internas">Funciones internas</h2>
<p>Python proporciona un número importante de funciones internas, que pueden ser usadas sin necesidad de tener que definirlas previamente. Los creadores de Python han escrito un conjunto de funciones para resolver problemas comunes y las han incluido en Python para que las podamos utilizar.</p>
<p>Las funciones <code>max</code> y <code>min</code> nos darán respectivamente el valor mayor y menor de una lista:</p>
<pre class="python"><code>&gt;&gt;&gt; max(&#39;¡Hola, mundo!&#39;)
&#39;u&#39;
&gt;&gt;&gt; min(&#39;¡Hola, mundo!&#39;)
&#39; &#39;
&gt;&gt;&gt;</code></pre>
<p>La función <code>max</code> nos dice cuál es el “carácter más grande” de la cadena (que resulta ser la letra “u”), mientras que la función <code>min</code> nos muestra el carácter más pequeño (que en ese caso es un espacio).</p>
<p>Otra función interna muy común es <code>len</code>, que nos dice cuántos elementos hay en su argumento. Si el argumento de <code>len</code> es una cadena, nos devuelve el número de caracteres que hay en la cadena.</p>
<pre class="python"><code>&gt;&gt;&gt; len(&#39;Hola, mundo&#39;)
11
&gt;&gt;&gt;</code></pre>
<p>Estas funciones no se limitan a buscar en cadenas. Pueden operar con cualquier conjunto de valores, como veremos en los siguientes capítulos.</p>
<p>Se deben tratar los nombres de las funciones internas como si fueran palabras reservadas (es decir, evita usar “max” como nombre para una variable).</p>
<h2 id="funciones-de-conversión-de-tipos">Funciones de conversión de tipos</h2>
<p> </p>
<p>Python también proporciona funciones internas que convierten valores de un tipo a otro. La función <code>int</code> toma cualquier valor y lo convierte en un entero, si puede, o se queja si no puede:</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; int(&#39;32&#39;)
32
&gt;&gt;&gt; int(&#39;Hola&#39;)
ValueError: invalid literal for int() with base 10: &#39;Hola&#39;</code></pre>
<p><code>int</code> puede convertir valores en punto flotante a enteros, pero no los redondea; simplemente corta y descarta la parte decimal:</p>
<pre class="python"><code>&gt;&gt;&gt; int(3.99999)
3
&gt;&gt;&gt; int(-2.3)
-2</code></pre>
<p><code>float</code> convierte enteros y cadenas en números de punto flotante:</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; float(32)
32.0
&gt;&gt;&gt; float(&#39;3.14159&#39;)
3.14159</code></pre>
<p>Finalmente, <code>str</code> convierte su argumento en una cadena:</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; str(32)
&#39;32&#39;
&gt;&gt;&gt; str(3.14159)
&#39;3.14159&#39;</code></pre>
<h2 id="funciones-matemáticas">Funciones matemáticas</h2>
<p>   </p>
<p>Python tiene un módulo matemático <code>(math)</code>, que proporciona la mayoría de las funciones matemáticas habituales. Antes de que podamos utilizar el módulo, deberemos importarlo:</p>
<pre class="python"><code>&gt;&gt;&gt; import math</code></pre>
<p>Esta sentencia crea un <em>objeto módulo</em> llamado math. Si se imprime el objeto módulo, se obtiene cierta información sobre él:</p>
<pre class="python"><code>&gt;&gt;&gt; print(math)
&lt;module &#39;math&#39; (built-in)&gt;</code></pre>
<p>El objeto módulo contiene las funciones y variables definidas en el módulo. Para acceder a una de esas funciones, es necesario especificar el nombre del módulo y el nombre de la función, separados por un punto (también conocido en inglés como <em>períod</em>). Este formato recibe el nombre de <em>notación punto</em>.</p>
<p></p>
<pre class="python"><code>&gt;&gt;&gt; relacion = int_senal / int_ruido
&gt;&gt;&gt; decibelios = 10 * math.log10(relacion)

&gt;&gt;&gt; radianes = 0.7
&gt;&gt;&gt; altura = math.sin(radianes)</code></pre>
<p>El primer ejemplo calcula el logaritmo en base 10 de la relación señal-ruido. El módulo math también proporciona una función llamada <code>log</code> que calcula logaritmos en base <code>e</code>.</p>
<p>     </p>
<p>El segundo ejemplo calcula el seno de la variable <code>radianes</code>. El nombre de la variable es una pista de que <code>sin</code> y las otras funciones trigonométricas (<code>cos</code>, <code>tan</code>, etc.) toman argumentos en radianes. Para convertir de grados a radianes, hay que dividir por 360 y multiplicar por <span class="math inline">2<em>π</em></span>:</p>
<pre class="python"><code>&gt;&gt;&gt; grados = 45
&gt;&gt;&gt; radianes = grados / 360.0 * 2 * math.pi
&gt;&gt;&gt; math.sin(radianes)
0.7071067811865476</code></pre>
<p>La expresión <code>math.pi</code> toma la variable <code>pi</code> del módulo math. El valor de esa variable es una aproximación de <span class="math inline"><em>π</em></span>, con una precisión de unos 15 dígitos.</p>
<p></p>
<p>Si sabes de trigonometría, puedes comprobar el resultado anterior, comparándolo con la raíz cuadrada de dos dividida por dos:</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; math.sqrt(2) / 2.0
0.7071067811865476</code></pre>
<h2 id="números-aleatorios">Números aleatorios</h2>
<p>   </p>
<p>A partir de las mismas entradas, la mayoría de los programas generarán las mismas salidas cada vez, que es lo que llamamos comportamiento <em>determinista</em>. El determinismo normalmente es algo bueno, ya que esperamos que la misma operación nos proporcione siempre el mismo resultado. Para ciertas aplicaciones, sin embargo, querremos que el resultado sea impredecible. Los juegos son el ejemplo obvio, pero hay más.</p>
<p>Conseguir que un programa sea realmente no-determinista no resulta tan fácil, pero hay modos de hacer que al menos lo parezca. Una de ellos es usar <em>algoritmos</em> que generen números <em>pseudoaleatorios</em>. Los números pseudoaleatorios no son verdaderamente aleatorios, ya que son generados por una operación determinista, pero si sólo nos fijamos en los números resulta casi imposible distinguirlos de los aleatorios de verdad.</p>
<p> </p>
<p>El módulo <code>random</code> proporciona funciones que generan números pseudoaleatorios (a los que simplemente llamaremos “aleatorios” de ahora en adelante).</p>
<p> </p>
<p>La función <code>random</code> devuelve un número flotante aleatorio entre 0.0 y 1.0 (incluyendo 0.0, pero no 1.0). Cada vez que se llama a <code>random</code>, se obtiene el número siguiente de una larga serie. Para ver un ejemplo, ejecuta este bucle:</p>
<pre class="python"><code>import random

for i in range(10):
    x = random.random()
    print(x)</code></pre>
<p>Este programa produce la siguiente lista de 10 números aleatorios entre 0.0 y hasta (pero no incluyendo) 1.0.</p>
<pre><code>0.11132867921152356
0.5950949227890241
0.04820265884996877
0.841003109276478
0.997914947094958
0.04842330803368111
0.7416295948208405
0.510535245390327
0.27447040171978143
0.028511805472785867</code></pre>
<p><strong>Ejercicio 1: Ejecuta el programa en tu sistema y observa qué números obtienes.</strong></p>
<p>La función <code>random</code> es solamente una de las muchas que trabajan con números aleatorios. La función <code>randint</code> toma los parámetros <code>inferior</code> y <code>superior</code>, y devuelve un entero entre <code>inferior</code> y <code>superior</code> (incluyendo ambos extremos).</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; random.randint(5, 10)
5
&gt;&gt;&gt; random.randint(5, 10)
9</code></pre>
<p>Para elegir un elemento de una secuencia aleatoriamente, se puede usar <code>choice</code>:</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; t = [1, 2, 3]
&gt;&gt;&gt; random.choice(t)
2
&gt;&gt;&gt; random.choice(t)
3</code></pre>
<p>El módulo <code>random</code> también proporciona funciones para generar valores aleatorios de varias distribuciones continuas, incluyendo gaussiana, exponencial, gamma, y unas cuantas más.</p>
<h2 id="añadiendo-funciones-nuevas">Añadiendo funciones nuevas</h2>
<p>Hasta ahora, sólo hemos estado usando las funciones que vienen incorporadas en Python, pero es posible añadir también funciones nuevas. Una <em>definición de función</em> especifica el nombre de una función nueva y la secuencia de sentencias que se ejecutan cuando esa función es llamada. Una vez definida una función, se puede reutilizar una y otra vez a lo largo de todo el programa.</p>
<p>  </p>
<p>He aquí un ejemplo:</p>
<pre class="python"><code>def muestra_estribillo():
    print(&#39;Soy un leñador, qué alegría.&#39;)
    print(&#39;Duermo toda la noche y trabajo todo el día.&#39;)</code></pre>
<p><code>def</code> es una palabra clave que indica que se trata de una definición de función. El nombre de la función es <code>muestra_estribillo</code>. Las reglas para los nombres de las funciones son los mismos que para las variables: se pueden usar letras, números y algunos signos de puntuación, pero el primer carácter no puede ser un número. No se puede usar una palabra clave como nombre de una función, y se debería evitar también tener una variable y una función con el mismo nombre.</p>
<p>  </p>
<p>Los paréntesis vacíos después del nombre indican que esta función no toma ningún argumento. Más tarde construiremos funciones que reciban argumentos de entrada.</p>
<p>    </p>
<p>La primera línea de la definición de la función es llamada la <em>cabecera</em>; el resto se llama el <em>cuerpo</em>. La cabecera debe terminar con dos-puntos (:), y el cuerpo debe ir indentado. Por convención, el indentado es siempre de cuatro espacios. El cuerpo puede contener cualquier número de sentencias.</p>
<p>Las cadenas en la sentencia print están encerradas entre comillas. Da igual utilizar comillas simples que dobles; la mayoría de la gente prefiere comillas simples, excepto en aquellos casos en los que una comilla simple (que también se usa como apostrofe) aparece en medio de la cadena.</p>
<p></p>
<p>Si escribes una definición de función en modo interactivo, el intérprete mostrará puntos suspensivos (<em>…</em>) para informarte de que la definición no está completa:</p>
<pre class="python"><code>&gt;&gt;&gt; def muestra_estribillo():
...     print &#39;Soy un leñador, qué alegría.&#39;
...     print &#39;Duermo toda la noche y trabajo todo el día.&#39;
...</code></pre>
<p>Para finalizar la función, debes introducir una línea vacía (esto no es necesario en un script).</p>
<p>Al definir una función se crea una variable con el mismo nombre.</p>
<pre class="python"><code>&gt;&gt;&gt; print(muestra_estribillo)
&lt;function muestra_estribillo at 0xb7e99e9c&gt;
&gt;&gt;&gt; print(type(muestra_estribillo))
&lt;type &#39;function&#39;&gt;</code></pre>
<p>El valor de <code>muestra_estribillo</code> es <em>function object</em> (objeto función), que tiene como tipo “function”.</p>
<p> </p>
<p>La sintaxis para llamar a nuestra nueva función es la misma que usamos para las funciones internas:</p>
<pre class="python"><code>&gt;&gt;&gt; muestra_estribillo()
Soy un leñador, qué alegría.
Duermo toda la noche y trabajo todo el día.</code></pre>
<p>Una vez que se ha definido una función, puede usarse dentro de otra. Por ejemplo, para repetir el estribillo anterior, podríamos escribir una función llamada <code>repite_estribillo</code>:</p>
<pre class="python"><code>def repite_estribillo():
    muestra_estribillo()
    muestra_estribillo()</code></pre>
<p>Y después llamar a <code>repite_estribillo</code>:</p>
<pre class="python"><code>&gt;&gt;&gt; repite_estribillo()
Soy un leñador, qué alegría.
Duermo toda la noche y trabajo todo el día.
Soy un leñador, qué alegría.
Duermo toda la noche y trabajo todo el día.</code></pre>
<p>Pero en realidad la canción no es así.</p>
<h2 id="definición-y-usos">Definición y usos</h2>
<p></p>
<p>Reuniendo los fragmentos de código de las secciones anteriores, el programa completo sería algo como esto:</p>
<pre class="python"><code>def muestra_estribillo():
    print(&#39;Soy un leñador, que alegría.&#39;)
    print(&#39;Duermo toda la noche y trabajo todo el día.&#39;)

def repite_estribillo():
    muestra_estribillo()
    muestra_estribillo()

repite_estribillo()

# Code: http://www.py4e.com/code3/lyrics.py</code></pre>
<p>Este programa contiene dos definiciones de funciones: <code>muestra_estribillo</code> y <code>repite_estribillo</code>. Las definiciones de funciones son ejecutadas exactamente igual que cualquier otra sentencia, pero su resultado consiste en crear objetos del tipo función. Las sentencias dentro de cada función son ejecutadas solamente cuando se llama a esa función, y la definición de una función no genera ninguna salida.</p>
<p></p>
<p>Como ya te imaginarás, es necesario crear una función antes de que se pueda ejecutar. En otras palabras, la definición de la función debe ser ejecutada antes de que la función se llame por primera vez.</p>
<p><strong>Ejercicio 2: Desplaza la última línea del programa anterior hacia arriba, de modo que la llamada a la función aparezca antes que las definiciones. Ejecuta el programa y observa qué mensaje de error obtienes.</strong></p>
<p><strong>Ejercicio 3: Desplaza la llamada de la función de nuevo hacia el final, y coloca la definición de <code>muestra_estribillo</code> después de la definición de <code>repite_estribillo</code>. ¿Qué ocurre cuando haces funcionar ese programa?</strong></p>
<h2 id="flujo-de-ejecución">Flujo de ejecución</h2>
<p></p>
<p>Para asegurarnos de que una función está definida antes de usarla por primera vez, es necesario saber el orden en que las sentencias son ejecutadas, que es lo que llamamos el <em>flujo de ejecución</em>.</p>
<p>La ejecución siempre comienza en la primera sentencia del programa. Las sentencias son ejecutadas una por una, en orden de arriba hacia abajo.</p>
<p>Las <em>definiciones</em> de funciones no alteran el flujo de la ejecución del programa, pero recuerda que las sentencias dentro de una función no son ejecutadas hasta que se llama a esa función.</p>
<p>Una llamada a una función es como un desvío en el flujo de la ejecución. En vez de pasar a la siguiente sentencia, el flujo salta al cuerpo de la función, ejecuta todas las sentencias que hay allí, y después vuelve al punto donde lo dejó.</p>
<p>Todo esto parece bastante sencillo, hasta que uno recuerda que una función puede llamar a otra. Cuando está en mitad de una función, el programa puede tener que ejecutar las sentencias de otra función. Pero cuando está ejecutando esa nueva función, ¡tal vez haya que ejecutar todavía más funciones!</p>
<p>Afortunadamente, Python es capaz de llevar el seguimiento de dónde se encuentra en cada momento, de modo que cada vez que completa la ejecución de una función, el programa vuelve al punto donde lo dejó en la función que había llamado a esa. Cuando esto le lleva hasta el final del programa, simplemente termina.</p>
<p>¿Cuál es la moraleja de esta extraña historia? Cuando leas un programa, no siempre te convendrá hacerlo de arriba a abajo. A veces tiene más sentido seguir el flujo de la ejecución.</p>
<h2 id="parámetros-y-argumentos">Parámetros y argumentos</h2>
<p>   </p>
<p>Algunas de las funciones internas que hemos visto necesitan argumentos. Por ejemplo, cuando se llama a <code>math.sin</code>, se le pasa un número como argumento. Algunas funciones necesitan más de un argumento: <code>math.pow</code> toma dos, la base y el exponente.</p>
<p>Dentro de las funciones, los argumentos son asignados a variables llamadas <em>parámetros</em>. A continuación mostramos un ejemplo de una función definida por el usuario que recibe un argumento:</p>
<p></p>
<pre class="python"><code>def muestra_dos_veces(bruce):
    print(bruce)
    print(bruce)</code></pre>
<p>Esta función asigna el argumento a un parámetro llamado <code>bruce</code>. Cuando la función es llamada, imprime el valor del parámetro (sea éste lo que sea) dos veces.</p>
<p>Esta función funciona con cualquier valor que pueda ser mostrado en pantalla.</p>
<pre class="python"><code>&gt;&gt;&gt; muestra_dos_veces(&#39;Spam&#39;)
Spam
Spam
&gt;&gt;&gt; muestra_dos_veces(17)
17
17
&gt;&gt;&gt; muestra_dos_veces(math.pi)
3.14159265359
3.14159265359</code></pre>
<p>Las mismas reglas de composición que se aplican a las funciones internas, también se aplican a las funciones definidas por el usuario, de modo que podemos usar cualquier tipo de expresión como argumento para <code>muestra_dos_veces</code>:</p>
<p></p>
<pre class="python"><code>&gt;&gt;&gt; muestra_dos_veces(&#39;Spam &#39;*4)
Spam Spam Spam Spam
Spam Spam Spam Spam
&gt;&gt;&gt; muestra_dos_veces(math.cos(math.pi))
-1.0
-1.0</code></pre>
<p>El argumento es evaluado antes de que la función sea llamada, así que en los ejemplos, la expresión <code>Spam *4</code> y <code>math.cos(math.pi)</code> son evaluadas sólo una vez.</p>
<p></p>
<p>También se puede usar una variable como argumento:</p>
<pre class="python"><code>&gt;&gt;&gt; michael = &#39;Eric, la medio-abeja.&#39;
&gt;&gt;&gt; muestra_dos_veces(michael)
Eric, la medio-abeja.
Eric, la medio-abeja.</code></pre>
<p>El nombre de la variable que pasamos como argumento, (<code>michael</code>) no tiene nada que ver con el nombre del parámetro (<code>bruce</code>). No importa cómo se haya llamado al valor en origen (en la llamada); dentro de <code>muestra_dos_veces</code>, siempre se llamará <code>bruce</code>.</p>
<h2 id="funciones-productivas-y-funciones-estériles">Funciones productivas y funciones estériles</h2>
<p>   </p>
<p>Algunas de las funciones que estamos usando, como las matemáticas, producen resultados; a falta de un nombre mejor, las llamaremos <em>funciones productivas</em> (fruitful functions). Otras funciones, como <code>muestra_dos_veces</code>, realizan una acción, pero no devuelven un valor. A esas las llamaremos <em>funciones estériles</em> (void functions).</p>
<p>Cuando llamas a una función productiva, casi siempre querrás hacer luego algo con el resultado; por ejemplo, puede que quieras asignarlo a una variable o usarlo como parte de una expresión:</p>
<pre class="python"><code>x = math.cos(radians)
aurea = (math.sqrt(5) + 1) / 2</code></pre>
<p>Cuando llamas a una función en modo interactivo, Python muestra el resultado:</p>
<pre class="python"><code>&gt;&gt;&gt; math.sqrt(5)
2.23606797749979</code></pre>
<p>Pero en un script, si llamas a una función productiva y no almacenas el resultado de la misma en una variable, ¡el valor de retorno se desvanece en la niebla!</p>
<pre class="python"><code>math.sqrt(5)</code></pre>
<p>Este script calcula la raíz cuadrada de 5, pero dado que no almacena el resultado en una variable ni lo muestra, no resulta en realidad muy útil.</p>
<p> </p>
<p>Las funciones estériles pueden mostrar algo en la pantalla o tener cualquier otro efecto, pero no devuelven un valor. Si intentas asignar el resultado a una variable, obtendrás un valor especial llamado <code>None</code> (nada).</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; resultado = muestra_dos_veces(&#39;Bing&#39;)
Bing
Bing
&gt;&gt;&gt; print(resultado)
None</code></pre>
<p>El valor <code>None</code> no es el mismo que la cadena “None”. Es un valor especial que tiene su propio tipo:</p>
<pre class="python"><code>&gt;&gt;&gt; print(type(None))
&lt;class &#39;NoneType&#39;&gt;</code></pre>
<p>Para devolver un resultado desde una función, usamos la sentencia <code>return</code> dentro de ella. Por ejemplo, podemos crear una función muy simple llamada <code>sumados</code>, que suma dos números y devuelve el resultado.</p>
<pre class="python"><code>def sumados(a, b):
    suma = a + b
    return suma

x = sumados(3, 5)
print(x)

# Code: http://www.py4e.com/code3/addtwo.py</code></pre>
<p>Cuando se ejecuta este script, la sentencia <code>print</code> mostrará “8”, ya que la función <code>sumados</code> ha sido llamada con 3 y 5 como argumentos. Dentro de la función, los parámetros <code>a</code> y <code>b</code> equivaldrán a 3 y a 5 respectivamente. La función calculó la suma de ambos número y la guardó en una variable local a la función llamada <code>suma</code>. Después usó la sentencia <code>return</code> para enviar el valor calculado de vuelta al código de llamada como resultado de la función, que fue asignado a la variable <code>x</code> y mostrado en pantalla.</p>
<h2 id="por-qué-funciones">¿Por qué funciones?</h2>
<p></p>
<p>Puede no estar muy claro por qué merece la pena molestarse en dividir un programa en funciones. Existen varias razones:</p>
<ul>
<li><p>El crear una función nueva te da la oportunidad de dar nombre a un grupo de sentencias, lo cual hace tu programa más fácil de leer, entender y depurar.</p></li>
<li><p>Las funciones pueden hacer un programa más pequeño, al eliminar código repetido. Además, si quieres realizar cualquier cambio en el futuro, sólo tendrás que hacerlo en un único lugar.</p></li>
<li><p>Dividir un programa largo en funciones te permite depurar las partes de una en una y luego ensamblarlas juntas en una sola pieza.</p></li>
<li><p>Las funciones bien diseñadas a menudo resultan útiles para otros muchos programas. Una vez que has escrito y depurado una, puedes reutilizarla.</p></li>
</ul>
<p>A lo largo del resto del libro, a menudo usaremos una definición de función para explicar un concepto. Parte de la habilidad de crear y usar funciones consiste en llegar a tener una función que represente correctamente una idea, como “encontrar el valor más pequeño en una lista de valores”. Más adelante te mostraremos el código para encontrar el valor más pequeño de una lista de valores y te lo presentaremos como una función llamada <code>min</code>, que toma una lista de valores como argumento y devuelve el menor valor de esa lista.</p>
<h2 id="editor">Depuración</h2>
<p></p>
<p>Si estás usando un editor de texto para escribir tus propios scripts, puede que tengas problemas con los espacios y tabulaciones. El mejor modo de evitar esos problemas es usar espacios exclusivamente (no tabulaciones). La mayoría de los editores de texto que reconocen Python lo hacen así por defecto, aunque hay algunos que no.</p>
<p></p>
<p>Las tabulaciones y los espacios normalmente son invisibles, lo cual hace que sea difícil depurar los errores que se pueden producir, así que mejor busca un editor que gestione el indentado por ti.</p>
<p>Tampoco te olvides de guardar tu programa antes de hacerlo funcionar. Algunos entornos de desarrollo lo hacen automáticamente, pero otros no. En ese caso, el programa que estás viendo en el editor de texto puede no ser el mismo que estás ejecutando en realidad.</p>
<p>¡La depuración puede llevar mucho tiempo si estás haciendo funcionar el mismo programa con errores una y otra vez!</p>
<p>Asegúrate de que el código que estás examinando es el mismo que estás ejecutando. Si no estás seguro, pon algo como <code>print("hola")</code> al principio del programa y hazlo funcionar de nuevo. Si no ves <code>hola</code> en la pantalla, ¡es que no estás ejecutando el programa correcto!</p>
<h2 id="glosario">Glosario</h2>
<dl>
<dt>algoritmo</dt>
<dd><p>Un proceso general para resolver una categoría de problemas.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>argumento</dt>
<dd><p>Un valor proporcionado a una función cuando ésta es llamada. Ese valor se asigna al parámetro correspondiente en la función.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>cabecera</dt>
<dd><p>La primera línea de una definición de función.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>cuerpo</dt>
<dd><p>La secuencia de sentencias dentro de la definición de una función.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>composición</dt>
<dd><p>Uso de una expresión o sentencia como parte de otra más larga,</p>
</dd>
</dl>
<p></p>
<dl>
<dt>definición de función</dt>
<dd><p>Una sentencia que crea una función nueva, especificando su nombre, parámetros, y las sentencias que ejecuta.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>determinístico</dt>
<dd><p>Perteneciente a un programa que hace lo mismo cada vez que se ejecuta, a partir de las mismas entradas.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>función</dt>
<dd><p>Una secuencia de sentencias con un nombre que realizan alguna operación útil. Las funciones pueden tomar argumentos o no, y pueden producir un resultado o no.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>función productiva (fruitful function)</dt>
<dd><p>Una función que devuelve un valor.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>función estéril (void function)</dt>
<dd><p>Una función que no devuelve ningún valor.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>flujo de ejecución</dt>
<dd><p>El orden en el cual se ejecutan las sentencias durante el funcionamiento de un programa.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>llamada a función</dt>
<dd><p>Una sentencia que ejecuta una función. Consiste en el nombre de la función seguido por una lista de argumentos.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>notación punto</dt>
<dd><p>La sintaxis para llamar a una función de otro módulo, especificando el nombre del módulo seguido por un punto y el nombre de la función.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>objeto función</dt>
<dd><p>Un valor creado por una definición de función. El nombre de la función es una variable que se refiere al objeto función.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>objeto módulo</dt>
<dd><p>Un valor creado por una sentencia <code>import</code>, que proporciona acceso a los datos y código definidos en un módulo.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>parámetro</dt>
<dd><p>Un nombre usado dentro de una función para referirse al valor pasado como argumento.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>pseudoaleatorio</dt>
<dd><p>Perteneciente a una secuencia de números que parecen ser aleatorios, pero son generados por un programa determinista.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>sentencia import</dt>
<dd><p>Una sentencia que lee un archivo módulo y crea un objeto módulo.</p>
</dd>
</dl>
<p> </p>
<dl>
<dt>valor de retorno</dt>
<dd><p>El resultado de una función. Si una llamada a una función es usada como una expresión, el valor de retorno es el valor de la expresión.</p>
</dd>
</dl>
<p></p>
<h2 id="ejercicios">Ejercicios</h2>
<p><strong>Ejercicio 4: ¿Cuál es la utilidad de la palabra clave “def” en Python?</strong></p>
<p>a) Es una jerga que significa “este código es realmente estupendo”<br />
b) Indica el comienzo de una función<br />
c) Indica que la siguiente sección de código indentado debe ser almacenada para usarla más tarde<br />
d) b y c son correctas ambas<br />
e) Ninguna de las anteriores</p>
<p><strong>Ejercicio 5: ¿Qué mostrará en pantalla el siguiente programa Python?</strong></p>
<pre class="python"><code>def fred():
   print(&quot;Zap&quot;)

def jane():
   print(&quot;ABC&quot;)

jane()
fred()
jane()</code></pre>
<p>a) Zap ABC jane fred jane<br />
b) Zap ABC Zap<br />
c) ABC Zap jane<br />
d) ABC Zap ABC<br />
e) Zap Zap Zap</p>
<p><strong>Ejercicio 6: Reescribe el programa de cálculo del salario, con tarifa-y-media para las horas extras, y crea una función llamada <code>calculo_salario</code> que reciba dos parámetros (<code>horas</code> y <code>tarifa</code>).</strong></p>
<pre><code>Introduzca Horas: 45
Introduzca Tarifa: 10
Salario: 475.0</code></pre>
<p><strong>Ejercicio 7: Reescribe el programa de calificaciones del capítulo anterior usando una función llamada <code>calcula_calificacion</code>, que reciba una puntuación como parámetro y devuelva una calificación como cadena.</strong></p>
<pre><code>Puntuación Calificación
&gt; 0.9      Sobresaliente
&gt; 0.8      Notable
&gt; 0.7      Bien
&gt; 0.6      Suficiente
&lt;= 0.6     Insuficiente</code></pre>
<pre><code>Introduzca puntuación: 0.95
Sobresaliente</code></pre>
<pre><code>Introduzca puntuación: perfecto
Puntuación incorrecta</code></pre>
<pre><code>Introduzca puntuación: 10.0
Puntuación incorrecta</code></pre>
<pre><code>Introduzca puntuación: 0.75
Bien</code></pre>
<pre><code>Introduzca puntuación: 0.5
Insuficiente</code></pre>
<p>Ejecuta el programa repetidamente para probar con varios valores de entrada diferentes.</p>
</body>
</html>
<?php if ( file_exists("../bookfoot.php") ) {
  $HTML_FILE = basename(__FILE__);
  $HTML = ob_get_contents();
  ob_end_clean();
  require_once "../bookfoot.php";
}?>
