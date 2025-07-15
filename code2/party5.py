class PartyAnimal:
   x = 0
   name = ""
   def __init__(self, nam):
     self.name = nam
     print self.name,"constructed"

   def party(self) :
     self.x = self.x + 1
     print self.name,"party count",self.x

class FootballFan(PartyAnimal):
   points = 0
   def touchdown(self):
      self.points = self.points + 7
      self.party()
      print self.name,"points",self.points

s = PartyAnimal("Sally")
s.party()

j = FootballFan("Jim")
j.party()
j.touchdown()

