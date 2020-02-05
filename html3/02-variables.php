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
<h1 id="variables-expresiones-y-sentencias">Variables, expresiones y sentencias</h1>
<h2 id="valores-y-tipos">Valores y tipos</h2>
<p>  </p>
<p>Un <em>valor</em> es una de las cosas básicas que utiliza un programa, como una letra o un número. Los valores que hemos visto hasta ahora han sido <code>1</code>, <code>2</code>, y &quot;¡Hola, mundo!&quot;</p>
<p>Esos valores pertenecen a <em>tipos</em> diferentes: <code>2</code> es un entero (int), y &quot;¡Hola, mundo!&quot; es una <em>cadena</em> (string), que recibe ese nombre porque contiene una &quot;cadena&quot; de letras. Tú (y el intérprete) podéis identificar las cadenas porque van encerradas entre comillas.</p>
<p></p>
<p>La sentencia <code>print</code> también funciona con enteros. Vamos a usar el comando <code>python</code> para iniciar el intérprete.</p>
<pre class="python"><code>python
&gt;&gt;&gt; print(4)
4</code></pre>
<p>Si no estás seguro de qué tipo de valor estás manejando, el intérprete te lo puede decir.</p>
<pre class="python trinket" height="160"><code>&gt;&gt;&gt; type(&#39;&#39;¡Hola, mundo!)
&lt;class &#39;str&#39;&gt;
&gt;&gt;&gt; type(17)
&lt;class &#39;int&#39;&gt;</code></pre>
<p>Not surprisingly, strings belong to the type <code>str</code> and integers belong to the type <code>int</code>. Less obviously, numbers with a decimal point belong to a type called <code>float</code>, because these numbers are represented in a format called <em>floating point</em>.</p>
<p>      </p>
<pre class="python trinket" height="120"><code>&gt;&gt;&gt; type(3.2)
&lt;class &#39;float&#39;&gt;</code></pre>
<p>¿Qué ocurre con valores como &quot;17&quot; y &quot;3.2&quot;? Parecen números, pero van entre comillas como las cadenas.</p>
<p></p>
<pre class="python trinket" height="160"><code>&gt;&gt;&gt; type(&#39;17&#39;)
&lt;class &#39;str&#39;&gt;
&gt;&gt;&gt; type(&#39;3.2&#39;)
&lt;class &#39;str&#39;&gt;</code></pre>
<p>Son cadenas.</p>
<p>Cuando escribes un entero grande, puede que te sientas tentado a usar comas o puntos para separarlo en grupos de tres dígitos, como en <code>1,000,000</code> <a href="#fn1" class="footnoteRef" id="fnref1"><sup>1</sup></a>. Eso no es un entero válido en Python, pero en cambio sí que resulta válido algo como:</p>
<pre class="python trinket" height="120"><code>&gt;&gt;&gt; print(1,000,000)
1 0 0</code></pre>
<p>Bien, ha funcionado. ¡Pero eso no era lo que esperábamos!. Python interpreta <code>1,000,000</code> como una secuencia de enteros separados por comas, así que lo imprime con espacios en medio.</p>
<p>  </p>
<p>Éste es el primer ejemplo que hemos visto de un error semántico: el código funciona sin producir ningún mensaje de error, pero no hace su trabajo &quot;correctamente&quot;.</p>
<h2 id="variables">Variables</h2>
<p>  </p>
<p>Una de las características más potentes de un lenguaje de programación es la capacidad de manipular <em>variables</em>. Una variable es un nombre que se refiere a un valor.</p>
<p>Una <em>sentencia de asignación</em> crea variables nuevas y las da valores:</p>
<pre class="python"><code>&gt;&gt;&gt; mensaje = &#39;Y ahora algo completamente diferente&#39;
&gt;&gt;&gt; n = 17
&gt;&gt;&gt; pi = 3.1415926535897931</code></pre>
<p>Este ejemplo hace tres asignaciones. La primera asigna una cadena a una variable nueva llamada <code>mensaje</code>; la segunda asigna el entero <code>17</code> a <code>n</code>; la tercera asigna el valor (aproximado) de <span class="math inline"><em>π</em></span> a <code>pi</code>.</p>
<p>Para mostrar el valor de una variable, se puede usar la sentencia print:</p>
<pre class="python"><code>&gt;&gt;&gt; print(n)
17
&gt;&gt;&gt; print(pi)
3.141592653589793</code></pre>
<p>El tipo de una variable es el tipo del valor al que se refiere.</p>
<pre class="python"><code>&gt;&gt;&gt; type(mensaje)
&lt;class &#39;str&#39;&gt;
&gt;&gt;&gt; type(n)
&lt;class &#39;int&#39;&gt;
&gt;&gt;&gt; type(pi)
&lt;class &#39;float&#39;&gt;</code></pre>
<h2 id="nombres-de-variables-y-palabras-claves">Nombres de variables y palabras claves</h2>
<p></p>
<p>Los programadores generalmente eligen nombres para sus variables que tengan sentido y documenten para qué se usa esa variable.</p>
<p>Los nombres de las variables pueden ser arbitrariamente largos. Pueden contener tanto letras como números, pero no pueden comenzar con un número. Se pueden usar letras mayúsculas, pero es buena idea comenzar los nombres de las variables con una letras minúscula (veremos por qué más adelante).</p>
<p>El carácter guión-bajo (<code>_</code>) puede utilizarse en un nombre. A menudo se utiliza en nombres con múltiples palabras, como en <code>mi_nombre</code> o <code>velocidad_de_golondrina_sin_carga</code>. Los nombres de las variables pueden comenzar con un carácter guión-bajo, pero generalmente se evita usarlo así a menos que se esté escribiendo código para librerías que luego utilizarán otros.</p>
<p></p>
<p>Si se le da a una variable un nombre no permitido, se obtiene un error de sintaxis:</p>
<pre class="python trinket" height="450"><code>&gt;&gt;&gt; 76trombones = &#39;gran desfile&#39;
SyntaxError: invalid syntax
&gt;&gt;&gt; more@ = 1000000
SyntaxError: invalid syntax
&gt;&gt;&gt; class = &#39;Teorema avanzado de Zymurgy&#39;
SyntaxError: invalid syntax</code></pre>
<p><code>76trombones</code> es incorrecto porque comienza por un número. <code>more@</code> es incorrecto porque contiene un carácter no premitido, <code>@</code>. Pero, ¿qué es lo que está mal en <code>class</code>?</p>
<p>Pues resulta que <code>class</code> es una de las <em>palabras clave</em> de Python. El intérprete usa palabras clave para reconocer la estructura del programa, y esas palabras no pueden ser utilizadas como nombres de variables.</p>
<p></p>
<p>Python reserva 33 palabras claves para su propio uso:</p>
<pre><code>and       del       from      None      True
as        elif      global    nonlocal  try
assert    else      if        not       while
break     except    import    or        with
class     False     in        pass      yield
continue  finally   is        raise
def       for       lambda    return</code></pre>
<p>Puede que quieras tener esta lista a mano. Si el intérprete se queja por el nombre de una de tus variables y no sabes por qué, comprueba si ese nombre está en esta lista.</p>
<h2 id="sentencias">Sentencias</h2>
<p>Una <em>sentencia</em> es una unidad de código que el intérprete de Python puede ejecutar. Hemos visto hasta ahora dos tipos de sentencia: print y las asignaciones.</p>
<p>  </p>
<p>Cuando escribes una sentencia en modo interactivo, el intérprete la ejecuta y muestra el resultado, si es que lo hay.</p>
<p>Un script normalmente contiene una secuencia de sentencias. Si hay más de una sentencia, los resultados aparecen de uno en uno según se van ejecutando las sentencias.</p>
<p>Por ejemplo, el script</p>
<pre class="python"><code>print(1)
x = 2
print(x)</code></pre>
<p>produce la salida</p>
<pre><code>1
2</code></pre>
<p>La sentencia de asignación no produce ninguna salida.</p>
<h2 id="operadores-y-operandos">Operadores y operandos</h2>
<p>   </p>
<p><em>Los operadores</em> son símbolos especiales que representan cálculos, como la suma o la multiplicación. Los valores a los cuales se aplican esos operadores reciben el nombre de <em>operandos</em>.</p>
<p>Los operadores <code>+</code>, <code>-</code>, , <code>/</code>, y <code>\*</code> realizan sumas, restas, multiplicaciones, divisiones y exponenciación (elevar un número a una potencia), como se muestra en los ejemplos siguientes:</p>
<pre class="python"><code>20+32
hour-1
hour*60+minute
minute/60
5**2
(5+9)*(15-7)</code></pre>
<p>Ha habido un cambio en el operador de división entre Python 2.x y Python 3.x. En Python 3.x, el resultado de esta división es un resultado de punto flotante:</p>
<pre class="python trinket" height="160"><code>&gt;&gt;&gt; minute = 59
&gt;&gt;&gt; minute/60
0.9833333333333333</code></pre>
<p>El operador de división en Python 2.0 dividiría dos enteros y truncar el resultado a un entero:</p>
<pre class="python"><code>&gt;&gt;&gt; minute = 59
&gt;&gt;&gt; minute/60
0</code></pre>
<p>Para obtener la misma respuesta en Python 3.0 use división dividida (<code>//</code> integer).</p>
<pre class="python trinket" height="160"><code>&gt;&gt;&gt; minute = 59
&gt;&gt;&gt; minute//60
0</code></pre>
<p>En Python 3, la división de enteros funciona mucho más como cabría esperar. Si ingresaste la expresión en una calculadora.</p>
<p>     </p>
<h2 id="expresiones">Expresiones</h2>
<p>Una <em>expresión</em> es una combinación de valores, variables y operadores. Un valor por si mismo se considera una expresión, y también lo es una variable, así que las siguientes expresiones son todas válidas (asumiendo que la variable <code>x</code> tenga un valor asignado):</p>
<p> </p>
<pre class="python"><code>17
x
x + 17</code></pre>
<p>Si escribes una expresión en modo interactivo, el intérprete la <em>evalúa</em> y muestra el resultado:</p>
<pre class="python"><code>&gt;&gt;&gt; 1 + 1
2</code></pre>
<p>Sin embargo, en un script, ¡una expresión por si misma no hace nada! Esto a menudo puede producir confusión entre los principiantes.</p>
<p><strong>Ejercicio 1: Escribe las siguientes sentencias en el intérprete de Python para comprobar qué hacen:</strong></p>
<pre class="python"><code>5
x = 5
x + 1</code></pre>
<h2 id="orden-de-las-operaciones">Orden de las operaciones</h2>
<p>  </p>
<p>Cuando en una expresión aparece más de un operador, el orden de evaluación depende de las <em>reglas de precedencia</em>. Para los operadores matemáticos, Python sigue las convenciones matemáticas. El acrónimo <em>PEMDSR</em> resulta útil para recordar esas reglas:</p>
<p></p>
<ul>
<li><p>Los <em>P</em>aréntesis tienen el nivel superior de precedencia, y pueden usarse para forzar a que una expresión sea evaluada en el orden que se quiera. Dado que las expresiones entre paréntesis son evaluadas primero, <code>2 * (3-1)</code> es 4, y <code>(1+1)**(5-2)</code> es 8. Se pueden usar también paréntesis para hacer una expresión más sencilla de leer, incluso si el resultado de la misma no varía por ello, como en <code>(minuto * 100) / 60</code>.</p></li>
<li><p>La <em>E</em>xponenciación (elevar un número a una potencia) tiene el siguiente nivel más alto de precedencia, de modo que <code>2**1+1</code> es 3, no 4, y <code>3*1**3</code> es 3, no 27.</p></li>
<li><p>La <em>M</em>ultiplicación y la <em>D</em>ivisión tienen la misma precedencia, que es superior a la de la <em>S</em>uma y la <em>R</em>esta, que también tienen entre si el mismo nivel de precedencia. Así que <code>2*3-1</code> es 5, no 4, y <code>6+4/2</code> es 8, no 5.</p></li>
<li><p>Los operadores con igual precedencia son evaluados de izquierda a derecha. Así que la expresión <code>5-3-1</code> es 1 y no 3, ya que <code>5-3</code> se evalúa antes, y después se resta <code>1</code> de <code>2</code>.</p></li>
</ul>
<p>En caso de duda, añade siempre paréntesis a tus expresiones para asegurarte de que las operaciones se realizan en el orden que tú quieres.</p>
<h2 id="operador-módulo">Operador módulo</h2>
<p> </p>
<p>El <em>operador módulo</em> trabaja con enteros y obtiene el resto de la operación consistente en dividir el primer operando por el segundo. En Python, el operador módulo es un signo de porcentaje (<code>%</code>). La sintaxis es la misma que se usa para los demás operadores:</p>
<pre class="python trinket" height="240"><code>&gt;&gt;&gt; quotient = 7 // 3
&gt;&gt;&gt; print(quotient)
2
&gt;&gt;&gt; remainder = 7 % 3
&gt;&gt;&gt; print(remainder)
1</code></pre>
<p>Así que 7 dividido por 3 es 2 y nos sobra 1.</p>
<p>El operador módulo resulta ser sorprendentemente útil. Por ejemplo, puedes comprobar si un número es divisible por otro—si <code>x % y</code> es cero, entonces <code>x</code> es divisible por <code>y</code>.</p>
<p></p>
<p>También se puede extraer el dígito más a la derecha de los que componen un número. Por ejemplo, <code>x % 10</code> obtiene el dígito que está más a la derecha de <code>x</code> (en base 10). De forma similar, <code>x % 100</code> obtiene los dos últimos dígitos.</p>
<h2 id="operaciones-con-cadenas">Operaciones con cadenas</h2>
<p> </p>
<p>El operador <code>+</code> funciona con las cadenas, pero no realiza una suma en el sentido matemático. En vez de eso, realiza una <em>concatenación</em>, que quiere decir que une ambas cadenas, enlazando el final de la primera con el principio de la segunda. Por ejemplo:</p>
<p></p>
<pre class="python"><code>&gt;&gt;&gt; primero = 10
&gt;&gt;&gt; segundo = 15
&gt;&gt;&gt; print(primero+segundo)
25
&gt;&gt;&gt; primero = &#39;100&#39;
&gt;&gt;&gt; segundo = &#39;150&#39;
&gt;&gt;&gt; print(primero + segundo)
100150</code></pre>
<p>La salida de este programa es <code>100150</code>.</p>
<p>El operador <code>*</code> también trabaja con cadenas multiplicando el contenido de una cadena por un entero. Por ejemplo:</p>
<pre class="python"><code>&gt;&gt;&gt; primero = &#39;Test &#39;
&gt;&gt;&gt; second = 3
&gt;&gt;&gt; print(primero * second)
Test Test Test</code></pre>
<h2 id="petición-de-información-al-usuario">Petición de información al usuario</h2>
<p></p>
<p>A veces necesitaremos que sea el usuario quien nos proporcione el valor para una variable, a través del teclado. Python proporciona una función interna llamada <code>input</code> que recibe la entrada desde el teclado. Cuando se llama a esa función, el programa se detiene y espera a que el usuario escriba algo. Cuando el usuario pulsa <code>Retorno</code> o <code>Intro</code>, el programa continúa y <code>input</code> devuelve como una cadena aquello que el usuario escribió.</p>
<p>  </p>
<pre class="python"><code>&gt;&gt;&gt; entrada = input()
Cualquier cosa ridícula
&gt;&gt;&gt; print(entrada)
Cualquier cosa ridícula</code></pre>
<p>Antes de recibir cualquier dato desde el usuario, es buena idea escribir un mensaje explicándole qué debe introducir. Se puede pasar una cadena a <code>input</code>, que será mostrada al usuario antes de que el programa se detenga para recibir su entrada:</p>
<p></p>
<pre class="python"><code>&gt;&gt;&gt; nombre = input(&#39;¿Cómo te llamas?\n&#39;)
¿Cómo te llamas?
Chuck
&gt;&gt;&gt; print(nombre)
Chuck</code></pre>
<p>La secuencia <code>\n</code> al final del mensaje representa un <em>newline</em>, que es un carácter especial que provoca un salto de línea. Por eso la entrada del usuario aparece debajo de nuestro mensaje.</p>
<p></p>
<p>Si esperas que el usuario escriba un entero, puedes intentar convertir el valor de retorno a <code>int</code> usando la función <code>int()</code>:</p>
<pre class="python"><code>&gt;&gt;&gt; prompt = &#39;¿Cual.... es la velocidad de vuelo de una golondrina sin carga?\n&#39;
&gt;&gt;&gt; velocidad = input(prompt)
¿Cual.... es la velocidad de vuelo de una golondrina sin carga?
17
&gt;&gt;&gt; int(velocidad)
17
&gt;&gt;&gt; int(velocidad) + 5
22</code></pre>
<p>Pero si el usuario escribe algo que no sea una cadena de dígitos, obtendrás un error:</p>
<pre class="python"><code>&gt;&gt;&gt; velocidad = input(prompt)
¿Cual.... es la velocidad de vuelo de una golondrina sin carga?
¿Te refieres a una golondrina africana o a una europea?
&gt;&gt;&gt; int(velocidad)
ValueError: invalid literal for int()</code></pre>
<p>Veremos cómo controlar este tipo de errores más adelante.</p>
<p> </p>
<h2 id="comentarios">Comentarios</h2>
<p></p>
<p>A medida que los programas se van volviendo más grandes y complicados, se vuelven más difíciles de leer. Los lenguajes formales son densos, y a menudo es complicado mirar un trozo de código e imaginarse qué es lo que hace, o por qué.</p>
<p>Por eso es buena idea añadir notas a tus programas, para explicar en un lenguaje normal qué es lo que el programa está haciendo. Estas notas reciben el nombre de <em>comentarios</em>, y en Python comienzan con el símbolo <code>#</code>:</p>
<pre class="python"><code># calcula el porcentaje de hora transcurrido
porcentaje = (minuto * 100) / 60</code></pre>
<p>En este caso, el comentario aparece como una línea completa. Pero también puedes poner comentarios al final de una línea</p>
<pre class="python"><code>porcentaje = (minuto * 100) / 60     # porcentaje de una hora</code></pre>
<p>Todo lo que va desde <code>#</code> hasta el final de la línea es ignorado—no afecta para nada al programa.</p>
<p>Las comentarios son más útiles cuando documentan características del código que no resultan obvias. Es razonable asumir que el lector puede descifrar <em>qué</em> es lo que el código hace; es mucho más útil explicarle <em>por qué</em>.</p>
<p>Este comentario es redundante con el código e inútil:</p>
<pre class="python"><code>v = 5     # asigna 5 a v</code></pre>
<p>Este comentario contiene información útil que no está en el código:</p>
<pre class="python"><code>v = 5     # velocidad en metros/segundo.</code></pre>
<p>Elegir nombres adecuados para las variables puede reducir la necesidad de comentarios, pero los nombres largos también pueden ocasionar que las expresiones complejas sean difíciles de leer, así que hay que conseguir una solución de compromiso.</p>
<h2 id="elección-de-nombres-de-variables-mnemónicos">Elección de nombres de variables mnemónicos</h2>
<p></p>
<p>Mientras sigas las sencillas reglas de nombrado de variables y evites las palabras reservadas, dispondrás de una gran variedad de opciones para poner nombres a tus variables. Al principio, esa diversidad puede llegar a resultarte confusa, tanto al leer un programa como al escribir el tuyo propio. Por ejemplo, los tres programas siguientes son idénticos en cuanto a la función que realizan, pero muy diferentes cuando los lees e intentas entenderlos.</p>
<pre class="python"><code>a = 35.0
b = 12.50
c = a * b
print(c)</code></pre>
<pre class="python"><code>horas = 35.0
tarifa = 12.50
salario = horas * tarifa
print(salario)</code></pre>
<pre class="python"><code>x1q3z9ahd = 35.0
x1q3z9afd = 12.50
x1q3p9afd = x1q3z9ahd * x1q3z9afd
print(x1q3p9afd)</code></pre>
<p>El intérprete de Python ve los tres programas como <em>exactamente idénticos</em>, pero los humanos ven y asimilan estos programas de forma bastante diferente. Los humanos entenderán más rápidamente el <em>objetivo</em> del segundo programa, ya que el programador ha elegido nombres de variables que reflejan lo que pretendía de acuerdo al contenido que iba almacenar en cada variable.</p>
<p>Esa sabia elección de nombres de variables se denomina utilizar &quot;nombres de variables mnemónicos&quot;. La palabra <em>mnemónico</em><a href="#fn2" class="footnoteRef" id="fnref2"><sup>2</sup></a> significa &quot;que ayuda a memorizar&quot;. Elegimos nombres de variables mnemónicos para ayudarnos a recordar por qué creamos las variables al principio.</p>
<p>A pesar de que todo esto parezca estupendo, y de que sea una idea muy buena usar nombres de variables mnemónicos, ese tipo de nombres pueden interponerse en el camino de los programadores novatos a la hora de analizar y comprender el código. Esto se debe a que los programadores principiantes no han memorizado aún las palabras reservadas (sólo hay 33), y a veces variables con nombres que son demasiado descriptivos pueden llegar a parecerles parte del lenguaje y no simplemente nombres de variable bien elegidos<a href="#fn3" class="footnoteRef" id="fnref3"><sup>3</sup></a>.</p>
<p>Echa un vistazo rápido al siguiente código de ejemplo en Python, que se mueve en bucle a través de un conjunto de datos. Trataremos los bucles pronto, pero por ahora tan sólo trata de entender su significado:</p>
<pre class="python"><code>for word in words:
    print(word)</code></pre>
<p>¿Qué ocurre aquí? ¿Cuáles de las piezas (for, word, in, etc.) son palabras reservadas y cuáles son simplemente nombres de variables? ¿Acaso Python comprende de un modo básico la noción de palabras (<code>words</code>)? Los programadores novatos tienen problemas separando qué parte del código <em>debe</em> mantenerse tal como está en este ejemplo y qué partes son simplemente elección del programador.</p>
<p>El código siguiente es equivalente al de arriba:</p>
<pre class="python"><code>for slice in pizza:
    print(slice)</code></pre>
<p>Para los principiantes es más fácil estudiar este código y saber qué partes son palabras reservadas definidas por Python y qué partes son simplemente nombres de variables elegidas por el programador. Está bastante claro que Python no entiende nada de pizza ni de porciones, ni del hecho de que una pizza consiste en un conjunto de una o más porciones.</p>
<p>Pero si nuestro programa lo que realmente va a hacer es leer datos y buscar palabras en ellos, <code>pizza</code> y <code>porción</code> son nombres muy poco mnemónicos. Elegirlos como nombres de variables distrae del propósito real del programa.</p>
<p>Dentro de muy poco tiempo, conocerás las palabras reservadas más comunes, y empezarás a ver cómo esas palabras reservadas resaltan sobre las demás:</p>
<pre>
<b>for</b> word <b>in</b> words<b>:</b>
    <b>print</b>(word)
</pre>
<p>Las partes del código que están definidas por Python (<code>for</code>, <code>in</code>, <code>print</code>, y <code>:</code>) están en negrita, mientras que las variables elegidas por el programador (<code>word</code> y <code>words</code>) no lo están. Muchos editores de texto son conscientes de la sintaxis de Python y colorearán las palabras reservadas de forma diferente para darte pistas que te permitan mantener tus variables y las palabras reservadas separados. Dentro de poco empezarás a leer Python y podrás determinar rápidamente qué es una variable y qué es una palabra reservada.</p>
<h2 id="depuración">Depuración</h2>
<p></p>
<p>En este punto, el error de sintaxis que es más probable que cometas será intentar utilizar nombres de variables no válidos, como <code>class</code> y <code>yield</code>, que son palabras clave, o <code>odd~job</code> y <code>US$</code>, que contienen caracteres no válidos.</p>
<p> </p>
<p>Si pones un espacio en un nombre de variable, Python cree que se trata de dos operandos sin ningún operador:</p>
<pre class="python"><code>&gt;&gt;&gt; bad name = 5
SyntaxError: invalid syntax</code></pre>
<pre class="python"><code>&gt;&gt;&gt; month = 09
  File &quot;&lt;stdin&gt;&quot;, line 1
    month = 09
             ^
SyntaxError: invalid token</code></pre>
<p>Para la mayoría de errores de sintaxis, los mensajes de error no ayudan mucho. Los mensajes más comunes son <code>SyntaxError: invalid syntax</code> y <code>SyntaxError: invalid token</code>, ninguno de los cuales resulta muy informativo.</p>
<p>    </p>
<p>El runtime error (error en tiempo de ejecución) que es más probable que obtengas es un &quot;use before def&quot; (uso antes de definir); que significa que estás intentando usar una variable antes de que le hayas asignado un valor. Eso puede ocurrir si escribes mal el nombre de la variable:</p>
<pre class="python"><code>&gt;&gt;&gt; principal = 327.68
&gt;&gt;&gt; interest = principle * rate
NameError: name &#39;principle&#39; is not defined</code></pre>
<p>Los nombres de las variables son sensibles a mayúsculas, así que <code>LaTeX</code> no es lo mismo que <code>latex</code>.</p>
<p>  </p>
<p>En este punto, la causa más probable de un error semántico es el orden de las operaciones. Por ejemplo, para evaluar <span class="math inline">$\frac{1}{2 \pi}$</span>, puedes sentirte tentado a escribir</p>
<pre class="python"><code>&gt;&gt;&gt; 1.0 / 2.0 * pi</code></pre>
<p>Pero la división se evalúa antes, ¡así que obtendrás <span class="math inline"><em>π</em>/2</span>, que no es lo mismo! No hay forma de que Python sepa qué es lo que querías escribir exactamente, así que en este caso no obtienes un mensaje de error; simplemente obtienes una respuesta incorrecta.</p>
<p></p>
<h2 id="glosario">Glosario</h2>
<dl>
<dt>asignación</dt>
<dd><p>Una sentencia que asigna un valor a una variable.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>cadena</dt>
<dd><p>Un tipo que representa secuencias de caracteres.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>concatenar</dt>
<dd><p>Unir dos operandos, uno a continuación del otro.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>comentario</dt>
<dd><p>Información en un programa que se pone para otros programadores (o para cualquiera que lea el código fuente), y no tiene efecto alguno en la ejecución del programa.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>división entera</dt>
<dd><p>La operación que divide dos números y trunca la parte fraccionaria.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>entero</dt>
<dd><p>Un tipo que representa números enteros.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>evaluar</dt>
<dd><p>Simplificar una expresión realizando las operaciones en orden para obtener un único valor.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>expresión</dt>
<dd><p>Una combinación de variables, operadores y valores que representan un único valor resultante.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>mnemónico</dt>
<dd><p>Una ayuda para memorizar. A menudo damos nombres mnemónicos a las variables para ayudarnos a recordar qué está almacenado en ellas.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>palabra clave</dt>
<dd><p>Una palabra reservada que es usada por el compilador para analizar un programa; no se pueden usar palabres clave como <code>if</code>, <code>def</code>, y <code>while</code> como nombres de variables.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>punto flotante</dt>
<dd><p>Un tipo que representa números con parte decimal.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>operador</dt>
<dd><p>Un símbolo especial que representa un cálculo simple, como suma, multiplicación o concatenación de cadenas.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>operador módulo</dt>
<dd><p>Un operador, representado por un signo de porcentaje (<code>%</code>), que funciona con enteros y obtiene el resto cuando un número es dividido por otro.</p>
</dd>
</dl>
<p> </p>
<dl>
<dt>operando</dt>
<dd><p>Uno de los valores con los cuales un operador opera.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>reglas de precedencia</dt>
<dd><p>El conjunto de reglas que gobierna el orden en el cual son evaluadas las expresiones que involucran a múltiples operadores.</p>
</dd>
</dl>
<p> </p>
<dl>
<dt>sentencia</dt>
<dd><p>Una sección del código que representa un comando o acción. Hasta ahora, las únicas sentencias que hemos visto son asignaciones y sentencias print.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>tipo</dt>
<dd><p>Una categoría de valores. Los tipos que hemos visto hasta ahora son enteros (tipo <code>int</code>), números en punto flotante (tipo <code>float</code>), y cadenas (tipo <code>str</code>).</p>
</dd>
</dl>
<p></p>
<dl>
<dt>valor</dt>
<dd><p>Una de las unidades básicas de datos, como un número o una cadena, que un programa manipula.</p>
</dd>
</dl>
<p></p>
<dl>
<dt>variable</dt>
<dd><p>Un nombre que hace referencia a un valor.</p>
</dd>
</dl>
<p></p>
<h2 id="ejercicios">Ejercicios</h2>
<p><strong>Ejercicio 2: Escribe un programa que use <code>input</code> para pedirle al usuario su nombre y luego darle la bienvenida.</strong></p>
<pre><code>Introduzca tu nombre: Chuck
Hola, Chuck</code></pre>
<p><strong>Ejercicio 3: Escribe un programa para pedirle al usuario el número de horas y la tarifa por hora para calcular el salario bruto.</strong></p>
<pre><code>Introduzca Horas: 35
Introduzca Tarifa: 2.75
Salario: 96.25</code></pre>
<p>Por ahora no es necesario preocuparse de que nuestro salario tenga exactamente dos dígitos después del punto decimal. Si quieres, puedes probar la función interna de Python <code>round</code> para redondear de forma adecuada el salario resultante a dos dígitos decimales.</p>
<p><strong>Ejercicio 4: Asume que ejecutamos las siguientes sentencias de asignación:</strong></p>
<pre><code>ancho = 17
alto = 12.0</code></pre>
<p>Para cada una de las expresiones siguientes, escribe el valor de la expresión y el tipo (del valor de la expresión).</p>
<ol style="list-style-type: decimal">
<li><p><code>ancho/2</code></p></li>
<li><p><code>ancho/2.0</code></p></li>
<li><p><code>alto/3</code></p></li>
<li><p><code>1 + 2 * 5</code></p></li>
</ol>
<p>Usa el intérprete de Python para comprobar tus respuestas.</p>
<p><strong>Ejercicio 5: Escribe un programa que le pida al usuario una temperatura en grados Celsius, la convierta a grados Fahrenheit e imprima por pantalla la temperatura convertida.</strong></p>
<div class="footnotes">
<hr />
<ol>
<li id="fn1"><p>En el mundo anglosajón el &quot;separador de millares&quot; es la coma, y no el punto (Nota del trad.)<a href="#fnref1">↩</a></p></li>
<li id="fn2"><p>Consulta <a href="https://es.wikipedia.org/wiki/Mnemonico" class="uri">https://es.wikipedia.org/wiki/Mnemonico</a> para obtener una descripción detallada de la palabra &quot;mnemónico&quot;.<a href="#fnref2">↩</a></p></li>
<li id="fn3"><p>El párrafo anterior se refiere más bien a quienes eligen nombres de variables en inglés, ya que todas las palabras reservadas de Python coinciden con palabras propias de ese idioma (Nota del trad.)<a href="#fnref3">↩</a></p></li>
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
