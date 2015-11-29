<?php

$EXERCISES = Array(
"hello" => Array (
"qtext" => "Write a program that uses a <b>print</b> statement to say 'hello world'
as shown below.",
"desired" => "hello world",
"code" => 'prinq "hello world"',
"checks" => Array(
"print" => "You must use a print statement within the loop."
)),

"loop" => Array (
"qtext" => "Write a program that uses a <b>for</b> loop  and the built-in function 
<b>range</b> to write out three numbers as shown below.",
"desired" => "0
1
2",
"code" => 'print range(3)',
"checks" => Array(
"for" => "You must produce the numbers using a for loop.",
"print" => "You must use a print statement within the loop.",
"range" => "You should use the range function to generate the list of numbers on the for statement.",
":" => "Your for statement should end with a colon (:) and the following line should be indented"
)),

"2.2" => Array (
"qtext" => "Write a program that uses raw_input to prompt a user for their name and then
welcomes them.",
"desired" => "Hello Sarah",
"code" => '# This first line is provided for you

name = raw_input("Enter your name")',
"checks" => Array(
"raw_input" => "You must prompt for the user's name using the raw_input() function.",
"print" => "You must use the print statement to print the line of output."
)),

"2.3" => Array(
"qtext" => "Write a program to prompt the user for hours and rate per hour using raw_input
to compute gross pay.  Use 35 hours and a rate of 2.75 per hour to test the 
program (the pay should be 96.25).  You should use <b>raw_input</b> to 
read a string and <b>float()</b> to convert the string to a number.
Do not worry about error checking.",
"desired" => "Pay: 96.25",
"code" => '# This first line is provided for you

hrs = raw_input("Enter Hours:")',
"checks" => Array(
"raw_input" => "You must prompt the pay and rate using the raw_input() function.",
"print" => "You must use the print statement to print the output.",
"float" => "You should use the built-in float() function to convert from a string to a float.",
"!96.25" => "You must actually calculate the pay."))
);
?>

