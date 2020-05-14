<?php

$EXERCISES =
Array(
"hello" => Array (
"qtext" => "Escriba un programa que use una declaración <b> imprimir </b> para decir 'hello world' como se muestra en 'Salida deseada'",
"desired" => "hello world",
"code" => '# el siguiente código casi funciona
prinq("hello world")',
"checks" => Array(
"print" => "Debe utilizar una declaración print dentro del bucle."
)),

"loop" => Array (
    "qtext" => "Escriba un programa que use un bucle <b> for </b> y la función incorporada
<b> range </b> para escribir tres números como se muestra en 'Salida deseada'",
"desired" => "0
1
2",
"code" => 'print(range(3))',
"checks" => Array(
"for" => "Debes producir los números usando un bucle for.",
"print" => "Debe utilizar una declaración de impresión dentro del bucle.",
"range" => "Debe usar la función de range para generar la lista de números en la declaración for.",
":" => "Su declaración for debe terminar con dos colon (:) y la siguiente línea debe estar sangrada."
)),

"2.2" => Array (
    "qtext" => "<b> 2.2 </ b> Write a program that uses <b> input </ b>
to prompt a user for their name and then
welcomes them. Note that <b> input </ b> will pop up a dialog box.
Enter <b> Sarah </ b> in the pop-up box when you are prompted so your
output will match the desired output.",
"desired" => "Hello Sarah",
"code" => '# El siguiente código casi funciona

name = input("Introduzca su nombre")
print("Hola")',
"checks" => Array(
"input" => "Debe solicitar el nombre del usuario usando la función input().",
"!Sarah" => "Debes pedir el nombre del usuario.",
"print" => "Debe utilizar la declaración de print para imprimir la línea de salida.."
)),

"2.3" => Array(
    "qtext" => "<b> 2.3 </b> Escriba un programa para solicitar al usuario
Horas y tarifa por hora utilizando entrada.
para calcular el salario bruto. Utilice 35 horas y una tasa de 2,75 por hora para probar el
programa (la paga debe ser 96.25). Debes utilizar <b> input() </b> para
lee una cadena y <b> float() </b> para convertir la cadena en un número.
No se preocupe por la comprobación de errores o los datos de usuario incorrectos.",
"desired" => "Paga: 96.25",
"desired2" => "96.25",
"code" => '# Esta primera línea se proporciona para usted

hrs = input("Introduce horas:")',
"checks" => Array(
"input" => "Debe solicitar el pago y la tasa utilizando la función input().",
"print" => "Debe utilizar la función print() para imprimir la salida.",
"float" => "Debe usar la función float () incorporada para convertir de una string a un float.",
"*" => "Para multiplicar el pago y la tarifa después de leerlos, use el operador '*'.",
"!35" => "No debe incluir los datos de entrada en su código fuente. Debe leer los valores de la tarifa y pagar usando input().",
"!2.75" => "No debe incluir los datos de entrada en su código fuente. Debe leer los valores de la tarifa y pagar usando input().",
"!96.25" => "Realmente debe calcular el pago.")),


"3.1" => Array(
"qtext" => "<b> 3.1 </b> Escriba un programa para pedirle al usuario las horas y la tarifa por hora usando la entrada
para calcular el salario bruto. Paga la tarifa por hora por las horas hasta 40 y
1.5 veces la tarifa por hora para todas las horas
Trabajó por encima de las 40 horas. Use 45 horas y una tasa de 10.50 por hora para probar el
programa (la paga debe ser 498.75). Debes utilizar <b> input </b> para
lee una cadena y <b> float () </b> para convertir la cadena en un número.
No se preocupe por la comprobación de errores en la entrada del usuario: suponga que el usuario escribe los números correctamente.
",
"desired" => "498.75",
"desired2" => "Pay: 498.75",
"code" => 'hrs = input("Enter Hours:")
h = float(hrs)',
"checks" => Array(
"input" => "Debe solicitar el pago y la tasa utilizando la función input ().",
"print" => "YDebe utilizar la función print() para imprimir la salida.",
"if" => "Debe usar una sentencia if para decidir si se realiza el cálculo de horas extra o no.",
"float" => "Debería usar la función float () incorporada para convertir de una cadena a un flotador.",
"!45" => "Debe leer los datos utilizando input () y luego convertirlos. El número '45' no debe aparecer en su programa.",
"!10.5" => "Debe leer los datos utilizando input () y luego convertirlos.",
"!498" => "Realmente debe calcular el pago.")),

"3.3" => Array(
"qtext" => "<b> 3.3 </b> Escriba un programa para solicitar una puntuación entre 0.0 y 1.0.
Si el puntaje está fuera de rango, imprima un error. Si el puntaje está entre 0.0 y 1.0,
imprima un grado usando la siguiente tabla:<br/>
Score    Grade<br/>
>= 0.9     A<br/>
>= 0.8     B<br/>
>= 0.7     C<br/>
>= 0.6     D<br/>
< 0.6      F<br/>
Si el usuario ingresa un valor fuera de rango, imprima un mensaje de error adecuado y salga.
Para la prueba, ingrese un puntaje de 0.85.
",
"desired" => "B",
"code" => 'score = input("Enter Score: ")',
"checks" => Array(
"input" => "Debe solicitar la puntuación utilizando la función input().",
"float" => "Debe usar la función float() incorporada para convertir de una cadena a un flotador.",
"print" => "Debe utilizar la función print() para imprimir la salida.",
"if" => "Debe usar una instrucción if para verificar el valor de la puntuación.",
"elif" => "Debe usar una declaración elif para verificar el valor de la puntuación.")
),

"4.6" => Array(
"qtext" => "<b> 4.6 </b> Escriba un programa para avisar al usuario por horas
y tasa por hora utilizando entrada
para calcular el salario bruto. El pago debe ser la tarifa normal por horas hasta 40 y
tiempo y medio para la tarifa por hora para todas las horas trabajadas por encima de las 40 horas.
Ponga la lógica para hacer el cálculo de la paga en
una función llamada <b> computepay() </b>
y usar la función para hacer el cálculo. La función debe devolver un valor.
Use 45 horas y una tasa de 10.50 por hora para probar el
programa (la paga debe ser 498.75).
Debes utilizar <b> input </b> para
lee una cadena y <b> float() </b> para convertir la cadena en un número.
No se preocupe por la comprobación de errores en la entrada del usuario a menos que desee:
Usted puede asumir que el usuario escribe los números correctamente. No nombre su variable
sum o usa la función sum().
",
"desired" => "498.75",
"code" => 'def computepay(h,r):
    return 42.37

hrs = input("Enter Hours:")
p = computepay(10,20)
print("Pay",p)',
"checks" => Array(
"input" => "ebe solicitar el pago y la tasa utilizando la función input().",
"print" => "Debe utilizar la función print() para imprimir la salida.",
"!45" => "Usted debe solicitar los datos.",
"!10.5" => "Usted debe solicitar los datos.",
"if" => "Debe usar una sentencia if para decidir si se realiza el cálculo de horas extra o no.",
"float" => "Debe usar la función float() incorporada para convertir de una cadena a un flotador.",
"def" => "Debe utilizar una función llamada computepay para realizar el cálculo.",
"!sum(" => "No use una variable llamada sum o una función llamada suma ()",
"return" => "Debe usar una declaración return para pasar la devolución calculada al código principal.",
"computepay" => "Debe utilizar una función llamada computepay para realizar el cálculo.",
"!475" => "Realmente debe calcular el pago.")
),

"5.2" => Array(
"qtext" => "<b> 5.2 </b> Escriba un programa que solicite repetidamente números enteros a un usuario
hasta que el usuario ingrese 'hecho'. Una vez que se ingrese 'hecho', imprima el más grande y el más pequeño
de los numeros. Si el usuario ingresa algo que no sea un número válido, cójalo
con un try / except y envía un mensaje apropiado e ignora el número.
Ingrese 7, 2, bob, 10 y 4 y haga coincidir la salida a continuación.
",
"desired" => "Invalid input
Maximum is 10
Minimum is 2",
"code" => 'largest = None
smallest = None
while True:
    num = input("Enter a number: ")
    if num == "hecho" : break
    print(num)

print("Maximum", largest)',
"checks" => Array(
"input" => "Debe solicitar los números utilizando la función input().",
"print" => "Debe utilizar la función print() para imprimir la salida.",
"while" => "Debe usar una declaración while para leer los números.",
"int" => "Debe usar la función int() para convertir de una cadena a un entero.",
"! 2" => "Debes calcular el máximo y el mínimo.",
"!=2" => "Debes calcular el máximo y el mínimo.",
"! 10" => "Debes calcular el máximo y el mínimo.",
"!=10" => "Debes calcular el máximo y el mínimo.",
"try" => "Debes manejar números malos usando una estructura try / except.",
"except" => "Debes manejar números malos usando una estructura try / except.")
),

"6.5" => Array(
"qtext" => "<b>6.5</b> Escriba el código utilizando find() y segmentación de
cadenas (consulte la sección 6.10) para extraer el número al final de la línea de abajo.
Convierta el valor extraído en un número de coma flotante e imprímalo.",
"desired" => "0.8475",
"code" => 'text = "X-DSPAM-Confidence:    0.8475";',
"checks" => Array(
"find" => "You should use the find function to get the position of the colon in the string.",
":" => "You should use string slicing [n:m] to extract data from the string.",
"float" => "You should use the float() function to convert from a string to an integer.",
'!"0.8475"' =>  "You must actually pull the data from the string.")
),

"fopen" => Array(
"qtext" => 'This Python program opens the file
"mbox-short.txt" and counts the number of lines in the file.',
"desired" => "1910 Lines",
"code" => 'fh = open("mbox-short.txt", "r")

count = 0
for line in fh:
   count = count + 1

print(count,"Lines")
'
),

"7.1" => Array(
"qtext" => "<b>7.1</b> 
Escriba un programa que solicite un nombre de archivo, luego abra ese archivo y lea el archivo e imprima el contenido del archivo en mayúsculas. Use el archivo words.txt para producir el resultado de abajo.",
'<p>
Puede descargar los datos de muestra en http://es.py4e.com/code3/words.txt"',
"desired" => "WRITING PROGRAMS OR PROGRAMMING IS A VERY CREATIVE
AND REWARDING ACTIVITY  YOU CAN WRITE PROGRAMS FOR
MANY REASONS RANGING FROM MAKING YOUR LIVING TO SOLVING
A DIFFICULT DATA ANALYSIS PROBLEM TO HAVING FUN TO HELPING
SOMEONE ELSE SOLVE A PROBLEM  THIS BOOK ASSUMES THAT
{\EM EVERYONE} NEEDS TO KNOW HOW TO PROGRAM AND THAT ONCE
YOU KNOW HOW TO PROGRAM, YOU WILL FIGURE OUT WHAT YOU WANT
TO DO WITH YOUR NEWFOUND SKILLS

WE ARE SURROUNDED IN OUR DAILY LIVES WITH COMPUTERS RANGING
FROM LAPTOPS TO CELL PHONES  WE CAN THINK OF THESE COMPUTERS
AS OUR PERSONAL ASSISTANTS WHO CAN TAKE CARE OF MANY THINGS
ON OUR BEHALF  THE HARDWARE IN OUR CURRENT-DAY COMPUTERS
IS ESSENTIALLY BUILT TO CONTINUOUSLY AS US THE QUESTION
WHAT WOULD YOU LIKE ME TO DO NEXT

OUR COMPUTERS ARE FAST AND HAVE VASTS AMOUNTS OF MEMORY AND
COULD BE VERY HELPFUL TO US IF WE ONLY KNEW THE LANGUAGE TO
SPEAK TO EXPLAIN TO THE COMPUTER WHAT WE WOULD LIKE IT TO
DO NEXT IF WE KNEW THIS LANGUAGE WE COULD TELL THE
COMPUTER TO DO TASKS ON OUR BEHALF THAT WERE REPTITIVE
INTERESTINGLY, THE KINDS OF THINGS COMPUTERS CAN DO BEST
ARE OFTEN THE KINDS OF THINGS THAT WE HUMANS FIND BORING
AND MIND-NUMBING",
"code" => '# Use words.txt as the file name
fname = input("Enter file name: ")
fh = open(fname)
',
"xcode" => '# Use words.txt as the file name
fname = input("Enter file name: ")
fh = open(fname)
text = fh.read().strip()
print(text.upper())
',
"checks" => Array(
"input" => "You must prompt for the file name using the input() function.",
"open" => "You need to use open() to open the file.",
"print" => "You must use the print() function to print the lines.",
"strip" => "You should use strip() or rstrip() to avoid double newlines.  You may need to scroll down to see a mis-match of the output.",
"upper" => "You should use the upper() function to convert the lines to upper case.")
),

"7.2" => Array(
"qtext" => '<b>7.2</b> 
Escribir un programa que solicita un nombre de archivo, a continuación, abre el archivo y lee a través del archivo, en busca de líneas de la forma:
<pre>
X-DSPAM-Confidence:    0.8475
</pre>
Cuente estas líneas y extraiga los valores de coma flotante de cada una de las líneas y calcule el promedio de esos valores y produzca una salida como se muestra a continuación. No use la función sum () o una variable llamada sum en su solución.
<p>
Puede descargar los datos de muestra en http://www.py4e.com/code3/mbox-short.txt cuando esté probando a continuación, ingrese cuando esté probando a continuación, ingrese mbox-short.txt como el nombre del archivo. como el nombre del archivo.
<p>
Puede descargar los datos de muestra en 
<a href="http://es.py4e.com/code3/mbox-short.txt" target="_blank">
http://es.py4e.com/code3/mbox-short.txt</a> 
esté probando a continuación, ingrese cuando esté probando a continuación,
ingrese <b>mbox-short.txt</b> como el nombre del archivo. como el nombre del archivo.',
"desired" => "Average spam confidence: 0.750718518519",
"code" => '# Use the file name mbox-short.txt as the file name
fname = input("Enter file name: ")
fh = open(fname)
for line in fh:
    if not line.startswith("X-DSPAM-Confidence:") : continue
    print(line)
print("Done")
',
"xcode" => '# Use the file name mbox-short.txt as the file name
fname = input("Enter file name: ")
fh = open(fname)
tot = 0.0
count = 0
for line in fh:
    if not line.startswith("X-DSPAM-Confidence:") : continue
    words = line.split()
    tot = tot + float(words[1])
    count = count + 1
print("Average spam confidence:", tot/count)
',
"checks" => Array(
"input" => "You must prompt for the file name using the input() function.",
"open" => "You need to use open() to open the file.",
"!sum" => "You should not use the sum() function and avoid using sum as a variable.",
"float" => "You should use the float() function to convert from a string to an integer.",
'!18518' =>  "You must actually pull the data from the strings and convert it.",
"/" => "Average is usually a total / count.")
),

"8.4" => Array(
"qtext" => '<b>8.4</b>
Abra el archivo romeo.txt y léalo línea por línea. Para cada línea, divídala en una lista de palabras usando el método split(). El programa debe construir una lista de palabras. Para cada palabra en cada línea, verifique si la palabra ya está en la lista y, si no, añádala a la lista. Cuando el programa se complete, ordene e imprima las palabras resultantes en orden alfabético.
<p>
Puede descargar los datos de muestra en
<a href="http://es.py4e.com/code3/romeo.txt" target="_blank">
http://es.py4e.com/code3/romeo.txt</a>',
"desired" => "['Arise', 'But', 'It', 'Juliet', 'Who', 'already', 'and', 'breaks', 'east', 'envious', 'fair', 'grief', 'is', 'kill', 'light', 'moon', 'pale', 'sick', 'soft', 'sun', 'the', 'through', 'what', 'window', 'with', 'yonder']",
"code" => 'fname = input("Enter file name: ")
fh = open(fname)
lst = list()
for line in fh:
print(line.rstrip())
',
"xcode" => 'fname = input("Enter file name: ")
fh = open(fname)
lst = list()
for line in fh:
    words = line.split()
    for word in words:
        if word in lst: continue
        lst.append(word)
lst.sort()
print(lst)
',
"checks" => Array(
"split" => "You should use split() to break each line into words.",
"append" => "You should use append() to add the word to the list if it is not there.",
"!extend" => "You should not use extend() in this assignment.",
"open" => "You need to use open() to open the file.",
"sort" => "You need to use sort() to sort the list before you print it out.",
"!'yonder'" => "You should not put the output data in strings",
"for" => "You need two for loops. One for the lines and one for the words on each line.")
),

"8.5" => Array(
"qtext" => "<b>8.5</b> Escriba un programa para leer <b>mbox-short.txt</b> 
Cuando encuentre una línea que comience con 'From' como la siguiente línea:
<pre>
From stephen.marquard@uct.ac.za Sat Jan  5 09:14:16 2008
</pre>
Analizará la línea From utilizando split() e imprimirá la segunda palabra en la línea (es decir, la dirección completa de la persona 
que envió el mensaje). A continuación, imprimir un recuento al final.
</p>
<p>
<b>Sugerencia:</b> asegúrese de no incluir las líneas que comienzan con 'From:'.".
'<p>
Puede descargar los datos de muestra en
<a href="http://es.py4e.com/code3/mbox-short.txt" target="_blank">
http://es.py4e.com/code3/mbox-short.txt</a>',
"desired" => "stephen.marquard@uct.ac.za
louis@media.berkeley.edu
zqian@umich.edu
rjlowe@iupui.edu
zqian@umich.edu
rjlowe@iupui.edu
cwen@iupui.edu
cwen@iupui.edu
gsilver@umich.edu
gsilver@umich.edu
zqian@umich.edu
gsilver@umich.edu
wagnermr@iupui.edu
zqian@umich.edu
antranig@caret.cam.ac.uk
gopal.ramasammycook@gmail.com
david.horwitz@uct.ac.za
david.horwitz@uct.ac.za
david.horwitz@uct.ac.za
david.horwitz@uct.ac.za
stephen.marquard@uct.ac.za
louis@media.berkeley.edu
louis@media.berkeley.edu
ray@media.berkeley.edu
cwen@iupui.edu
cwen@iupui.edu
cwen@iupui.edu
There were 27 lines in the file with From as the first word",
"code" => 'fname = input("Enter file name: ")
if len(fname) < 1 : fname = "mbox-short.txt"

fh = open(fname)
count = 0

print("There were", count, "lines in the file with From as the first word")
',
"xcode" => 'fname = input("Enter file name: ")
if len(fname) < 1 : fname = "mbox-short.txt"

fh = open(fname)
count = 0
for line in fh:
    wds = line.split()
    if len(wds) < 2 : continue
    if wds[0] != "From" : continue
    print(wds[1])
    count = count + 1
print("There were", count, "lines in the file with From as the first word")
',
"checks" => Array(
"for" => "You need a for loop to read the lines in the file.",
"split" => "You should use split() to break each line into words.",
"if" => "You need to use one or more if statements to skip the lines that do not start with 'From '.",
"open" => "You need to use open() to open the file.")
),

"9.4" => Array(
"qtext" => "<b>9.4</b>
Escriba un programa para leer <b>mbox-short.txt</b> y descubra quién ha enviado la mayor cantidad de mensajes de correo. El programa busca líneas 'De' y toma la segunda palabra de esas líneas como la persona que envió el correo. El programa crea un diccionario Python que asigna la dirección de correo del remitente a un recuento de la cantidad de veces que aparecen en el archivo. Después de que se produce el diccionario, el programa lee a través del diccionario utilizando un bucle máximo para encontrar el confirmador más prolífico.",
"desired" => "cwen@iupui.edu 5",
"code" => 'name = input("Enter file:")
if len(name) < 1 : name = "mbox-short.txt"
handle = open(name)
',
"xcode" => 'name = input("Enter file:")
if len(name) < 1 : name = "mbox-short.txt"
handle = open(name)
counts = dict()
for line in handle:
    wds = line.split()
    if len(wds) < 2 : continue
    if wds[0] != "From" : continue
    email = wds[1]
    counts[email] = counts.get(email,0) + 1

bigcount = None
bigname = None
for name,count in counts.items():
    if bigname is None or count > bigcount:
        bigname = name
        bigcount = count

print(bigname, bigcount)
',
"checks" => Array(
"for" => "You need a for loop to read the lines in the file.",
"split" => "You should use split() to break each line into words.",
"!cwen@iupui.edu" => "You need a for loop to read the data in the file.",
"if" => "You need to use one or more if statements to skip the lines that do not start with 'From '.",
"open" => "You need to use open() to open the file.")
),

"10.2" => Array(
"qtext" => "<b>10.2</b> 
Escriba un programa para leer <b>mbox-short.txt</b> y calcule la distribución por hora del día para cada uno de los mensajes. Puede tirar de la hora desde el 'De' línea por encontrar el tiempo y luego dividir la cadena por segunda vez con dos puntos.
<pre>
From stephen.marquard@uct.ac.za Sat Jan  5 <b>09</b>:14:16 2008
</pre>
Una vez que haya acumulado los recuentos de cada hora, imprima los recuentos, ordenados por hora como se muestra a continuación.",
"desired" => "04 3
06 1
07 1
09 2
10 3
11 6
14 1
15 2
16 4
17 2
18 1
19 1",
"code" => 'name = input("Enter file:")
if len(name) < 1 : name = "mbox-short.txt"
handle = open(name)
',
"xcode" => 'name = input("Enter file:")
if len(name) < 1 : name = "mbox-short.txt"
handle = open(name)
counts = dict()
for line in handle:
    wds = line.split()
    if len(wds) < 5 : continue
    if wds[0] != "From" : continue
    when = wds[5]
    tics = when.split(":")
    if len(tics) != 3 : continue
    hour = tics[0]
    counts[hour] = counts.get(hour,0) + 1

lst = counts.items()
lst.sort()

for key, val in lst :
    print(key, val)
',
"checks" => Array(
"for" => "You need a for loop to read the lines in the file.",
"sort" => "You need to use list sort() method to sort the list of times.")
),

"11.1" => Array (
"qtext" => '<b>11.1</b> Sadly, the autograder does not support the regular expression library.
So please write a program that computes the
<b>Answer to the Ultimate Question of Life, the Universe, and Everything</b>
[<a href="http://www.youtube.com/watch?v=aboZctrHfK8" target="_blank">more detail</a>].
Sample output is below.',
"desired" => "42",
"code" => '',
"checks" => Array(
"print" => "By now you should know that a print() function would be helpful here.",
"*" => "I think that multiplication is involved..."
)),

"11.9" => Array(
"qtext" => "<b>11.9</b> Write a program to prompt the user for a regular expression
and read through the <b>mbox-short.txt</b> and count the number of lines that match
the regular expression using re.search().",
"desired" => "04 3
19 1",
"code" => 'import re

string = input("Enter a regular expression:")
if len(name) < 1 : name = "mbox-short.txt"
handle = open("mbox-short.txt")
count = 0
for line in handle:
    if re.search(string) : count = count + 1
print("mbox-short.txt had ", count, "lines that matched", string)

',
"xcode" => 'name = input("Enter file:")
if len(name) < 1 : name = "mbox-short.txt"
handle = open(name)
counts = dict()
for line in handle:
    wds = line.split()
    if len(wds) < 5 : continue
    if wds[0] != "From" : continue
    when = wds[5]
    tics = when.split(":")
    if len(tics) != 3 : continue
    hour = tics[0]
    counts[hour] = counts.get(hour,0) + 1

lst = counts.items()
lst.sort()

for key, val in lst :
    print(key, val)
',
"checks" => Array(
"for" => "You need a for loop to read the lines in the file.",
"sort" => "You need to use list sort() method to sort the list of times.")
)


);
