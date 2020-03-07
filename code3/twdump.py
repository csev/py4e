import sqlite3

conn = sqlite3.connect('arana.sqlite')
cur = conn.cursor()
cur.execute('SELECT * FROM Twitter')
contador = 0
for fila in cur:
    print(fila)
    contador = contador + 1
print(contador, 'filas.')
cur.close()
