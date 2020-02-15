<?php if ( file_exists("../booktop.php") ) {
  require_once "../booktop.php";
  ob_start();
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <meta name="generator" content="pandoc" />
  <title></title>
  <style type="text/css">code{white-space: pre;}</style>
</head>
<body>
<h1 id="cadenas">Cadenas</h1>
<h2 id="una-cadena-es-una-secuencia">Una cadena es una secuencia</h2>
<p>   </p>
<p>Una cadena es una <em>secuencia</em> de caracteres. Puedes acceder a los caracteres de uno en uno con el operador corchete:</p>
<pre class="python"><code>&gt;&gt;&gt; fruta = &#39;banana&#39;
&gt;&gt;&gt; letra = fruta[1]</code></pre>
<p> </p>
<p>La segunda sentencia extrae el carácter en la posición del indice 1 de la variable <code>fruta</code> y la asigna a la variable <code>letra</code>.</p>
<p>La expresión en los corchetes es llamada <em>índice</em>. El índice indica qué carácter de la secuencia quieres (de ahí el nombre).</p>
<p>Pero podrías no obtener lo que esperas:</p>
<pre class="python"><code>&gt;&gt;&gt; print(letra)
a</code></pre>
<p>Para la mayoría de las personas, la primer letra de &quot;banana&quot; es &quot;b&quot;, no &quot;a&quot;. Pero en Python, el índice es un desfase desde el inicio de la cadena, y el desfase de la primera letra es cero.</p>
<pre class="python"><code>&gt;&gt;&gt; letra = fruta[0]
&gt;&gt;&gt; print(letra)
b</code></pre>
<p>Así que &quot;b&quot; es la letra 0 (&quot;cero&quot;) de &quot;banana&quot;, &quot;a&quot; es la letra con índice 1, y &quot;n&quot; es la que tiene índice 2, etc.</p>
<div class="figure">
<img src="../images/string.svg" alt="Indices de Cadenas" />
<p class="caption">Indices de Cadenas</p>
</div>
<p> </p>
<p>Puedes usar cualquier expresión, incluyendo variables y operadores, como un índice, pero el valor del índice tiene que ser un entero. De otro modo obtendrás:</p>
<p>   </p>
<pre class="python"><code>&gt;&gt;&gt; letra = fruta[1.5]
TypeError: string indices must be integers</code></pre>
<h2 id="obtener-el-tamaño-de-una-cadena-usando-len">Obtener el tamaño de una cadena usando <code>len</code></h2>
<p> </p>
<p><code>len</code> es una función nativa que devuelve el número de caracteres en una cadena:</p>
<pre class="python"><code>&gt;&gt;&gt; fruta = &#39;banana&#39;
&gt;&gt;&gt; len(fruta)
6</code></pre>
<p>Para obtener la última letra de una cadena, podrías estar tentado a probar algo como esto:</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; tamaño = len(fruta)
&gt;&gt;&gt; ultima = fruta[tamaño]
IndexError: string index out of range</code></pre>
<p>La razón de que haya un <code>IndexError</code> es que ahí no hay ninguna letra en &quot;banana&quot; con el índice 6. Puesto que empezamos a contar desde cero, las seis letras están enumeradas desde 0 hasta 5. Para obtener el último carácter, tienes que restar 1 a <code>length</code>:</p>
<pre class="python"><code>&gt;&gt;&gt; ultima = fruta[tamaño-1]
&gt;&gt;&gt; print(ultima)
a</code></pre>
<p>Alternativamente, puedes usar índices negativos, los cuales cuentan hacia atrás desde el final de la cadena. La expresión <code>fruta[-1]</code> devuelve la última letra, <code>fruta[-2]</code> la penúltima letra, y así sucesivamente.</p>
<p> </p>
<h2 id="recorriendo-una-cadena-mediante-un-bucle">Recorriendo una cadena mediante un bucle</h2>
<p>     </p>
<p>Muchos de los cálculos requieren procesar una cadena carácter por carácter. Frecuentemente empiezan desde el inicio, seleccionando cada carácter presente, haciendo algo con él, y continuando hasta el final. Este patrón de procesamiento es llamado un <em>recorrido</em>. Una manera de escribir un recorrido es con un bucle <code>while</code>:</p>
<pre class="python"><code>indice = 0
while indice &lt; len(fruta):
    letra = fruta[indice]
    print(letra)
    indice = indice + 1</code></pre>
<p>Este bucle recorre la cadena e imprime cada letra en una línea cada una. La condición del bucle es <code>indice &lt; len(fruta)</code>, así que cuando <code>indice</code> es igual al tamaño de la cadena, la condición es falsa, y el código del bucle no se ejecuta. El último carácter accedido es el que tiene el índice <code>len(fruta)-1</code>, el cual es el último carácter en la cadena.</p>
<p><strong>Ejercicio 1: Escribe un bucle <code>while</code> que comience con el último carácter en la cadena y haga un recorrido hacia atrás hasta el primer carácter en la cadena, imprimiendo cada letra en una línea independiente.</strong></p>
<p>Otra forma de escribir un recorrido es con un bucle <code>for</code>:</p>
<pre class="python"><code>for caracter in fruta:
    print(caracter)</code></pre>
<p>Cada vez que iteramos el bucle, el siguiente carácter en la cadena es asignado a la variable <code>caracter</code>. El ciclo continúa hasta que no quedan caracteres.</p>
<h2 id="parte-slicing-de-una-cadena">Parte (slicing) de una cadena</h2>
<p>    </p>
<p>Un segmento de una cadena es llamado <em>parte</em>. Seleccionar una parte es similar a seleccionar un carácter:</p>
<pre class="python"><code>&gt;&gt;&gt; s = &#39;Monty Python&#39;
&gt;&gt;&gt; print(s[0:5])
Monty
&gt;&gt;&gt; print(s[6:12])
Python</code></pre>
<p>El operador [n:m] retorna la parte de la cadena desde el &quot;n-ésimo&quot; carácter hasta el &quot;m-ésimo&quot; carácter, incluyendo el primero pero excluyendo el último.</p>
<p>Si omites el primer índice (antes de los dos puntos), la parte comienza desde el inicio de la cadena. Si omites el segundo índice, la parte va hasta el final de la cadena:</p>
<pre class="python"><code>&gt;&gt;&gt; fruta = &#39;banana&#39;
&gt;&gt;&gt; fruta[:3]
&#39;ban&#39;
&gt;&gt;&gt; fruta[3:]
&#39;ana&#39;</code></pre>
<p>Si el primer índice es mayor que o igual que el segundo, el resultado es una <em>cadena vacía</em>, representado por dos comillas:</p>
<p></p>
<pre class="python"><code>&gt;&gt;&gt; fruta = &#39;banana&#39;
&gt;&gt;&gt; fruta[3:3]
&#39;&#39;</code></pre>
<p>Una cadena vacía no contiene caracteres y tiene un tamaño de 0, pero fuera de esto es lo mismo que cualquier otra cadena.</p>
<p><strong>Ejercicio 2: Dado que <code>fruta</code> es una cadena, ¿que significa <code>fruta[:]</code>?</strong></p>
<p> </p>
<h2 id="los-cadenas-son-inmutables">Los cadenas son inmutables</h2>
<p>  </p>
<p>Puede ser tentador utilizar el operador [] en el lado izquierdo de una asignación, con la intención de cambiar un carácter en una cadena. Por ejemplo:</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; saludo = &#39;Hola, mundo!&#39;
&gt;&gt;&gt; saludo[0] = &#39;J&#39;
TypeError: &#39;str&#39; object does not support item assignment</code></pre>
<p>El &quot;object&quot; en este caso es la cadena y el &quot;ítem&quot; es el carácter que tratamos de asignar. Por ahora, un <em>object</em> es la misma cosa que un valor, pero vamos a redefinir esa definición después. Un <em>ítem</em> es uno de los valores en una secuencia.</p>
<p>   </p>
<p>La razón por la cual ocurre el error es que las cadenas son <em>inmutables</em>, lo cual significa que no puedes modificar una cadena existente. Lo mejor que puedes hacer es crear una nueva cadena que sea una variación del original:</p>
<pre class="python"><code>&gt;&gt;&gt; saludo = &#39;Hola, mundo!&#39;
&gt;&gt;&gt; nuevo_saludo = &#39;J&#39; + saludo[1:]
&gt;&gt;&gt; print(nuevo_saludo)
Jola, mundo!</code></pre>
<p>Este ejemplo concatena una nueva letra a una parte de <code>saludo</code>. Esto no tiene efecto sobre la cadena original.</p>
<p></p>
<h2 id="iterando-y-contando">Iterando y contando</h2>
<p>   </p>
<p>El siguiente programa cuenta el número de veces que la letra &quot;a&quot; aparece en una cadena:</p>
<pre class="python"><code>palabra = &#39;banana&#39;
contador = 0
for letra in palabra:
    if letra == &#39;a&#39;:
        contador = contador + 1
print(contador)</code></pre>
<p>Este programa demuestra otro patrón de computación llamado <em>contador</em>. La variable <code>contador</code> es inicializada a 0 y después se incrementa cada vez que una &quot;a&quot; es encontrada. Cuando el bucle termina, <code>contador</code> contiene el resultado: el número total de a's.</p>
<p></p>
<p><strong>Ejercicio 3: Encapsula este código en una función llamada <code>cuenta</code>, y hazla genérica de tal modo que pueda aceptar una cadena y una letra como argumentos.</strong></p>
<h2 id="el-operador-in">El operador <code>in</code></h2>
<p>   </p>
<p>La palabra <code>in</code> es un operador booleano que toma dos cadenas y regresa <code>True</code> si la primera cadena aparece como una subcadena de la segunda:</p>
<pre class="python"><code>&gt;&gt;&gt; &#39;a&#39; in &#39;banana&#39;
True
&gt;&gt;&gt; &#39;semilla&#39; in &#39;banana&#39;
False</code></pre>
<h2 id="comparación-de-cadenas">Comparación de cadenas</h2>
<p> </p>
<p>Los operadores de comparación funcionan en cadenas. Para ver si dos cadenas son iguales:</p>
<pre class="python"><code>if palabra == &#39;banana&#39;:
    print(&#39;Muy bien, bananas.&#39;)</code></pre>
<p>Otras operaciones de comparación son útiles para poner palabras en orden alfabético:</p>
<pre class="python"><code>if palabra &lt; &#39;banana&#39;:
    print(&#39;Tu palabra, &#39; + palabra + &#39;, está antes de banana.&#39;)
elif palabra &gt; &#39;banana&#39;:
    print(&#39;Tu palabra, &#39; + palabra + &#39;, está después de banana.&#39;)
else:
    print(&#39;Muy bien, bananas.&#39;)</code></pre>
<p>Python no maneja letras mayúsculas y minúsculas de la misma forma que la gente lo hace. Todas las letras mayúsculas van antes que todas las letras minúsculas, por ejemplo:</p>
<pre><code>Tu palabra, Piña, está antes que banana.</code></pre>
<p>Una forma común de manejar este problema es convertir cadenas a un formato estándar, como todas a minúsculas, antes de llevar a cabo la comparación. Ten en cuenta eso en caso de que tengas que defenderte contra un hombre armado con una Piña.</p>
<h2 id="métodos-de-cadenas">Métodos de cadenas</h2>
<p>Los cadenas son un ejemplo de <em>objetos</em> en Python. Un objeto contiene tanto datos (el valor de la cadena misma) como <em>métodos</em>, los cuales son efectivamente funciones que están implementadas dentro del objeto y que están disponibles para cualquier <em>instancia</em> del objeto.</p>
<p>Python tiene una función llamada <code>dir</code> la cual lista los métodos disponibles para un objeto. La función <code>type</code> muestra el tipo de un objeto y la función <code>dir</code> muestra los métodos disponibles.</p>
<pre class="python"><code>&gt;&gt;&gt; cosa = &#39;Hola mundo&#39;
&gt;&gt;&gt; type(cosa)
&lt;class &#39;str&#39;&gt;
&gt;&gt;&gt; dir(cosa)
[&#39;capitalize&#39;, &#39;casefold&#39;, &#39;center&#39;, &#39;count&#39;, &#39;encode&#39;,
&#39;endswith&#39;, &#39;expandtabs&#39;, &#39;find&#39;, &#39;format&#39;, &#39;format_map&#39;,
&#39;index&#39;, &#39;isalnum&#39;, &#39;isalpha&#39;, &#39;isdecimal&#39;, &#39;isdigit&#39;,
&#39;isidentifier&#39;, &#39;islower&#39;, &#39;isnumeric&#39;, &#39;isprintable&#39;,
&#39;isspace&#39;, &#39;istitle&#39;, &#39;isupper&#39;, &#39;join&#39;, &#39;ljust&#39;, &#39;lower&#39;,
&#39;lstrip&#39;, &#39;maketrans&#39;, &#39;partition&#39;, &#39;replace&#39;, &#39;rfind&#39;,
&#39;rindex&#39;, &#39;rjust&#39;, &#39;rpartition&#39;, &#39;rsplit&#39;, &#39;rstrip&#39;,
&#39;split&#39;, &#39;splitlines&#39;, &#39;startswith&#39;, &#39;strip&#39;, &#39;swapcase&#39;,
&#39;title&#39;, &#39;translate&#39;, &#39;upper&#39;, &#39;zfill&#39;]
&gt;&gt;&gt; help(str.capitalize)
Help on method_descriptor:

capitalize(...)
    S.capitalize() -&gt; str

    Return a capitalized version of S, i.e. make the first character
    have upper case and the rest lower case.
&gt;&gt;&gt;</code></pre>
<p>Aunque la función <code>dir</code> lista los métodos y puedes usar la función <code>help</code> para obtener una breve documentación de un método, una mejor fuente de documentación para los métodos de cadenas se puede encontrar en <a href="https://docs.python.org/library/stdtypes.html#string-methods" class="uri">https://docs.python.org/library/stdtypes.html#string-methods</a>.</p>
<p>Llamar a un <em>método</em> es similar a llamar una función (esta toma argumentos y devuelve un valor) pero la sintaxis es diferente. Llamamos a un método uniendo el nombre del método al de la variable, usando un punto como delimitador.</p>
<p>Por ejemplo, el método <code>upper</code> toma una cadena y devuelve una nueva cadena con todas las letras en mayúscula:</p>
<p> </p>
<p>En vez de la sintaxis de función <code>upper(word)</code>, éste utiliza la sintaxis de método <code>word.upper()</code>.</p>
<p></p>
<pre class="python"><code>&gt;&gt;&gt; palabra = &#39;banana&#39;
&gt;&gt;&gt; nueva_palabra = palabra.upper()
&gt;&gt;&gt; print(nueva_palabra)
BANANA</code></pre>
<p>Esta forma de notación con punto especifica el nombre del método, <code>upper</code>, y el nombre de la cadena al que se le aplicará el método, <code>palabra</code>. Los paréntesis vacíos indican que el método no toma argumentos.</p>
<p></p>
<p>Una llamada a un método es conocida como una <em>invocación</em>; en este caso, diríamos que estamos invocando <code>upper</code> en <code>palabra</code>.</p>
<p></p>
<p>Por ejemplo, existe un método de cadena llamado <code>find</code> que busca la posición de una cadena dentro de otra:</p>
<pre class="python"><code>&gt;&gt;&gt; palabra = &#39;banana&#39;
&gt;&gt;&gt; indice = palabra.find(&#39;a&#39;)
&gt;&gt;&gt; print(indice)
1</code></pre>
<p>En este ejemplo, invocamos <code>find</code> en <code>palabra</code> y pasamos la letra que estamos buscando como un parámetro.</p>
<p>El método <code>find</code> puede encontrar subcadenas así como caracteres:</p>
<pre class="python"><code>&gt;&gt;&gt; palabra.find(&#39;na&#39;)
2</code></pre>
<p>También puede tomar como un segundo argumento el índice desde donde debe empezar:</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; palabra.find(&#39;na&#39;, 3)
4</code></pre>
<p>Una tarea común es eliminar los espacios en blanco (espacios, tabs, o nuevas líneas) en el inicio y el final de una cadena usando el método <code>strip</code>:</p>
<pre class="python"><code>&gt;&gt;&gt; linea = &#39;  Aquí vamos  &#39;
&gt;&gt;&gt; linea.strip()
&#39;Aquí vamos&#39;</code></pre>
<p>Algunos métodos como <em>startswith</em> devuelven valores booleanos.</p>
<pre class="python"><code>&gt;&gt;&gt; linea = &#39;Que tengas un buen día&#39;
&gt;&gt;&gt; linea.startswith(&#39;Que&#39;)
True
&gt;&gt;&gt; linea.startswith(&#39;q&#39;)
False</code></pre>
<p>Puedes notar que <code>startswith</code> requiere que el formato (mayúsculas y minúsculas) coincida, de modo que a veces tendremos que tomar la línea y cambiarla completamente a minúsculas antes de hacer la verificación, utilizando el método <code>lower</code>.</p>
<pre class="python"><code>&gt;&gt;&gt; linea = &#39;Que tengas un buen día&#39;
&gt;&gt;&gt; linea.startswith(&#39;q&#39;)
False
&gt;&gt;&gt; linea.lower()
&#39;que tengas un buen día&#39;
&gt;&gt;&gt; linea.lower().startswith(&#39;q&#39;)
True</code></pre>
<p>En el último ejemplo, el método <code>lower</code> es llamado y después usamos <code>startswith</code> para ver si la cadena resultante en minúsculas comienza con la letra &quot;q&quot;. Siempre y cuando seamos cuidadosos con el orden, podemos hacer múltiples llamadas a métodos en una sola expresión.</p>
<p> </p>
<p><strong>Ejercicio 4: Hay un método de cadenas llamado <code>count</code> que es similar a la función del ejercicio previo. Lee la documentación de este método en:</strong></p>
<p><a href="https://docs.python.org/library/stdtypes.html#string-methods" class="uri">https://docs.python.org/library/stdtypes.html#string-methods</a></p>
<p><strong>Escribe una invocación que cuenta el número de veces que una letra aparece en &quot;banana&quot;.</strong></p>
<h2 id="analizando-cadenas">Analizando cadenas</h2>
<p>Frecuentemente, queremos examinar una cadena para encontrar una subcadena. Por ejemplo, si se nos presentaran una seria de líneas con el siguiente formato:</p>
<p><code>From stephen.marquard@</code><em><code>uct.ac.za</code></em><code> Sat Jan  5 09:14:16 2008</code></p>
<p>y quisiéramos obtener únicamente la segunda parte de la dirección de correo (esto es, <code>uct.ac.za</code>) de cada línea, podemos hacer esto utilizando el método <code>find</code> y una parte de la cadena.</p>
<p>Primero tenemos que encontrar la posición de la arroba en la cadena. Después, tenemos que encontrar la posición del primer espacio <em>después</em> de la arroba. Y después partiremos la cadena para extraer la porción de la cadena que estamos buscando.</p>
<pre class="python"><code>&gt;&gt;&gt; dato = &#39;From stephen.marquard@uct.ac.za Sat Jan  5 09:14:16 2008&#39;
&gt;&gt;&gt; arrobapos = dato.find(&#39;@&#39;)
&gt;&gt;&gt; print(arrobapos)
21
&gt;&gt;&gt; espos = dato.find(&#39; &#39;,arrobapos)
&gt;&gt;&gt; print(espos)
31
&gt;&gt;&gt; direccion = dato[arrobapos+1:espos]
&gt;&gt;&gt; print(direccion)
uct.ac.za
&gt;&gt;&gt;</code></pre>
<p>Utilizamos una versión del método <code>find</code> que nos permite especificar la posición en la cadena desde donde queremos que <code>find</code> comience a buscar. Cuando recortamos una parte de una cadena, extraemos los caracteres desde &quot;uno después de la arroba hasta, <em>pero no incluyendo</em>, el carácter de espacio&quot;.</p>
<p>La documentación del método <code>find</code> está disponible en</p>
<p><a href="https://docs.python.org/library/stdtypes.html#string-methods" class="uri">https://docs.python.org/library/stdtypes.html#string-methods</a>.</p>
<h2 id="el-operador-de-formato">El operador de formato</h2>
<p> </p>
<p>El <em>operador de formato</em> <code>%</code> nos permite construir cadenas, reemplazando partes de las cadenas con datos almacenados en variables. Cuando lo aplicamos a enteros, <code>%</code> es el operador módulo. Pero cuando es aplicado a una cadena, <code>%</code> es el operador de formato.</p>
<p></p>
<p>El primer operando es la <em>cadena a formatear</em>, la cual contiene una o más <em>secuencias de formato</em> que especifican cómo el segundo operando es formateado. El resultado es una cadena.</p>
<p></p>
<p>Por ejemplo, la secuencia de formato <code>%d</code> significa que el segundo operando debería ser formateado como un entero (&quot;d&quot; significa &quot;decimal&quot;):</p>
<pre class="python"><code>&gt;&gt;&gt; camellos = 42
&gt;&gt;&gt; &#39;%d&#39; % camellos
&#39;42&#39;</code></pre>
<p>El resultado es la cadena '42', el cual no debe ser confundido con el valor entero 42.</p>
<p>Una secuencia de formato puede aparecer en cualquier lugar en la cadena, así que puedes meter un valor en una frase:</p>
<pre class="python"><code>&gt;&gt;&gt; camellos = 42
&gt;&gt;&gt; &#39;Yo he visto %d camellos.&#39; % camellos
&#39;Yo he visto 42 camellos.&#39;</code></pre>
<p>Si hay más de una secuencia de formato en la cadena, el segundo argumento tiene que ser una tupla<a href="#fn1" class="footnoteRef" id="fnref1"><sup>1</sup></a>. Cada secuencia de formato es relacionada con un elemento de la tupla, en orden.</p>
<p>El siguiente ejemplo usa <code>%d</code> para formatear un entero, <code>%g</code> para formatear un número de punto flotante (no preguntes por qué), y <code>%s</code> para formatear una cadena:</p>
<pre class="python"><code>&gt;&gt;&gt; &#39;En %d años yo he visto %g %s.&#39; % (3, 0.1, &#39;camellos&#39;)
&#39;En 3 años yo he visto 0.1 camellos.&#39;</code></pre>
<p>El número de elementos en la tupla debe coincidir con el número de secuencias de formato en la cadena. El tipo de los elementos también debe coincidir con la secuencia de formato:</p>
<p> </p>
<pre class="python"><code>&gt;&gt;&gt; &#39;%d %d %d&#39; % (1, 2)
TypeError: not enough arguments for format string
&gt;&gt;&gt; &#39;%d&#39; % &#39;dolares&#39;
TypeError: %d format: a number is required, not str</code></pre>
<p>En el primer ejemplo, no hay suficientes elementos; en el segundo, el elemento es de un tipo incorrecto.</p>
<p>El operador de formato es poderoso, pero puede ser difícil de usar. Puedes leer más al respecto en</p>
<p><a href="https://docs.python.org/library/stdtypes.html#printf-style-string-formatting" class="uri">https://docs.python.org/library/stdtypes.html#printf-style-string-formatting</a>.</p>
<h2 id="depuración">Depuración</h2>
<p></p>
<p>Una habilidad que debes desarrollar cuando programas es siempre preguntarte a ti mismo, &quot;¿Qué podría fallar aquí?&quot; o alternativamente, &quot;¿Qué cosa ilógica podría hacer un usuario para hacer fallar nuestro (aparentemente) perfecto programa?&quot;</p>
<p>Por ejemplo, observa el programa que utilizamos para demostrar el bucle <code>while</code> en el capítulo de iteraciones:</p>
<pre class="python"><code>while True:
    linea = input(&#39;&gt; &#39;)
    if linea[0] == &#39;#&#39; :
        continue
    if linea == &#39;fin&#39;:
        break
    print(linea)
print(&#39;¡Terminado!&#39;)

# Code: http://www.py4e.com/code3/copytildone2.py</code></pre>
<p>Mira lo que pasa cuando el usuario introduce una línea vacía como entrada:</p>
<pre class="python"><code>&gt; hello there
hello there
&gt; # don&#39;t print this
&gt; print this!
print this!
&gt;
Traceback (most recent call last):
  File &quot;copytildone.py&quot;, line 3, in &lt;module&gt;
    if line[0] == &#39;#&#39;:
IndexError: string index out of range</code></pre>
<p>El código funciona bien hasta que se presenta una línea vacía. En ese momento no hay un carácter cero, por lo que obtenemos una traza de error (traceback). Existen dos soluciones a esto para convertir la línea tres en &quot;segura&quot;, incluso si la línea está vacía.</p>
<p>Una posibilidad es simplemente usar el método <code>startswith</code> que devuelve <code>False</code> si la cadena está vacía.</p>
<pre class="python"><code>if line.startswith(&#39;#&#39;):</code></pre>
<p> </p>
<p>Otra forma segura es escribir una sentencia <code>if</code> utilizando el patrón <em>guardián</em> y asegurarse que la segunda expresión lógica es evaluada sólo cuando hay al menos un carácter en la cadena:</p>
<pre class="python"><code>if len(line) &gt; 0 and line[0] == &#39;#&#39;:</code></pre>
<h2 id="glosario">Glosario</h2>
<dl>
<dt>contador</dt>
<dd>Una variable utilizada para contar algo, usualmente inicializada a cero y luego incrementada.
</dd>
<dt>cadena vacía</dt>
<dd>una cadena sin caracteres y de tamaño 0, representada por dos comillas sencillas.
</dd>
<dt>operador de formato</dt>
<dd>Un operador, <code>%</code>, que toma una cadena de formato y una tupla y genera una cadena que incluye los elementos de la tupla formateados como se especifica en la cadena de formato.
</dd>
<dt>secuencia de formato</dt>
<dd>Una secuencia de caracteres en una cadena a formatear, como <code>%d</code>, que especifica cómo un valor debe ser formateado.
</dd>
<dt>cadena a formatear</dt>
<dd>Una cadena, usado con el operador de formato, que contiene secuencias de formato.
</dd>
<dt>flag (bandera)</dt>
<dd>Una variable booleana utilizada para indicar si una condición es verdadera o falsa.
</dd>
<dt>invocación</dt>
<dd>Una sentencia que llama un método.
</dd>
<dt>inmutable</dt>
<dd>La propiedad de una secuencia cuyos elementos no pueden ser asignados.
</dd>
<dt>índice</dt>
<dd>Un valor entero utilizado para seleccionar un ítem en una secuencia, tal como un carácter en una cadena.
</dd>
<dt>ítem</dt>
<dd>Uno de los valores en una secuencia.
</dd>
<dt>método</dt>
<dd>Una función que está asociada a un objeto y es llamada utilizando la notación de punto.
</dd>
<dt>objeto</dt>
<dd>Algo a lo que una variable puede referirse. Por ahora, puedes usar &quot;objeto&quot; y &quot;valor&quot; indistintamente.
</dd>
<dt>búsqueda</dt>
<dd>Un patrón de recorrido que se detiene cuando encuentra lo que está buscando.
</dd>
<dt>secuencia</dt>
<dd>Un conjunto ordenado; esto es, un conjunto de valores donde cada valor es identificado por un índice entero.
</dd>
<dt>parte (slice)</dt>
<dd>Una parte de una cadena especificado por un rango de índices.
</dd>
<dt>atravesar</dt>
<dd>Iterar a través de los ítems de una secuencia, ejecutando una operación similar en cada uno.
</dd>
</dl>
<h2 id="ejercicios">Ejercicios</h2>
<p><strong>Ejercicio 5: Toma el siguiente código en Python que almacena una cadena:</strong></p>
<p><code>str = 'X-DSPAM-Confidence:</code><strong><code>0.8475</code></strong><code>'</code></p>
<p><strong>Utiliza <code>find</code> y una parte de la cadena para extraer la porción de la cadena después del carácter dos puntos y después utiliza la función <code>float</code> para convertir la cadena extraída en un número de punto flotante.</strong></p>
<p> </p>
<p><strong>Ejercicio 6: Lee la documentación de los métodos de cadenas en <a href="https://docs.python.org/library/stdtypes.html#string-methods" class="uri">https://docs.python.org/library/stdtypes.html#string-methods</a> Quizá quieras experimentar con algunos de ellos para asegurarte de entender como funcionan. <code>strip</code> y <code>replace</code> son particularmente útiles.</strong></p>
<p><strong>La documentación usa una sintaxis que puede ser confusa. Por ejemplo, en <code>find(sub[, start[, end]])</code>, los corchetes indican argumentos opcionales. De modo que <code>sub</code> es requerido, pero <code>start</code> es opcional, y si se incluye <code>start</code>, entonces <code>end</code> es opcional.</strong></p>
<div class="footnotes">
<hr />
<ol>
<li id="fn1"><p>Una tupla es una secuencia de valores separados por comas dentro de un par de paréntesis. Veremos tuplas en el Capítulo 10<a href="#fnref1">↩</a></p></li>
</ol>
</div>
</body>
</html>
<?php if ( file_exists("../bookfoot.php") ) {
  $HTML_FILE = basename(__FILE__);
  $HTML = ob_get_contents();
  ob_end_clean();
  require_once "../bookfoot.php";
}?>
