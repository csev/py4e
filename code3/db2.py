import sqlite3

conn = sqlite3.connect('musica.sqlite')
cur = conn.cursor()

cur.execute('INSERT INTO Canciones (titulo, reproducciones) VALUES (?, ?)', 
    ('Thunderstruck', 20))
cur.execute('INSERT INTO Canciones (titulo, reproducciones) VALUES (?, ?)', 
    ('My Way', 15))
conn.commit()

print('Canciones:')
cur.execute('SELECT titulo, reproducciones FROM Canciones')
for fila in cur:
     print(fila)

cur.execute('DELETE FROM Canciones WHERE reproducciones < 100')
conn.commit()

cur.close()
