<?php

$EXERCISES =
Array(
"hello" => Array (
"qtext" => "Escriba un programa que use una declaración <b> print </b> para decir 'hello world' como se muestra en 'Salida deseada'",
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
"print" => "Debe utilizar una declaración print dentro del bucle.",
"range" => "Debe usar la función de range para generar la lista de números en la declaración for.",
":" => "Su declaración for debe terminar con dos puntos (:) y la siguiente línea debe estar indentada."
)),

"2.2" => Array (
    "qtext" => "<b> 2.2 </ b> Escriba un programa que utilice <b> input </ b>
para solicitar al usuario su nombre y después darle la bienvenida. Nótese
que <b> input </ b> va a mostrar una ventana de diálogo.
Ingresa <b> Sarah </ b> en la ventana de diálogo cuando se te solicite de forma
que la salida coincida con la salida esperada.",
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
Horas y tarifa por hora utilizando la función input
para calcular el salario bruto. Utilice 35 horas y una tasa de 2,75 por hora para probar el
programa (la paga debe ser 96.25). Debes utilizar <b> input() </b> para
leer una cadena y <b> float() </b> para convertir la cadena en un número.
No se preocupe por la comprobación de errores o los datos de usuario incorrectos.",
"desired" => "Paga: 96.25",
"desired2" => "96.25",
"code" => '# Esta primera línea se proporciona para usted

hrs = input("Introduce horas:")',
"checks" => Array(
"input" => "Debe solicitar el pago y la tasa utilizando la función input().",
"print" => "Debe utilizar la función print() para imprimir la salida.",
"float" => "Debe usar la función float () incorporada para convertir de una cadena a un número flotante.",
"*" => "Para multiplicar el pago y la tarifa después de leerlos, use el operador '*'.",
"!35" => "No debe incluir los datos de entrada en su código fuente. Debe leer los valores de la tarifa y pagar usando input().",
"!2.75" => "No debe incluir los datos de entrada en su código fuente. Debe leer los valores de la tarifa y pagar usando input().",
"!96.25" => "Realmente debe calcular el pago.")),


"3.1" => Array(
"qtext" => "<b> 3.1 </b> Escriba un programa para pedirle al usuario las horas y la tarifa por hora usando la entrada
para calcular el salario bruto. Paga la tarifa por hora por las horas hasta 40 y
1.5 veces la tarifa por hora para todas las horas
que se trabajaron por encima de las 40 horas. Use 45 horas y una tasa de 10.50 por hora para probar el
programa (la paga debe ser 498.75). Debes utilizar <b> input </b> para
leer una cadena y <b> float () </b> para convertir la cadena en un número.
No se preocupe por la comprobación de errores en la entrada del usuario: suponga que el usuario escribe los números correctamente.
",
"desired" => "498.75",
"desired2" => "Pay: 498.75",
"code" => 'hrs = input("Ingrese Horas:")
h = float(hrs)',
"checks" => Array(
"input" => "Debe solicitar el pago y la tasa utilizando la función input ().",
"print" => "Debe utilizar la función print() para imprimir la salida.",
"if" => "Debe usar una sentencia if para decidir si se realiza el cálculo de horas extra o no.",
"float" => "Debe usar la función float () incorporada para convertir de una cadena a un flotante.",
"!45" => "Debe leer los datos utilizando input () y luego convertirlos. El número '45' no debe aparecer en su programa.",
"!10.5" => "Debe leer los datos utilizando input () y luego convertirlos.",
"!498" => "Realmente debe calcular el pago.")),

"3.3" => Array(
"qtext" => "<b> 3.3 </b> Escriba un programa para solicitar una puntuación entre 0.0 y 1.0.
Si el puntaje está fuera de rango, imprima un error. Si el puntaje está entre 0.0 y 1.0,
imprima un grado usando la siguiente tabla:<br/>
Score    Grado<br/>
>= 0.9     A<br/>
>= 0.8     B<br/>
>= 0.7     C<br/>
>= 0.6     D<br/>
< 0.6      F<br/>
Si el usuario ingresa un valor fuera de rango, imprima un mensaje de error adecuado y salga.
Para probar el código, ingrese un puntaje de 0.85.
",
"desired" => "B",
"code" => 'score = input("Ingresa puntaje: ")',
"checks" => Array(
"input" => "Debe solicitar la puntuación utilizando la función input().",
"float" => "Debe usar la función float() incorporada para convertir de una cadena a un flotador.",
"print" => "Debe utilizar la función print() para imprimir la salida.",
"if" => "Debe usar una instrucción if para verificar el valor de la puntuación.",
"elif" => "Debe usar una declaración elif para verificar el valor de la puntuación.")
),

"4.6" => Array(
"qtext" => "<b> 4.6 </b> Escriba un programa para avisar al usuario por horas
y tasa por hora utilizando input
para calcular el salario bruto. El pago debe ser la tarifa normal por horas hasta 40 y
1.5 veces para la tarifa por hora para todas las horas trabajadas por encima de las 40 horas.
Ponga la lógica para hacer el cálculo de la paga en
una función llamada <b> computepay() </b>
y use la función para hacer el cálculo. La función debe devolver un valor.
Use 45 horas y una tasa de 10.50 por hora para probar el
programa (la paga debe ser 498.75).
Debes utilizar <b> input </b> para
lee una cadena y <b> float() </b> para convertir la cadena en un número.
No se preocupe por la comprobación de errores en la entrada del usuario a menos que desee:
Usted puede asumir que el usuario escribe los números correctamente. No nombre su variable
sum o use la función sum().
",
"desired" => "498.75",
"code" => 'def computepay(h,r):
    return 42.37

hrs = input("Ingrese horas:")
p = computepay(10,20)
print("Paga",p)',
"checks" => Array(
"input" => "Debe solicitar el pago y la tasa utilizando la función input().",
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
de los numeros. Si el usuario ingresa algo que no sea un número válido, atrápelo
con un try / except y envíe un mensaje apropiado e ignore el número.
Ingrese 7, 2, bob, 10 y 4 y haga coincidir la salida a continuación.
",
"desired" => "Valor inválido
Máximo es 10
Mínimo es 2",
"code" => 'largest = None
smallest = None
while True:
    num = input("Ingrese un número: ")
    if num == "hecho" : break
    print(num)

print("Máximo es", largest)',
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
"qtext" => "<b>6.5</b> Escriba el código utilizando find() y rebanado de
cadenas (consulte la sección 6.10) para extraer el número al final de la línea de abajo.
Convierta el valor extraído en un número de coma flotante e imprímalo.",
"desired" => "0.8475",
"code" => 'text = "X-DSPAM-Confidence:    0.8475";',
"checks" => Array(
"find" => "Debes utilizar la función find para obtener la posición de los dos puntos en la cadena.",
":" => "Debes utilizar el rebanado de cadenas [n:m] para extraer datos de la cadena.",
"float" => "Debes utilizar la función float() para convertir de cadena a entero.",
'!"0.8475"' =>  "De hecho debes obtener los datos de la cadena.")
),

"fopen" => Array(
"qtext" => 'Este programa de Python abre el archivo
"mbox-short.txt" y cuenta el número de líneas en el archivo.',
"desired" => "1910 Lineas",
"code" => 'fh = open("mbox-short.txt", "r")

cuenta = 0
for linea in fh:
   cuenta = cuenta + 1

print(cuenta,"Lineas")
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
"code" => '# Usa words.txt como nombre de archivo
fname = input("Ingresa un nombre de archivo: ")
fh = open(fname)
',
"xcode" => '# Usa words.txt como nombre de archivo
fname = input("Ingresa un nombre de archivo: ")
fh = open(fname)
text = fh.read().strip()
print(text.upper())
',
"checks" => Array(
"input" => "Debes solicitar el nombre de archivo usando la función input().",
"open" => "Debes utilizar open() para abrir el archivo.",
"print" => "Debes utilizar la función print() para imprimir las líneas.",
"strip" => "Debes utilizar strip() o rstrip() para evitar dobles saltos de línea. Puede que necesites recorrer hacia abajo para ver una diferencia en la salida.",
"upper" => "Debes utilizar la función upper() para convertir las líneas a mayúsculas.")
),

"7.2" => Array(
"qtext" => '<b>7.2</b> 
Escribir un programa que solicita un nombre de archivo, a continuación, abre el archivo y lee a través del archivo, en busca de líneas de la forma:
<pre>
X-DSPAM-Confidence:    0.8475
</pre>
Cuenta estas líneas y extrae los valores de coma flotante de cada una de las líneas y calcula el promedio de esos valores y produce una salida como se muestra a continuación. No uses la función sum () o una variable llamada sum en tu solución.
<p>
Puedes descargar los datos de muestra en 
<a href="http://es.py4e.com/code3/mbox-short.txt" target="_blank">
http://es.py4e.com/code3/mbox-short.txt</a> 
para probar la función, ingrese <b>mbox-short.txt</b> como el nombre del archivo.',
"desired" => "Average spam confidence: 0.750718518519",
"code" => '# Usa mbox-short.txt como el nombre de archivo
fname = input("Ingresa un nombre de archivo: ")
fh = open(fname)
for linea in fh:
    if not linea.startswith("X-DSPAM-Confidence:") : continue
    print(linea)
print("Hecho")
',
"xcode" => '# Utiliza mbox-short.txt como nombre de archivo
fname = input("Ingresa un nombre de archivo: ")
fh = open(fname)
tot = 0.0
cuenta = 0
for linea in fh:
    if not linea.startswith("X-DSPAM-Confidence:") : continue
    palabras = linea.split()
    tot = tot + float(palabras[1])
    cuenta = cuenta + 1
print("Average spam confidence:", tot/cuenta)
',
"checks" => Array(
"input" => "Debes solicitar el nombre de archivo usando la función input().",
"open" => "Debes utilizar la función open() para abrir el archivo.",
"!sum" => "No debes utilizar la función sum() y evitar usar sum como nombre de variable.",
"float" => "Debes utilizar la función float() para convertir de una cadena a un entero.",
'!18518' =>  "Debes obtener los datos de las cadenas y convertirlas.",
"/" => "Promedio es normalmente total / cuenta.")
),

"8.4" => Array(
"qtext" => '<b>8.4</b>
Abra el archivo romeo.txt y léalo línea por línea. Para cada línea, divídala en una lista de palabras usando el método split(). El programa debe construir una lista de palabras. Para cada palabra en cada línea, verifique si la palabra ya está en la lista y, si no, añádala a la lista. Cuando el programa se complete, ordene e imprima las palabras resultantes en orden alfabético.
<p>
Puede descargar los datos de muestra en
<a href="http://es.py4e.com/code3/romeo.txt" target="_blank">
http://es.py4e.com/code3/romeo.txt</a>',
"desired" => "['Arise', 'But', 'It', 'Juliet', 'Who', 'already', 'and', 'breaks', 'east', 'envious', 'fair', 'grief', 'is', 'kill', 'light', 'moon', 'pale', 'sick', 'soft', 'sun', 'the', 'through', 'what', 'window', 'with', 'yonder']",
"code" => 'fname = input("Ingresa un nombre de archivo: ")
fh = open(fname)
lst = list()
for linea in fh:
print(linea.rstrip())
',
"xcode" => 'fname = input("Ingresa un nombre de archivo: ")
fh = open(fname)
lst = list()
for linea in fh:
    palabras = linea.split()
    for palabra in palabras:
        if palabra in lst: continue
        lst.append(palabra)
lst.sort()
print(lst)
',
"checks" => Array(
"split" => "Debes utilizar split() para dividir cada línea en palabras.",
"append" => "Debes utilizar append() para agregar la palabra a la lista si no se encuentra ahí.",
"!extend" => "No debes utilizar extend() en esta asignación.",
"open" => "Necesitas usar open() para abrir el archivo.",
"sort" => "Necesitas utilizar sort() para ordenar la lista antes de imprimirla.",
"!'yonder'" => "No debes poner los datos de salida en cadenas",
"for" => "Necesitas dos bucles for. Uno para las líneas y otro para las palabras en cada línea.")
),

"8.5" => Array(
"qtext" => "<b>8.5</b> Escribe un programa para leer <b>mbox-short.txt</b> 
Cuando encuentres una línea que comience con 'From' como la siguiente línea:
<pre>
From stephen.marquard@uct.ac.za Sat Jan  5 09:14:16 2008
</pre>
Analiza la línea From utilizando split() e imprime la segunda palabra en la línea (es decir, la dirección completa de la persona 
que envió el mensaje). A continuación, imprime un recuento al final.
</p>
<p>
<b>Sugerencia:</b> asegúrate de no incluir las líneas que comienzan con 'From:'.".
'<p>
Puedes descargar los datos de muestra en
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
Hay 27 lineas en el archivo con From como la primer palabra",
"code" => 'fname = input("Ingresa un nombre de archivo: ")
if len(fname) < 1 : fname = "mbox-short.txt"

fh = open(fname)
count = 0

print("Hay", count, "lineas en el archivo con From como la primer palabra")
',
"xcode" => 'fname = input("Ingresa un nombre de archivo: ")
if len(fname) < 1 : fname = "mbox-short.txt"

fh = open(fname)
cuenta = 0
for linea in fh:
    pbs = linea.split()
    if len(pbs) < 2 : continue
    if pbs[0] != "From" : continue
    print(pbs[1])
    cuenta = cuenta + 1
print("Hay", cuenta, "lineas en el archivo con From como la primer palabra")
',
"checks" => Array(
"for" => "Necesitas un bucle for para leer las lineas del archivo.",
"split" => "Debes utilizar split() para separar cada linea en palabras.",
"if" => "Debes utilizar una o más sentencias if para saltar las líneas que no empiezan con 'From '.",
"open" => "Necesitas utilizar open() para abrir el archivo.")
),

"9.4" => Array(
"qtext" => "<b>9.4</b>
Escribe un programa para leer <b>mbox-short.txt</b> y encuentra quién ha enviado la mayor cantidad de mensajes de correo. El programa busca líneas 'De' y toma la segunda palabra de esas líneas como la persona que envió el correo. El programa crea un diccionario Python que asigna la dirección de correo del remitente a un recuento de la cantidad de veces que aparecen en el archivo. Después de que se produce el diccionario, el programa lee a través del diccionario utilizando un bucle máximo para encontrar la dirección que más envíos tuvo.",
"desired" => "cwen@iupui.edu 5",
"code" => 'name = input("Ingresa un nombre de archivo:")
if len(name) < 1 : name = "mbox-short.txt"
handle = open(name)
',
"xcode" => 'name = input("Ingresa un nombre de archivo:")
if len(name) < 1 : name = "mbox-short.txt"
handle = open(name)
cuentas = dict()
for linea in handle:
    wds = linea.split()
    if len(wds) < 2 : continue
    if wds[0] != "From" : continue
    email = wds[1]
    cuentas[email] = cuentas.get(email,0) + 1

bigcount = None
bigname = None
for name,count in cuentas.items():
    if bigname is None or count > bigcount:
        bigname = name
        bigcount = count

print(bigname, bigcount)
',
"checks" => Array(
"for" => "Necesitas un bucle for para leer las líneas en el archivo.",
"split" => "Debes utilizar split() para separar cada linea en palabras.",
"!cwen@iupui.edu" => "Necesitas un bucle for para leer los datos en el archivo.",
"if" => "Necesitas utilizar una o más sentencias if para saltar las líneas que no comienzan con 'From '.",
"open" => "Necesitas utilizar open() para abrir el archivo.")
),

"10.2" => Array(
"qtext" => "<b>10.2</b> 
Escriba un programa para leer <b>mbox-short.txt</b> y calcule la distribución por hora del día para cada uno de los mensajes. Puede obtener la hora desde las líneas que comienzan con 'From' para encontrar el tiempo y luego dividir la cadena por segunda vez con dos puntos.
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
"code" => 'name = input("Ingresa un nombre de archivo:")
if len(name) < 1 : name = "mbox-short.txt"
handle = open(name)
',
"xcode" => 'name = input("Ingresa un nombre de archivo:")
if len(name) < 1 : name = "mbox-short.txt"
handle = open(name)
cuentas = dict()
for linea in handle:
    wds = linea.split()
    if len(wds) < 5 : continue
    if wds[0] != "From" : continue
    cuando = wds[5]
    tics = cuando.split(":")
    if len(tics) != 3 : continue
    hora = tics[0]
    cuentas[hora] = cuentas.get(hora,0) + 1

lst = cuentas.items()
lst.sort()

for key, val in lst :
    print(key, val)
',
"checks" => Array(
"for" => "Necesitas un bucle for para leer las líneas en el archivo.",
"sort" => "Necesitas utilizar el método de lista sort() para ordenar la lista de tiempos.")
),

"11.1" => Array (
"qtext" => '<b>11.1</b> Tristemente, el autoevaluador no soporta la librería de expresiones regulares.
Por favor escribe un programa que calcula la
<b>Respuesta a la Pregunta Máxima de la Vida, el Universo, y Todo</b>
[<a href="http://www.youtube.com/watch?v=aboZctrHfK8" target="_blank">more detail</a>].
El ejemplo de salida está abajo.',
"desired" => "42",
"code" => '',
"checks" => Array(
"print" => "Ya deberías saber que la función print() sería útil aquí.",
"*" => "Pienso que la multiplicación está involucrada aquí..."
)),

"11.9" => Array(
"qtext" => "<b>11.9</b> Escribe un programa que solicite al usuario una expresión regular
y lee a través de <b>mbox-short.txt</b> y cuenta el número de líneas que coinciden con la
expresión regular usando la función re.search().",
"desired" => "04 3
19 1",
"code" => 'import re

string = input("Ingresa una expresión regular:")
if len(name) < 1 : name = "mbox-short.txt"
handle = open("mbox-short.txt")
cuenta = 0
for linea in handle:
    if re.search(string) : cuenta = cuenta + 1
print("mbox-short.txt tiene ", cuenta, "lineas que coinciden", string)

',
"xcode" => 'name = input("Ingresa un nombre de archivo:")
if len(name) < 1 : name = "mbox-short.txt"
handle = open(name)
cuentas = dict()
for linea in handle:
    wds = linea.split()
    if len(wds) < 5 : continue
    if wds[0] != "From" : continue
    cuando = wds[5]
    tics = cuando.split(":")
    if len(tics) != 3 : continue
    hora = tics[0]
    cuentas[hora] = cuentas.get(hora,0) + 1

lst = cuentas.items()
lst.sort()

for key, val in lst :
    print(key, val)
',
"checks" => Array(
"for" => "Necesitas un bucle for para leer las líneas en el archivo.",
"sort" => "Necesitas utilizar el método de lista sort() para ordenar la lista de tiempos.")
)


);
