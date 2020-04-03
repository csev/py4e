import urllib.request, urllib.parse, urllib.error
import twurl
import json
import sqlite3
import ssl

TWITTER_URL = 'https://api.twitter.com/1.1/friends/list.json'

conn = sqlite3.connect('amigos.sqlite')
cur = conn.cursor()

cur.execute('''CREATE TABLE IF NOT EXISTS Personas
    (id INTEGER PRIMARY KEY, nombre TEXT UNIQUE, recuperado INTEGER)''')
cur.execute('''CREATE TABLE IF NOT EXISTS Seguimientos
    (desde_id INTEGER, hacia_id INTEGER, UNIQUE(desde_id, hacia_id))''')

# Ignore SSL certificate errors
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

while True:
    cuenta = input('Ingresa una cuenta de Twitter, o salir: ')
    if (cuenta == 'salir'): break
    if (len(cuenta) < 1):
        cur.execute('''SELECT id, nombre FROM Personas
                WHERE recuperado=0 LIMIT 1''')
        try:
            (id, cuenta) = cur.fetchone()
        except:
            print('No se han encontrado cuentas de Twitter sin recuperar')
            continue
    else:
        cur.execute('SELECT id FROM Personas WHERE nombre = ? LIMIT 1',
                    (cuenta, ))
        try:
            id = cur.fetchone()[0]
        except:
            cur.execute('''INSERT OR IGNORE INTO Personas
                        (nombre, recuperado) VALUES (?, 0)''', (cuenta, ))
            conn.commit()
            if cur.rowcount != 1:
                print('Error insertando cuenta:', cuenta)
                continue
            id = cur.lastrowid

    url = twurl.aumentar(TWITTER_URL, 
            {'screen_name': cuenta, 'count': '100'})
    print('Recuperando cuenta', cuenta)
    try:
        conexion = urllib.request.urlopen(url, context=ctx)
    except Exception as err:
        print('Fallo al recuperar', err)
        break

    datos = conexion.read().decode()
    cabeceras = dict(conexion.getheaders())

    print('Restantes', cabeceras['x-rate-limit-remaining'])

    try:
        js = json.loads(datos)
    except:
        print('Fallo al analizar json')
        print(datos)
        break

    # Depuración
    # print(json.dumps(js, indent=4))

    if 'users' not in js:
        print('JSON incorrecto recibido')
        print(json.dumps(js, indent=4))
        continue

    cur.execute('UPDATE Personas SET recuperado=1 WHERE nombre = ?', (cuenta, ))

    contnuevas = 0
    contantiguas = 0
    for u in js['users']:
        amigo = u['screen_name']
        print(amigo)
        cur.execute('SELECT id FROM Personas WHERE nombre = ? LIMIT 1',
                    (amigo, ))
        try:
            amigo_id = cur.fetchone()[0]
            contantiguas = contantiguas + 1
        except:
            cur.execute('''INSERT OR IGNORE INTO Personas
                (nombre, recuperado) VALUES (?, 0)''', (amigo, ))
            conn.commit()
            if cur.rowcount != 1:
                print('Error inserting account:', amigo)
                continue
            amigo_id = cur.lastrowid
            contnuevas = contnuevas + 1
        cur.execute('''INSERT OR IGNORE INTO Seguimientos
             (desde_id, hacia_id) VALUES (?, ?)''', (id, amigo_id))
    print('Cuentas nuevas=', contnuevas, ' ya visitadas=', contantiguas)
    print('Restantes', cabeceras['x-rate-limit-remaining'])
    conn.commit()
cur.close()
