<?php
use \Tsugi\Core\LTIX;
use \Tsugi\UI\Output;

require_once "top.php";
require_once "nav.php";
?>
<div id="container">
<h1>Python para Todos</h1>
<p>
<b>Este sitio esta en construcción. Si desea ayudar con las traducciones, consulte el repositorio de GitHub
<a href="https://github.com/csev-es/py4e" target="_blank">https://github.com/csev-es/py4e</a>.</b>
</p>
<?php if ( isset($_SESSION['id']) ) { ?>
<p>
Bienvenido a la versión de Curso Abierto Masivo en Línea (MOOC en inglés) de Python para Todos.

Ahora que has ingresado, tienes a las funciones de curso de este sitio web.

<ul class="list-group">
<li class="list-group-item">
A medida que pasas las <a href="lessons">Lecciones</a> del curso, verás enlaces adicionales
a las herramientas de autoevaluación de la clase. Puedes hacer la prueba con los autoevaluadores
y obtener un puntaje.</li>
<li class="list-group-item">
Puedes monitorear tu avance en el curso usando la herramienta de <a href="assignments">Tareas</a>
y, cuando completes un grupo de ellas, puedes recibir una <a href="badges">Medalla</a>.
Puedes descargar estas medallas y exhibirlas en tu página web o referencias la URL de las medallas en 
este sitio.</li>
<li class="list-group-item">
Hay un 
<a href="https://disqus.com/home/channel/pythonforeverybody/" target="_blank">foro</a>
alojado en Disqus.</li>
<li class="list-group-item">
Si quieres usar estos materiales licenciados con Creative Commons
en tus propias clases, puedes
<a href="materials.php">descargar o enlazar</a> a los artefactos de este sitio,
<a href="tsugi/cc/export.php">exportar los materiales del curso</a> como un
Cartucho Común IMS®, o pedir una
<a href="tsugi/admin/key/index.php">clave y secreto</a>
de Interoperabilidad de Herramientas del Aprendizaje de IMS® (LTI®)
para ejecutar los autoevaluadores desde tu LMS.
</li>
</ul>
<?php } else { ?>
<p>
<p>
Hola y bienvenido a mi sitio donde puede trabajar con los materiales de mi curso relacionados con mi libro de texto gratuito
(<a href="book.php">Python para todos</a>).
<!--
Puedes tomar este curso para obtener un certificado
como parte de la
<a href="https://www.coursera.org/specializations/python" target="_blank">Esoecialización Python Para Todos</a> en Coursera
o los cursos
<a href="https://www.edx.org/bio/charles-severance" target="_blank">Python para Todos</a>(2 cursos)  en edX.</p>
-->
</p>
<p>
Puedes usar este sitio de varias maneras:
<ul class="list-group">
<li class="list-group-item">
Puedes explorar mis videos y materiales del curso en <a href="lessons">Lecciones</a>. Todos los materiales
que he desarrollado para 
esta clase 
tienen una licencia de Creative Commons, con lo que puedes descargarlos o enlazar a ellos
para incorporarlos a tus propias clases si lo deseas.</li>
<li class="list-group-item">
Si <a href="tsugi/login.php">ingresas</a> al sitio
es como si te hubieras unido a un curso en línea
global, gratuito y abierto. Tienes un libro de calificaciones, tareas autoevaluadas, un foro de discusión, 
y puedes ganar medallas por tus esfuerzos.</li>
<li class="list-group-item">
En este sitio nos tomamos en serio tu privacidad, puedes revisar nuestra
<a href="privacy">Política de Privacidad</a> para más detalles.
</li>
<li class="list-group-item">
Si quieres usar estos materiales
en tus propias clases, puedes descargarlos o dejar un enlace a los artefactos en este sitio,
<a href="tsugi/cc/export.php">exportar los materiales del curso</a> como un
Cartucho Común IMS®, o pedir una
<a href="tsugi/admin/key/index.php">clave y secreto</a>
de Interoperabilidad de Herramientas del Aprendizaje de IMS® (LTI®)
para ejecutar los autoevaluadores desde tu LMS.
</li>
<li class="list-group-item">
El código de este sitio, incluyendo los autoevaluadores, diapositivas y contenido, se encuentran
disponibles en <a href="https://github.com/csev/py4e" target="_blank">GitHub</a>. Esto significa que
puedes hacer tu propia copia del sitio del curso, publicarla o modificarla como gustes. Incluso mejor,
podrías traducir todo el sitio/ curso a tu propio lenguaje y publicarlo. He publicado
algunas <a href="https://github.com/csev/py4e/blob/master/TRANSLATION.md" target="_new">
instrucciones sobre cómo traducir este curso</a> en mi repositorio de GitHub.
</li>
</ul>
<?php } ?>
Este sitio utiliza el entorno <a href="http://www.tsugi.org" target="_blank">Tsugi</a> 
para incorporar un sistema de manejo de aprendizaje e implementar los autoevaluadores.
Si te interesa ayudar a construir este tipo de sitios por tu cuenta, por favor revisa
el sitio web <a href="http://www.tsugi.org" target="_blank">tsugi.org</a> y/o contáctame.
</p>
<!--
<?php
echo(Output::safe_var_dump($_SESSION));
var_dump($USER);
?>
-->
</div>
<?php $OUTPUT->footer();
