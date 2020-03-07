<?php
use \Tsugi\Core\LTIX;
use \Tsugi\UI\Output;

$pos_head_start = strpos($HTML,'<head');
$pos_head_start = strpos($HTML,'<',$pos_head_start+1);
$pos_head_end = strpos($HTML,'</head',$pos_head_start);
$pos_body = strpos($HTML,'<body',$pos_head_end);
$pos_body = strpos($HTML,'<',$pos_body+1);
$pos_end = strpos($HTML,'</body',$pos_body);
$head = substr($HTML, $pos_head_start, $pos_head_end-$pos_head_start);
$body = substr($HTML, $pos_body, $pos_end-$pos_body);
require_once "top.php";
require_once "nav.php";

function x_sel($file) {
    global $HTML_FILE;
    $retval = 'value="'.$file.'"';
    if ( strpos($HTML_FILE, $file) === 0 ) {
        $retval .= " selected";
    }
    return $retval;
}

?>
<script>
function onSelect() {
    console.log($('#chapters').val());
    window.location = $('#chapters').val();
}
</script>    
<div style="float:right">
<select id="chapters" onchange="onSelect();">
  <option <?= x_sel("01-intro") ?>>Capítulo 1: Introducción</option>
  <option <?= x_sel("02-variables") ?>>Capítulo 2: Variables, expresiones y sentencias</option>
  <option <?= x_sel("03-conditional") ?>>Capítulo 3: Ejecución condicional</option>
  <option <?= x_sel("04-functions") ?>>Capítulo 4: Funciones</option>
  <option <?= x_sel("05-iterations") ?>>Capítulo 5: Iteración</option>
  <option <?= x_sel("06-strings") ?>>Capítulo 6: Cadenas</option>
  <option <?= x_sel("07-files") ?>>Capítulo 7: Archivos</option>
  <option <?= x_sel("08-lists") ?>>Capítulo 8: Listas</option>
  <option <?= x_sel("09-dictionaries") ?>>Capítulo 9: Diccionarios</option>
  <option <?= x_sel("10-tuples") ?>>Capítulo 10: Tuplas</option>
  <option <?= x_sel("11-regex") ?>>Capítulo 11: Expresiones Regulares</option>
  <option <?= x_sel("12-network") ?>>Capítulo 12: Programas en Red</option>
  <option <?= x_sel("13-web") ?>>Capítulo 13: Uso de Servicios Web</option>
  <option <?= x_sel("14-objects") ?>>Capítulo 14: Programación Orientada a Objetos</option>
  <option <?= x_sel("15-database") ?>>Capítulo 15: Bases de Datos y SQL</option>
  <option <?= x_sel("16-viz") ?>>Capítulo 16: Visualización de Datos</option>
</select>
</div>

<?php
echo($body);
?>
<hr/>
<p>
Si encuentras un error en este libro, siéntete libre de enviarme una solución usando
<a href="https://github.com/csev/py4e/tree/master/book3" target="_blank">Github</a>.
</p>
<?php

$OUTPUT->footer();
