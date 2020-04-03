from urllib.request import urlopen
import urllib.error
import twurl
import json
import sqlite3
import ssl

TWITTER_URL = 'https://api.twitter.com/1.1/friends/list.json'

conn = sqlite3.connect('arana.sqlite')
cur = conn.cursor()

cur.execute('''
            CREATE TABLE IF NOT EXISTS Twitter
            (nombre TEXT, recuperado INTEGER, amigos INTEGER)''')

# Ignorar errores de certificado SSL
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

while True:
    cuenta = input('Ingresa una cuenta de Twitter, o salir: ')
    if (cuenta == 'salir'): break
    if (len(cuenta) < 1):
        cur.execute('''SELECT nombre FROM Twitter 
            WHERE recuperado = 0 LIMIT 1''')
        try:
            cuenta = cur.fetchone()[0]
        except:
            print('No se han encontrado cuentas de Twitter por recuperar')
            continue

    url = twurl.aumentar(TWITTER_URL, {'screen_name': cuenta, 'count': '5'})
    print('Recuperando', url)
    conexion = urlopen(url, context=ctx)
    datos = conexion.read().decode()
    cabeceras = dict(conexion.getheaders())

    print('Restante', cabeceras['x-rate-limit-remaining'])
    js = json.loads(datos)
    # Depuración
    # print json.dumps(js, indent=4)

    cur.execute('''UPDATE Twitter 
            SET recuperado=1 WHERE nombre = ?''', (cuenta, ))

    contnuevas = 0
    contantiguas = 0
    for u in js['users']:
        amigo = u['screen_name']
        print(amigo)
        cur.execute('SELECT amigos FROM Twitter WHERE nombre = ? LIMIT 1',
                    (amigo, ))
        try:
            contador = cur.fetchone()[0]
            cur.execute('UPDATE Twitter SET amigos = ? WHERE nombre = ?',
                        (contador+1, amigo))
            contantiguas = contantiguas + 1
        except:
            cur.execute('''INSERT INTO Twitter (nombre, recuperado, amigos)
                        VALUES (?, 0, 1)''', (amigo, ))
            contnuevas = contnuevas + 1
    print('Cuentas nuevas=', contnuevas, ' ya visitadas=', contantiguas)
    conn.commit()

cur.close()
