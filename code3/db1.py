import sqlite3

conn = sqlite3.connect('musica.sqlite')
cur = conn.cursor()

cur.execute('DROP TABLE IF EXISTS Canciones')
cur.execute('CREATE TABLE Canciones (titulo TEXT, reproducciones INTEGER)')

conn.close()

