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
  <meta name="author" content="Explorando la información con Python 3" />
  <title>Python para todos</title>
  <style type="text/css">code{white-space: pre;}</style>
</head>
<body>
<div id="header">
<h1 class="title">Python para todos</h1>
<h2 class="author">Explorando la información con Python 3</h2>
<h3 class="date">Charles R. Severance</h3>
</div>
<h1 id="por-qué-deberías-aprender-a-escribir-programas">¿Por qué deberías aprender a escribir programas?</h1>
<p>Escribir programas (o programar) es una actividad muy creativa y gratificante. Puedes escribir programas por muchas razones, que pueden ir desde mantenerte activo resolviendo un problema de análisis de datos complejo hasta hacerlo por pura diversión ayudando a otros a resolver un enigma. Este libro asume que <em>todo el mundo</em> necesita saber programar, y que una vez que aprendas a programar ya encontrarás qué quieres hacer con esas habilidades recién adquiridas.</p>
<p>En nuestra vida diaria estamos rodeados de computadoras, desde equipos portátiles (laptops) hasta teléfonos móviles (celulares). Podemos pensar en esas computadoras como nuestros &quot;asistentes personales&quot;, que pueden ocuparse de muchas tareas por nosotros. El hardware en los equipos que usamos cada día está hecho esencialmente para hacernos de forma constante la misma pregunta, &quot;¿Qué quieres que haga ahora?&quot;</p>
<div class="figure">
<img src="../images/pda.svg" alt="Personal Digital Assistant" />
<p class="caption">Personal Digital Assistant</p>
</div>
<p>Los programadores suelen añadir un sistema operativo y un conjunto de aplicaciones al hardware y así nos proporcionan un Asistente Digital Personal que es bastante útil y capaz de ayudarnos a realizar una gran variedad de tareas.</p>
<p>Nuestros equipos son rápidos y tienen grandes cantidades de memoria. Podrían resultarnos muy útiles si tan solo supiéramos qué idioma utilizar para explicarle a la computadora qué es lo que queremos que &quot;haga ahora&quot;. Si conociéramos ese idioma, podríamos pedirle al aparato que realizase en nuestro lugar, por ejemplo, tareas repetitivas. Precisamente el tipo de cosas que las computadoras saben hacer mejor suelen ser el tipo de cosas que las personas encontramos pesadas y aburridas.</p>
<p>Por ejemplo, mira los primeros tres párrafos de este capítulos y dime cuál es la palabra que más se repite, y cuántas veces se ha utilizado. Aunque seas capaz de leer y comprender las palabras en pocos segundos, contarlas te resultará casi doloroso, porque la mente humana no fue diseñada para resolver ese tipo de problemas. Para una computadora es justo al revés, leer y comprender texto de un trozo de papel le sería difícil, pero contar las palabras y decirte cuántas veces se ha repetido la más utilizada le resulta muy sencillo:</p>
<pre class="python"><code>    python words.py
    Enter file:words.txt
    to 16</code></pre>
<p>Nuestro &quot;asistente de análisis de información personal&quot; nos dirá enseguida que la palabra &quot;que&quot; se usó nueve veces en los primeros tres párrafos de este capítulo.</p>
<p>El hecho de que los computadores sean buenos en aquellas cosas en las que los humanos no lo son es el motivo por el que necesitas aprender a hablar el &quot;idioma de las computadoras&quot;. Una vez que aprendas este nuevo lenguaje, podrás delegar tareas mundanas en tu compañero (la computadora), lo que te dejará más tiempo para ocuparte de las cosas para las que sólo tú estás capacitado. Tú pondrás la creatividad, intuición y la inventiva en esa alianza.</p>
<h2 id="creatividad-y-motivación">Creatividad y motivación</h2>
<p>A pesar de que este libro no va dirigido a los programadores profesionales, la programación a nivel profesional puede ser un trabajo muy gratificante, tanto a nivel financiero como personal. Crear programas útiles, elegantes e inteligentes para que los usen otros es una actividad muy creativa. Tu computadora o Asistente Digital Personal (PDA), normalmente contiene muchos programas diferentes pertenecientes a distintos grupos de programadores, cada uno de ellos compitiendo por tu atención e interés. Todos ellos hacen lo mejor que saben por adaptarse a tus necesidades y proporcionarte una experiencia de usuario satisfactoria. En ocasiones, cuando elijes un software determinado, sus programadores son directamente recompensados gracias a tu elección.</p>
<p>Si pensamos en los programas como la salida a nivel creativo de grupos de programadores, tal vez la figura siguiente sea una versión más acertada de nuestra PDA:</p>
<div class="figure">
<img src="../images/pda2.svg" alt="Programadores Dirigiéndose a Ti" />
<p class="caption">Programadores Dirigiéndose a Ti</p>
</div>
<p>Por ahora, nuestra primera motivación no es conseguir dinero ni complacer a los usuarios finales, sino simplemente conseguir ser más productivos a nivel personal en el manejo de datos e información que encontremos en nuestras vidas. Cuando se empieza por primera vez, uno es a la vez programador y usuario final de sus propios programas. A medida que se gana habilidad como programador, y la programación se hace más creativa para uno mismo, se puede empezar a pensar en desarrollar programas para los demás.</p>
<h2 id="arquitectura-hardware-de-las-computadoras">Arquitectura hardware de las computadoras</h2>
<p> </p>
<p>Antes de empezar a aprender el lenguaje que deberemos hablar con el fin de darle instrucciones a las computadoras para desarrollar software, tendremos que aprender un poco acerca de cómo están construidos esas máquinas. Si desmontaras tu computadora o <em>smartphone</em> y mirases dentro con atención, encontrarías los siguientes componentes:</p>
<div class="figure">
<img src="../images/arch.svg" alt="Arquitectura Hardware" />
<p class="caption">Arquitectura Hardware</p>
</div>
<p>Las definiciones de alto nivel de esos componentes son las siguientes:</p>
<ul>
<li><p>La <em>Unidad Central de Procesamiento</em> (o CPU) es el componente de la computadora diseñado para estar obsesionado con el &quot;¿qué hago ahora?&quot;. Si tu equipo está dentro de la clasificación de 3.0 Gigahercios, significa que la CPU preguntará &quot;¿Qué hago ahora?&quot; tres mil millones de veces por segundo. Vas a tener que aprender a hablar muy rápido para mantener el ritmo de la CPU.</p></li>
<li><p>La <em>Memoria Principal</em> se usa para almacenar la información que la CPU necesita de forma inmediata. La memoria principal es casi tan rápida como la CPU. Pero la información almacenada en la memoria principal desaparece cuando se apaga el equipo.</p></li>
<li><p>La <em>Memoria Secundaria</em> también se utiliza para almacenar información, pero es mucho más lenta que la memoria principal. La ventaja de la memoria secundaria es que puede almacenar la información incluso cuando el equipo está apagado. Algunos ejemplos de memoria secundaria serían las unidades de disco o las memorias flash (que suelen encontrarse en los <em>pendrives</em> USB y en los reproductores de música portátiles).</p></li>
<li><p>Los <em>Dispositivos de Entrada y Salida</em> son simplemente la pantalla, teclado, ratón, micrófono, altavoz, <em>touchpad</em>, etc. Incluyen cualquier modo de interactuar con una computadora.</p></li>
<li><p>Actualmente, casi todos los equipos tienen una <em>Conexión de Red</em> para recibir información dentro de una red. Podemos pensar en una red como en un lugar donde almacenar y recuperar datos de forma muy lenta, que puede no estar siempre &quot;activo&quot;. Así que, en cierto sentido, la red no es más que un tipo de <em>Memoria Secundaria</em> más lenta y a veces poco fiable.</p></li>
</ul>
<p>Aunque la mayoría de los detalles acerca de cómo funcionan estos componentes es mejor dejársela a los constructores de equipos, resulta útil disponer de cierta terminología para poder referirnos a ellos a la hora de escribir nuestros programas.</p>
<p>Como programador, tu trabajo es usar y orquestar cada uno de esos recursos para resolver el problema del que tengas que ocuparte y analizar los datos de los que dispongas para encontrar la solución. Como programador estarás casi siempre &quot;hablando&quot; con la CPU y diciéndole qué es lo siguiente que debe hacer. A veces le tendrás que pedir a la CPU que use la memoria principal, la secundaria, la red, o los dispositivos de entrada/salida.</p>
<div class="figure">
<img src="../images/arch2.svg" alt="¿Dónde estás?" />
<p class="caption">¿Dónde estás?</p>
</div>
<p>Tú deberás ser la persona que responda a la pregunta &quot;¿Qué hago ahora?&quot; de la CPU. Pero sería muy incómodo encogerse uno mismo hasta los 5 mm. de altura e introducirse dentro de la computadora sólo para poder dar una orden tres mil millones de veces por segundo. Así que en vez de eso, tendrás que escribir las instrucciones por adelantado. Esas instrucciones almacenadas reciben el nombre de <em>programa</em> y el acto de escribirlas y encontrar cuáles son las instrucciones adecuadas, <em>programar</em>.</p>
<h2 id="comprendiendo-la-programación">Comprendiendo la programación</h2>
<p>En el resto de este libro, intentaremos convertirte en una persona experta en el arte de programar. Al terminar, te habrás convertido en un <em>programador</em> - tal vez no en un programador profesional, pero al menos tendrás la capacidad de encarar un problema de análisis de datos/información y desarrollar un programa para resolverlo.</p>
<p></p>
<p>En cierto modo, necesitas dos capacidades para ser programador:</p>
<ul>
<li><p>Primero, necesitas saber un lenguaje de programación (Python) - debes conocer su vocabulario y su gramática. Debes ser capaz de deletrear correctamente las palabras en ese nuevo lenguaje y saber construir &quot;frases&quot; bien formadas.</p></li>
<li><p>Segundo, debes &quot;contar una historia&quot;. Al escribir un relato, combinas palabras y frases para comunicar una idea al lector. Hay una cierta técnica y arte en la construcción de un relato, y la habilidad para escribir relatos mejora escribiendo y recibiendo cierta respuesta. En programación, nuestro programa es el &quot;relato&quot; y el problema que estás tratando de resolver es la &quot;idea&quot;.</p></li>
</ul>
<p>Una vez que aprendas un lenguaje de programación como Python, encontrarás mucho más fácil aprender un segundo lenguaje como JavaScript o C++. Cada nuevo lenguaje tiene un vocabulario y gramática muy diferentes, pero la técnica de resolución de problemas será la misma en todos ellos.</p>
<p>Aprenderás el &quot;vocabulario&quot; y &quot;frases&quot; de Python bastante rápido. Te llevará más tiempo el ser capaz de escribir un programa coherente para resolver un problema totalmente nuevo. Se enseña programación de forma muy similar a como se enseña a escribir. Se empieza leyendo y explicando programas, luego se escriben programas sencillos, y a continuación se van escribiendo programas progresivamente más complejos con el tiempo. En algún momento &quot;encuentras tu musa&quot;, empiezas a descubrir los patrones por ti mismo y empiezas a ver casi de forma instintiva cómo coger un problema y escribir un programa para resolverlo. Y una vez alcanzado ese punto, la programación se convierte en un proceso muy placentero y creativo.</p>
<p>Comenzaremos con el vocabulario y la estructura de los programa en Python. Ten paciencia si la simplicidad de los ejemplos te recuerda a cuando aprendiste a leer.</p>
<h2 id="palabras-y-frases">Palabras y frases</h2>
<p> </p>
<p>A diferencia de los lenguajes humanos, el vocabulario de Python es en realidad bastante reducido. Llamamos a este &quot;vocabulario&quot; las &quot;palabras reservadas&quot;. Se trata de palabras que tienen un significado muy especial para Python. Cuando Python se encuentra estas palabras en un programa, sabe que sólo tienen un único significado para él. Más adelante, cuando escribas programas, podrás usar tus propias palabras con significado, que reciben el nombre de <em>variables</em>. Tendrás gran libertad a la hora de elegir los nombres para tus variables, pero no podrás utilizar ninguna de las palabras reservadas de Python como nombre de una variable.</p>
<p>Cuando se entrena a un perro, se utilizan palabras especiales como &quot;siéntate&quot;, &quot;quieto&quot; y &quot;tráelo&quot;. Cuando te diriges a un perro y no usas ninguna de las palabras reservadas, lo único que consigues es que se te quede mirando con cara extrañada, hasta que le dices una de las palabras que reconoce. Por ejemplo, si dices, &quot;Me gustaría que más gente saliera a caminar para mejorar su salud general&quot;, lo que la mayoría de los perros oirían es: &quot;bla bla bla <em>caminar</em> bla bla bla bla.&quot;. Eso se debe a que &quot;caminar&quot; es una palabra reservada en el lenguaje del perro. Seguramente habrá quien apunte que el lenguaje entre humanos y gatos no dispone de palabras reservadas<a href="#fn1" class="footnoteRef" id="fnref1"><sup>1</sup></a>.</p>
<p>Las palabras reservadas en el lenguaje que utilizan los humanos para hablar con Python son, entre otras, las siguientes:</p>
<pre><code>and       del       global      not       with
as        elif      if          or        yield
assert    else      import      pass
break     except    in          raise
class     finally   is          return
continue  for       lambda      try
def       from      nonlocal    while    </code></pre>
<p>Es decir, a diferencia de un perro, Python ya está completamente entrenado. Cada vez le digas &quot;inténtalo&quot;, Python lo intentará una vez tras otra sin desfallecer.</p>
<p>Aprenderemos cuáles son las palabras reservados y cómo utilizarlas en su momento, pero por ahora nos centraremos en en el equivalente en Python de &quot;habla&quot; (en el lenguaje humano-perro). Lo bueno de pedirle a Python que hable es que podemos incluso decirle lo que debe decir, pasándole un mensaje entre comillas:</p>
<pre class="python"><code>    print(&#39;¡Hola, mundo!&#39;)</code></pre>
<p>Y ya acabamos de escribir nuestra primera oración sintácticamente correcta en Python. La frase comienza con la función <em>print</em> seguida de la cadena de texto que hayamos elegido dentro de comillas simples.</p>
<h2 id="conversando-con-python">Conversando con Python</h2>
<p>Ahora que ya conocemos una palabra y sabemos cómo crear una frase sencilla en Python, necesitamos aprender a iniciar una conversación con él para comprobar nuestras nuevas capacidades con el lenguaje.</p>
<p>Antes de que puedas conversar con Python, deberás instalar el software necesario en tu computadora y aprender a iniciar Python en ella. En este capítulo no entraremos en detalles sobre cómo hacerlo, pero te sugiero que consultes <a href="http://www.py4e.com">www.py4e.com</a> , donde encontrarás instrucciones detalladas y capturas sobre cómo configurar e iniciar Python en sistemas Macintosh y Windows. Si sigues los pasos, llegará un momento en que te encuentres ante una ventana de comandos o terminal, si escribes entonces <em>python</em>, el intérprete de Python empezará a ejecutarse en modo interactivo, y aparecerá algo como esto:</p>
<p></p>
<pre class="python"><code>    Python 3.5.1 (v3.5.1:37a07cee5969, Dec  6 2015, 01:54:25)
    [MSC v.1900 64 bit (AMD64)] on win32
    Type &quot;help&quot;, &quot;copyright&quot;, &quot;credits&quot; or &quot;license&quot; for more information.
    &gt;&gt;&gt;</code></pre>
<p>El indicador <code>&gt;&gt;&gt;</code> es el modo que tiene el intérprete de Python de preguntarte, &quot;¿Qué quieres que haga ahora?&quot;. Python está ya preparado para mantener una conversación contigo. Todo lo que tienes que saber es cómo hablar en su idioma.</p>
<p>Supongamos por ejemplo que aún no conoces ni las palabras ni frases más sencillas de Python. Puede que quieras utilizar el método clásico que utilizan los astronautas cuando aterrizan en un planeta lejano e intentan hablar con los habitantes de ese mundo:</p>
<pre class="python"><code>    &gt;&gt;&gt; Vengo en son de paz, por favor llévame ante tu líder
      File &quot;&lt;stdin&gt;&quot;, line 1
        Vengo en son de paz, por favor llévame ante tu líder
              ^
    SyntaxError: invalid syntax
    &gt;&gt;&gt;</code></pre>
<p>La cosa no está yendo muy bien. A menos que pienses en algo rápidamente, los habitantes del planeta sacarán sus lanzas, te ensartarán, te asarán sobre el fuego y al final les servirás de cena.</p>
<p>Por suerte compraste una copia de este libro durante tus viajes, así que lo abres precisamente por esta página y pruebas de nuevo:</p>
<pre class="python"><code>    &gt;&gt;&gt; print(&#39;¡Hola, mundo!&#39;)
    ¡Hola, mundo!</code></pre>
<p>Esto tiene mejor aspecto, de modo que intentas comunicarte un poco más:</p>
<pre class="python"><code>    &gt;&gt;&gt; print(&#39;Usted debe ser el dios legendario que viene del cielo&#39;)
    Usted debe ser el dios legendario que viene del cielo
    &gt;&gt;&gt; print(&#39;Hemos estado esperándole durante mucho tiempo&#39;)
    Hemos estado esperándole durante mucho tiempo
    &gt;&gt;&gt; print(&#39;La leyenda dice que debe estar usted muy rico con mostaza&#39;)
    La leyenda dice que debe estar usted muy rico con mostaza
    &gt;&gt;&gt; print &#39;Tendremos un festín esta noche a menos que diga
      File &quot;&lt;stdin&gt;&quot;, line 1
        print &#39;Tendremos un festín esta noche a menos que diga
                                                             ^
    SyntaxError: Missing parentheses in call to &#39;print&#39;
    &gt;&gt;&gt;</code></pre>
<p>La conversación fue bien durante un rato, pero en cuanto cometiste el más mínimo fallo al utilizar el lenguaje Python, Python volvió a sacar las lanzas.</p>
<p>En este momento, ya te habrás dado cuenta también de que a pesar de que Pyhton es tremendamente complejo y poderoso, y muy estricto en cuanto a la sintaxis que debes usar para comunicarte con él, Python <em>no</em> es inteligente. En realidad estás solamente manteniendo una conversación contigo mismo; eso sí, usando una sintaxis adecuada.</p>
<p>En cierto modo, cuando utilizas un programa escrito por otra persona, la conversación se mantiene entre tú y el programador, con Python actuando meramente de intermediario. Python es una herramienta que permite a los creadores de programas expresar el modo en que la conversación supuestamente debe discurrir. Y dentro de unos pocos capítulos más, tú serás uno de esos programadores que utilizan Python para hablar con los usuarios de tu programa.</p>
<p>Antes de que abandonemos nuestra primera conversación con el intérprete de Python, deberías aprender cual es el modo correcto de decir &quot;adiós&quot; al interactuar con los habitantes del Planeta Python:</p>
<pre class="python"><code>    &gt;&gt;&gt; adiós
    Traceback (most recent call last):
      File &quot;&lt;stdin&gt;&quot;, line 1, in &lt;module&gt;
    NameError: name &#39;adiós&#39; is not defined
    &gt;&gt;&gt; if you don&#39;t mind, I need to leave\footnote{si no te importa, tengo que marcharme (N. del T.)}
      File &quot;&lt;stdin&gt;&quot;, line 1
        if you don&#39;t mind, I need to leave
                 ^
    SyntaxError: invalid syntax
    &gt;&gt;&gt; quit()</code></pre>
<p>Te habrás fijado en que el error es diferente en cada uno de los dos primeros intentos. El segundo error es diferente porque <em>if</em> es una palabra reservada y Python ve la palabra reservada y cree que estamos intentando decirle algo, pero encuentra la sintaxis de la frase incorrecta.</p>
<p>El modo correcto de decir &quot;adiós&quot; a Python es introducir <em>quit()</em> en el símbolo indicador del sistema <code>&gt;&gt;&gt;</code>. Seguramente te hubiera llevado un buen rato adivinarlo, así que tener este libro a mano probablemente te haya resultado útil.</p>
<h2 id="terminología-intérprete-y-compilador">Terminología: intérprete y compilador</h2>
<p>Python es un lenguaje <em>de alto nivel</em>, pensado para ser relativamente sencillo de leer y escribir para las personas y fácil de leer y procesar para las máquinas. Otros lenguajes de alto nivel son Java, C++, PHP, Ruby, Basic, Perl, JavaScript, y muchos más. El hardware real que está dentro de la Unidad Central de Procesamiento (CPU), no entiende ninguno de esos lenguajes de alto nivel.</p>
<p>La CPU entiende únicamente un lenguaje llamado <em>lenguaje de máquina</em> o <em>código máquina</em>. El código máquina es muy simple y francamente muy pesado de escribir, ya que está representado en su totalidad por solamente ceros y unos:</p>
<pre><code>    001010001110100100101010000001111
    11100110000011101010010101101101
    ...</code></pre>
<p>El código máquina parece bastante sencillo a simple vista, dado que sólo contiene ceros y unos, pero su sintaxis es incluso más compleja y mucho más enrevesada que la de Python. Por eso muy pocos programadores escriben en código máquina. En vez de eso, se han creado varios programas traductores para permitir a los programadores escribir en lenguajes de alto nivel como Python o Javascript, y son esos traductores quienes convierten los programas a código máquina, que es lo que ejecuta en realidad la CPU.</p>
<p>Dado que el código máquina está unido al hardware de la máquina que lo ejecuta, ese código no es <em>portable</em> (trasladable) entre equipos de diferente tipo. Los programas escritos en lenguajes de alto nivel pueden ser trasladados entre máquinas diferentes usando un intérprete diferente en cada máquina o recompilando el código para crear una versión diferente del código máquina del programa para cada uno de los tipos de equipo.</p>
<p>Esos traductores de lenguajes de programación forman dos categorías generales: (1) intérpretes y (2) compiladores.</p>
<p>Un <em>intérprete</em> lee el código fuente de los programas tal y como ha sido escrito por el programador, lo analiza, e interpreta sus instrucciones al vuelo (sobre la marcha). Python es un intérprete y cuando estamos ejecutando Python de forma interactiva, podemos escribir una línea de Python (una frase), y Python la procesa de forma inmediata y queda listo para que podamos escribir otra línea.</p>
<p>Algunas de esas líneas le indican a Python que tú quieres que recuerde cierto valor para utilizarlo más tarde. Tenemos que escoger un nombre para que ese valor sea recordado y usaremos ese nombre simbólico para recuperar el valor más tarde. Utilizamos el término <em>variable</em> para denominar las etiquetas que usamos para referirnos a esos datos almacenados.</p>
<pre class="python"><code>    &gt;&gt;&gt; x = 6
    &gt;&gt;&gt; print(x)
    6
    &gt;&gt;&gt; y = x * 7
    &gt;&gt;&gt; print(y)
    42
    &gt;&gt;&gt;</code></pre>
<p>En este ejemplo, le pedimos a Python que recuerde el valor seis y use la etiqueta <em>x</em> para que podamos recuperar el valor más tarde. Comprobamos que Python ha guardado de verdad el valor usando <em>print</em>. Luego le pedimos a Python que recupere <em>x</em>, lo multiplique por siete y guarde el valor así calculado en <em>y</em>. Finalmente, le pedimos a Python que escriba el valor actual de <em>y</em>.</p>
<p>A pesar de que estamos escribiendo estos comandos en Python línea a línea, Python los está tratando como una secuencia ordenada de órdenes, en la cual las últimas frases son capaces de obtener datos creados en las anteriores. Estamos, por tanto, escribiendo nuestro primer párrafo sencillo con cuatro frases en un orden lógico y útil.</p>
<p>La esencia de un <em>intérprete</em> consiste en ser capaz de mantener una conversación interactiva como la mostrada más arriba. Un <em>compilador</em> necesita que le entreguen el programa completo en un fichero, y luego ejecuta un proceso para traducir el código fuente de alto nivel a código máquina, tras lo cual coloca ese código máquina resultante dentro de otro fichero para su ejecución posterior.</p>
<p>En sistemas Windows, a menudo esos ejecutables en código máquina tienen un sufijo como &quot;.exe&quot; o &quot;.dll&quot;, que significan &quot;ejecutable&quot; y &quot;librería de enlace dinámico&quot; (<em>dynamic link library</em>) respectivamente. En Linux y Macintosh, no existe un sufijo que identifique de manera exclusiva a un fichero como ejecutable.</p>
<p>Si abrieras un fichero ejecutable con un editor de texto, verías algo complemente disparatado e ilegible:</p>
<pre><code>    ^?ELF^A^A^A^@^@^@^@^@^@^@^@^@^B^@^C^@^A^@^@^@\xa0\x82
    ^D^H4^@^@^@\x90^]^@^@^@^@^@^@4^@ ^@^G^@(^@$^@!^@^F^@
    ^@^@4^@^@^@4\x80^D^H4\x80^D^H\xe0^@^@^@\xe0^@^@^@^E
    ^@^@^@^D^@^@^@^C^@^@^@^T^A^@^@^T\x81^D^H^T\x81^D^H^S
    ^@^@^@^S^@^@^@^D^@^@^@^A^@^@^@^A\^D^HQVhT\x83^D^H\xe8
    ....</code></pre>
<p>No resulta fácil leer o escribir código máquina, pero afortunadamente disponemos de <em>intérpretes</em> y <em>compiladores</em> que nos permiten escribir en lenguajes de alto nivel, como Python o C.</p>
<p>Llegados a este punto en la explicación acerca de los compiladores e intérpretes, seguramente te estarás preguntando algunas cosas acerca del propio intérprete de Python. ¿En qué lenguaje está escrito? ¿Está escrito en un lenguaje compilado? Cuando escribimos &quot;python&quot;, ¿qué ocurre exactamente?</p>
<p>El intérprete de Python está escrito en un lenguaje de alto nivel llamado &quot;C&quot;. En realidad, puedes ver el código fuente del intérprete de Python acudiendo a <a href="http://www.python.org">www.python.org</a> e incluso modificarlo a tu gusto. Quedamos, pues, en que Python es en sí mismo un programa y que está compilado en código máquina. Cuando instalaste Python en tu computadora (o el vendedor lo instaló), colocaste una copia del código máquina del programa Python traducido para tu sistema. En Windows, el código máquina ejecutable para el intérprete de Python es probablemente un fichero con un nombre como:</p>
<pre><code>    C:\Python35\python.exe</code></pre>
<p>En realidad, eso ya es más de lo que necesitas saber para ser un programador en Python, pero algunas veces vale la pena contestar estas pequeñas dudas recurrentes justo al principio.</p>
<h2 id="escribiendo-un-programa">Escribiendo un programa</h2>
<p>Escribir comandos en el intérprete de Python es un buen modo de experimentar con las capacidades de Python, pero no es lo más recomendado a la hora de resolver problemas más complejos.</p>
<p>Cuando queremos escribir un programa, usamos un editor de texto para escribir las instrucciones de Python en un fichero, que recibe el nombre de <em>script</em>. Por convención, los scripts de Python tienen nombres que terminan en <code>.py</code>.</p>
<p></p>
<p>Para ejecutar el script, hay que indicarle al intérprete de Python el nombre del fichero. En una ventana de comandos de Unix o Windows, escribirías <code>python hola.py</code>, de este modo:</p>
<pre class="bash"><code>    csev$ cat hola.py
    print(&#39;¡Hola, mundo!&#39;)
    csev$ python hola.py
    ¡Hola, mundo!
    csev$</code></pre>
<p>&quot;csev$&quot; es el indicador (<em>prompt</em>) del sistema operativo, y el comando &quot;cat hola.py&quot; nos muestra que el archivo &quot;hola.py&quot; contiene un programa con una única línea que imprime en pantalla una cadena.</p>
<p>Llamamos al intérprete de Python y le pedimos que lea su código fuente desde el archivo &quot;hola.py&quot;, en vez de esperar a que vayamos introduciendo líneas de código Python de forma interactiva.</p>
<p>Habrás notado que cuando trabajamos con un fichero no necesitamos incluir el comando <em>quit()</em> al final del programa Python. Cuando Python va leyendo tu código fuente desde un archivo, sabe que debe parar cuando llega al final del fichero.</p>
<h2 id="qué-es-un-programa">¿Qué es un programa?</h2>
<p>Podemos definir un <em>programa</em>, en su forma más básica, como una secuencia de declaraciones o sentencias que han sido diseñadas para hacer algo. Incluso nuestro sencillo script &quot;hola.py&quot; es un programa. Es un programa de una sola línea y no resulta particularmente útil, pero si nos ajustamos estrictamente a la definición, se trata de un programa en Python.</p>
<p>Tal vez resulte más fácil comprender qué es un programa pensando en un problema que pudiera ser resuelto a través de un programa, y luego estudiando cómo sería el programa que solucionaría ese problema.</p>
<p>Supongamos que estás haciendo una investigación de computación o informática social en mensajes de Facebook, y te interesa conocer cual es la palabra más utilizada en un conjunto de mensajes. Podrías imprimir el flujo de mensajes de Facebook y revisar con atención el texto, buscando la palabra más común, pero sería un proceso largo y muy propenso a errores. Sería más inteligente escribir un programa en Python para encargarse de la tarea con rapidez y precisión, y así poder emplear el fin de semana en hacer otras cosas más divertidas.</p>
<p>Por ejemplo, fíjate en el siguiente texto, acerca de un payaso y un coche. Estudia el texto y trata de averiguar cual es la palabra más común y cuántas veces se repite.</p>
<pre><code>    el payaso corrió tras el coche y el coche se metió dentro de la tienda
    y la tienda cayó sobre el payaso y el coche</code></pre>
<p>Ahora imagina que haces lo mismo pero buscando a través de millones de líneas de texto. Francamente, tardarías menos aprendiendo Python y escribiendo un programa en ese lenguaje para contar las palabras que si tuvieras que ir revisando todas ellas una a una.</p>
<p>Pero hay una noticia aún mejor, y es que a mí ya se me ha ocurrido un programa sencillo para encontrar cuál es la palabra más común dentro de un fichero de texto. Ya lo he escrito, lo he probado, y ahora te lo regalo para que lo puedas utilizar y ahorrarte mucho tiempo.</p>
<pre class="python"><code>name = input(&#39;Enter file:&#39;)
handle = open(name, &#39;r&#39;)
counts = dict()

for line in handle:
    words = line.split()
    for word in words:
        counts[word] = counts.get(word, 0) + 1

bigcount = None
bigword = None
for word, count in list(counts.items()):
    if bigcount is None or count &gt; bigcount:
        bigword = word
        bigcount = count

print(bigword, bigcount)

# Code: http://www.py4e.com/code3/words.py</code></pre>

<p>No necesitas ni siquiera saber Python para usar este programa. Tendrás que llegar hasta el capítulo 10 de este libro para entender por completo las impresionantes técnicas de Python que se han utilizado para crearlo. Ahora eres el usuario final, sólo tienes que usar el programa y maravillarte de sus habilidades y de cómo te permite ahorrarte un montón de esfuerzo. Tan sólo tienes que escribir el código dentro de un fichero llamado <em>words.py</em> y ejecutarlo, o puedes descargar el código fuente directamente desde <a href="http://www.py4e.com/code3/" class="uri">http://www.py4e.com/code3/</a> y ejecutarlo.</p>
<p></p>
<p>Este es un buen ejemplo de cómo Python y el lenguaje Python actúan como un intermediario entre tú (el usuario final) y yo (el programador). Python es un medio para que nosotros intercambiemos secuencias de instrucciones útiles (es decir, programas) en un lenguaje común que puede ser usado por cualquiera que instale Python en su computadora. Así que ninguno de nosotros está hablando <em>con Python</em>, sino que estamos comunicándonos uno con el otro <em>a través de</em> Python.</p>
<h2 id="los-bloques-de-construcción-de-los-programas">Los bloques de construcción de los programas</h2>
<p>En los próximos capítulos, aprenderemos más acerca del vocabulario, la estructura de las frases y de los párrafos y la estructura de los relatos en Python. Aprenderemos cuáles son las poderosas capacidades de Python y cómo combinar esas capacidades entre sí para crear programas útiles.</p>
<p>Hay ciertos patrones conceptuales de bajo nivel que se usan para estructurar los programas. Esas estructuras no son exclusivas de Python, sino que forman parte de cualquier lenguaje de programación, desde el código máquina hasta los lenguajes de alto nivel.</p>
<dl>
<dt>entrada</dt>
<dd>Obtener datos del &quot;mundo exterior&quot;. Puede consistir en leer datos desde un fichero, o incluso desde algún tipo de sensor, como un micrófono o un GPS. En nuestros primeros programas, las entradas va a provenir del usuario, que introducirá los datos a través del teclado.
</dd>
<dt>salida</dt>
<dd>Mostrar los resultados del programa en una pantalla, almacenarlos en un fichero o incluso es posible enviarlos a un dispositivo como un altavoz para reproducir música o leer un texto.
</dd>
<dt>ejecución secuencial</dt>
<dd>Ejecutar una sentencia tras otra en el mismo orden en que se van encontrando en el <em>script</em>.
</dd>
<dt>ejecución condicional</dt>
<dd>Comprobar ciertas condiciones y luego ejecutar u omitir una secuencia de sentencias.
</dd>
<dt>ejecución repetida</dt>
<dd>Ejecutar un conjunto de sentencias varias veces, normalmente con algún tipo de variación.
</dd>
<dt>reutilización</dt>
<dd>Escribir un conjunto de instrucciones una vez, darles un nombre y así poder reutilizarlas luego cuando se necesiten en cualquier punto de tu programa.
</dd>
</dl>
<p>Parece demasiado simple para ser cierto, y por supuesto nunca es tan sencillo. Es como si dijéramos que andar es simplemente &quot;poner un pie delante del otro&quot;. El &quot;arte&quot; de escribir un programa es componer y entrelazar juntos esos elementos básicos muchas veces hasta conseguir al final algo que resulte útil para sus usuarios.</p>
<p>El programa para contar palabras que vimos antes utiliza al mismo tiempo todos esos patrones excepto uno.</p>
<h2 id="qué-es-posible-que-vaya-mal">¿Qué es posible que vaya mal?</h2>
<p>Como vimos en nuestra anterior conversación con Python, debemos comunicarnos con mucha precisión cuando escribimos código Python. La menor desviación o error provocará que Python se niegue a hacer funcionar tu programa.</p>
<p>Los programadores novatos a menudo se toman el hecho de que Python no permita cometer errores como la prueba fehaciente de que Python es mezquino, odioso y cruel. A pesar de que a Python parece gustarle todo el mundo, es capaz de identificarles a ellos en concreto, y se la tiene jurada. Debido a ello, Python toma sus programas, que están perfectamente escritos, y los rechaza, considerándolos como &quot;inservibles&quot;, sólo para atormentarles.</p>
<pre class="python"><code>    &gt;&gt;&gt; primt &#39;¡Hola, mundo!&#39;
      File &quot;&lt;stdin&gt;&quot;, line 1
        primt &#39;¡Hola, mundo!&#39;
                           ^
    SyntaxError: invalid syntax
    &gt;&gt;&gt; primt (&#39;Hola, mundo&#39;)
    Traceback (most recent call last):
    File &quot;&lt;stdin&gt;&quot;, line 1, in &lt;module&gt;
    NameError: name &#39;primt&#39; is not defined

    &gt;&gt;&gt; ¡Te odio, Python!
      File &quot;&lt;stdin&gt;&quot;, line 1
        ¡Te odio, Python!
          ^
    SyntaxError: invalid syntax
    &gt;&gt;&gt; si sales fuera, te daré una lección
      File &quot;&lt;stdin&gt;&quot;, line 1
        si sales fuera, te daré una lección
                  ^
    SyntaxError: invalid syntax
    &gt;&gt;&gt;</code></pre>
<p>Hay poco que ganar discutiendo con Python. Se trata tan sólo de una herramienta. No tiene emociones y está feliz y preparado para servirte en cualquier cosa que necesites. Sus mensajes de error parecen crueles, pero se trata tan sólo de una petición de ayuda del propio Python. Ha examinado lo que has tecleado, y simplemente no es capaz de entender lo que has escrito.</p>
<p>Python se parece mucho a un perro, te quiere incondicionalmente, tiene unas pocas palabras clave que comprende, te mira con una mirada dulce en su cara (<code>&gt;&gt;&gt;</code>), y espera que le digas algo que él comprenda. Cuando Python dice &quot;SyntaxError: invalid syntax&quot; (Error de sintaxis: sintaxis inválida), tan sólo está meneando su cola y diciendo: &quot;Creo que has dicho algo, pero no te entiendo; de todos modos, por favor, sigue hablando conmigo (<code>&gt;&gt;&gt;</code>).&quot;</p>
<p>A medida que tus programas vayan aumentando su complejidad, te encontrarás con tres tipos de errores generales:</p>
<dl>
<dt>Errores de sintaxis (Syntax errors)</dt>
<dd>Estos son los primeros errores que cometerás y también los más fáciles de solucionar. Un error de sintaxis significa que has violado las reglas &quot;gramaticales&quot; de Python. Python hace todo lo que puede para señalar el punto exacto, la línea y el carácter donde ha detectado el fallo. Lo único un poco complicado de los errores de sintaxis es que a veces el error que debe corregirse está en realidad en un punto anterior del programa a aquel en el cual Python <em>detectó</em> ese fallo. De modo que la línea y el carácter que Python indica en un error de sintaxis pueden ser tan sólo un punto de partida para iniciar la investigación.
</dd>
<dt>Errores lógicos</dt>
<dd>Se produce un error lógico cuando un programa tiene una sintaxis correcta, pero existe un error en el orden de las sentencias o a veces un error en el modo en que esas sentencias se relacionan entre si. Un buen ejemplo de un error lógico sería: &quot;toma un trago de tu botella de agua, ponla en tu mochila, camina hasta la biblioteca y luego vuelve a enroscar el tapón en la botella.&quot;
</dd>
<dt>Errores semánticos</dt>
<dd>Un error semántico es cuando la descripción que has realizado de los pasos a seguir es sintácticamente perfecta y está dispuesta en el orden correcto, pero simplemente existe un error en el programa. El programa es perfectamente correcto pero no hace aquello que supuestamente <em>querías</em> que hiciese. Un ejemplo ilustrativo podría ser si le estuvieras dando indicaciones a alguien para llegar un restaurante y dijeras: &quot;... cuando llegues al cruce de la gasolinera, gira a la izquierda y continúa durante kilómetro y medio. El restaurante es un edificio rojo que encontrarás a tu izquierda.&quot; Tu amigo se retrasa y te llama para contarte que están en una granja y dando vueltas alrededor de un granero, sin encontrar el restaurante por ningún lado. Entonces tu le dices: &quot;¿girasteis a la izquierda o a la derecha en la gasolinera?&quot;, y él te responde: &quot;He seguido tus indicaciones exactamente, las tengo escritas, dicen que que gire a la izquierda y continúe durante kilómetro y medio hasta la gasolinera.&quot; Entonces tú dices: &quot;Lo siento mucho, porque aunque mis instrucciones eran sintácticamente correctas, por desgracia contenían un pequeño error semántico del cual no me dí cuenta.&quot;.
</dd>
</dl>
<p>Insisto en que, ante cualquiera de estos tres tipos de errores, Python lo único que hace es todo lo que está en su mano por seguir al pie de la letra lo que tú le has pedido que haga.</p>
<h2 id="el-camino-del-aprendizaje">El camino del aprendizaje</h2>
<p>A medida que avances a través del resto del libro, no te asustes si al principio los conceptos no parecen encajar muy bien unos con otros. Cuando aprendiste a hablar, no te resultó problemático que durante tus primeros años sólo fueras capaz de expresarte con lindos balbuceos. También fue normal que te llevara seis meses pasar de un vocabulario básico a usar frases sencillas, y que te llevaran 5-6 años más pasar de frases a párrafos, y unos cuantos años más hasta que fueras capaz de escribir alguna pequeña e interesante historia por ti mismo.</p>
<p>Queremos que aprendas Python mucho más rápidamente, de modo que te enseñaremos todo al mismo tiempo a lo largo de los próximos capítulos. Pero es como aprender un idioma nuevo, que lleva tiempo asimilar y comprender antes de que te parezca normal. Eso puede producir cierta confusión, ya que trataremos y volveremos a tratar los mismos temas para intentar que consigas ver el cuadro completo a medida que vamos definiendo los pequeños fragmentos que componen la imagen global. A pesar de que el libro está escrito de forma lineal, y que si estás siguiendo un curso éste también avanzará de modo lineal, no temas ser no lineal en tu modo de seguir la materia. Echa vistazos adelante y atrás y lee por encima. Al ojear materia más avanzada sin comprender del todo los detalles, serás capaz de entender mejor los &quot;por qués&quot; de la programación. Al revisar materia anterior e incluso al volver a hacer ejercicios ya hechos, te darás cuenta de que has aprendido un montón, incluso si la materia a la que te estás enfrentando en ese momento te parece en cierto modo impenetrable.</p>
<p>Normalmente, cuando estás aprendiendo tu primer lenguaje de programación, hay unos pocos y maravillosos momentos &quot;¡Ajá!&quot;, en los cuales puedes levantar la vista, dejar de machacar la piedra con martillo y cincel, dar un paso atrás y darte cuenta de que lo que estás creando es en realidad una bonita escultura.</p>
<p>Si algo te parece particularmente difícil, normalmente no merece la pena quedarte despierto toda la noche contemplándolo. Tómate un respiro, échate una siesta, come algo, explícale que tienes un problema a alguien (tal vez, simplemente, a tu perro), y luego vuelve a abordarlo con la mente despejada. Te aseguro que una vez que hayas aprendido los conceptos de programación que se explican en el libro, echarás la vista atrás y te darás cuenta de que todo era fácil y elegante en realidad, y que simplemente te he llevado un poco de tiempo asimilarlo.</p>
<h2 id="glosario">Glosario</h2>
<dl>
<dt>bug</dt>
<dd>Un error en un programa.
</dd>
<dt>código fuente</dt>
<dd>Un programa en un lenguaje de alto nivel.
</dd>
<dt>código máquina</dt>
<dd>El lenguaje de más bajo nivel para el software, es decir, el lenguaje que es directamente ejecutado por la unidad central de procesamiento (CPU).
</dd>
<dt>compilar</dt>
<dd>Traducir un programa completo escrito en un lenguaje de alto nivel a un lenguaje de bajo nivel, para dejarlo listo para una ejecución posterior.
</dd>
<dt>error semántico</dt>
<dd>Un error dentro de un programa que provoca que haga algo diferente de lo que pretendía el programador.
</dd>
<dt>función print</dt>
<dd>Una instrucción que hace que el intérprete de Python muestre un valor en la pantalla.
</dd>
<dt>indicador de línea de comandos (<em>prompt</em>)</dt>
<dd>Cuando un programa muestra un mensaje y se detiene para que el usuario teclee algún tipo de dato.
</dd>
<dt>interpretar</dt>
<dd>Ejecutar un programa escrito en un lenguaje de alto nivel traduciéndolo línea a línea.
</dd>
<dt>lenguaje de alto nivel</dt>
<dd>Un lenguaje de programación como Python, que ha sido diseñado para que sea fácil de leer y escribir por las personas.
</dd>
<dt>lenguaje de bajo nivel</dt>
<dd>Un lenguaje de programación que está diseñado para ser fácil de ejecutar para una computadora; también recibe el nombre de &quot;código máquina&quot;, &quot;lenguaje máquina&quot; o &quot;lenguaje ensamblador&quot;.
</dd>
<dt>memoria principal</dt>
<dd>Almacena los programas y datos. La memoria principal pierde su información cuando se desconecta la alimentación.
</dd>
<dt>memoria secundaria</dt>
<dd>Almacena los programas y datos y mantiene su información incluso cuando se interrumpe la alimentación. Es generalmente más lenta que la memoria principal. Algunos ejemplos de memoria secundaria son las unidades de disco y memorias flash que se encuentran dentro de los dispositivos USB.
</dd>
<dt>modo interactivo</dt>
<dd>Un modo de usar el intérprete de Python, escribiendo comandos y expresiones directamente en el indicador de la línea de comandos.
</dd>
<dt>parsear</dt>
<dd>Examinar un programa y analizar la estructura sintáctica.
</dd>
<dt>portabilidad</dt>
<dd>Es la propiedad que poseen los programas que pueden funcionar en más de un tipo de computadora.
</dd>
<dt>programa</dt>
<dd>Un conjunto de instrucciones que indican cómo realizar algún tipo de cálculo.
</dd>
<dt>resolución de un problema</dt>
<dd>El proceso de formular un problema, encontrar una solución, y mostrar esa solución.
</dd>
<dt>semántica</dt>
<dd>El significado de un programa.
</dd>
<dt>unidad central de procesamiento</dt>
<dd>El corazón de cualquier computadora. Es lo que ejecuta el software que escribimos. También recibe el nombre de &quot;CPU&quot; por sus siglas en inglés (<em>Central Processsing Unit</em>), o simplemente, &quot;el procesador&quot;.
</dd>
</dl>
<h2 id="ejercicios">Ejercicios</h2>
<p>Ejercicio 1: ¿Cuál es la función de la memoria secundaria en una computadora?</p>
<p>a) Ejecutar todos los cálculos y la lógica del programa<br />
b) Descargar páginas web de Internet<br />
c) Almacenar información a largo plazo, incluso después de interrumpir la alimentación<br />
d) Recoger los datos de entrada del usuario</p>
<p>Ejercicio 2: ¿Qué es un programa?</p>
<p>Ejercicio 3: ¿Cuál es la diferencia entre un compilador y un intérprete?</p>
<p>Ejercicio 4: ¿Cuál de los siguientes contiene &quot;código máquina&quot;?</p>
<p>a) El intérprete de Python<br />
b) El teclado<br />
c) El código fuente de Python<br />
d) Un documento de un procesador de textos</p>
<p>Ejercicio 5: ¿Qué es incorrecto en el siguiente código?:</p>
<pre class="python"><code>    &gt;&gt;&gt; primt &#39;¡Hola, mundo!&#39;
      File &quot;&lt;stdin&gt;&quot;, line 1
        primt &#39;¡Hola, mundo!&#39;
                           ^
    SyntaxError: invalid syntax
    &gt;&gt;&gt;</code></pre>
<p>Ejercicio 6: ¿En qué lugar del computador queda almacenada una variable, como en este caso &quot;X&quot;, después de ejecutar la siguiente línea de Python?:</p>
<pre class="python"><code>    x = 123</code></pre>
<p>a) Unidad central de procesamiento<br />
b) Memoria Principal<br />
c) Memoria Secundaria<br />
d) Dispositivos de Entrada<br />
e) Dispositivos de Salida</p>
<p>Ejercicio 7: ¿Qué escribirá el siguiente programa?:</p>
<pre class="python"><code>    x = 43
    x = x + 1
    print(x)</code></pre>
<p>a) 43<br />
b) 44<br />
c) x + 1<br />
d) Error, porque x = x + 1 is una operación imposible desde el punto de vista matemático</p>
<p>Ejercicio 8: Explica cada uno de los siguientes conceptos usando un ejemplo de una capacidad humana: (1) Unidad central de procesamiento, (2) Memoria principal, (3) Memoria secundaria, (4) Dispositivos de entrada, y (5) Dispositivos de salida. Por ejemplo, &quot;¿Cual sería el equivalente humano de la Unidad central de procesamiento?&quot;.</p>
<p>Ejercicio 9: ¿Cómo solucionarías un &quot;Error de sintaxis (<em>Syntax Error</em>)?&quot;.</p>
<div class="footnotes">
<hr />
<ol>
<li id="fn1"><p><a href="http://xkcd.com/231/" class="uri">http://xkcd.com/231/</a><a href="#fnref1">↩</a></p></li>
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
