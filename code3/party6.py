from party import GrupoAnimal

class GrilloFan(GrupoAnimal):
   puntos = 0
   def seis(self):
      self.puntos = self.puntos + 6
      self.grupo()
      print(self.nombre,"puntos",self.puntos)

s = GrupoAnimal("Sally")
s.grupo()
j = GrilloFan("Jim")
j.grupo()
j.seis()
print(dir(j))
