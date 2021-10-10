inp = input('Εισαγάγετε τη θερμοκρασία Φαρενάιτ:')
try:
    fahr = float(inp)
    cel = (fahr - 32.0) * 5.0 / 9.0
    print(cel)
except:
    print('Παρακαλώ εισάγετε έναν αριθμό')
