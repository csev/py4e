import urllib.request, urllib.parse, urllib.error
import oauth
import hidden

# https://apps.twitter.com/
# Crear App y obtener las cuatro cadenas, luego colocarlas en hidden.py

def aumentar(url, parametros):
    credenciales = hidden.oauth()
    consumidor = oauth.OAuthConsumer(credenciales['consumer_key'],
                                     credenciales['consumer_secret'])
    token = oauth.OAuthToken(credenciales['token_key'], credenciales['token_secret'])

    oauth_solicitud = oauth.OAuthRequest.from_consumer_and_token(consumidor,
                      token=token, http_method='GET', http_url=url,
                      parameters=parametros)
    oauth_solicitud.sign_request(oauth.OAuthSignatureMethod_HMAC_SHA1(),
                                 consumidor, token)
    return oauth_solicitud.to_url()


def pruebame():
    print('* Conectando a Twitter...')
    url = aumentar('https://api.twitter.com/1.1/statuses/user_timeline.json',
                  {'screen_name': 'drchuck', 'count': '2'})
    print(url)
    conexion = urllib.request.urlopen(url)
    datos = conexion.read()
    print(datos)
    cabeceras = dict(conexion.getheaders())
    print(cabeceras)
