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
<h1 id="uso-de-servicios-web">Uso de Servicios Web</h1>
<p>Una vez que recuperar documentos a través de HTTP y analizarlos usando programas se convirtió en algo sencillo, no se tardó mucho en desarrollar un modelo consistente en la producción de documentos específicamente diseñados para ser consumidos por otros programas (es decir, no únicamente HTML para ser mostrado en un navegador).</p>
<p>Existen dos formatos habituales que se usan para el intercambio de datos a través de la web. El “eXtensible Markup Language” (lenguaje extensible de marcas), o XML, ha sido utilizado durante mucho tiempo, y es el más adecuado para intercambiar datos del tipo documento. Cuando los programas simplemente quieren intercambiar diccionarios, listas u otra información interna, usan “JavaScript Object Notation”, o JSON (Notación de Objetos Javascript; consulta www.json.org). Nosotros examinaremos ambos formatos.</p>
<h2 id="extensible-markup-language---xml">eXtensible Markup Language - XML</h2>
<p>XML tiene un aspecto similar a HTML, pero más estructurado. Este es un ejemplo de un documento XML:</p>
<pre class="xml"><code>&lt;person&gt;
  &lt;name&gt;Chuck&lt;/name&gt;
  &lt;phone type=&quot;intl&quot;&gt;
    +1 734 303 4456
  &lt;/phone&gt;
  &lt;email hide=&quot;yes&quot; /&gt;
&lt;/person&gt;</code></pre>
<p>Cada par de etiquetas de apertura (p. ej., ‘<person>’) y de cierre (p. ej., ‘</person>’) representan un <em>elemento</em> o <em>nodo</em> con el mismo nombre de la etiqueta (p. ej., ‘person’). Cada elemento puede contener texto, atributos (p. ej., ‘hide’) y otros elementos anidados. Si un elemento XML está vacío (es decir, no tiene contenido), puede representarse con una etiqueta auto-cerrada (p. ej., ‘<email />’).</p>
<p>A menudo resulta útil pensar en un documento XML como en la estructura de un árbol, donde hay una etiqueta superior (en este caso ‘person’), y otras etiquetas como ‘phone’ que se muestran como <em>hijas</em> de sus nodos <em>padres</em>.</p>
<figure>
<img src="../images/xml-tree.svg" alt="" /><figcaption>A Tree Representation of XML</figcaption>
</figure>
<h2 id="análisis-de-xml">Análisis de XML</h2>
<p>  </p>
<p>He aquí una aplicación sencilla que analiza un archivo XML y extrae algunos elementos de él:</p>
<pre class="python"><code>import xml.etree.ElementTree as ET

data = &#39;&#39;&#39;
&lt;person&gt;
  &lt;name&gt;Chuck&lt;/name&gt;
  &lt;phone type=&quot;intl&quot;&gt;
    +1 734 303 4456
  &lt;/phone&gt;
  &lt;email hide=&quot;yes&quot; /&gt;
&lt;/person&gt;&#39;&#39;&#39;

tree = ET.fromstring(data)
print(&#39;Name:&#39;, tree.find(&#39;name&#39;).text)
print(&#39;Attr:&#39;, tree.find(&#39;email&#39;).get(&#39;hide&#39;))

# Code: http://www.py4e.com/code3/xml1.py</code></pre>
<p>Tanto la triple comilla simple (’’’’‘) como la triple comilla doble (’"""’) permiten la creación de cadenas que abarquen varias líneas.</p>
<p>La llamada a ‘fromstring’ convierte la representación de cadena del XML en un “árbol” de nodos XML. Una vez tenemos el XML como un árbol, disponemos de una serie de métodos que podemos llamar para extraer porciones de datos de ese XML. La función ‘find’ busca a través del árbol XML y recupera el nodo que coincide con la etiqueta especificada.</p>
<pre><code>Name: Chuck
Attr: yes</code></pre>
<p>El usar un analizador de XML como ‘ElementTree’ tiene la ventaja de que, a pesar de que el XML de este ejemplo es bastante sencillo, resulta que hay muchas reglas relativas a la validez del XML, y el uso de ‘ElementTree’ nos permite extraer datos del XML sin preocuparnos por esas reglas de sintaxis.</p>
<h2 id="desplazamiento-a-través-de-los-nodos">Desplazamiento a través de los nodos</h2>
<p> </p>
<p>A menudo el XML tiene múltiples nodos y tenemos que escribir un bucle para procesarlos todos. En el programa siguiente, usamos un bucle para recorrer todos los nodos ‘user’:</p>
<pre class="python"><code>import xml.etree.ElementTree as ET

input = &#39;&#39;&#39;
&lt;stuff&gt;
  &lt;users&gt;
    &lt;user x=&quot;2&quot;&gt;
      &lt;id&gt;001&lt;/id&gt;
      &lt;name&gt;Chuck&lt;/name&gt;
    &lt;/user&gt;
    &lt;user x=&quot;7&quot;&gt;
      &lt;id&gt;009&lt;/id&gt;
      &lt;name&gt;Brent&lt;/name&gt;
    &lt;/user&gt;
  &lt;/users&gt;
&lt;/stuff&gt;&#39;&#39;&#39;

stuff = ET.fromstring(input)
lst = stuff.findall(&#39;users/user&#39;)
print(&#39;User count:&#39;, len(lst))

for item in lst:
    print(&#39;Name&#39;, item.find(&#39;name&#39;).text)
    print(&#39;Id&#39;, item.find(&#39;id&#39;).text)
    print(&#39;Attribute&#39;, item.get(&#39;x&#39;))

# Code: http://www.py4e.com/code3/xml2.py</code></pre>
<p>El método ‘findall’ devuelve una lista de subárboles que representan las estructuras ‘user’ del árbol XML. A continuación podemos escribir un bucle ‘for’ que busque en cada uno de los nodos usuario, e imprima el texto de los elementos ‘name’ e ‘id’, además del atributo ‘x’ de cada nodo usuario.</p>
<pre><code>User count: 2
Name Chuck
Id 001
Attribute 2
Name Brent
Id 009
Attribute 7</code></pre>
<p>Es importante incluir todos los elementos base en la declaración de ‘findall’ exceptuando aquel que se encuentra en el nivel superior (p. ej., ‘users/user’). De lo contrario, Python no encontrará ninguno de los nodos que buscamos.</p>
<pre class="python"><code>import xml.etree.ElementTree as ET

input = &#39;&#39;&#39;
&lt;stuff&gt;
  &lt;users&gt;
    &lt;user x=&quot;2&quot;&gt;
      &lt;id&gt;001&lt;/id&gt;
      &lt;name&gt;Chuck&lt;/name&gt;
    &lt;/user&gt;
    &lt;user x=&quot;7&quot;&gt;
      &lt;id&gt;009&lt;/id&gt;
      &lt;name&gt;Brent&lt;/name&gt;
    &lt;/user&gt;
  &lt;/users&gt;
&lt;/stuff&gt;&#39;&#39;&#39;

stuff = ET.fromstring(input)

lst = stuff.findall(&#39;users/user&#39;)
print(&#39;User count:&#39;, len(lst))

lst2 = stuff.findall(&#39;user&#39;)
print(&#39;User count:&#39;, len(lst2))</code></pre>
<p>‘lst’ almacena todos los elementos ‘user’ anidados dentro de su base ‘users’. ‘lst2’ busca los elementos ‘user’ que no se encuentren anidados dentro del elemento de nivel superior ‘stuff’ donde no hay ninguno.</p>
<pre><code>User count: 2
User count: 0</code></pre>
<h2 id="javascript-object-notation---json">JavaScript Object Notation - JSON</h2>
<p> </p>
<p>El formato JSON se inspiró en el formato de objetos y arrays que se usa en el lenguaje JavaScript. Pero como Python se inventó antes que JavaScript, la sintaxis usada en Python para los diccionarios y listas influyeron la sintaxis de JSON. De modo que el formato del JSON es casi idéntico a la combinación de listas y diccionarios de Python.</p>
<p>He aquí una codificación JSON que es más o menos equivalente al XML del ejemplo anterior:</p>
<pre class="json"><code>{
  &quot;name&quot; : &quot;Chuck&quot;,
  &quot;phone&quot; : {
    &quot;type&quot; : &quot;intl&quot;,
    &quot;number&quot; : &quot;+1 734 303 4456&quot;
   },
   &quot;email&quot; : {
     &quot;hide&quot; : &quot;yes&quot;
   }
}</code></pre>
<p>Si te fijas, encontrarás ciertas diferencias. Primero, en XML se pueden añadir atributos como “intl” a la etiqueta “phone”. En JSON, simplemente tenemos parejas clave-valor. Además, la etiqueta “person” de XML ha desaparecido, reemplazada por un conjunto de llaves exteriores.</p>
<p>En general, las estructuras JSON son más simples que las de XML, debido a que JSON tiene menos capacidades. Pero JSON tiene la ventaja de que mapea <em>directamente</em> hacia una combinación de diccionarios y listas. Y, dado que casi todos los lenguajes de programación tienen algo equivalente a los diccionarios y listas de Python, JSON es un formato muy intuitivo para que dos programas que vayan a cooperar intercambien datos.</p>
<p>JSON se está convirtiendo rápidamente en el formato elegido para casi todos los intercambios de datos entre aplicaciones, debido a su relativa simplicidad comparado con XML.</p>
<h2 id="análisis-de-json">Análisis de JSON</h2>
<p>El JSON se construye anidando diccionarios y listas según se necesite. En este ejemplo, vamos a representar una lista de usuarios en la que cada usuario es un conjunto de parejas clave-valor (es decir, un diccionario). De modo que tendremos una lista de diccionarios.</p>
<p>En el programa siguiente, usaremos la librería integrada ‘json’ para analizar el JSON y leer los datos. Compáralo cuidadosamente con los datos y código XML equivalentes que usamos antes. El JSON tiene menos detalles, de modo que podemos saber de antemano que vamos a obtener una lista y que la lista es de usuarios y además que cada usuario es un conjunto de parejas clave-valor. El JSON es más conciso (una ventaja), pero también es menos auto-descriptivo (una desventaja).</p>
<pre class="python"><code>import json

data = &#39;&#39;&#39;
[
  { &quot;id&quot; : &quot;001&quot;,
    &quot;x&quot; : &quot;2&quot;,
    &quot;name&quot; : &quot;Chuck&quot;
  } ,
  { &quot;id&quot; : &quot;009&quot;,
    &quot;x&quot; : &quot;7&quot;,
    &quot;name&quot; : &quot;Brent&quot;
  }
]&#39;&#39;&#39;

info = json.loads(data)
print(&#39;User count:&#39;, len(info))

for item in info:
    print(&#39;Name&#39;, item[&#39;name&#39;])
    print(&#39;Id&#39;, item[&#39;id&#39;])
    print(&#39;Attribute&#39;, item[&#39;x&#39;])

# Code: http://www.py4e.com/code3/json2.py</code></pre>
<p>Si comparas el código que extrae los datos del JSON analizado y el del XML, verás que lo que obtenemos de ‘json.loads()’ es una lista de Python que recorreremos con un bucle for, y cada elemento dentro de esa lista es un diccionario de Python. Una vez analizado el JSON, podemos usar el operador índice de Python para extraer los distintos fragmentos de datos de cada usuario. No tenemos que usar la librería JSON para rebuscar a través del JSON analizado, ya que los datos devueltos son sencillamente estructuras nativas de Python.</p>
<p>La salida de este programa es exactamente la misma que la de la versión XML anterior.</p>
<pre><code>User count: 2
Name Chuck
Id 001
Attribute 2
Name Brent
Id 009
Attribute 7</code></pre>
<p>En general, hay una tendencia en la industria a apartarse del XML y pasar al JSON para los servicios web. Como el JSON es más sencillo, y se mapea de forma más directa hacia estructuras de datos nativas que ya tenemos en los lenguajes de programación, el código de análisis y extracción de datos normalmente es más sencillo y directo usando JSON. Sin embargo, XML es más auto-descriptivo, y por eso hay ciertas aplicaciones en las cuales mantiene su ventaja. Por ejemplo, la mayoría de los procesadores de texto almacenan sus documentos internamente usando XML en vez de JSON.</p>
<h2 id="interfaces-de-programación-de-aplicaciones">Interfaces de programación de aplicaciones</h2>
<p>Ahora tenemos la capacidad de intercambiar datos entre aplicaciones usando el Protocolo de Transporte de Hipertexto (HTTP), y un modo de representar estructuras de datos complejas para poder enviar y recibir los datos entre esas aplicaciones, a través del eXtensibleMarkup Language (XML) o del JavaScript Object Notation (JSON).</p>
<p>El paso siguiente es empezar a definir y documentar “contratos” entre aplicaciones usando estas técnicas. El nombre habitual para estos contratos entre aplicaciones es <em>Interfaces de Programación de Aplicaciones</em> (Application Program Interfaces), o APIs. Cuando se utiliza una API, normalmente un programa crea un conjunto de <em>servicios</em> disponibles para que los usen otras aplicaciones y publica las APIs (es decir, las “reglas”) que deben ser seguidas para acceder a los servicios proporcionados por el programa.</p>
<p>Cuando comenzamos a construir programas con funcionalidades que incluyen el acceso a servicios proporcionados por otros programas, el enfoque se denomina <em>Service-Oriented Architecture</em> (Arquitectura Orientada a Servicios), o SOA. Un enfoque SOA es aquel en el cual nuestra aplicación principal usa los servicios de otras aplicaciones. Un planteamiento no-SOA es aquel en el cual tenemos una única aplicación independiente que contiene todo el código necesario para su implementación.</p>
<p>Podemos encontrar multitud de ejemplos de SOAs cuando utilizamos servicios de la web. Podemos ir a un único sitio web y reservar viajes en avión, hoteles y automóviles, todo ello desde el mismo sitio. Los datos de los hoteles no están almacenados en los equipos de la compañía aérea. En vez de eso, los computadores de la aerolínea contactan con los servicios de los computadores de los hoteles, recuperan los datos de éstos, y se los presentan al usuario. Cuando el usuario acepta realizar una reserva de un hotel usando el sitio web de una aerolínea, ésta utiliza otro servicio web en los sistemas de los hoteles para realizar la reserva real. Y cuando llega el momento de cargar en tu tarjeta de crédito el importe de la transacción completa, hay todavía otros equipos diferentes involucrados en el proceso.</p>
<figure>
<img src="../images/soa.svg" alt="" /><figcaption>Service-oriented architecture</figcaption>
</figure>
<p>Una Arquitectura Orientada a Servicios tiene muchas ventajas, que incluyen: (1) siempre se mantiene una única copia de los datos (lo cual resulta particularmente importante en ciertas áreas como las reservas hoteleras, donde no queremos duplicar excesivamente la información) y (2) los propietarios de los datos pueden imponer reglas acerca del uso de esos datos. Con estas ventajas, un sistema SOA debe ser diseñado cuidadosamente para tener buen rendimiento y satisfacer las necesidades de los usuarios.</p>
<p>Cuando una aplicación ofrece un conjunto de servicios en su API disponibles a través de la web, los llamamos <em>servicios web</em>.</p>
<h2 id="seguridad-y-uso-de-apis">Seguridad y uso de APIs</h2>
<p> </p>
<p>Resulta bastante frecuente que se necesite algún tipo de “clave API” para hacer uso de una API comercial. La idea general es que ellos quieren saber quién está usando sus servicios y cuánto los utiliza cada usuario. Tal vez tienen distintos niveles (gratuitos y de pago) de servicios, o una política que limita el número de peticiones que un único usuario puede realizar durante un determinado periodo de tiempo.</p>
<p>En ocasiones, una vez que tienes tu clave API, tan sólo debes incluirla como parte de los datos POST, o tal vez como parámetro dentro de la URL que usas para llamar a la API.</p>
<p>Otras veces, el vendedor quiere aumentar la certeza sobre el origen de las peticiones, de modo que además espera que envíes mensajes firmados criptográficamente, usando claves compartidas y secretas. Una tecnología muy habitual que se utiliza para firmar peticiones en Internet se llama <em>OAuth</em>. Puedes leer más acerca del protocolo OAuth en <a href="http://www.oauth.net">www.oauth.net</a>.</p>
<p>Afortunadamente, hay varias librerías OAuth útiles y gratuitas, de modo que te puedes ahorrar el tener que escribir una implementación OAuth desde cero leyendo las especificaciones. Estas librerías tienen distintos niveles de complejidad, así como variedad de características. El sitio web OAuth tiene información sobre varias librerías OAuth.</p>
<h2 id="glossary">Glossary</h2>
<dl>
<dt>API</dt>
<dd>Application Programming Interface (Interfaz de Programación de Aplicaciones) - Un contrato entre aplicaciones que define las pautas de interacción entre los componentes de dos aplicaciones.
</dd>
<dt>ElementTree</dt>
<dd>Una librería interna de Python que se utiliza para analizar datos XML.
</dd>
<dt>JSON</dt>
<dd>JavaScript Object Notation (Notación de Objetos JavaScript). Un formato que permite el envío de estructuras de datos basadas en la sintaxis de los Objetos JavaScript.
</dd>
</dl>
<p> </p>
<dl>
<dt>SOA</dt>
<dd>Service-Oriented Architecture (Arquitectura Orientada a Servicios). Cuando una aplicación está formada por componentes conectados a través de una red.
</dd>
</dl>
<p> </p>
<dl>
<dt>XML</dt>
<dd>eXtensible Markup Language (Lenguaje de Marcas eXtensible). Un formato que permite el envío de datos estructurados.
</dd>
</dl>
<p> </p>
<h2 id="aplicación-nº-1-servicio-web-de-geocodificación-de-google">Aplicación Nº 1: Servicio web de geocodificación de Google</h2>
<p>  </p>
<p>Google tiene un excelente servicio web que nos permite hacer uso de su enorme base de datos de información geográfica. Podemos enviar una cadena de búsqueda geográfica, como “Ann Arbor, MI” a su API de geocodificación y conseguir que Google nos devuelva su mejor suposición sobre donde podría estar nuestra cadena de búsqueda en un mapa, además de los puntos de referencia en los alrededores.</p>
<p>El servicio de geocodificación es gratuito, pero limitado, de modo que no se puede hacer un uso intensivo de esta API en una aplicación comercial. Pero si tienes ciertos datos estadísticos en los cuales un usuario final ha introducido una localización en formato libre en un cuadro de texto, puedes utilizar esta API para limpiar esos datos de forma bastante efectiva.</p>
<p><em>Cuando se usa una API libre, como la API de geocodificación de Google, se debe ser respetuoso con el uso de los recursos. Si hay demasiada gente que abusa del servicio, Google puede interrumpir o restringir significativamente su uso gratuito.</em></p>
<p></p>
<p>Puedes leer la documentación online de este servicio, pero es bastante sencillo y puedes incluso probarlo desde un navegador, simplemente tecleando la siguiente URL en él:</p>
<p><a href="http://maps.googleapis.com/maps/api/geocode/json?address=Ann+Arbor%2C+MI">http://maps.googleapis.com/maps/api/geocode/json?address=Ann+Arbor%2C+MI</a></p>
<p>Asegúrate de limpiar la URL y eliminar cualquier espacio de ella antes de pegarla en tu navegador.</p>
<p>La siguiente es una aplicación sencilla que pide al usuario una cadena de búsqueda, llama a la API de geocodificación de Google y extrae información del JSON que nos devuelve.</p>
<pre class="python"><code>import urllib.request, urllib.parse, urllib.error
import json
import ssl

api_key = False
# If you have a Google Places API key, enter it here
# api_key = &#39;AIzaSy___IDByT70&#39;
# https://developers.google.com/maps/documentation/geocoding/intro

if api_key is False:
    api_key = 42
    serviceurl = &#39;http://py4e-data.dr-chuck.net/json?&#39;
else :
    serviceurl = &#39;https://maps.googleapis.com/maps/api/geocode/json?&#39;

# Ignore SSL certificate errors
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

while True:
    address = input(&#39;Enter location: &#39;)
    if len(address) &lt; 1: break

    parms = dict()
    parms[&#39;address&#39;] = address
    if api_key is not False: parms[&#39;key&#39;] = api_key
    url = serviceurl + urllib.parse.urlencode(parms)

    print(&#39;Retrieving&#39;, url)
    uh = urllib.request.urlopen(url, context=ctx)
    data = uh.read().decode()
    print(&#39;Retrieved&#39;, len(data), &#39;characters&#39;)

    try:
        js = json.loads(data)
    except:
        js = None

    if not js or &#39;status&#39; not in js or js[&#39;status&#39;] != &#39;OK&#39;:
        print(&#39;==== Failure To Retrieve ====&#39;)
        print(data)
        continue

    print(json.dumps(js, indent=4))

    lat = js[&#39;results&#39;][0][&#39;geometry&#39;][&#39;location&#39;][&#39;lat&#39;]
    lng = js[&#39;results&#39;][0][&#39;geometry&#39;][&#39;location&#39;][&#39;lng&#39;]
    print(&#39;lat&#39;, lat, &#39;lng&#39;, lng)
    location = js[&#39;results&#39;][0][&#39;formatted_address&#39;]
    print(location)

# Code: http://www.py4e.com/code3/geojson.py</code></pre>
<p>El programa toma la cadena de búsqueda y construye una URL codificándola como parámetro dentro de ella, utilizando luego ‘urllib’ para recuperar el texto de la API de geocodificación de Google. A diferencia de una página web estática, los datos que obtengamos dependerán de los parámetros que enviemos y de los datos geográficos almacenados en los servidores de Google.</p>
<p>Una vez recuperados los datos JSON, los analizamos con la librería ‘json’ y revisamos para asegurarnos de que hemos recibido datos válidos. Finalmente, extraemos la información que buscábamos.</p>
<p>La salida del programa es la siguiente (parte del JSON recibido ha sido eliminado):</p>
<pre><code>$ python3 geojson.py
Enter location: Ann Arbor, MI
Retrieving http://py4e-data.dr-chuck.net/json?address=Ann+Arbor%2C+MI&amp;key=42
Retrieved 1736 characters</code></pre>
<pre class="json"><code>{
    &quot;results&quot;: [
        {
            &quot;address_components&quot;: [
                {
                    &quot;long_name&quot;: &quot;Ann Arbor&quot;,
                    &quot;short_name&quot;: &quot;Ann Arbor&quot;,
                    &quot;types&quot;: [
                        &quot;locality&quot;,
                        &quot;political&quot;
                    ]
                },
                {
                    &quot;long_name&quot;: &quot;Washtenaw County&quot;,
                    &quot;short_name&quot;: &quot;Washtenaw County&quot;,
                    &quot;types&quot;: [
                        &quot;administrative_area_level_2&quot;,
                        &quot;political&quot;
                    ]
                },
                {
                    &quot;long_name&quot;: &quot;Michigan&quot;,
                    &quot;short_name&quot;: &quot;MI&quot;,
                    &quot;types&quot;: [
                        &quot;administrative_area_level_1&quot;,
                        &quot;political&quot;
                    ]
                },
                {
                    &quot;long_name&quot;: &quot;United States&quot;,
                    &quot;short_name&quot;: &quot;US&quot;,
                    &quot;types&quot;: [
                        &quot;country&quot;,
                        &quot;political&quot;
                    ]
                }
            ],
            &quot;formatted_address&quot;: &quot;Ann Arbor, MI, USA&quot;,
            &quot;geometry&quot;: {
                &quot;bounds&quot;: {
                    &quot;northeast&quot;: {
                        &quot;lat&quot;: 42.3239728,
                        &quot;lng&quot;: -83.6758069
                    },
                    &quot;southwest&quot;: {
                        &quot;lat&quot;: 42.222668,
                        &quot;lng&quot;: -83.799572
                    }
                },
                &quot;location&quot;: {
                    &quot;lat&quot;: 42.2808256,
                    &quot;lng&quot;: -83.7430378
                },
                &quot;location_type&quot;: &quot;APPROXIMATE&quot;,
                &quot;viewport&quot;: {
                    &quot;northeast&quot;: {
                        &quot;lat&quot;: 42.3239728,
                        &quot;lng&quot;: -83.6758069
                    },
                    &quot;southwest&quot;: {
                        &quot;lat&quot;: 42.222668,
                        &quot;lng&quot;: -83.799572
                    }
                }
            },
            &quot;place_id&quot;: &quot;ChIJMx9D1A2wPIgR4rXIhkb5Cds&quot;,
            &quot;types&quot;: [
                &quot;locality&quot;,
                &quot;political&quot;
            ]
        }
    ],
    &quot;status&quot;: &quot;OK&quot;
}
lat 42.2808256 lng -83.7430378
Ann Arbor, MI, USA</code></pre>
<pre><code>Enter location:</code></pre>
<p>Puedes descargar <a href="http://www.py4e.com/code3/geoxml.py">www.py4e.com/code3/geoxml.py</a> para revisar las variantes JSON y XML de la API de geocodificación de Google.</p>
<p><strong>Ejercicio 1: Modifica</strong> <a href="http://www.py4e.com/code3/geojson.py"><strong>geojson.py</strong></a> <strong>o</strong> <a href="http://www.py4e.com/code3/geoxml.py"><strong>geoxml.py</strong></a> <strong>para imprimir en pantalla el código de país de dos caracteres de los datos recuperados. Añade comprobación de errores, de modo que tu programa no rastree los datos si el código del país no está presente. Una vez que lo tengas funcionando, busca “Océano Atlántico” y asegúrate de que es capaz de gestionar ubicaciones que no estén dentro de ningún país. </strong></p>
<h2 id="aplicación-2-twitter">Aplicación 2: Twitter</h2>
<p>A medida que la API de Twitter se vuelve más valiosa, Twitter pasó de una API pública y abierta a una que requiere el uso de firmas OAuth en cada solicitud.</p>
<p>Para el programa de ejemplo siguiente, descarga los archivos <em>twurl.py</em>, <em>hidden.py</em>, <em>oauth.py</em> y <em>twitter1.py</em> desde <a href="http://www.py4e.com/code3">www.py4e.com/code</a> y ponlos todos en una misma carpeta en tu equipo.</p>
<p>Para usar estos programas debes tener una cuenta de Twitter, y autorizar a tu código Python como aplicación permitida, estableciendo diversos parámetros (key, secret, token y token secret). Luego deberás editar el archivo <em>hidden.py</em> y colocar esas cuatro cadenas en las variables apropiadas dentro del archivo:</p>
<pre class="python"><code># Keep this file separate

# https://apps.twitter.com/
# Create new App and get the four strings

def oauth():
    return {&quot;consumer_key&quot;: &quot;h7Lu...Ng&quot;,
            &quot;consumer_secret&quot;: &quot;dNKenAC3New...mmn7Q&quot;,
            &quot;token_key&quot;: &quot;10185562-eibxCp9n2...P4GEQQOSGI&quot;,
            &quot;token_secret&quot;: &quot;H0ycCFemmC4wyf1...qoIpBo&quot;}

# Code: http://www.py4e.com/code3/hidden.py</code></pre>
<p>Se puede acceder al servicio web de Twitter mediante una URL como ésta:</p>
<p><a href="https://api.twitter.com/1.1/statuses/user_timeline.json" class="uri">https://api.twitter.com/1.1/statuses/user_timeline.json</a></p>
<p>Pero una vez añadida la información de seguridad, la URL se parecerá más a esto: ~~~~ https://api.twitter.com/1.1/statuses/user_timeline.json?count=2 &amp;oauth_version=1.0&amp;oauth_token=101…SGI&amp;screen_name=drchuck &amp;oauth_nonce=09239679&amp;oauth_timestamp=1380395644 &amp;oauth_signature=rLK…BoD&amp;oauth_consumer_key=h7Lu…GNg &amp;oauth_signature_method=HMAC-SHA1 ~~~~</p>
<p>Puedes leer la especificación OAuth si quieres saber más acerca del significado de los distintos parámetros que hemos añadido para cumplir con los requerimientos de seguridad de OAuth.</p>
<p>Para los programas que ejecutamos con Twitter, ocultamos toda la complejidad dentro de los archivos <em>oauth.py</em> y <em>twurl.py</em>. Simplemente ajustamos los parámetros secretos en <em>hidden.py</em>, enviamos la URL deseada a la función <em>twurl.augment()</em>, y el código de la librería añade todos los parámetros necesarios a la URL.</p>
<p>Este programa recupera la línea de tiempo de un usuario de Twitter concreto y nos la devuelve en formato JSON como una cadena. Vamos a imprimir simplemente los primeros 250 caracteres de esa cadena:</p>
<pre class="python"><code>import urllib.request, urllib.parse, urllib.error
import twurl
import ssl

# https://apps.twitter.com/
# Create App and get the four strings, put them in hidden.py

TWITTER_URL = &#39;https://api.twitter.com/1.1/statuses/user_timeline.json&#39;

# Ignore SSL certificate errors
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

while True:
    print(&#39;&#39;)
    acct = input(&#39;Enter Twitter Account:&#39;)
    if (len(acct) &lt; 1): break
    url = twurl.augment(TWITTER_URL,
                        {&#39;screen_name&#39;: acct, &#39;count&#39;: &#39;2&#39;})
    print(&#39;Retrieving&#39;, url)
    connection = urllib.request.urlopen(url, context=ctx)
    data = connection.read().decode()
    print(data[:250])
    headers = dict(connection.getheaders())
    # print headers
    print(&#39;Remaining&#39;, headers[&#39;x-rate-limit-remaining&#39;])

# Code: http://www.py4e.com/code3/twitter1.py</code></pre>
<p>Cuando el programa se ejecuta, produce la salida siguiente:</p>
<pre><code>Enter Twitter Account:drchuck
Retrieving https://api.twitter.com/1.1/ ...
[{&quot;created_at&quot;:&quot;Sat Sep 28 17:30:25 +0000 2013&quot;,&quot;
id&quot;:384007200990982144,&quot;id_str&quot;:&quot;384007200990982144&quot;,
&quot;text&quot;:&quot;RT @fixpert: See how the Dutch handle traffic
intersections: http:\/\/t.co\/tIiVWtEhj4\n#brilliant&quot;,
&quot;source&quot;:&quot;web&quot;,&quot;truncated&quot;:false,&quot;in_rep
Remaining 178

Enter Twitter Account:fixpert
Retrieving https://api.twitter.com/1.1/ ...
[{&quot;created_at&quot;:&quot;Sat Sep 28 18:03:56 +0000 2013&quot;,
&quot;id&quot;:384015634108919808,&quot;id_str&quot;:&quot;384015634108919808&quot;,
&quot;text&quot;:&quot;3 months after my freak bocce ball accident,
my wedding ring fits again! :)\n\nhttps:\/\/t.co\/2XmHPx7kgX&quot;,
&quot;source&quot;:&quot;web&quot;,&quot;truncated&quot;:false,
Remaining 177

Enter Twitter Account:</code></pre>
<p>Junto con los datos de la línea del tiempo, Twitter también devuelve metadatos sobre la petición en las cabeceras de respuesta HTTP. Una cabecera en particular, ‘x-rate-limit-remaining’, nos informa sobre cuántas peticiones podremos hacer antes de que seamos bloqueados por un corto periodo de tiempo. Puedes ver que cada vez que realizamos una petición a la API nuestros intentos restantes van disminuyendo.</p>
<p>En el ejemplo siguiente, recuperamos los amigos de un usuario en Twitter, analizamos el JSON devuelto y extraemos parte de la información sobre esos amigos. Después de analizar el JSON e “imprimirlo bonito”, realizamos un volcado completo con un indentado de cuatro caracteres, que nos permite estudiar minuciosamente los datos en caso de que queramos extraer más campos.</p>
<pre class="python"><code>import urllib.request, urllib.parse, urllib.error
import twurl
import json
import ssl

# https://apps.twitter.com/
# Create App and get the four strings, put them in hidden.py

TWITTER_URL = &#39;https://api.twitter.com/1.1/friends/list.json&#39;

# Ignore SSL certificate errors
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

while True:
    print(&#39;&#39;)
    acct = input(&#39;Enter Twitter Account:&#39;)
    if (len(acct) &lt; 1): break
    url = twurl.augment(TWITTER_URL,
                        {&#39;screen_name&#39;: acct, &#39;count&#39;: &#39;5&#39;})
    print(&#39;Retrieving&#39;, url)
    connection = urllib.request.urlopen(url, context=ctx)
    data = connection.read().decode()

    js = json.loads(data)
    print(json.dumps(js, indent=2))

    headers = dict(connection.getheaders())
    print(&#39;Remaining&#39;, headers[&#39;x-rate-limit-remaining&#39;])

    for u in js[&#39;users&#39;]:
        print(u[&#39;screen_name&#39;])
        if &#39;status&#39; not in u:
            print(&#39;   * No status found&#39;)
            continue
        s = u[&#39;status&#39;][&#39;text&#39;]
        print(&#39;  &#39;, s[:50])

# Code: http://www.py4e.com/code3/twitter2.py</code></pre>
<p>Dado que el JSON se transforma en un conjunto de listas y diccionarios de Python anidados, podemos usar una combinación del operador índice junto con bucles ‘for’ para movernos a través de las estructuras de datos devueltas con muy poco código de Python.</p>
<p>La salida del programa se parece a la siguiente (parte de los datos se han acortado para que quepan en la página):</p>
<pre><code>Enter Twitter Account:drchuck
Retrieving https://api.twitter.com/1.1/friends ...
Remaining 14</code></pre>
<pre class="json"><code>{
  &quot;next_cursor&quot;: 1444171224491980205,
  &quot;users&quot;: [
    {
      &quot;id&quot;: 662433,
      &quot;followers_count&quot;: 28725,
      &quot;status&quot;: {
        &quot;text&quot;: &quot;@jazzychad I just bought one .__.&quot;,
        &quot;created_at&quot;: &quot;Fri Sep 20 08:36:34 +0000 2013&quot;,
        &quot;retweeted&quot;: false,
      },
      &quot;location&quot;: &quot;San Francisco, California&quot;,
      &quot;screen_name&quot;: &quot;leahculver&quot;,
      &quot;name&quot;: &quot;Leah Culver&quot;,
    },
    {
      &quot;id&quot;: 40426722,
      &quot;followers_count&quot;: 2635,
      &quot;status&quot;: {
        &quot;text&quot;: &quot;RT @WSJ: Big employers like Google ...&quot;,
        &quot;created_at&quot;: &quot;Sat Sep 28 19:36:37 +0000 2013&quot;,
      },
      &quot;location&quot;: &quot;Victoria Canada&quot;,
      &quot;screen_name&quot;: &quot;_valeriei&quot;,
      &quot;name&quot;: &quot;Valerie Irvine&quot;,
    }
  ],
 &quot;next_cursor_str&quot;: &quot;1444171224491980205&quot;
}</code></pre>
<pre><code>leahculver
   @jazzychad I just bought one .__.
_valeriei
   RT @WSJ: Big employers like Google, AT&amp;amp;T are h
ericbollens
   RT @lukew: sneak peek: my LONG take on the good &amp;a
halherzog
   Learning Objects is 10. We had a cake with the LO,
scweeker
   @DeviceLabDC love it! Now where so I get that &quot;etc

Enter Twitter Account:</code></pre>
<p>El último trozo de la salida es donde podemos ver cómo el bucle for lee los cinco “amigos” más nuevos de la cuenta de Twitter <em><span class="citation" data-cites="drchuck">@drchuck</span></em> e imprime el estado más reciente de cada uno de ellos. Hay muchos más datos disponibles en el JSON devuelto. Si miras la salida del programa, podrás ver que el “encuentra a los amigos” de una cuenta particular tiene una limitación de usos distinta a la del número de consultas de líneas de tiempo que está permitido realizar durante un periodo de tiempo.</p>
<p>Estas claves de seguridad de la API permiten a Twitter tener la certeza de que sabe quién está usando su API de datos, y a qué nivel. El enfoque de límite de usos nos permite hacer capturas de datos sencillas, pero no crear un producto que extraiga datos de esa API millones de veces al día.</p>
</body>
</html>
<?php if ( file_exists("../bookfoot.php") ) {
  $HTML_FILE = basename(__FILE__);
  $HTML = ob_get_contents();
  ob_end_clean();
  require_once "../bookfoot.php";
}?>
