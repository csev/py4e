class GrupoAnimal:
   x = 0

   def __init__(self):
     print('Estoy construido')

   def grupo(self) :
     self.x = self.x + 1
     print('Hasta ahora',self.x)

   def __del__(self):
     print('Estoy destruido', self.x)

an = GrupoAnimal()
an.grupo()
an.grupo()
an = 42
print('an contiene',an)
