from party import PartyAnimal

class FootballFan(PartyAnimal):

   def __init__(self, nam) :
       super().__init__(nam)
       self.points = 0

   def touchdown(self):
      self.points = self.points + 7
      self.party()
      print(self.name,"points",self.points)

s = PartyAnimal("Sally")
s.party()
j = FootballFan("Jim")
j.party()
j.touchdown()
print(dir(j))
