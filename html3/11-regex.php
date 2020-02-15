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
<h1 id="expresiones-regulares">Expresiones regulares</h1>
<p>Hasta ahora hemos leído archivos, buscando patrones y extrayendo varias secciones de líneas que hemos encontrado interesantes. Hemos</p>
<p>usado métodos de cadenas como <code>split</code> y <code>find</code>, así como rebanar listas y cadenas para extraer trozos de las líneas.</p>
<p>  </p>
<p>Esta tarea de buscar y extraer es tan común que Python tiene una librería muy poderosa llamada <em>expresiones regulares</em> que maneja varias de estas tareas de manera bastante elegante. La razón por la que no presentamos las expresiones regulares antes se debe a que, aunque son muy poderosas, son un poco más complicadas y toma algo de tiempo acostumbrarse a su sintaxis.</p>
<p>Las expresiones regulares casi son su propio lenguaje de programación en miniatura para buscar y analizar cadenas. De hecho, se han escrito libros enteros sobre las expresiones regulares. En este capítulo, solo cubriremos los aspectos básicos de las expresiones regulares. Para más información al respecto, recomendamos ver:</p>
<p><a href="https://es.wikipedia.org/wiki/Expresi%C3%B3n_regular">https://es.wikipedia.org/wiki/Expresi%C3%B3n_regular</a></p>
<p><a href="https://docs.python.org/library/re.html" class="uri">https://docs.python.org/library/re.html</a></p>
<p>Se debe importar la librería de expresiones regulares <code>re</code> a tu programa antes de que puedas usarlas. La forma más simple de usar la librería de expresiones regulares es la función <code>search()</code> (N. del T.: &quot;search&quot; significa búsqueda). El siguiente programa demuestra una forma muy sencilla de usar esta función.</p>
<p></p>
<pre class="python"><code># Search for lines that contain &#39;From&#39;
import re
hand = open(&#39;mbox-short.txt&#39;)
for line in hand:
    line = line.rstrip()
    if re.search(&#39;From:&#39;, line):
        print(line)

# Code: http://www.py4e.com/code3/re01.py</code></pre>

<p>Abrimos el archivo, revisamos cada línea, y usamos la expresión regular <code>search()</code> para imprimir solo las líneas que contengan la cadena &quot;From&quot;. Este programa no toma ventaja del auténtico poder de las expresiones regulares, ya que podríamos simplemente haber usado <code>line.find()</code> para lograr el mismo resultado.</p>
<p></p>
<p>El poder de las expresiones regulares se manifiesta cuando agregamos caracteres especiales a la cadena de búsqueda que nos permite controlar de manera más precisa qué líneas calzan con la cadena. Agregar estos caracteres especiales a nuestra expresión regular nos permitirá buscar coincidencias y extraer datos usando unas pocas líneas de código.</p>
<p>Por ejemplo, el signo de intercalación (N. del T.: &quot;caret&quot; en inglés, corresponde al signo ^) se utiliza en expresiones regulares para encontrar &quot;el comienzo&quot; de una lína. Podríamos cambiar nuestro programa para que solo retorne líneas en que tengan &quot;From:&quot; al comienzo, de la siguiente manera:</p>
<pre class="python"><code># Search for lines that start with &#39;From&#39;
import re
hand = open(&#39;mbox-short.txt&#39;)
for line in hand:
    line = line.rstrip()
    if re.search(&#39;^From:&#39;, line):
        print(line)

# Code: http://www.py4e.com/code3/re02.py</code></pre>

<p>Ahora solo retornará líneas que <em>comiencen con</em> la cadena &quot;From:&quot;. Este sigue siendo un ejemplo muy sencillo que podríamos haber implementado usando el método <code>startswith()</code> de la librería de cadenas. Pero sirve para presentar la idea de que las expresiones regulares contienen caracteres especiales que nos dan mayor control sobre qué coincidencias retornará la expresión regular. will match the regular expression.</p>
<p></p>
<h2 id="coincidencia-de-caracteres-en-expresiones-regulares">Coincidencia de caracteres en expresiones regulares</h2>
<p>Existen varios caracteres especiales que nos permiten construir expresiones regulares incluso más poderosas. El más común es el punto, que coincide con cualquier carácter.</p>
<p> </p>
<p>En el siguiente ejemplo, la expresión regular <code>F..m:</code> coincidiría con las cadenas &quot;From:&quot;, &quot;Fxxm:&quot;, &quot;F12m:&quot;, o &quot;F!<span class="citation">@m</span>:&quot;, ya que los caracteres de punto en la expresión regular coinciden con cualquier carácter.</p>
<pre class="python"><code># Search for lines that start with &#39;F&#39;, followed by
# 2 characters, followed by &#39;m:&#39;
import re
hand = open(&#39;mbox-short.txt&#39;)
for line in hand:
    line = line.rstrip()
    if re.search(&#39;^F..m:&#39;, line):
        print(line)

# Code: http://www.py4e.com/code3/re03.py</code></pre>

<p>Esto resulta particularmente poderoso cuando se le combina con la habilidad de indicar que un carácter puede repetirse cualquier cantidad de veces usando los caracteres <code>*</code> o <code>+</code> en tu expresión regular. Estos caracteres especiales indican que en lugar de coincidir con un solo carácter en la cadena de búsqueda, coinciden con cero o más caracteres (en el caso del asterisco) o con uno o más caracteres (en el caso del signo de suma).</p>
<p>Podemos reducir más las líneas que coincidan usando un carácter <em>comodín</em> en el siguiente ejemplo:</p>
<pre class="python"><code># Search for lines that start with From and have an at sign
import re
hand = open(&#39;mbox-short.txt&#39;)
for line in hand:
    line = line.rstrip()
    if re.search(&#39;^From:.+@&#39;, line):
        print(line)

# Code: http://www.py4e.com/code3/re04.py</code></pre>

<p>La cadena <code>^From:.+@</code> retornará coincidencias con líneas que empiecen con &quot;From:&quot;, seguidas de uno o más caracteres (<code>.+</code>), seguidas de un carácter @. Por lo tanto, la siguiente línea coincidirá:</p>
<pre><code>From: stephen.marquard@uct.ac.za</code></pre>
<p>Puede considerarse que el comodín <code>.+</code> se expande para abarcar todos los caracteres entre los signos : y @.</p>
<pre><code>From:.+@</code></pre>
<p>Conviene considerar que los signos de suma y los asteriscos &quot;empujan&quot;. Por ejemplo, la siguiente cadena marcaría una coincidencia con el último signo @, ya que el <code>.+</code> &quot;empujan&quot; hacia afuera, como se muestra a continuación:</p>
<pre><code>From: stephen.marquard@uct.ac.za, csev@umich.edu, and cwen @iupui.edu</code></pre>
<p>Es posible indicar a un asterisco o signo de suma que no debe ser tan &quot;ambicioso&quot; agregando otro carácter. Revisa la documentación para obtener información sobre cómo desactivar este comportamiento ambicioso.</p>
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
s = &#39;A message from csev@umich.edu to cwen@iupui.edu about meeting @2PM&#39;
lst = re.findall(&#39;\S+@\S+&#39;, s)
print(lst)

# Code: http://www.py4e.com/code3/re05.py</code></pre>

<p>El método <code>findall()</code> busca en la cadena en el segundo argumento y retorna una lista de todas las cadenas que parecen ser direcciones de email. Estamos usando una secuencia de dos caracteres que coincide con un carácter distinto a un espacio en blanco (<code>\S</code>).</p>
<p>El resultado de la ejecución del programa debiera ser:</p>
<pre><code>[&#39;csev@umich.edu&#39;, &#39;cwen@iupui.edu&#39;]</code></pre>
<p>Translating the regular expression, we are looking for substrings that have at least one non-whitespace character, followed by an at-sign, followed by at least one more non-whitespace character. The <code>\S+</code> matches as many non-whitespace characters as possible.</p>
<p>The regular expression would match twice (csev@umich.edu and cwen@iupui.edu), but it would not match the string &quot;<span class="citation">@2PM</span>&quot; because there are no non-blank characters <em>before</em> the at-sign. We can use this regular expression in a program to read all the lines in a file and print out anything that looks like an email address as follows:</p>
<pre class="python"><code># Search for lines that have an at sign between characters
import re
hand = open(&#39;mbox-short.txt&#39;)
for line in hand:
    line = line.rstrip()
    x = re.findall(&#39;\S+@\S+&#39;, line)
    if len(x) &gt; 0:
        print(x)

# Code: http://www.py4e.com/code3/re06.py</code></pre>

<p>We read each line and then extract all the substrings that match our regular expression. Since <code>findall()</code> returns a list, we simply check if the number of elements in our returned list is more than zero to print only lines where we found at least one substring that looks like an email address.</p>
<p>If we run the program on <em>mbox.txt</em> we get the following output:</p>
<pre><code>[&#39;wagnermr@iupui.edu&#39;]
[&#39;cwen@iupui.edu&#39;]
[&#39;&lt;postmaster@collab.sakaiproject.org&gt;&#39;]
[&#39;&lt;200801032122.m03LMFo4005148@nakamura.uits.iupui.edu&gt;&#39;]
[&#39;&lt;source@collab.sakaiproject.org&gt;;&#39;]
[&#39;&lt;source@collab.sakaiproject.org&gt;;&#39;]
[&#39;&lt;source@collab.sakaiproject.org&gt;;&#39;]
[&#39;apache@localhost)&#39;]
[&#39;source@collab.sakaiproject.org;&#39;]</code></pre>
<p>Some of our email addresses have incorrect characters like &quot;&lt;&quot; or &quot;;&quot; at the beginning or end. Let's declare that we are only interested in the portion of the string that starts and ends with a letter or a number.</p>
<p>To do this, we use another feature of regular expressions. Square brackets are used to indicate a set of multiple acceptable characters we are willing to consider matching. In a sense, the <code>\S</code> is asking to match the set of &quot;non-whitespace characters&quot;. Now we will be a little more explicit in terms of the characters we will match.</p>
<p>Here is our new regular expression:</p>
<pre><code>[a-zA-Z0-9]\S*@\S*[a-zA-Z]</code></pre>
<p>This is getting a little complicated and you can begin to see why regular expressions are their own little language unto themselves. Translating this regular expression, we are looking for substrings that start with a <em>single</em> lowercase letter, uppercase letter, or number &quot;[a-zA-Z0-9]&quot;, followed by zero or more non-blank characters (<code>\S*</code>), followed by an at-sign, followed by zero or more non-blank characters (<code>\S*</code>), followed by an uppercase or lowercase letter. Note that we switched from <code>+</code> to <code>*</code> to indicate zero or more non-blank characters since <code>[a-zA-Z0-9]</code> is already one non-blank character. Remember that the <code>*</code> or <code>+</code> applies to the single character immediately to the left of the plus or asterisk.</p>
<p></p>
<p>If we use this expression in our program, our data is much cleaner:</p>
<pre class="python"><code># Search for lines that have an at sign between characters
# The characters must be a letter or number
import re
hand = open(&#39;mbox-short.txt&#39;)
for line in hand:
    line = line.rstrip()
    x = re.findall(&#39;[a-zA-Z0-9]\S+@\S+[a-zA-Z]&#39;, line)
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
<p>Notice that on the <code>source@collab.sakaiproject.org</code> lines, our regular expression eliminated two letters at the end of the string (&quot;&gt;;&quot;). This is because when we append <code>[a-zA-Z]</code> to the end of our regular expression, we are demanding that whatever string the regular expression parser finds must end with a letter. So when it sees the &quot;&gt;&quot; at the end of &quot;sakaiproject.org&gt;;&quot; it simply stops at the last &quot;matching&quot; letter it found (i.e., the &quot;g&quot; was the last good match).</p>
<p>Also note that the output of the program is a Python list that has a string as the single element in the list.</p>
<h2 id="combining-searching-and-extracting">Combining searching and extracting</h2>
<p>If we want to find numbers on lines that start with the string &quot;X-&quot; such as:</p>
<pre><code>X-DSPAM-Confidence: 0.8475
X-DSPAM-Probability: 0.0000</code></pre>
<p>we don't just want any floating-point numbers from any lines. We only want to extract numbers from lines that have the above syntax.</p>
<p>We can construct the following regular expression to select the lines:</p>
<pre><code>^X-.*: [0-9.]+</code></pre>
<p>Translating this, we are saying, we want lines that start with <code>X-</code>, followed by zero or more characters (<code>.*</code>), followed by a colon (<code>:</code>) and then a space. After the space we are looking for one or more characters that are either a digit (0-9) or a period <code>[0-9.]+</code>. Note that inside the square brackets, the period matches an actual period (i.e., it is not a wildcard between the square brackets).</p>
<p>This is a very tight expression that will pretty much match only the lines we are interested in as follows:</p>
<pre class="python"><code># Search for lines that start with &#39;X&#39; followed by any non
# whitespace characters and &#39;:&#39;
# followed by a space and any number.
# The number can include a decimal.
import re
hand = open(&#39;mbox-short.txt&#39;)
for line in hand:
    line = line.rstrip()
    if re.search(&#39;^X\S*: [0-9.]+&#39;, line):
        print(line)

# Code: http://www.py4e.com/code3/re10.py</code></pre>

<p>When we run the program, we see the data nicely filtered to show only the lines we are looking for.</p>
<pre><code>X-DSPAM-Confidence: 0.8475
X-DSPAM-Probability: 0.0000
X-DSPAM-Confidence: 0.6178
X-DSPAM-Probability: 0.0000</code></pre>
<p>But now we have to solve the problem of extracting the numbers. While it would be simple enough to use <code>split</code>, we can use another feature of regular expressions to both search and parse the line at the same time.</p>
<p></p>
<p>Parentheses are another special character in regular expressions. When you add parentheses to a regular expression, they are ignored when matching the string. But when you are using <code>findall()</code>, parentheses indicate that while you want the whole expression to match, you only are interested in extracting a portion of the substring that matches the regular expression.</p>
<p> </p>
<p>So we make the following change to our program:</p>
<pre class="python"><code># Search for lines that start with &#39;X&#39; followed by any
# non whitespace characters and &#39;:&#39; followed by a space
# and any number. The number can include a decimal.
# Then print the number if it is greater than zero.
import re
hand = open(&#39;mbox-short.txt&#39;)
for line in hand:
    line = line.rstrip()
    x = re.findall(&#39;^X\S*: ([0-9.]+)&#39;, line)
    if len(x) &gt; 0:
        print(x)

# Code: http://www.py4e.com/code3/re11.py</code></pre>

<p>Instead of calling <code>search()</code>, we add parentheses around the part of the regular expression that represents the floating-point number to indicate we only want <code>findall()</code> to give us back the floating-point number portion of the matching string.</p>
<p>The output from this program is as follows:</p>
<pre><code>[&#39;0.8475&#39;]
[&#39;0.0000&#39;]
[&#39;0.6178&#39;]
[&#39;0.0000&#39;]
[&#39;0.6961&#39;]
[&#39;0.0000&#39;]
..</code></pre>
<p>The numbers are still in a list and need to be converted from strings to floating point, but we have used the power of regular expressions to both search and extract the information we found interesting.</p>
<p>As another example of this technique, if you look at the file there are a number of lines of the form:</p>
<pre><code>Details: http://source.sakaiproject.org/viewsvn/?view=rev&amp;rev=39772</code></pre>
<p>If we wanted to extract all of the revision numbers (the integer number at the end of these lines) using the same technique as above, we could write the following program:</p>
<pre class="python"><code># Search for lines that start with &#39;Details: rev=&#39;
# followed by numbers and &#39;.&#39;
# Then print the number if it is greater than zero
import re
hand = open(&#39;mbox-short.txt&#39;)
for line in hand:
    line = line.rstrip()
    x = re.findall(&#39;^Details:.*rev=([0-9.]+)&#39;, line)
    if len(x) &gt; 0:
        print(x)

# Code: http://www.py4e.com/code3/re12.py</code></pre>

<p>Translating our regular expression, we are looking for lines that start with <code>Details:</code>, followed by any number of characters (<code>.*</code>), followed by <code>rev=</code>, and then by one or more digits. We want to find lines that match the entire expression but we only want to extract the integer number at the end of the line, so we surround <code>[0-9]+</code> with parentheses.</p>
<p>When we run the program, we get the following output:</p>
<pre><code>[&#39;39772&#39;]
[&#39;39771&#39;]
[&#39;39770&#39;]
[&#39;39769&#39;]
...</code></pre>
<p>Remember that the <code>[0-9]+</code> is &quot;greedy&quot; and it tries to make as large a string of digits as possible before extracting those digits. This &quot;greedy&quot; behavior is why we get all five digits for each number. The regular expression library expands in both directions until it encounters a non-digit, or the beginning or the end of a line.</p>
<p>Now we can use regular expressions to redo an exercise from earlier in the book where we were interested in the time of day of each mail message. We looked for lines of the form:</p>
<pre><code>From stephen.marquard@uct.ac.za Sat Jan  5 09:14:16 2008</code></pre>
<p>and wanted to extract the hour of the day for each line. Previously we did this with two calls to <code>split</code>. First the line was split into words and then we pulled out the fifth word and split it again on the colon character to pull out the two characters we were interested in.</p>
<p>While this worked, it actually results in pretty brittle code that is assuming the lines are nicely formatted. If you were to add enough error checking (or a big try/except block) to insure that your program never failed when presented with incorrectly formatted lines, the code would balloon to 10-15 lines of code that was pretty hard to read.</p>
<p>We can do this in a far simpler way with the following regular expression:</p>
<pre><code>^From .* [0-9][0-9]:</code></pre>
<p>The translation of this regular expression is that we are looking for lines that start with <code>From</code> (note the space), followed by any number of characters (<code>.*</code>), followed by a space, followed by two digits <code>[0-9][0-9]</code>, followed by a colon character. This is the definition of the kinds of lines we are looking for.</p>
<p>In order to pull out only the hour using <code>findall()</code>, we add parentheses around the two digits as follows:</p>
<pre><code>^From .* ([0-9][0-9]):</code></pre>
<p>This results in the following program:</p>
<pre class="python"><code># Search for lines that start with From and a character
# followed by a two digit number between 00 and 99 followed by &#39;:&#39;
# Then print the number if it is greater than zero
import re
hand = open(&#39;mbox-short.txt&#39;)
for line in hand:
    line = line.rstrip()
    x = re.findall(&#39;^From .* ([0-9][0-9]):&#39;, line)
    if len(x) &gt; 0: print(x)

# Code: http://www.py4e.com/code3/re13.py</code></pre>

<p>When the program runs, it produces the following output:</p>
<pre><code>[&#39;09&#39;]
[&#39;18&#39;]
[&#39;16&#39;]
[&#39;15&#39;]
...</code></pre>
<h2 id="escape-character">Escape character</h2>
<p>Since we use special characters in regular expressions to match the beginning or end of a line or specify wild cards, we need a way to indicate that these characters are &quot;normal&quot; and we want to match the actual character such as a dollar sign or caret.</p>
<p>We can indicate that we want to simply match a character by prefixing that character with a backslash. For example, we can find money amounts with the following regular expression.</p>
<pre class="python"><code>import re
x = &#39;We just received $10.00 for cookies.&#39;
y = re.findall(&#39;\$[0-9.]+&#39;,x)</code></pre>
<p>Since we prefix the dollar sign with a backslash, it actually matches the dollar sign in the input string instead of matching the &quot;end of line&quot;, and the rest of the regular expression matches one or more digits or the period character. <em>Note:</em> Inside square brackets, characters are not &quot;special&quot;. So when we say <code>[0-9.]</code>, it really means digits or a period. Outside of square brackets, a period is the &quot;wild-card&quot; character and matches any character. Inside square brackets, the period is a period.</p>
<h2 id="summary">Summary</h2>
<p>While this only scratched the surface of regular expressions, we have learned a bit about the language of regular expressions. They are search strings with special characters in them that communicate your wishes to the regular expression system as to what defines &quot;matching&quot; and what is extracted from the matched strings. Here are some of those special characters and character sequences:</p>
<p><code>^</code> Matches the beginning of the line.</p>
<p><code>$</code> Matches the end of the line.</p>
<p><code>.</code> Matches any character (a wildcard).</p>
<p><code>\s</code> Matches a whitespace character.</p>
<p><code>\S</code> Matches a non-whitespace character (opposite of \s).</p>
<p><code>*</code> Applies to the immediately preceding character(s) and indicates to match zero or more times.</p>
<p><code>*?</code> Applies to the immediately preceding character(s) and indicates to match zero or more times in &quot;non-greedy mode&quot;.</p>
<p><code>+</code> Applies to the immediately preceding character(s) and indicates to match one or more times.</p>
<p><code>+?</code> Applies to the immediately preceding character(s) and indicates to match one or more times in &quot;non-greedy mode&quot;.</p>
<p><code>?</code> Applies to the immediately preceding character(s) and indicates to match zero or one time.</p>
<p><code>??</code> Applies to the immediately preceding character(s) and indicates to match zero or one time in &quot;non-greedy mode&quot;.</p>
<p><code>[aeiou]</code> Matches a single character as long as that character is in the specified set. In this example, it would match &quot;a&quot;, &quot;e&quot;, &quot;i&quot;, &quot;o&quot;, or &quot;u&quot;, but no other characters.</p>
<p><code>[a-z0-9]</code> You can specify ranges of characters using the minus sign. This example is a single character that must be a lowercase letter or a digit.</p>
<p><code>[^A-Za-z]</code> When the first character in the set notation is a caret, it inverts the logic. This example matches a single character that is anything <em>other than</em> an uppercase or lowercase letter.</p>
<p><code>( )</code> When parentheses are added to a regular expression, they are ignored for the purpose of matching, but allow you to extract a particular subset of the matched string rather than the whole string when using <code>findall()</code>.</p>
<p><code>\b</code> Matches the empty string, but only at the start or end of a word.</p>
<p><code>\B</code> Matches the empty string, but not at the start or end of a word.</p>
<p><code>\d</code> Matches any decimal digit; equivalent to the set [0-9].</p>
<p><code>\D</code> Matches any non-digit character; equivalent to the set [^0-9].</p>
<h2 id="bonus-section-for-unix-linux-users">Bonus section for Unix / Linux users</h2>
<p>Support for searching files using regular expressions was built into the Unix operating system since the 1960s and it is available in nearly all programming languages in one form or another.</p>
<p></p>
<p>As a matter of fact, there is a command-line program built into Unix called <em>grep</em> (Generalized Regular Expression Parser) that does pretty much the same as the <code>search()</code> examples in this chapter. So if you have a Macintosh or Linux system, you can try the following commands in your command-line window.</p>
<pre class="bash"><code>$ grep &#39;^From:&#39; mbox-short.txt
From: stephen.marquard@uct.ac.za
From: louis@media.berkeley.edu
From: zqian@umich.edu
From: rjlowe@iupui.edu</code></pre>
<p>This tells <code>grep</code> to show you lines that start with the string &quot;From:&quot; in the file <em>mbox-short.txt</em>. If you experiment with the <code>grep</code> command a bit and read the documentation for <code>grep</code>, you will find some subtle differences between the regular expression support in Python and the regular expression support in <code>grep</code>. As an example, <code>grep</code> does not support the non-blank character <code>\S</code> so you will need to use the slightly more complex set notation <code>[^ ]</code>, which simply means match a character that is anything other than a space.</p>
<h2 id="debugging">Debugging</h2>
<p>Python has some simple and rudimentary built-in documentation that can be quite helpful if you need a quick refresher to trigger your memory about the exact name of a particular method. This documentation can be viewed in the Python interpreter in interactive mode.</p>
<p>You can bring up an interactive help system using <code>help()</code>.</p>
<pre class="python"><code>&gt;&gt;&gt; help()

help&gt; modules</code></pre>
<p>If you know what module you want to use, you can use the <code>dir()</code> command to find the methods in the module as follows:</p>
<pre class="python trinket"><code>&gt;&gt;&gt; import re
&gt;&gt;&gt; dir(re)
[.. &#39;compile&#39;, &#39;copy_reg&#39;, &#39;error&#39;, &#39;escape&#39;, &#39;findall&#39;,
&#39;finditer&#39;, &#39;match&#39;, &#39;purge&#39;, &#39;search&#39;, &#39;split&#39;, &#39;sre_compile&#39;,
&#39;sre_parse&#39;, &#39;sub&#39;, &#39;subn&#39;, &#39;sys&#39;, &#39;template&#39;]</code></pre>
<p>You can also get a small amount of documentation on a particular method using the dir command.</p>
<pre class="python trinket"><code>&gt;&gt;&gt; help (re.search)
Help on function search in module re:

search(pattern, string, flags=0)
    Scan through string looking for a match to the pattern, returning
    a match object, or None if no match was found.
&gt;&gt;&gt;</code></pre>
<p>The built-in documentation is not very extensive, but it can be helpful when you are in a hurry or don't have access to a web browser or search engine.</p>
<h2 id="glossary">Glossary</h2>
<dl>
<dt>brittle code</dt>
<dd>Code that works when the input data is in a particular format but is prone to breakage if there is some deviation from the correct format. We call this &quot;brittle code&quot; because it is easily broken.
</dd>
<dt>greedy matching</dt>
<dd>The notion that the <code>+</code> and <code>*</code> characters in a regular expression expand outward to match the largest possible string.
</dd>
<dt>grep</dt>
<dd>A command available in most Unix systems that searches through text files looking for lines that match regular expressions. The command name stands for &quot;Generalized Regular Expression Parser&quot;.
</dd>
<dt>regular expression</dt>
<dd>A language for expressing more complex search strings. A regular expression may contain special characters that indicate that a search only matches at the beginning or end of a line or many other similar capabilities.
</dd>
<dt>wild card</dt>
<dd>A special character that matches any character. In regular expressions the wild-card character is the period.
</dd>
</dl>
<h2 id="exercises">Exercises</h2>
<p><strong>Exercise 1: Write a simple program to simulate the operation of the <code>grep</code> command on Unix. Ask the user to enter a regular expression and count the number of lines that matched the regular expression:</strong></p>
<pre><code>$ python grep.py
Enter a regular expression: ^Author
mbox.txt had 1798 lines that matched ^Author

$ python grep.py
Enter a regular expression: ^X-
mbox.txt had 14368 lines that matched ^X-

$ python grep.py
Enter a regular expression: java$
mbox.txt had 4175 lines that matched java$</code></pre>
<p><strong>Exercise 2: Write a program to look for lines of the form:</strong></p>
<pre><code>New Revision: 39772</code></pre>
<p><strong>Extract the number from each of the lines using a regular expression and the <code>findall()</code> method. Compute the average of the numbers and print out the average.</strong></p>
<pre><code>Enter file:mbox.txt
38444.0323119

Enter file:mbox-short.txt
39756.9259259</code></pre>
</body>
</html>
<?php if ( file_exists("../bookfoot.php") ) {
  $HTML_FILE = basename(__FILE__);
  $HTML = ob_get_contents();
  ob_end_clean();
  require_once "../bookfoot.php";
}?>
