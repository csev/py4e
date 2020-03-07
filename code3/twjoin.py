import sqlite3

conn = sqlite3.connect('amigos.sqlite')
cur = conn.cursor()

cur.execute('SELECT * FROM Personas')
contador = 0
print('Personas:')
for fila in cur:
    if contador < 5: print(fila)
    contador = contador + 1
print(contador, 'filas.')

cur.execute('SELECT * FROM Seguimientos')
contador = 0
print('Seguimientos:')
for fila in cur:
    if contador < 5: print(fila)
    contador = contador + 1
print(contador, 'filas.')

cur.execute('''SELECT * FROM Seguimientos JOIN Personas
            ON Seguimientos.hacia_id = Personas.id
            WHERE Seguimientos.desde_id = 2''')
contador = 0
print('Conexiones para id=2:')
for fila in cur:
    if contador < 5: print(fila)
    contador = contador + 1
print(contador, 'filas.')

cur.close()
