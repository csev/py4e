<?php include("top.php");?>
<?php include("nav.php");?>
<div id="iframe-dialog" title="Read Only Dialog" style="display: none;">
   <iframe name="iframe-frame" style="height:600px" id="iframe-frame" 
    src="<?= $OUTPUT->getSpinnerUrl() ?>"></iframe>
</div>
<div style="float: right;"/><iframe style="width:120px;height:240px;" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" src="//ws-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&OneJS=1&Operation=GetAdHtml&MarketPlace=US&source=ss&ref=as_ss_li_til&ad_type=product_link&tracking_id=drchu02-20&marketplace=amazon&region=US&placement=1530051126&asins=1530051126&linkId=2ea6c883c6cf11f29568856139bad34b&show_border=true&link_opens_in_new_window=true"></iframe></div>
        <h2>Los Materiales del Curso son Abiertos / Gratuitos</h2>
        <p>
            Siéntete libre de usar / reusar / mezclar / conservar los materiales de este sitio en tus propios cursos.
            Casi todo el material en este sitio web tiene una Atribución de Derechos de Autor de Creative Commons. Estos
            enlaces llevan a contenido descargable, así como a otras fuentes de estos materiales.            
        </p>
        <ul>
            <li>Clases en Video
            <ul>
            <li><a href="https://www.youtube.com/playlist?list=PLlRFEj9H3Oj7Bp8-DfGpfAfDBiblRfl5p" target="_blank">YouTube Playlist</a></li>
            <li><a href="https://itunes.apple.com/us/podcast/python-for-everybody-video/id1214664324" target="_blank">iTunes Video</a></li>
            <li><a href="http://amzn.to/2mFrCuh" target="_blank">Amazon Prime Video</a></li>
            </ul>
            </li>
            <li>Clases en Audio
            <ul>
            <li><a href="https://itunes.apple.com/us/podcast/python-for-everybody-audio-py4e/id1214665693" target="_blank">iTunes Audio</a></li>
            <li><a href="https://play.google.com/music/listen?u=0#/ps/Ijgj3aofh6m73rps4wtdk6djhv4" target="_blank">Google Play Audio</a></li>
            </ul>
            </li>
            <li>
                <a href="lectures3/" target="_blank">Presentaciones y Materiales Adicionales</a>
            </li>
            <li>
                <a href="code3.zip" target="_blank">Código de Ejemplos en ZIP</a>
                (<a href="code3/" target="_blank">Archivos Individuales</a>)
            </li>
            <li>
                <a href="book.php">Libro Gratuito</a>
            </li>
            <li>
                Todo el contenido del curso y el software autoevaluador están disponibles en                               
                <a href="https://github.com/csev/py4e" target="_blank">
                Github</a> bajo una licencia Creative Commons o Apache 2.0.  
            </li>
</ul>
        <p>
        Si te interesa traducir el libro u otros materiales en línea a otro idioma, he
        dejado algunas
        <a href="https://github.com/csev/py4e/blob/master/TRANSLATION.md" target="_new">
instrucciones sobre como traducir este curso</a> en mi repositorio de Github.
Si estás comenzando una traducción, por favor contáctame para que podamos coordinarnos.           
        </p>
<h2>Usando este curso en tu LMS (Sistema de Manejo de Aprendizaje) Local</h2>
<p>Este sitio utiliza <a href="http://www.tsugi.org/" target="_blank">Tsugi</a> 
tanto para alojar los autoevaluadores basados en software como para proveer este material de
manera que pueda integrarse fácilmente en un Sistema de Manejo de Aprendizaje como
<a href="http://www.sakaiproject.org/" target=_blank">Sakai</a>, Moodle, Canvas, Desire2Learn, Blackboard
u otros similares.
</p>
<ul>
<li>
<p>
Si tu LMS soporta
<a href="https://www.imsglobal.org/activity/learning-tools-interoperability" target="_blank">
IMS Learning Tools Interoperabilty®</a> versión 1.x o 2.x, puedes ingresar y pedir acceso
a las herramientas de este sitio. Asegúrate de indicar si necesitas una clave LTI 1.x (lo más común)
o 2.x. Se te darán instrucciones para utilizar
tus credenciales una vez que obtengas tu clave.
</p>
</li>
<li>
<p>
<a href="#" title="Descargar material del Curso"
  onclick="showModalIframeUrl(this.title, 'iframe-dialog', 'iframe-frame', 'tsugi/cc/select', _TSUGI.spinnerUrl, true); return false;" >
  Descargar Material del Curso
  </a> como 
<a href="https://www.imsglobal.org/cc/index.html" target="_blank">
IMS Common Cartridge®</a>, para importarlo a un LMS como Sakai, Moodle, Canvas,
Desire2Learn, Blackboard, o similar.
Tras cargar el Cartucho, necesitarás dar una clave y secreto LTI
a las herramientos basadas en LTI provistas en ese cartucho.
</p>
</li>
<li>
<p>
Si tu LMS soporta
<a href="https://www.imsglobal.org/specs/lticiv1p0" target="_blank">
Learning Tools Interoperability® Content-Item Message</a> puedes
ingresar y solicitar una clave y secreto LTI 1.x e instalar este sitio web
en tu LMS como parte de la App Store / Repositorio de Objeto de Aprendizaje que te permite
crear tu clase en tu LMS, así como elegir herramientas y contenido
desde este sitio, un objeto a la vez. Se te darán instrucciones
para configurar la "app store" en tu LMS cuando recibas
tu clave y secreto.
</p>
</li>
<li><p>
Si usas
<a href="https://classroom.google.com" target="_blank">Google Classroom</a>,
puedes enlazar automáticamente los recursos en este sitio
a tu sala de clases en la
<a href="<?= $CFG->apphome ?>/lessons/intro?nostyle=yes">vista de bajo estilo de las lecciones</a>. (debes haber ingresado)
</p></li>
<li>
<p>
Si tu LMS no soporta ni Objetos de Contenido, ni Cartuchos Comunes, pero sí LTI,
puedes copiar manualmente los enlaces de los materiales de este curso a tu LMS, uno a uno. Tenemos una
<a href="<?= $CFG->apphome ?>/lessons/intro?nostyle=yes">vista especial de bajo estilo de las lecciones</a>
para hacer que la copia manual resulte lo más sencilla posible.
</p>
</li>
        </ul>
<h2>Archivo en Audio</h2>
<p>
Aquí hay un archivo con las
<a href="https://archive.org/details/201509UMSI502Podcasts_201601" target="_blank">grabaciones de las clases en vivo</a>
desde SI502 tal como se impartieron en el campus de la Escuela de Información de UM en el Otoño de 2015.
</p>


<?php include("footer.php"); ?>

