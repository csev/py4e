man_a = open('mbox-short.txt')
for linea in man_a:
    linea = linea.rstrip()
    # Ignorar 'líneas que no nos interesan'
    if not linea.startswith('From:'):
        continue
    # Procesar la línea que nos 'interesa'
    print(linea)
