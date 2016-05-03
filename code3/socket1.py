import socket

mysock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
mysock.connect(('www.pythonlearn.com', 80))
cmd = 'GET http://www.pythonlearn.com/code3/romeo.txt HTTP/1.0\n\n'.encode()
mysock.send(cmd);

while True:
    data = mysock.recv(512)
    if ( len(data) < 1 ) :
        break
    print(data.decode());

mysock.close()
