class GrupoAnimal:
   x = 0

   def grupo(self) :
     self.x = self.x + 1
     print("Hasta ahora",self.x)

an = GrupoAnimal()
print ("Type", type(an))
print ("Dir ", dir(an))
print ("Type", type(an.x))
print ("Type", type(an.grupo))
