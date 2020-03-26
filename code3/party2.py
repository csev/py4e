class GrupoAnimal:
   x = 0

   def grupo(self) :
     self.x = self.x + 1
     print("Hasta ahora",self.x)

an = GrupoAnimal()
an.grupo()
an.grupo()
an.grupo()
GrupoAnimal.grupo(an)
